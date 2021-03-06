<?php

class FluxoSettingsPage
{
	/**
	 * Holds the values to be used in the fields callbacks
	 */
	private $options;

	/**
	 * Start up
	 */
	public function __construct()
	{
		add_action( 'admin_menu', array( $this, 'add_theme_page' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );
	}

	/**
	 * Add options page
	 */
	public function add_theme_page()
	{
		// This page will be under "Settings"
		$page_hook = add_management_page( 
			__('Importar do arquivo','fluxo'),
			__('Importar do arquivo','fluxo'),
			'import',
			'fluxo-import-file',
			array(&$this, 'create_admin_page')
		);
		//add_action('load-' . $page_hook, array(&$this, 'admin_load'));
		
	}

	/**
	 * Options page callback
	 */
	public function create_admin_page()
	{
		// Set class property
		$this->options = get_option( 'fluxo_theme_options', array() );
		?>
        <div class="wrap">
            <h2><?php _e('Import File Tool', 'fluxo') ?></h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'fluxo_option_group' );   
                do_settings_sections( 'fluxo-import-file' );
                submit_button("Check Estado/Cidades", 'secundary', 'check-estado-cidade' );
                submit_button("Importar Csv", 'secundary', 'importcsv' );
                submit_button("Importar Pins", 'secundary', 'importpins' );
                submit_button(); 
            ?>
            </form>
            <div id="result">
            </div>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'fluxo_option_group', // Option group
            'fluxo_theme_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_estatos_cidades', // ID
            __('Importações personalizadas', 'fluxo'), // Title
            array( $this, 'print_section_info' ), // Callback
            'fluxo-import-file' // Page
        );  

        add_settings_field(
            'criar_estatos_cidades', // ID
            'Criar Estatos e Cidades?', // Title 
            array( $this, 'criar_estatos_cidades_callback' ), // Callback
            'fluxo-import-file', // Page
            'setting_estatos_cidades' // Section           
        );
        
        update_option('setting_estatos_cidades', 'N');
        
		if(array_key_exists('page', $_REQUEST) && $_REQUEST['page'] == 'fluxo-import-file')
		{
			wp_register_script('fluxo_import_scripts', get_template_directory_uri() . '/assets/js/fluxo_import_scripts.js', array('jquery'));
			
			wp_enqueue_script('fluxo_import_scripts');
					
			wp_localize_script( 'fluxo_import_scripts', 'fluxo_import_scripts_object',
			array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );
		}
		add_action( 'wp_ajax_ImportarCsv', array($this, 'ImportarCsv_callback') );
		add_action( 'wp_ajax_ImportPins', array($this, 'ImportPins') );
		add_action( 'wp_ajax_CheckEstadoCidade', array('EstadosCidades', 'check_location_terms') );
		
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( array_key_exists('criar_estatos_cidades', $input ))
        {
			$new_input['criar_estatos_cidades'] = $input['criar_estatos_cidades'] == 'S'? 'S' : 'N';
        
			if($new_input['criar_estatos_cidades'] == 'S')
			{
				if(!is_array($this->options))
	        		$this->options = get_option( 'fluxo_theme_options', array() );
				
	        	if( !array_key_exists('criar_estatos_cidades', $this->options) || $this->options['criar_estatos_cidades'] != 'S')
	        	{
	        		ini_set("memory_limit", "2048M");
	        		set_time_limit(0);
	        		global $EstadosCidades;
        			$EstadosCidades->create_location_terms();
	        	}
			}
        }
        
        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        _e('Importações especiais do Tema:', 'fluxo');
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function criar_estatos_cidades_callback()
    {
    	$checked = isset( $this->options['criar_estatos_cidades'] ) && $this->options['criar_estatos_cidades'] == 'S' ? 'checked="checked"' : '';
    	?>
            <input type="checkbox" id="criar_estatos_cidades" name="fluxo_theme_options[criar_estatos_cidades]" value="S" <?php echo $checked; ?> /><?php _e('Criar', 'fluxo'); ?>
        <?php 
    }
    
