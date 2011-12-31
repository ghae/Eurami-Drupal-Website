<?php

/**
* Implementation of THEMEHOOK_settings() function.
*
* @param $saved_settings
*   array An array of saved settings for this theme.
* @return
*   array A form array.
*/
function somaxiom_settings($saved_settings){
	
	$grid1 = drupal_map_assoc(array(12));
	$grid2 = drupal_map_assoc(array('2|10','3|9','4|8','5|7','6|6','7|5','8|4','9|3','10|2'));
	$grid3 = drupal_map_assoc(array('2|2|8','2|3|7','2|4|6','2|5|5','2|6|4','2|7|3','2|8|2','3|2|7','3|3|6','3|4|5','3|5|4','3|6|3','3|7|2','4|2|6','4|3|5','4|4|4','4|5|3','4|6|2','5|2|5','5|3|4','5|4|3','5|5|2','6|2|4','6|3|3','6|4|2','7|2|3','7|3|2','8|2|2'));
	$grid4 = drupal_map_assoc(array('2|2|2|6','2|2|3|5','2|2|4|4','2|2|5|3','2|2|6|2','2|3|2|5','2|3|3|4','2|3|4|3','2|3|5|2','2|4|2|4','2|4|3|3','2|4|4|2','2|5|2|3','2|5|3|2','2|6|2|2','3|2|2|5','3|2|3|4','3|2|4|3','3|2|5|2','3|3|2|4','3|3|3|3','3|3|4|2','3|4|2|3','3|4|3|2','3|5|2|2','4|2|2|4','4|2|3|3','4|2|4|2','4|3|2|3','4|3|3|2','4|4|2|2','5|2|2|3','5|2|3|2','5|3|2|2','6|2|2|2'));
	$grid5 = drupal_map_assoc(array('2|2|2|2|4','2|2|2|3|3','2|2|2|4|2','2|2|3|2|3','2|2|3|3|2','2|2|4|2|2','2|3|2|2|3','2|3|2|3|2','2|3|3|2|2','2|4|2|2|2','3|2|2|2|3','3|2|2|3|2','3|2|3|2|2','3|3|2|2|2','4|2|2|2|2'));
	$grid6 = drupal_map_assoc(array('2|2|2|2|2|2'));
	
	$overlays = array(
		'none' 					=> 'None', 
		'circles' 				=> 'Circles',  
		'squares' 				=> 'Squares'
	);
	
	$fieldType = "textfield";
	
	$defaults = somaxiom_settings_defaults();

    // Merge the saved variables and their default values
    $settings = array_merge($defaults, $saved_settings);

    // Create the form widgets using Forms API


// THEME =====================================
	$form['theme'] = array(
		  '#type' => 'fieldset',
		  '#title' => t('Style Settings'),
		  '#collapsible' => TRUE,
		  '#collapsed' => FALSE,
	);
	
  	$form['theme']['presetstyle'] = array(
	    '#type' => 'select',
	    '#title' => t('Preset Style'),
			'#options' => array(
		  		'style1' 	=> 'Preset 1',  
		  		'style2'	=> 'Preset 2', 
		  		'style3'	=> 'Preset 3',  
		  		'style4'	=> 'Preset 4',
		  		'style5' 	=> 'Preset 5',  
		  		'style6' 	=> 'Preset 6',
		  		'style7'	=> 'Preset 7',
		  		'style8' 	=> 'Preset 8'
		),
		'#default_value' => $settings['presetstyle']
  	);

	

// =====================================
  	
  	$form['theme']['font_family'] = array(
	'#type' => 'select',
	'#title' => t('Font family'),
		'#options' => array(
            'geneva' 	=> 'Geneva',
            'georgia' 	=> 'Georgia',
            'helvetica' => 'Helvetica',
            'lucida' 	=> 'Lucida',
            'optima' 	=> 'Optima',
            'palatino' 	=> 'Palatino',
            'trebuchet' => 'Trebuchet'
		),
	'#description' => t(''),
	'#default_value' => $settings['font_family'],
	);
	
	$form['theme']['default_font'] = array(
    '#type' => 'select',
    '#title' => t('Font size'),
		'#options' => array(
			'small' => 'Small', 
			'default' => 'Default', 
			'large' => 'Large'
		),
    '#default_value' => $settings['default_font'],
  	);
  	

	
	$form['gridlayout'] = array(
		  '#type' => 'fieldset',
		  '#title' => t('Grid Layouts'),
		  '#collapsible' => TRUE,
		  '#collapsed' => TRUE,
		  '#description' => t('')
	);
	
// TOP REGION LAYOUT =====================================

	$form['gridlayout']['toplayout'] = array(
		  '#type' => 'fieldset',
		  '#title' => t('Top Region'),
		  '#collapsible' => TRUE,
		  '#collapsed' => TRUE,
		  '#description' => t('Select the layouts for this region.  You can choose a default layout for each of the possible block counts. ')
	);
	$form['gridlayout']['toplayout']['topgrid_1'] = array(
    '#type' => 'select',
    '#title' => t('1 Block'),
		'#options' => $grid1,
		'#description' => t(''),
    '#default_value' => $settings['topgrid_1']
  	);
	$form['gridlayout']['toplayout']['topgrid_2'] = array(
    '#type' => 'select',
    '#title' => t('2 Blocks'),
		'#options' => $grid2,
		'#description' => t(''),
    '#default_value' => $settings['topgrid_2']
  	);
  	$form['gridlayout']['toplayout']['topgrid_3'] = array(
    '#type' => 'select',
    '#title' => t('3 Blocks'),
		'#options' => $grid3,
		'#description' => t(''),
    '#default_value' => $settings['topgrid_3']
  	);
	$form['gridlayout']['toplayout']['topgrid_4'] = array(
    '#type' => 'select',
    '#title' => t('4 Blocks'),
		'#options' => $grid4,
		'#description' => t(''),
    '#default_value' => $settings['topgrid_4']
  	);
	
	$form['gridlayout']['toplayout']['topgrid_5'] = array(
    '#type' => 'select',
    '#title' => t('5 Blocks'),
		'#options' => $grid5,
		'#description' => t(''),
    '#default_value' => $settings['topgrid_5']
  	);
  	$form['gridlayout']['toplayout']['topgrid_6'] = array(
    '#type' => 'select',
    '#title' => t('6 Blocks'),
		'#options' => $grid6,
		'#description' => t(''),
    '#default_value' => $settings['topgrid_6']
  	);
// =====================================  

// HEADER REGION LAYOUT =====================================

	$form['gridlayout']['headerlayout'] = array(
		  '#type' => 'fieldset',
		  '#title' => t('Header Region'),
		  '#collapsible' => TRUE,
		  '#collapsed' => TRUE,
		  '#description' => t('Select the layouts for this region.  You can choose a default layout for each of the possible block counts. ')
	);
	$form['gridlayout']['headerlayout']['headergrid_1'] = array(
    '#type' => 'select',
    '#title' => t('1 Block'),
		'#options' => $grid1,
		'#description' => t(''),
    '#default_value' => $settings['headergrid_1']
  	);
	$form['gridlayout']['headerlayout']['headergrid_2'] = array(
    '#type' => 'select',
    '#title' => t('2 Blocks'),
		'#options' => $grid2,
		'#description' => t(''),
    '#default_value' => $settings['headergrid_2']
  	);
  	$form['gridlayout']['headerlayout']['headergrid_3'] = array(
    '#type' => 'select',
    '#title' => t('3 Blocks'),
		'#options' => $grid3,
		'#description' => t(''),
    '#default_value' => $settings['headergrid_3']
  	);
	$form['gridlayout']['headerlayout']['headergrid_4'] = array(
    '#type' => 'select',
    '#title' => t('4 Blocks'),
		'#options' => $grid4,
		'#description' => t(''),
    '#default_value' => $settings['headergrid_4']
  	);
	
	$form['gridlayout']['headerlayout']['headergrid_5'] = array(
    '#type' => 'select',
    '#title' => t('5 Blocks'),
		'#options' => $grid5,
		'#description' => t(''),
    '#default_value' => $settings['headergrid_5']
  	);
  	$form['gridlayout']['headerlayout']['headergrid_6'] = array(
    '#type' => 'select',
    '#title' => t('6 Blocks'),
		'#options' => $grid6,
		'#description' => t(''),
    '#default_value' => $settings['headergrid_6']
  	);
// ===================================== 

// SHOWCASE REGION LAYOUT =====================================

	$form['gridlayout']['showcaselayout'] = array(
		  '#type' => 'fieldset',
		  '#title' => t('Showcase Region'),
		  '#collapsible' => TRUE,
		  '#collapsed' => TRUE,
		  '#description' => t('Select the layouts for this region.  You can choose a default layout for each of the possible block counts. ')
	);
	$form['gridlayout']['showcaselayout']['showcasegrid_1'] = array(
    '#type' => 'select',
    '#title' => t('1 Block'),
		'#options' => $grid1,
		'#description' => t(''),
    '#default_value' => $settings['showcasegrid_1']
  	);
	$form['gridlayout']['showcaselayout']['showcasegrid_2'] = array(
    '#type' => 'select',
    '#title' => t('2 Blocks'),
		'#options' => $grid2,
		'#description' => t(''),
    '#default_value' => $settings['showcasegrid_2']
  	);
  	$form['gridlayout']['showcaselayout']['showcasegrid_3'] = array(
    '#type' => 'select',
    '#title' => t('3 Blocks'),
		'#options' => $grid3,
		'#description' => t(''),
    '#default_value' => $settings['showcasegrid_3']
  	);
	$form['gridlayout']['showcaselayout']['showcasegrid_4'] = array(
    '#type' => 'select',
    '#title' => t('4 Blocks'),
		'#options' => $grid4,
		'#description' => t(''),
    '#default_value' => $settings['showcasegrid_4']
  	);
	
	$form['gridlayout']['showcaselayout']['showcasegrid_5'] = array(
    '#type' => 'select',
    '#title' => t('5 Blocks'),
		'#options' => $grid5,
		'#description' => t(''),
    '#default_value' => $settings['showcasegrid_5']
  	);
  	$form['gridlayout']['showcaselayout']['showcasegrid_6'] = array(
    '#type' => 'select',
    '#title' => t('6 Blocks'),
		'#options' => $grid6,
		'#description' => t(''),
    '#default_value' => $settings['showcasegrid_6']
  	);
// ===================================== 

// UTILITY REGION LAYOUT =====================================

	$form['gridlayout']['utilitylayout'] = array(
		  '#type' => 'fieldset',
		  '#title' => t('Utility Region'),
		  '#collapsible' => TRUE,
		  '#collapsed' => TRUE,
		  '#description' => t('Select the layouts for this region.  You can choose a default layout for each of the possible block counts. ')
	);
	$form['gridlayout']['utilitylayout']['utilitygrid_1'] = array(
    '#type' => 'select',
    '#title' => t('1 Block'),
		'#options' => $grid1,
		'#description' => t(''),
    '#default_value' => $settings['utilitygrid_1']
  	);
	$form['gridlayout']['utilitylayout']['utilitygrid_2'] = array(
    '#type' => 'select',
    '#title' => t('2 Blocks'),
		'#options' => $grid2,
		'#description' => t(''),
    '#default_value' => $settings['utilitygrid_2']
  	);
  	$form['gridlayout']['utilitylayout']['utilitygrid_3'] = array(
    '#type' => 'select',
    '#title' => t('3 Blocks'),
		'#options' => $grid3,
		'#description' => t(''),
    '#default_value' => $settings['utilitygrid_3']
  	);
	$form['gridlayout']['utilitylayout']['utilitygrid_4'] = array(
    '#type' => 'select',
    '#title' => t('4 Blocks'),
		'#options' => $grid4,
		'#description' => t(''),
    '#default_value' => $settings['utilitygrid_4']
  	);
	
	$form['gridlayout']['utilitylayout']['utilitygrid_5'] = array(
    '#type' => 'select',
    '#title' => t('5 Blocks'),
		'#options' => $grid5,
		'#description' => t(''),
    '#default_value' => $settings['utilitygrid_5']
  	);
  	$form['gridlayout']['utilitylayout']['utilitygrid_6'] = array(
    '#type' => 'select',
    '#title' => t('6 Blocks'),
		'#options' => $grid6,
		'#description' => t(''),
    '#default_value' => $settings['utilitygrid_6']
  	);
// ===================================== 


// FEATURE REGION LAYOUT =====================================

	$form['gridlayout']['featurelayout'] = array(
		  '#type' => 'fieldset',
		  '#title' => t('Feature Region'),
		  '#collapsible' => TRUE,
		  '#collapsed' => TRUE,
		  '#description' => t('Select the layouts for this region.  You can choose a default layout for each of the possible block counts. ')
	);
	$form['gridlayout']['featurelayout']['featuregrid_1'] = array(
    '#type' => 'select',
    '#title' => t('1 Block'),
		'#options' => $grid1,
		'#description' => t(''),
    '#default_value' => $settings['featuregrid_1']
  	);
	$form['gridlayout']['featurelayout']['featuregrid_2'] = array(
    '#type' => 'select',
    '#title' => t('2 Blocks'),
		'#options' => $grid2,
		'#description' => t(''),
    '#default_value' => $settings['featuregrid_2']
  	);
  	$form['gridlayout']['featurelayout']['featuregrid_3'] = array(
    '#type' => 'select',
    '#title' => t('3 Blocks'),
		'#options' => $grid3,
		'#description' => t(''),
    '#default_value' => $settings['featuregrid_3']
  	);
	$form['gridlayout']['featurelayout']['featuregrid_4'] = array(
    '#type' => 'select',
    '#title' => t('4 Blocks'),
		'#options' => $grid4,
		'#description' => t(''),
    '#default_value' => $settings['featuregrid_4']
  	);
	
	$form['gridlayout']['featurelayout']['featuregrid_5'] = array(
    '#type' => 'select',
    '#title' => t('5 Blocks'),
		'#options' => $grid5,
		'#description' => t(''),
    '#default_value' => $settings['featuregrid_5']
  	);
  	$form['gridlayout']['featurelayout']['featuregrid_6'] = array(
    '#type' => 'select',
    '#title' => t('6 Blocks'),
		'#options' => $grid6,
		'#description' => t(''),
    '#default_value' => $settings['featuregrid_6']
  	);
// ===================================== 

// MAINTOP REGION LAYOUT =====================================

	$form['gridlayout']['maintoplayout'] = array(
		  '#type' => 'fieldset',
		  '#title' => t('MainTop Region'),
		  '#collapsible' => TRUE,
		  '#collapsed' => TRUE,
		  '#description' => t('Select the layouts for this region.  You can choose a default layout for each of the possible block counts. ')
	);
	$form['gridlayout']['maintoplayout']['maintopgrid_1'] = array(
    '#type' => 'select',
    '#title' => t('1 Block'),
		'#options' => $grid1,
		'#description' => t(''),
    '#default_value' => $settings['maintopgrid_1']
  	);
	$form['gridlayout']['maintoplayout']['maintopgrid_2'] = array(
    '#type' => 'select',
    '#title' => t('2 Blocks'),
		'#options' => $grid2,
		'#description' => t(''),
    '#default_value' => $settings['maintopgrid_2']
  	);
  	$form['gridlayout']['maintoplayout']['maintopgrid_3'] = array(
    '#type' => 'select',
    '#title' => t('3 Blocks'),
		'#options' => $grid3,
		'#description' => t(''),
    '#default_value' => $settings['maintopgrid_3']
  	);
	$form['gridlayout']['maintoplayout']['maintopgrid_4'] = array(
    '#type' => 'select',
    '#title' => t('4 Blocks'),
		'#options' => $grid4,
		'#description' => t(''),
    '#default_value' => $settings['maintopgrid_4']
  	);
	
	$form['gridlayout']['maintoplayout']['maintopgrid_5'] = array(
    '#type' => 'select',
    '#title' => t('5 Blocks'),
		'#options' => $grid5,
		'#description' => t(''),
    '#default_value' => $settings['maintopgrid_5']
  	);
  	$form['gridlayout']['maintoplayout']['maintopgrid_6'] = array(
    '#type' => 'select',
    '#title' => t('6 Blocks'),
		'#options' => $grid6,
		'#description' => t(''),
    '#default_value' => $settings['maintopgrid_6']
  	);
// ===================================== 

// MAIN BODY/SIDEBAR LAYOUT =====================================  
	$form['gridlayout']['mainbodylayout'] = array(
		  '#type' => 'fieldset',
		  '#title' => t('Main Body/Sidebar'),
		  '#collapsible' => TRUE,
		  '#collapsed' => TRUE,
		  '#description' => t('Choose the layout for this section (number of grids to span). '),
	);
	$form['gridlayout']['mainbodylayout']['mainbodygrid_1'] = array(
    '#type' => 'select',
    '#title' => t('1 Region'),
		'#options' => $grid1,
		'#description' => t('MainBody Only'),
    '#default_value' => $settings['mainbodygrid_1']
  	);
  	$form['gridlayout']['mainbodylayout']['mainbodygrid_2'] = array(
    '#type' => 'select',
    '#title' => t('2 Regions'),
		'#options' => array(
			'0'   => '6|6 [mb|sb]',
			'1'   => '8|4',
			'2'   => '9|3',
			'3'   => '6|6 [sb|mb]',
			'4'   => '4|8',
			'5'   => '3|9'
		),
		'#description' => t('[Main | Side] OR [Side | Main]'),
    '#default_value' => $settings['mainbodygrid_2']
  	);
  	$form['gridlayout']['mainbodylayout']['mainbodygrid_3'] = array(
    '#type' => 'select',
    '#title' => t('3 Regions'),
		'#options' => array(
			'0'   => '6|3|3 [mb|sb|sb]',
			'1'   => '8|2|2 ',
			'2'   => '3|3|6 [sb|sb|mb]',
			'3'   => '2|2|8'
		),
		'#description' => t('[Main | Side | Side] OR [Side | Side | Main]'),
    '#default_value' => $settings['mainbodygrid_3']
  	);
  	

// ===================================== 

// MAINBOTTOM REGION LAYOUT =====================================

	$form['gridlayout']['mainbottomlayout'] = array(
		  '#type' => 'fieldset',
		  '#title' => t('MainBottom Region'),
		  '#collapsible' => TRUE,
		  '#collapsed' => TRUE,
		  '#description' => t('Select the layouts for this region.  You can choose a default layout for each of the possible block counts. ')
	);
	$form['gridlayout']['mainbottomlayout']['mainbottomgrid_1'] = array(
    '#type' => 'select',
    '#title' => t('1 Block'),
		'#options' => $grid1,
		'#description' => t(''),
    '#default_value' => $settings['mainbottomgrid_1']
  	);
	$form['gridlayout']['mainbottomlayout']['mainbottomgrid_2'] = array(
    '#type' => 'select',
    '#title' => t('2 Blocks'),
		'#options' => $grid2,
		'#description' => t(''),
    '#default_value' => $settings['mainbottomgrid_2']
  	);
  	$form['gridlayout']['mainbottomlayout']['mainbottomgrid_3'] = array(
    '#type' => 'select',
    '#title' => t('3 Blocks'),
		'#options' => $grid3,
		'#description' => t(''),
    '#default_value' => $settings['mainbottomgrid_3']
  	);
	$form['gridlayout']['mainbottomlayout']['mainbottomgrid_4'] = array(
    '#type' => 'select',
    '#title' => t('4 Blocks'),
		'#options' => $grid4,
		'#description' => t(''),
    '#default_value' => $settings['mainbottomgrid_4']
  	);
	
	$form['gridlayout']['mainbottomlayout']['mainbottomgrid_5'] = array(
    '#type' => 'select',
    '#title' => t('5 Blocks'),
		'#options' => $grid5,
		'#description' => t(''),
    '#default_value' => $settings['mainbottomgrid_5']
  	);
  	$form['gridlayout']['mainbottomlayout']['mainbottomgrid_6'] = array(
    '#type' => 'select',
    '#title' => t('6 Blocks'),
		'#options' => $grid6,
		'#description' => t(''),
    '#default_value' => $settings['mainbottomgrid_6']
  	);
// ===================================== 

// BOTTOM REGION LAYOUT =====================================

	$form['gridlayout']['bottomlayout'] = array(
		  '#type' => 'fieldset',
		  '#title' => t('Bottom Region'),
		  '#collapsible' => TRUE,
		  '#collapsed' => TRUE,
		  '#description' => t('Select the layouts for this region.  You can choose a default layout for each of the possible block counts. ')
	);
	$form['gridlayout']['bottomlayout']['bottomgrid_1'] = array(
    '#type' => 'select',
    '#title' => t('1 Block'),
		'#options' => $grid1,
		'#description' => t(''),
    '#default_value' => $settings['bottomgrid_1']
  	);
	$form['gridlayout']['bottomlayout']['bottomgrid_2'] = array(
    '#type' => 'select',
    '#title' => t('2 Blocks'),
		'#options' => $grid2,
		'#description' => t(''),
    '#default_value' => $settings['bottomgrid_2']
  	);
  	$form['gridlayout']['bottomlayout']['bottomgrid_3'] = array(
    '#type' => 'select',
    '#title' => t('3 Blocks'),
		'#options' => $grid3,
		'#description' => t(''),
    '#default_value' => $settings['bottomgrid_3']
  	);
	$form['gridlayout']['bottomlayout']['bottomgrid_4'] = array(
    '#type' => 'select',
    '#title' => t('4 Blocks'),
		'#options' => $grid4,
		'#description' => t(''),
    '#default_value' => $settings['bottomgrid_4']
  	);
	
	$form['gridlayout']['bottomlayout']['bottomgrid_5'] = array(
    '#type' => 'select',
    '#title' => t('5 Blocks'),
		'#options' => $grid5,
		'#description' => t(''),
    '#default_value' => $settings['bottomgrid_5']
  	);
  	$form['gridlayout']['bottomlayout']['bottomgrid_6'] = array(
    '#type' => 'select',
    '#title' => t('6 Blocks'),
		'#options' => $grid6,
		'#description' => t(''),
    '#default_value' => $settings['bottomgrid_6']
  	);
// ===================================== 

// FOOTER REGION LAYOUT =====================================

	$form['gridlayout']['footerlayout'] = array(
		  '#type' => 'fieldset',
		  '#title' => t('Footer Region'),
		  '#collapsible' => TRUE,
		  '#collapsed' => TRUE,
		  '#description' => t('Select the layouts for this region.  You can choose a default layout for each of the possible block counts. ')
	);
	$form['gridlayout']['footerlayout']['footergrid_1'] = array(
    '#type' => 'select',
    '#title' => t('1 Block'),
		'#options' => $grid1,
		'#description' => t(''),
    '#default_value' => $settings['footergrid_1']
  	);
	$form['gridlayout']['footerlayout']['footergrid_2'] = array(
    '#type' => 'select',
    '#title' => t('2 Blocks'),
		'#options' => $grid2,
		'#description' => t(''),
    '#default_value' => $settings['footergrid_2']
  	);
  	$form['gridlayout']['footerlayout']['footergrid_3'] = array(
    '#type' => 'select',
    '#title' => t('3 Blocks'),
		'#options' => $grid3,
		'#description' => t(''),
    '#default_value' => $settings['footergrid_3']
  	);
	$form['gridlayout']['footerlayout']['footergrid_4'] = array(
    '#type' => 'select',
    '#title' => t('4 Blocks'),
		'#options' => $grid4,
		'#description' => t(''),
    '#default_value' => $settings['footergrid_4']
  	);
	
	$form['gridlayout']['footerlayout']['footergrid_5'] = array(
    '#type' => 'select',
    '#title' => t('5 Blocks'),
		'#options' => $grid5,
		'#description' => t(''),
    '#default_value' => $settings['footergrid_5']
  	);
  	$form['gridlayout']['footerlayout']['footergrid_6'] = array(
    '#type' => 'select',
    '#title' => t('6 Blocks'),
		'#options' => $grid6,
		'#description' => t(''),
    '#default_value' => $settings['footergrid_6']
  	);
// =====================================  	
	

// MENU =====================================  	

  $form['menu'] = array(
  '#type' => 'fieldset',
  '#title' => t('Menu settings'),
  '#collapsible' => TRUE,
  '#collapsed' => TRUE,
  );

  $form['menu']['menutype'] = array(
    '#type' => 'select',
    '#title' => t('Menu type'),
		'#options' => array(
			'dfission' => 'dFission',
			'suckerfish' => 'Suckerfish', 
			'splitmenu' => 'SplitMenu',
			'none' => "None"
		),
		'#description' => t('Type of menu for main navigation'),
    '#default_value' => $settings['menutype'],
  );
  
  $form['menu']['level2cols'] = array(
    '#type' => 'select',
    '#title' => t('Secondary Menu Columns'),
		'#options' => array(
			'1' => '1',
			'2' => '2'
		),
		'#description' => t('Columns for Level 1 Submenu'),
    '#default_value' => $settings['level2cols'],
  );
  $form['menu']['level3cols'] = array(
    '#type' => 'select',
    '#title' => t('3rd Menu Columns'),
		'#options' => array(
			'1' => '1',
			'2' => '2'
		),
		'#description' => t('Columns for Level 2 Submenu'),
    '#default_value' => $settings['level3cols'],
  );
  $form['menu']['menu_duration'] = array(
	    '#type' => 'textfield',
	    '#title' => t('Menu Duration'),
	 	'#prefix' => '<div class="escaped">',
	 	'#suffix' => '</div>',
	    '#default_value' => $settings['menu_duration'],
		'#size' => 10,
		'#required' => TRUE
	);

	$form['menu']['show_subtext_1'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show First Level Menu Subtext'),
    '#default_value' => $settings['show_subtext_1']
	);
	
	$form['menu']['show_subtext_2'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show Second Level Menu Subtext'),
    '#default_value' => $settings['show_subtext_2']
	);
	
	$form['menu']['show_subtext_3'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show All Other Menu Subtext'),
    '#default_value' => $settings['show_subtext_3']
	);
  

	  
// ELEMENTS =====================================
	 $form['elements'] = array(
	  '#type' => 'fieldset',
	  '#title' => t('Elements'),
	  '#collapsible' => TRUE,
	  '#collapsed' => TRUE,
	);
	
	
	$form['elements']['show_breadcrumb'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show breadcrumb'),
    '#default_value' => $settings['show_breadcrumb']
	);
	
	$form['elements']['show_copyright'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show Copyright'),
    '#default_value' => $settings['show_copyright']
	);
	$form['elements']['fontspan'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable Font Span'),
    '#default_value' => $settings['fontspan']
	);
	$form['elements']['enable_ie6warn'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable IE6 Warning Message'),
    '#default_value' => $settings['enable_ie6warn']
	);

	
	$form['elements']['copyright_text'] = array(
	    '#type' => 'textfield',
	    '#title' => t('Copyright Text'),
	 	'#prefix' => '<div class="escaped">',
	 	'#suffix' => '</div>',
	    '#default_value' => $settings['copyright_text'],
		'#size' => 70,
		'#required' => TRUE
	);


  
 
  // Return the additional form widgets
  return $form;
	
}


