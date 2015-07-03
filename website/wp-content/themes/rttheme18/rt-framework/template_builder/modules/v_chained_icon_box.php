<?php
class rt_generate_v_chained_icon_box_class extends RTThemePageLayoutOptions{
	#
	#	Vertical Chained Icon Boxes 
	#
	function rt_generate_v_chained_icon_box($theGroupID,$theTemplateID,$options,$randomClass){

			$boxName       = __("Vertical Chained Icon Boxes", "rt_theme_admin"); 
			$contet_type   = "v_chained_icon_box";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			$isNewBox      = (trim($randomClass)=="") ? false : true;
			$opacity       = 1;
			$layout        = "one passive_module";
			$position      = $isNewBox ? 'open minus' : 'plus' ;
			$data_position = 'display: none;' ;

 			$media_alignment = isset($options["media_alignment"]) ? $options["media_alignment"] : "";  		

			echo '<li class="ui-state-default '.$layout.' '.$randomClass.' v_chained_icon_box" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';

								
			$form_options = array (
  
				array(
						"desc" 		=> __("This module creates a chained content boxes with icons.",'rt_theme_admin'),	 
						"hr" 		=> "true",
						"type" 		=> "info"), 	 

				array(
						"name"		=> __("Select Icon Alignment",'rt_theme_admin'), 
						"id" 		=> $theTemplateID.'_'.$theGroupID."_v_chained_icon_box[media_alignment]", 
						"options" 	=>	array( 
											"left" => __("Left","rt_theme_admin"),
											"right" => __("Right","rt_theme_admin")
									), 
						"value"		=> $media_alignment,
						"hr" 		=> "true",
						"dont_save"	=> true,
						"type"		=> "select"),   
				
				array(
						"desc" 		=> __("CREATE CONTENTS",'rt_theme_admin'),	  
						"type" 		=> "info_text_only"), 
			);


			echo  $this->rt_generate_forms($form_options);
			 
			//call the accordions
			$options["box_contents"] = isset( $options["box_contents"] ) ? $options["box_contents"] : array();
			echo $this->rt_create_contents($theTemplateID,$theGroupID,$options["box_contents"],$randomClass);  
			echo  '</div></div></div></li>';
	}