    public function fetch_remote_file( $url, $post ) {
    
    	global $url_remap;
    
    	// extract the file name and extension from the url
    	$file_name = basename( $url );
    
    	// get placeholder file in the upload dir with a unique, sanitized filename
    	$upload = wp_upload_bits( $file_name, 0, '',
    			array_key_exists('upload_date', $post) ? $post['upload_date'] : null );
    	if ( $upload['error'] )
    		return new WP_Error( 'upload_dir_error', $upload['error'] );
    
    	// fetch the remote url and write it to the placeholder file
    	$headers = wp_get_http( $url, $upload['file'] );
    
    	// request failed
    	if ( ! $headers ) {
    		@unlink( $upload['file'] );
    		return new WP_Error( 'import_file_error', __('Remote server did not respond', 'wordpress-importer') );
    	}
    
    	// make sure the fetch was successful
    	if ( $headers['response'] != '200' ) {
    		@unlink( $upload['file'] );
    		return new WP_Error( 'import_file_error', sprintf( __('Remote server returned error response %1$d %2$s', 'wordpress-importer'), esc_html($headers['response']), get_status_header_desc($headers['response']) ) );
    	}
    
    	$filesize = filesize( $upload['file'] );
    
    	if ( isset( $headers['content-length'] ) && $filesize != $headers['content-length'] ) {
    		@unlink( $upload['file'] );
    		return new WP_Error( 'import_file_error', __('Remote file is incorrect size', 'wordpress-importer') );
    	}
    
    	if ( 0 == $filesize ) {
    		@unlink( $upload['file'] );
    		return new WP_Error( 'import_file_error', __('Zero size file downloaded', 'wordpress-importer') );
    	}
    
    
    	// keep track of the old and new urls so we can substitute them later
    	$url_remap[$url] = $upload['url'];
    
    
    	return $upload;
    }
    
    public function process_attachment( $post, $url )
    {
    	
	    // if the URL is absolute, but does not contain address, then upload it assuming base_site_url
	    //if ( preg_match( '|^/[\w\W]+$|', $url ) )
	    //	$url = rtrim( $this->base_url, '/' ) . $url;
	    
	    global $url_remap;
	    
	    $upload = $this->fetch_remote_file( $url, $post );
	    if ( is_wp_error( $upload ) )
	        return $upload;
	
	    if ( $info = wp_check_filetype( $upload['file'] ) )
	        $post['post_mime_type'] = $info['type'];
	    else
	        return new WP_Error( 'attachment_processing_error', __('Invalid file type', 'wordpress-importer') );
	
	    $post['guid'] = $upload['url'];
	
	    // as per wp-admin/includes/upload.php
	    $post_id = wp_insert_attachment( $post, $upload['file'] );
	    wp_update_attachment_metadata( $post_id, wp_generate_attachment_metadata( $post_id, $upload['file'] ) );
	
	    update_post_meta($post_id, '_pin_anchor', array('x' => 0, 'y' => 30 ));
	
	    return $post_id;
	}
    
    public function ImportPins()
    {
    	if ($handle = opendir(get_stylesheet_directory() . '/assets/images/pins'))
		{
    		while (false !== ($entry = readdir($handle)))
			{
    			if (substr($entry, -3) == "png")
				{
    				$newatt = array
					(
    					'post_title' => $entry,
    					'post_status' => 'publish',
    					'post_parent' => 0,
    					'post_type' => 'attachment'
    				);
						    	
    				$ret = $this->process_attachment( $newatt, get_template_directory_uri().'/assets/images/pins/'.$entry);
    				if(is_object($ret) && get_class($ret) == 'WP_Error')
    				{
    					
    					wp_die(print_r($ret, true)." URL:".get_template_directory_uri().'/assets/images/pins/'.$entry);
    				}
    	
    			}
    		}
    		closedir($handle);
    	}
    	die();//ajax callback
    }
    
    protected $logfilename = 'csv_import.log';
    
    public static function log($msn, $print_r = false)
    {
    	if($print_r)
    	{
    		print_r($msn);
    		file_put_contents(dirname(__FILE__)."/csv_import.log", print_r($msn, true), FILE_APPEND);
    	}
    	else
    	{
	    	echo $msn;
	    	$msn = str_replace("<br/>", "\n", $msn);
	    	$msn = str_replace("<br>", "\n", $msn);
	    	file_put_contents(dirname(__FILE__)."/csv_import.log", $msn, FILE_APPEND);
    	}
    }
    