function somaxiom_settings_defaults(){
	
	$defaults = array(
		
		'presetstyle'	 			=> "style1",
		'body_level'				=> "high",
		'body_style'				=> "circles",
		'link_color'				=> "#CD5A1C",
		'article_style'				=> "default",
		'fontspan'					=> 1,
		'font_family'            	=> "helvetica",
		'default_font'				=> "default",
		'menutype' 					=> "dfission",
		'level2cols'				=> "2",
		'level3cols'				=> "1",
		'menu_duration'				=> "300",
		'show_subtext_1'			=> 0,
		'show_subtext_2'			=> 1,
		'show_subtext_3'			=> 1,
		'default_font' 				=> "default",
		'topgrid_2'					=> "6|6",
		'topgrid_3'					=> "4|4|4",
		'topgrid_4'					=> "3|3|3|3",
		'topgrid_5'					=> "2|3|2|3|2",
		'headergrid_2'				=> "6|6",
		'headergrid_3'				=> "4|4|4",
		'headergrid_4'				=> "3|3|3|3",
		'headergrid_5'				=> "2|3|2|3|2",
		'showcasegrid_2'			=> "6|6",
		'showcasegrid_3'			=> "4|4|4",
		'showcasegrid_4'			=> "3|3|3|3",
		'showcasegrid_5'			=> "2|3|2|3|2",
		'utilitygrid_2'				=> "6|6",
		'utilitygrid_3'				=> "4|4|4",
		'utilitygrid_4'				=> "3|3|3|3",
		'utilitygrid_5'				=> "2|3|2|3|2",
		'featuregrid_2'				=> "6|6",
		'featuregrid_3'				=> "4|4|4",
		'featuregrid_4'				=> "3|3|3|3",
		'featuregrid_5'				=> "2|3|2|3|2",
		'maintopgrid_2'				=> "6|6",
		'maintopgrid_3'				=> "4|4|4",
		'maintopgrid_4'				=> "3|3|3|3",
		'maintopgrid_5'				=> "2|3|2|3|2",
		'mainbottomgrid_2'			=> "6|6",
		'mainbottomgrid_3'			=> "4|4|4",
		'mainbottomgrid_4'			=> "3|3|3|3",
		'mainbottomgrid_5'			=> "2|3|2|3|2",
		'bottomgrid_2'				=> "6|6",
		'bottomgrid_3'				=> "4|4|4",
		'bottomgrid_4'				=> "3|3|3|3",
		'bottomgrid_5'				=> "2|3|2|3|2",
		'footergrid_2'				=> "6|6",
		'footergrid_3'				=> "4|4|4",
		'footergrid_4'				=> "3|3|3|3",
		'footergrid_5'				=> "2|3|2|3|2",
		'mainbodygrid_2'			=> "2",
		'mainbodygrid_3'			=> "0",
		'show_breadcrumb'			=> 1,
		'show_textsizer'		 	=> 1,
		'show_date'					=> 1,
		'show_copyright' 			=> 1,
		'enable_ie6warn'			=> 1,
		'link_title'				=> 0,
		'copyright_text'		 	=> "Designed by RocketTheme, LLC"

  	);
  
	return $defaults;
	
}

