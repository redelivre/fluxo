<?php

class Tratar
{
	public static function tiracento($texto)
	{
		$trocarIsso = 	array('à','á','â','ã','ä','å','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ù','ü','ú','ÿ','À','Á','Â','Ã','Ä','Å','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ñ','Ò','Ó','Ô','Õ','Ö','Ù','Ü','Ú','Ÿ',);
		$porIsso = 		array('a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','u','u','u','y','A','A','A','A','A','A','C','E','E','E','E','I','I','I','I','N','O','O','O','O','O','U','U','U','Y',);
		$titletext = str_replace($trocarIsso, $porIsso, $texto);
		return $titletext;
	}
	
	public static function FormatText($str)
	{
		$str = trim($str);
		$str = strtolower($str);
		$str = Tratar::tiracento($str);
		$str = str_replace('"', '', $str);
		return $str;
	}
	
	public static function insert($postID, $taxonomy, $term)
	{
		//$term = Tratar::FormatText($term);
		
		$term_obj = get_term_by('name', $term, $taxonomy);
		
		if($term_obj === false)
		{
			FluxoSettingsPage::log("Term: {$term}, não encontrado, tax: $taxonomy, Post: $postID<br/>");
			return;
		}
		
		if($postID > 0)
		{
			wp_set_object_terms( $postID, intval($term_obj->term_id), $taxonomy, true );
		}
		else //Debug?
		{
			FluxoSettingsPage::log("wp_set_object_terms( $postID, intval($term_obj->term_id), $taxonomy, true );");
			FluxoSettingsPage::log(" Term name: $term_obj->name<br/>");
		}
		
	}
		
	public static function territorio($postID,$taxonomy,$col1, $uf_row = false)
	{
	
		$uf = trim($uf_row);
	
		$cidade = trim($col1);
		$cidade_slug = sanitize_title($cidade);
	
		if($uf !== false)
		{
			$uf_slug = sanitize_title($uf);
	
			$term_obj = get_term_by('slug', $uf_slug, $taxonomy);
				
			if($term_obj !== false)
			{
				if($postID > 0)
				{
					wp_set_object_terms( $postID, intval($term_obj->term_id), $taxonomy, true );
				}
				else //Debug?
				{
					FluxoSettingsPage::log("wp_set_object_terms( $postID, intval($term_obj->term_id), $taxonomy, true );");
					FluxoSettingsPage::log(" Term name: $term_obj->name<br/>");
				}
			}
			else 
			{
				$estados = get_terms($taxonomy, array(
					'hide_empty' => 0,
					'parent' => 0,
				));
				$descs = array();
				foreach ($estados as $estado)
				{
					$descs[trim($estado->description)] = $estado->term_id;
				}
				
				if( array_key_exists($uf, $descs) )
				{
					wp_set_object_terms( $postID, intval($descs[$uf]), $taxonomy, true );
				}
				else 
				{
					FluxoSettingsPage::log("Term: UF: {$uf_slug}, não encontrado, tax: $taxonomy, Post: $postID, cols: $col1, $uf_row<br/>");
				}
			}
		}
	
		if(!empty($cidade_slug))
		{
			$term_obj = get_term_by('slug', $cidade_slug, $taxonomy);
				
			if($term_obj !== false)
			{
				if($postID > 0)
				{
					wp_set_object_terms( $postID, intval($term_obj->term_id), $taxonomy, true );
				}
				else //Debug?
				{
					FluxoSettingsPage::log("wp_set_object_terms( $postID, intval($term_obj->term_id), $taxonomy, true );");
					FluxoSettingsPage::log(" Term name: $term_obj->name<br/>");
				}
			}
			else
			{
				FluxoSettingsPage::log("Term: Cidade: {$cidade_slug}, não encontrada, tax: $taxonomy, Post: $postID, cols: $col1, $uf, cidade: $cidade, cidade_slug: $cidade_slug<br/>");
			}
		}	
	}