    public static function newLog()
    {
    	file_put_contents(dirname(__FILE__)."/csv_import.log", date('Y-m-d').'\n');
    }
    
    public function ImportarCsv_callback()
    {
    	FluxoSettingsPage::newLog();
    	
    	echo '<div id="result">';
    	
    	if(function_exists('mapasdevista_get_coords') )
    	{
    		include_once dirname(__FILE__).'/Tratar.php';
    		
    		$debug = false;
    		$getLocation = true;
    		$begin = 0;
    		$limit = 20;
    		$ids = array();
    		
    		$pins_args = array (
	    		'post_type' => 'attachment',
				'meta_key' => '_pin_anchor',
        		'posts_per_page' => '-1'
	    	);
			$pinsTodos = get_posts($pins_args);
			
			$pins = array();
			
			foreach ($pinsTodos as $pin)
			{
				$pins[] = $pin->ID;
			}
			
			FluxoSettingsPage::log(print_r($pins,true));
			
	    	ini_set("memory_limit", "2048M");
	    	set_time_limit(0);
	    
	    	$names = array();
	    	
	    	$file = fopen ( '/tmp/import.csv', 'r');
	    	
	    	$coords = array();
	    	
	    	if(file_exists('/tmp/coords.csv')) // load coords from other file
	    	{
	    		$coords_file = fopen ( '/tmp/coords.csv', 'r');
	    		$coords_row = fgetcsv( $coords_file, 0, ';');
	    		
	    		while ($coords_row !== false) // locate next valid id
	    		{
	    			$coords[$coords_row[0]] = array('lat' => $coords_row[1], 'lon' => $coords_row[2]);
	    			$coords_row = fgetcsv( $coords_file, 0, ';');
	    		}
	    		
	    	}
	    	//cabeçalho da planilha
	    	for ($i = 0; $i < 3; $i++) // first 4 lines has header
	    	{
	    		$row = fgetcsv( $file, 0, ';');
	    		$names[$i] = array_map('trim',$row);
	    	}
	    	
	    	for ($i = 0; $i < $begin; $i++) // move pointer to begin of data
	    	{
	    		$row = fgetcsv( $file, 0, ';');
	    	}
	    	
	    	FluxoSettingsPage::log('<pre>');
	    
	    	$row = fgetcsv( $file, 0, ';');
	    	$i = 0;
	    	do
	    	{
	    		if(count($ids) > 0) // have ids limit
	    		{
	    			while ($row !== false && !in_array($row[3], $ids)) // locate next valid id 
	    			{
	    				$row = fgetcsv( $file, 0, ';');
	    			}
	    			if($row === false) break;
	    		}
	    		
	    		$row[0] = trim($row[0]);
	    		$row[1] = trim($row[1]);
	    		
	    		if( (empty($row[0]) && empty($row[1]) ) || strcasecmp($row[0],'Inexistente') == 0)
	    		{
	    			$row = fgetcsv( $file, 0, ';');
	    			$i++;
	    			continue;
	    		}
	    		
	    		if(empty($row[0]))
	    		{
	    			$row[0] = $row[1];
	    		}
	    		
	    		// definir titulo e descrição
	    		$post = array(
	    				'post_author'    => 1, //The user ID number of the author.
	    				'post_content'   => trim($row[6]),
	    				'post_title'     => trim($row[0]), //The title of your post.
	    				'post_type'      => 'emrede',
	    				'post_status'	 => 'publish'
	    		);
	    
				$post_id = 0;
	    		if(!$debug) $post_id = wp_insert_post($post);
	    		//colunas que eu não quero importar como texto livre (custom fields)
	    		$no_import = array(7, 8, 10);

	    		$location = false;
	    		
	    		if(count($coords) > 0)
	    		{
	    			$location = $coords[$row[1]];
	    		}
	    		
	    		$row[19] = trim($row[19]);
	    		$row[20] = trim($row[20]);
	    		$row[21] = trim($row[21]);
	    		$row[22] = trim($row[22]);
	    		
	    		$row[19] = trim(array_shift(explode(';', $row[19])));
	    		$row[19] = trim(array_shift(explode(',', $row[19])));
	    		$row[19] = trim(array_shift(explode('-', $row[19])));
	    		if($getLocation && $location === false)
	    		{ 
	    			//lets try address first
	    			$uf = $row[20];
	    			if(!empty($row[21])) // país
	    				$uf .=  ",".$row[21];
	    			
	    			if(!empty($row[22]))
	    			{
	    				$row[22] = array_shift(explode(';', $row[22]));
	    				$location = mapasdevista_get_coords($row[22].",".$row[19].','.$uf); // Endereço
	    				if($location == false)
	    				{
	    					$location = mapasdevista_get_coords($row[19].','.$uf); // Município e estado
	    				}
	    			}
	    			else
	    			{
		    			//setar coluna do municipio
			    		$location = mapasdevista_get_coords($row[19].','.$uf); // Município e estado
	    			}
	    		}
	    		
	    		if($debug)
	    		{
	    			FluxoSettingsPage::log($post, true);
	    			
	    			if($location !== false) FluxoSettingsPage::log("{$row[0]};{$location['lat']};{$location['lon']}");
	    			elseif($getLocation) FluxoSettingsPage::log("$row[0] -> debug ponto em rede não encontrado");
	    			
	    			FluxoSettingsPage::log('<br/>');
	    		}
	    		else
	    		{
	    			if($location !== false)
	    			{ //setar coluna id 
	    				FluxoSettingsPage::log("{$row[0]};{$location['lat']};{$location['lon']}"); // exportar lat e lon
	    				FluxoSettingsPage::log('<br/>');
	    				update_post_meta($post_id, '_mpv_location', $location);
	    			}
	    			elseif($getLocation) 
	    			{
	    				FluxoSettingsPage::log("$row[0] -> ponto em rede não encontrado");
	    				FluxoSettingsPage::log('<br/>');
	    			}
	    		}
	    		
	    		$pin = $pins[rand(0, count($pins) - 1)];
	    		
    			if(!$debug && is_int($post_id) )
    			{
    				update_post_meta($post_id, '_mpv_pin', $pin);
    					
    				delete_post_meta($post_id, '_mpv_inmap');
    				delete_post_meta($post_id, '_mpv_in_img_map');
    				add_post_meta($post_id, "_mpv_inmap", 1);
    			}
    			else
    			{
    				FluxoSettingsPage::log("Pin: {$pin}");
    				FluxoSettingsPage::log('<br/>');
    			}
    			global $EmRede_global;
    			$fields = $EmRede_global->getFields(); 
    			
    			foreach ($row as $key => $custom_field)
    			{
    				$custom_field = trim($custom_field);
    				
    				if(in_array($key, array(0,1,2,3,5,6,11,12,13,14,19,20,24,26,28,29,36,38,42,))) // stop on column with tax
    				{
    					continue;
    				}
    				if($key > 44) // fim
    				{
    					break;
    				}
    				
    				if(!in_array($key, $no_import))
    				{
    					if(array_key_exists($names[0][$key], $fields))
    					{
	    					if($debug)
	    					{
	    						FluxoSettingsPage::log("update_post_meta($post_id, {$fields[$names[0][$key]]['slug']}, $custom_field);<br/>");
	    					}
	    					else 
	    					{
	    						update_post_meta($post_id, $fields[$names[0][$key]]['slug'], $custom_field);
	    					}
    					}
    					else
    					{
    						FluxoSettingsPage::log("$row[0] -> campo não encontrado: {$names[0][$key]}");
    						FluxoSettingsPage::log('<br/>');
    					}
    				}
    			}
    			
    			
    			/**
				 * Taxonomies
    			 */
    			Tratar::territorio($post_id, 'territorio', $row[19], $row[20]);
    			Tratar::tags($post_id, 'category', $row[14]);
    			Tratar::publicoalvo($post_id, 'publico-alvo', $row[11]);
    			
	    		$row = fgetcsv( $file, 0, ';');
	    		$i++;
	    	} while ($row !== false && ( !$debug || $i < $limit ) );
	    	FluxoSettingsPage::log('</pre>');
	    	fclose ( $file );
    	}
    	echo '</div>';
    	die();
    }

}

if( is_admin() )
    $fluxo_settings_page = new FluxoSettingsPage();
