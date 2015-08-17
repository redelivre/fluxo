<?php

add_action('init', 'register_emrede_taxonomies');
function register_emrede_taxonomies()
{

	$labels = array
	(
			'name' => __('Público Alvo','fluxo'),
			'singular_name' => __('Público Alvo', 'fluxo'),
			'search_items' => __('Procurar em Público Alvo','fluxo'),
			'all_items' => __('Todos os Públicos Alvos','fluxo'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __('Editar Público Alvo','fluxo'),
			'update_item' => __('Atualizar um Público Alvo','fluxo'),
			'add_new_item' => __('Adicionar Novo Público Alvo','fluxo'),
			'add_new' => __('Adicionar Público Alvo', 'fluxo'),
			'new_item_name' => __('Novo Público Alvo','fluxo'),
			'view_item' => __('Visualizar Público Alvo','fluxo'),
			'not_found' =>  __('Nenhum Público Alvo localizado','fluxo'),
			'not_found_in_trash' => __('Nenhum Público Alvo localizado na lixeira','fluxo'),
			'menu_name' => __('Público Alvo','fluxo')
	);
	
	register_taxonomy( 'publico-alvo',array (
			'pratica'
	),
			array( 'hierarchical' => true,
					'label' => 'Público Alvo',
					'show_ui' => true,
					'query_var' => true,
					'show_admin_column' => true,
					'labels' => $labels
			)
	);
	
	if(!term_exists('Público em Geral', 'publico-alvo'))
	{
		wp_insert_term("Coletivos, artistas", 'publico-alvo');
		wp_insert_term("comunidades", 'publico-alvo');
		wp_insert_term("Crianças, jovens e adultos", 'publico-alvo');
		wp_insert_term("Desenvolvedores", 'publico-alvo');
		wp_insert_term("Educadores", 'publico-alvo');
		wp_insert_term("Indígenas", 'publico-alvo');
		wp_insert_term("Jovens", 'publico-alvo');
		wp_insert_term("Jovens e adultos", 'publico-alvo');
		wp_insert_term("Jovens, adultos, idosos", 'publico-alvo');
		wp_insert_term("juristas, sociólogos, economistas", 'publico-alvo');
		wp_insert_term("Militantes e pesquisadores que atuam no Direito à Cidade", 'publico-alvo');
		wp_insert_term("Militantes pela cultura", 'publico-alvo');
		wp_insert_term("Movimentos sociais", 'publico-alvo');
		wp_insert_term("organizaciones sociales, comunitarias, sindicales, movimientos de base, fundaciones, asociaciones civiles, cooperativas, empresas recuperadas, bancos populare", 'publico-alvo');
		wp_insert_term("Produtores culturais", 'publico-alvo');
		wp_insert_term("Produtores e artistas", 'publico-alvo');
		wp_insert_term("Produtores, gestores e articuladores culturais", 'publico-alvo');
		wp_insert_term("professores e lideranças populares", 'publico-alvo');
		wp_insert_term("Público em Geral", 'publico-alvo');
		wp_insert_term("rtistas e arte-educadores de coletivos e Pontos de Cultur", 'publico-alvo');
		wp_insert_term("Rádios comunitárias", 'publico-alvo');
		wp_insert_term("Segmentos Populares", 'publico-alvo');
		wp_insert_term("Outro#input#", 'publico-alvo');
	}
	
	
}


?>