	//create contents
	private function rt_create_contents($theTemplateID,$theGroupID,$options){

		echo '<div class="slider_creator for_boxes"><ul class="slides_holder">';		 


		if ( isset( $options["caption"] ) ) {
			foreach ( $options["caption"] as $key => $value ) {

				$caption = ! empty( $options["caption"][$key] ) ? $options["caption"][$key] : "";
				$text    = ! empty( $options["text"][$key] ) ? $options["text"][$key] : "";		
				$icon    = ! empty( $options["icon"][$key] ) ? $options["icon"][$key] : "";				 
				$link    = ! empty( $options["link"][$key] ) ? $options["link"][$key] : "";	
				$link_target  = ! empty( $options["link_target"][$key] ) ? $options["link_target"][$key] : "";	

				if ( $caption ) {
					echo '<li class="slide_options"><div class="title">'.stripslashes($caption).'<span class="s_edit"></span><span class="s_delete"></span></div><div class="options">';

						$form_options = array (

							array("type"    => "table_start"),

							array(
								"name"      => __("Caption",'rt_theme_admin'), 
								"desc"      => __('Enter the accordion caption title.','rt_theme_admin'),													
								"id"        => $theTemplateID.'_'.$theGroupID."_v_chained_icon_box[box_contents][caption][]", 
								"value"     => $caption, 
								"type"      => "text"),  

							array("type"   => "td_col"),

							array(
									"name"		=> __("Link",'rt_theme_admin'),						
									"desc"      => __('Put in a valid link for the caption and icon','rt_theme_admin'),																				
									"id" 		=> $theTemplateID.'_'.$theGroupID."_v_chained_icon_box[box_contents][link][]", 
									"value"		=> $link, 
									"type"		=> "text"), 					

							array("type"    => "table_end"),

							array("type"    => "table_start"),

							array(
								"name"      => __("Icon",'rt_theme_admin'),
								"desc"      => __('Select and set an icon','rt_theme_admin'),	
								"id"        => $theTemplateID.'_'.$theGroupID."_v_chained_icon_box[box_contents][icon][]", 
								"value"     => $icon,
								"class"     => 'icon_selection', 
								"type"      => "text"), 

							array("type"   => "td_col"),

							array(
									"name"      => __("Link Target",'rt_theme_admin'),
									"desc"      => __('Select and set the link target.','rt_theme_admin'),
									"id"        => $theTemplateID.'_'.$theGroupID."_v_chained_icon_box[box_contents][link_target][]", 
									"options"   => array(
														'_self'=>__('Same Window','rt_theme_admin'),
														'_blank'=>__('New Window','rt_theme_admin')
													),
									"value"     => $link_target, 
									"type"      => "select"),

							array("type"    => "table_end"),

							array( 
									"type" => "col_start",
									"layout" => "one",
									"holder_class" => "labels_block box_border paddings",
							),

							array(
								"name"      => __("Text",'rt_theme_admin'), 
								"desc"      => __('Enter the content to be displayed within the accordion panel. The content becomes visible when the accordion panel is active.','rt_theme_admin'),													
								"id"        => $theTemplateID.'_'.$theGroupID."_v_chained_icon_box[box_contents][text][]",								
								"css_id"    => $theTemplateID.'_'.$theGroupID."_v_chained_icon_box".$key,
								"value"     => $text, 
								"type"      => "textarea_tinyMCE"), 

							array( 
									"type" => "col_end"
							)							
						); 

						echo  $this->rt_generate_forms($form_options);

					echo '</div></li>';	
				}
 
			}							
		}

		echo '<li class="slide_options new_slide"><div class="title">New Content<span class="s_edit"></span><span class="s_delete"></span></div><div class="options">';

			$form_options = array (

				array("type"		=> "table_start"),

				array(
					"name"      => __("Caption",'rt_theme_admin'), 
					"desc"      => __('Enter the accordion caption title.','rt_theme_admin'),																		
					"id"        => $theTemplateID.'_'.$theGroupID."_v_chained_icon_box[box_contents][caption][]",
					"hr"        => "true",
					"type"      => "text"),

				array(
					"name"		=> __("Link",'rt_theme_admin'),						
					"desc"      => __('Put in a valid link for the caption and icon','rt_theme_admin'),																				
					"id" 		=> $theTemplateID.'_'.$theGroupID."_v_chained_icon_box[box_contents][link][]", 
					"type"		=> "text"), 					

				array("type"   => "td_col"),

				array(
					"name"      => __("Icon",'rt_theme_admin'), 
					"desc"      => __('Select and set an icon','rt_theme_admin'),																		
					"id"        => $theTemplateID.'_'.$theGroupID."_v_chained_icon_box[box_contents][icon][]",  
					"class"		=> 'icon_selection',
					"hr"        => "true",
					"type"      => "text"),		

				array(
					"name"      => __("Link Target",'rt_theme_admin'),
					"desc"      => __('Select and set the link target.','rt_theme_admin'),
					"id"        => $theTemplateID.'_'.$theGroupID."_v_chained_icon_box[box_contents][link_target][]", 
					"options"   => array(
										'_self'=>__('Same Window','rt_theme_admin'),
										'_blank'=>__('New Window','rt_theme_admin')
									),
					"type"      => "select"),

				array("type"    => "table_end"),

				array( 
					"type"         => "col_start",
					"layout"       => "one",
					"holder_class" => "labels_block box_border paddings",
				),

				array(
					"name"      => __("Text",'rt_theme_admin'), 
					"desc"      => __('Enter the content to be displayed within the accordion panel. The content becomes visible when the accordion panel is active.','rt_theme_admin'),																		
					"id"        => $theTemplateID.'_'.$theGroupID."_v_chained_icon_box[box_contents][text][]",
					"css_id"    => $theTemplateID.'_'.$theGroupID."_content_box_new", 
					"type"      => "textarea_tinyMCE"),  		

				array( 
						"type" => "col_end"
				),					
			); 

			echo  $this->rt_generate_forms($form_options);

		echo '</div></li>';   
		echo '</ul>';  
		echo '<button type="button" class="template_button green rt_add_new_slide icon-plus-squared-1">'.__('add new content','rt_theme_admin') .' </button>';  				
		echo '</div>';
	}
}
?>	