	public static function publicoalvo($postID,$taxonomy,$col1,$col2=false,$col3=false)
	{
		$col1 = Tratar::FormatText($col1);
		$col2 = Tratar::FormatText($col2);
		$col3 = Tratar::FormatText($col3);
	
		$rel = array(
				Tratar::FormatText("Coletivos, artistas") => "Coletivos, artistas",
				Tratar::FormatText("comunidades") => "comunidades",
				Tratar::FormatText("Crianças, jovens e adultos") => "Crianças, jovens e adultos",
				Tratar::FormatText("Desenvolvedores") => "Desenvolvedores",
				Tratar::FormatText("Educadores") => "Educadores",
				Tratar::FormatText("Indígenas") => "Indígenas",
				Tratar::FormatText("Jovens") => "Jovens",
				Tratar::FormatText("Jovens e adultos") => "Jovens e adultos",
				Tratar::FormatText("Jovens, adultos, idosos") => "Jovens, adultos, idosos",
				Tratar::FormatText("juristas, sociólogos, economistas") => "juristas, sociólogos, economistas",
				Tratar::FormatText("Militantes e pesquisadores que atuam no Direito à Cidade") => "Militantes e pesquisadores que atuam no Direito à Cidade",
				Tratar::FormatText("Militantes pela cultura") => "Militantes pela cultura",
				Tratar::FormatText("Movimentos sociais") => "Movimentos sociais",
				Tratar::FormatText("organizaciones sociales, comunitarias, sindicales, movimientos de base, fundaciones, asociaciones civiles, cooperativas, empresas recuperadas, bancos populare") => "organizaciones sociales, comunitarias, sindicales, movimientos de base, fundaciones, asociaciones civiles, cooperativas, empresas recuperadas, bancos populare",
				Tratar::FormatText("Produtores culturais") => "Produtores culturais",
				Tratar::FormatText("Produtores e artistas") => "Produtores e artistas",
				Tratar::FormatText("Produtores, gestores e articuladores culturais") => "Produtores, gestores e articuladores culturais",
				Tratar::FormatText("professores e lideranças populares") => "professores e lideranças populares",
				Tratar::FormatText("Público em Geral") => "Público em Geral",
				Tratar::FormatText("rtistas e arte-educadores de coletivos e Pontos de Cultur") => "artistas e arte-educadores de coletivos e Pontos de Cultura",
				Tratar::FormatText("Rádios comunitárias") => "Rádios comunitárias",
				Tratar::FormatText("Segmentos Populares") => "Segmentos Populares",
				Tratar::FormatText("Outro#input#") => "Outro#input#",
				Tratar::FormatText("Outro") => "Outro#input#",
		);
		if(array_key_exists($col1, $rel) && is_array($rel[$col1]) && method_exists('Tratar', reset($rel[$col1])))
		{
			$func = reset($rel[$col1]);
			Tratar::$func($postID, reset($rel[$col1]), key($rel[$col1]));
		}
		elseif(array_key_exists($col1, $rel) && $rel[$col1] != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col1]);
		}
		if(array_key_exists($col2, $rel) && is_array($rel[$col2]) && method_exists('Tratar', reset($rel[$col2])))
		{
			$func = reset($rel[$col2]);
			Tratar::$func($postID, reset($rel[$col2]), key($rel[$col2]));
		}
		elseif(array_key_exists($col2, $rel) && $rel[$col2] != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col2]);
		}
		if(array_key_exists($col3, $rel) && is_array($rel[$col3]) && method_exists('Tratar', reset($rel[$col3])))
		{
			$func = reset($rel[$col3]);
			Tratar::$func($postID, reset($rel[$col3]), key($rel[$col3]));
		}
		elseif(array_key_exists($col3, $rel) && $rel[$col3] != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col3]);
		}
	}
	
	public static function tags($postID,$taxonomy,$col1)
	{
		$col1 = sanitize_text_field($col1);
		$col1 = str_replace(';', ',', $col1);

		wp_set_post_tags( $postID, $col1, true );
		
	}
	
}

?>