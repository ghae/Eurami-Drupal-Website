<?php

/**
 * Comment out for production!
 * For development only. Defeats theme register caching.
 * Changes to theme show immediately, but performance is effected.
 * Comment out for production.
 */
drupal_rebuild_theme_registry();

/*
* Initialize theme settings
*/
if (is_null(theme_get_setting('presetstyle'))) {  

  global $theme_key;

	if (!(function_exists('somaxiom_settings_defaults'))){
		include('theme-settings.php');
	}
	
	
  $defaults = somaxiom_settings_defaults();

  // Get default theme settings.
  $settings = theme_get_settings($theme_key);
  // Don't save the toggle_node_info_ variables.
  if (module_exists('node')) {
    foreach (node_get_types() as $type => $name) {
      unset($settings['toggle_node_info_' . $type]);
    }
  }
  // Save default theme settings.
  variable_set(
    str_replace('/', '_', 'theme_'. $theme_key .'_settings'),
    array_merge($defaults, $settings)
  );

  // Force refresh of Drupal internals.
  theme_get_setting('', TRUE);

}



/**
* Override or insert PHPTemplate variables into the search_block_form template.
*
* @param $vars
*   A sequential array of variables to pass to the theme template.
* @param $hook
*   The name of the theme function being called (not used in this case.)
*/
function somaxiom_preprocess_search_block_form(&$variables) {
  $variables['form']['search_block_form']['#title'] = '';
  $variables['form']['search_block_form']['#size'] = 30;
  $variables['form']['search_block_form']['#value'] = 'Search...';
  $variables['form']['search_block_form']['#attributes'] = array('onblur' => "if (this.value == '') {this.value = '".$variables['form']['search_block_form']['#value']."';}", 'onfocus' => "if (this.value == '".$variables['form']['search_block_form']['#value']."') {this.value = '';}" );
  unset($variables['form']['search_block_form']['#printed']);

  $variables['search']['search_block_form'] = drupal_render($variables['form']['search_block_form']);

  $variables['search_form'] = implode($variables['search']);
}

function somaxiom_blocks($region) {
  $output = '';

  if ($list = block_list($region)) {
    $blockcounter = 1; // there is at least one block in this region
    foreach ($list as $key => $block) {
      // $key == <i>module</i>_<i>delta</i>
      $block->extraclass = ''; // add the 'extracclass' key to the $block object
      $block->num_count = 0;
      if ($blockcounter == 1){ // is this the first block in this region?
        $block->extraclass .= 'first'; 
      }
      elseif ($blockcounter == count($list)){ // is this the last block in this region?
        $block->extraclass .= 'last';
      }
      else {
      	$block->extraclass .= 'middle';
      }
      
      
      $output .= theme('block', $block);
      $blockcounter++;
    }
   
  }

  // Add any content assigned to this region through drupal_set_content() calls.
  $output .= drupal_get_content($region);

  return $output;
}

function somaxiom_links($links, $attributes = array('class' => 'links')) {
  global $language;
  $output = '';

  if (count($links) > 0) {
    $output = '<div'. drupal_attributes($attributes) .'>';

    $num_links = count($links);
    $i = 1;
   
    foreach ($links as $key => $link) {
      $class = $key;

      // Add first, last and active classes to the list of links to help out themers.
      if ($i == 1) {
        $class .= ' first';
      }
      if ($i == $num_links) {
        $class .= ' last';
      }
      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))
          && (empty($link['language']) || $link['language']->language == $language->language)) {
        $class .= ' active';
      }
      $output .= '<div class="rt-readon-surround" style="float: left;">';

      if (isset($link['href'])) {
        // Pass in $link as $options, they share the same keys.
        $link['html'] = TRUE;
        //$output .= l($link['title'], $link['href'], $link);
        $output .= '<a href="' . base_path() . $link['href'] . '" class="readon"><span>'. $link['title'] .'</span></a>';
      }
      else if (!empty($link['title'])) {
        // Some links are actually not links, but we wrap these in <span> for adding title and class attributes
        if (empty($link['html'])) {
          $link['html'] = TRUE;//check_plain($link['title']);
        }
        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $output .= '<span'. $span_attributes .'>'. $link['title'] .'</span>';
      }

      $i++;
      $output .= "</div>\n";
    }

    $output .= '</div>';
  }

  return $output;
}



function somaxiom_preprocess_block(&$variables){
	
	$variables['block_count'] = count(block_list($variables['block']->region));

	
}


function somaxiom_preprocess_maintenance_page(&$vars) {
	somaxiom_preprocess_page($vars);
}



function GantryBrowser() {
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$variables['platform'] = _checkPlatform($user_agent);
	//$this->_checkBrowser();
    //$this->_checkEngine();

	// add short version
	//if ($this->version != 'unknown') $this->shortversion = substr($this->version, 0, strpos($this->version, '.'));
	//else $this->shortversion = 'unknown';

    //$this->_createChecks();
}

function _checkPlatform($agent) {
	$platform;
	if (preg_match("/iPhone/", $agent) || preg_match("/iPod/", $agent)) {
		$platform = "iphone";
	}
	elseif (preg_match("/iPad/", $agent)) {
		$platform = "ipad";
	}
	elseif (preg_match("/Android/", $agent)) {
		$platform = "android";
	}
	elseif (preg_match("/Mobile/i", $agent)) {
		$platform = "mobile";
	}
	elseif (preg_match("/win/i", $agent)) {
		$platform = "win";
	}
	elseif (preg_match("/mac/i", $agent)) {
		$platform = "mac";
	}
	elseif (preg_match("/linux/i", $agent)) {
		$platform = "linux";
	} else {
		$platform = "unknown";
	}

	return $platform;
}

function _checkEngine($browserName){
    switch($browserName){
        case 'ie':
            $engine = 'trident';
            break;
		case 'minefield':
        case 'firefox':
            $engine = 'gecko';
            break;
        case 'android':
        case 'ipad':
        case 'iphone':
        case 'chrome':
        case 'safari':
            $engine = 'webkit';
            break;
        case 'opera':
            $engine = 'presto';
            break;
        default:
            $engine = 'unknown';
            break;
    }
    
    return $engine;
}
function _checkBrowser($agent) {
	$browser_array = array();
	// IE
	if (preg_match('/msie/i', $agent) && !preg_match('/opera/i', $agent)) {
		$result = explode(' ', stristr(str_replace(';', ' ', $agent), 'msie'));
		$browser_array[0] = 'ie';
		$browser_array[1] = $result[1];
	}
	// Firefox
	elseif (preg_match('/Firefox/', $agent)) {
		$result = explode('/', stristr($agent, 'Firefox'));
		$version = explode(' ', $result[1]);
		$browser_array[0] = 'firefox';
		$browser_array[1] = $version[0];
	}
	// Minefield
	elseif (preg_match('/Minefield/', $agent)) {
		$result = explode('/', stristr($agent, 'Minefield'));
		$version = explode(' ', $result[1]);
		$browser_array[0] = 'minefield';
		$browser_array[1] = $version[0];
	}
	// Chrome
	elseif (preg_match('/Chrome/', $agent)) {
		$result = explode('/', stristr($agent, 'Chrome'));
		$version = explode(' ', $result[1]);
		$browser_array[0] = 'chrome';
		$browser_array[1] = $version[0];
	}
	//Safari
	elseif (preg_match('/Safari/', $agent) && !preg_match('/iPhone/', $agent) && !preg_match('/iPod/', $agent) && !preg_match('/iPad/', $agent)) {
		$result = explode('/', stristr($agent, 'Version'));
		$browser_array[0] = 'safari';
		if (isset ($result[1])) {
			$version = explode(' ', $result[1]);
			$browser_array[1] = $version[0];
		} else {
			$browser_array[1] = 'unknown';
		}
	}
	// Opera
	elseif (preg_match('/opera/i', $agent)) {
		$result = stristr($agent, 'opera');

		if (preg_match('/\//', $result)) {
			$result = explode('/', $result);
			$version = explode(' ', $result[1]);
			$browser_array[0] = 'opera';
			$browser_array[1] = $version[0];
		} else {
			$version = explode(' ', stristr($result, 'opera'));
			$browser_array[0] = 'opera';
			$browser_array[1] = $version[1];
		}
	}
	// iPhone/iPod
	elseif (preg_match('/iPhone/', $agent) || preg_match('/iPod/', $agent)) {
		$result = explode('/', stristr($agent, 'Version'));
		$browser_array[0] = 'iphone';
		if (isset ($result[1])) {
			$version = explode(' ', $result[1]);
			$browser_array[1] = $version[0];
		} else {
			$browser_array[1] = 'unknown';
		}
	}
	// iPad
	elseif (preg_match('/iPad/', $agent)) {
		$result = explode('/', stristr($agent, 'Version'));
		$browser_array[0] = 'ipad';
		if (isset ($result[1])) {
			$version = explode(' ', $result[1]);
			$browser_array[1] = $version[0];
		} else {
			$browser_array[1] = 'unknown';
		}
	}
	// Android
	elseif (preg_match('/Android/', $agent)) {
		$result = explode('/', stristr($agent, 'Version'));
		$browser_array[0] = 'android';
		if (isset ($result[1])) {
			$version = explode(' ', $result[1]);
			$browser_array[1] = $version[0];
		} else {
			$browser_array[1] = "unknown";
		}
	} else {
		$browser_array[0] = "unknown";
		$browser_array[0] = "unknown";
	}
	
	return $browser_array;
}



function somaxiom_preprocess_page(&$variables) {
	
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$variables['platform'] = _checkPlatform($user_agent);
	$thisBrowser = _checkBrowser($user_agent);
	$variables['browser_name'] = $thisBrowser[0];
	$variables['browser_version'] = $thisBrowser[1];
    $variables['browser_engine'] = _checkEngine($thisBrowser[0]);
	
	
	$variables['path'] = base_path() . path_to_theme();
	$css_path = path_to_theme().'/css/';
	$js_path = path_to_theme() . '/js/';
	$variables['file_path'] = base_path().file_directory_path();
	$variables['url'] = "http://" . $_SERVER['HTTP_HOST'] . url();
    $variables['uri'] = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    
    $variables['tabs2'] = menu_secondary_local_tasks();
	
	$rt_style_includes = path_to_theme() . "/styles.php";
	include $rt_style_includes;
				
	
	// presetstyle
	if( isset( $_COOKIE['somaxiom_presetstyle'] ) )
		$variables['somaxiom_presetstyle'] = $_COOKIE['somaxiom_presetstyle']; 
	else
		$variables['somaxiom_presetstyle'] = theme_get_setting(presetstyle);
	
	$style = $stylesList[$variables['somaxiom_presetstyle']];
	
	
	
	if (theme_get_setting(presetstyle) == "custom" OR isset( $_COOKIE['somaxiom_body_level'])) {
		if( isset( $_COOKIE['somaxiom_body_level'] ) )
			$variables['somaxiom_body_level'] = $_COOKIE['somaxiom_body_level']; 
		else
			$variables['somaxiom_body_level'] = theme_get_setting(body_level);
	}
	else 
		$variables['somaxiom_body_level'] = $style['body_level'];
	

	if (theme_get_setting(presetstyle) == "custom" OR isset( $_COOKIE['somaxiom_body_style'])) {
		if( isset( $_COOKIE['somaxiom_body_style'] ) )
			$variables['somaxiom_body_style'] = $_COOKIE['somaxiom_body_style']; 
		else
			$variables['somaxiom_body_style'] = theme_get_setting(body_style);
	}
	else 
		$variables['somaxiom_body_style'] = $style['body_style'];
	
	
	if (theme_get_setting(presetstyle) == "custom" OR isset( $_COOKIE['somaxiom_link_color'])) {
		if( isset( $_COOKIE['somaxiom_link_color'] ) )
			$variables['somaxiom_link_color'] = $_COOKIE['somaxiom_link_color']; 
		else
			$variables['somaxiom_link_color'] = theme_get_setting(link_color);
	}
	else 
		$variables['somaxiom_link_color'] = $style['link_color'];
	
	if (theme_get_setting(presetstyle) == "custom" OR isset( $_COOKIE['somaxiom_article_style'])) {
		if( isset( $_COOKIE['somaxiom_article_style'] ) )
			$variables['somaxiom_article_style'] = $_COOKIE['somaxiom_article_style']; 
		else
			$variables['somaxiom_article_style'] = theme_get_setting(article_style);
	}
	else 
		$variables['somaxiom_article_style'] = $style['article_style'];	
	
	
	
	// fontfamily	
	if( isset( $_COOKIE['somaxiom_fontfamily'] ) )
		$variables['somaxiom_fontfamily'] = $_COOKIE['somaxiom_fontfamily']; 
	else
		$variables['somaxiom_fontfamily'] = theme_get_setting(font_family);

	
	// default font size
	if( isset( $_COOKIE['somaxiom_default_font'] ) )
		$variables['somaxiom_default_font'] = $_COOKIE['somaxiom_default_font']; 
	else
		$variables['somaxiom_default_font'] = theme_get_setting(default_font);
	
	// set global for menu style if exists
	if( isset( $_COOKIE['somaxiom_menutype'] ) )
		$variables['somaxiom_menutype'] = $_COOKIE['somaxiom_menutype']; 
	else
		$variables['somaxiom_menutype'] = theme_get_setting('menutype');
	
	
	
	$variables['scripts'] = drupal_get_js();
	$variables['styles'] = drupal_get_css();

	// get widths for block regions
	
	$block_regions = array('top', 'header', 'showcase', 'feature', 'maintop', 'mainbottom', 'bottom', 'footer', 'sidebar', 'sidebar2');
	
	$block_region_widths = array(
		1 => 'w99',
		2 => 'w49',
		3 => 'w33',
		4 => 'w24'
	);
	
 	foreach($block_regions as $block_region){
		$blocks = block_list($block_region);	
		$variables[$block_region.'_width'] = ($block_region_widths[count($blocks)] ? $block_region_widths[count($blocks)] : $block_region_widths[4]);
		$variables[$block_region.'_number'] = count($blocks);
		
	} 
	

	if (strpos(request_uri(), 'wrapper') != false){
		$variables['template_file'] = 'page-wrapper';
	}

}

function getMBgrid($sidebarcount) {
	$mbgrid2 = array('6|6','8|4', '9|3','6|6','4|8', '3|9');
	$mbgrid3 = array('6|3|3', '8|2|2', '3|3|6', '2|2|8');

	$mbCount = $sidebarcount+1;
	
	$mbVar = "mainbodygrid_" . $mbCount;
	$mbNumber = theme_get_setting($mbVar);
	//echo "regions: " . $mbCount . " pulledval: " . $mbNumber;
	
	// 1 REGION
	if($mbCount==1){$maingrid=12;}
	
	// 2 REGIONS 
	elseif($mbCount==2){
		$mbGridSelected = $mbgrid2[$mbNumber];
		//echo $mbGridSelected;
		$mbArray = explode("|", $mbGridSelected);
		// MS
		if($mbNumber < 3) { 
			$maingrid=$mbArray[0]; 
			$sidegrid=$mbArray[1];
		}
		// SM
		else {
			$sidegrid=$mbArray[0];
			$maingrid=$mbArray[1];
		}
	}
	// 3 REGIONS 
	elseif($mbCount==3){
		$mbGridSelected = $mbgrid3[$mbNumber];
		//echo $mbGridSelected;
		$mbArray = explode("|", $mbGridSelected);
		// MS
		if($mbNumber < 2) { 
			$maingrid=$mbArray[0]; 
			$sidegrid=$mbArray[1];
			$sidegrid2=$mbArray[2];
		}
		// SM
		else {
			$sidegrid=$mbArray[0];
			$sidegrid2=$mbArray[1];
			$maingrid=$mbArray[2];
		}
	}
	
	return array($maingrid, $sidegrid, $sidegrid2, $mbNumber);
}

function somaxiom_restore_defaults() {
	
	$cookie_path = "/";
	foreach($_COOKIE as $key => $value) {
		if(substr($key, 0, 9) == 'somaxiom_') {
			setcookie($key, '', 1, $cookie_path);
		}
	}
	
	
	drupal_goto('<front>');
}


function somaxiom_change_theme($change, $changeVal, $page=''){
	

	//change=showcase&styleVar=color2&bglevel=high&preset=style1
	
	$theme_settings = variable_get('theme_somaxiom_settings', array());
	
	$cookie_prefix = "somaxiom_";
	$cookie_time = time()+31536000;
	$cookie_path = "/";
	
	
	if($change && $changeVal){
		
		switch ($change){
			
			case 'showcase':
				
				$rt_style_includes = path_to_theme() . "/styles.php";
				include $rt_style_includes;
				
				$style = $stylesList[$preset];
				
				setcookie("somaxiom_presetstyle", $preset, $cookie_time, $cookie_path);
				setcookie("somaxiom_linkcolor", $style[0], $cookie_time, $cookie_path);
				setcookie("somaxiom_showcase_color", $changeVal, $cookie_time, $cookie_path);
			
			break;
			
			case 'fontfamily':
			
				$cookie_name = $cookie_prefix . "font_family";
				setcookie($cookie_name, $changeVal, $cookie_time);
			
			break;
			
			case 'tstyle':
				
				$rt_style_includes = path_to_theme() . "/styles.php";
				include $rt_style_includes;
				
				$style = $stylesList[$changeVal];
				
				setcookie("somaxiom_presetstyle", $changeVal, $cookie_time, $cookie_path);
				
				
				
			break;		
	

			case 'menu_type':
				$cookie_name = $cookie_prefix . "menutype";
				setcookie($cookie_name, $changeVal, $cookie_time, $cookie_path);
			
			break;

		}


		
	}
	

	if ($page){
		drupal_goto("node/$page");
	}
	else {
		drupal_goto('<front>');
	}
	
}



function change_font($change, $page=''){

	$cookie_prefix = "somaxiom_";
	$cookie_time = time()+31536000;
	$cookie_path = "/";
	$cookie_name = $cookie_prefix . "default_font";
	setcookie($cookie_name, $change, $cookie_time, $cookie_path);
	
	$query = "openchooser=1";
	
	if ($page){
		drupal_goto("node/$page", $query);
	}
	else {
		drupal_goto("<front>", $query);
	}
	
}



//********************************************
// PRIMARY LINK MENU ITEM INFO
//********************************************

/**
 * Returns a rendered menu tree.
 *
 * @param $tree
 *   A data structure representing the tree as returned from menu_tree_data.
 * @return
 *   The rendered HTML of that data structure.
 */
function main_menu_tree_output($tree) {
  $output = '';
  $items = array();

  if( isset( $_COOKIE['somaxiom_menutype'] ) )
	$this_mtype = $_COOKIE['somaxiom_menutype']; 
  else
	$this_mtype = theme_get_setting('menutype');
  // Pull out just the menu items we are going to render so that we
  // get an accurate count for the first/last classes.
  foreach ($tree as $data) {
    if (!$data['link']['hidden']) {
      $items[] = $data;
    }
  }

  $num_items = count($items);
  foreach ($items as $i => $data) {
    
    $extra_class = NULL;
    //$extra_class = get_link_color($items[$i]['title']);
    
    if (stristr($i, 'active')) {
        $extra_class .= " active";
      }
    
    
    if ($i == 0) {
      //$extra_class = 'first';
    }
    if ($i == $num_items - 1) {
      //$extra_class = 'last';
    }
    $link = main_menu_item_link($data['link'], $data['link']['has_children']);
   
    if ($data['below']) {
      $extra_class = "parent ";
      if($this_mtype == "splitmenu") {
      	$output .= main_menu_item($link, $data['link']['has_children'], '', $data['link']['in_active_trail'], $extra_class);
      }	
      else {	
      	$output .= main_menu_item($link, $data['link']['has_children'], sub_menu_tree_output($data['below']), $data['link']['in_active_trail'], $extra_class);
      }
    }
    
    else {
      $output .= main_menu_item($link, $data['link']['has_children'], '', $data['link']['in_active_trail'], $extra_class);
    }
  }
  return $output ? main_menu_tree($output) : '';
}



function sub_menu_tree_output($tree) {
  if( isset( $_COOKIE['somaxiom_menutype'] ) )
	$this_mtype = $_COOKIE['somaxiom_menutype']; 
  else
	$this_mtype = theme_get_setting('menutype');
  
  $output = '';
  $items = array();

  // Pull out just the menu items we are going to render so that we
  // get an accurate count for the first/last classes.
  foreach ($tree as $data) {
    if (!$data['link']['hidden']) {
      $items[] = $data;
    }
  }

  $num_items = count($items);
  foreach ($items as $i => $data) {
    
    $extra_class = NULL;
    //$extra_class = get_link_color($items[$i]['title']);
    
    if (stristr($i, 'active')) {
        $extra_class .= " active";
      }
    
    
    if ($i == 0) {
      //$extra_class = 'first';
    }
    if ($i == $num_items - 1) {
      //$extra_class = 'last';
    }
    $link = sub_menu_item_link($data['link'], $data['link']['has_children']);
    if ($data['below']) {
    	$extra_class = " parent f-parent-item f-menuparent-item";
      	if($this_mtype == "dfission" OR $this_mtype == "suckerfish") {
      		$output .= sub_menu_item($link, $data['link']['has_children'], tri_menu_tree_output($data['below']), $data['link']['in_active_trail'], $extra_class);
    	}
    	else {
    		$output .= sub_menu_item($link, $data['link']['has_children'], sub_menu_tree_output($data['below']), $data['link']['in_active_trail'], $extra_class);
    	}
    }
    else {
      $output .= sub_menu_item($link, $data['link']['has_children'], '', $data['link']['in_active_trail'], $extra_class);
    }
  }
  return $output ? sub_menu_tree($output) : '';
}

function tri_menu_tree_output($tree) {
  $output = '';
  $items = array();

  // Pull out just the menu items we are going to render so that we
  // get an accurate count for the first/last classes.
  foreach ($tree as $data) {
    if (!$data['link']['hidden']) {
      $items[] = $data;
    }
  }

  $num_items = count($items);
  foreach ($items as $i => $data) {
    
    $extra_class = NULL;
    //$extra_class = get_link_color($items[$i]['title']);
    
    if (stristr($i, 'active')) {
        $extra_class .= " active";
      }
    
    if ($i == 0) {
      //$extra_class = 'first';
    }
    if ($i == $num_items - 1) {
      //$extra_class = 'last';
    }
    $link = tri_menu_item_link($data['link'], $data['link']['has_children']);
    if ($data['below']) {
      $extra_class = " parent ";
      $output .= tri_menu_item($link, $data['link']['has_children'], tri_menu_tree_output($data['below']), $data['link']['in_active_trail'], $extra_class);
    }
    else {
      $output .= tri_menu_item($link, $data['link']['has_children'], '', $data['link']['in_active_trail'], $extra_class);
    }
  }
  return $output ? tri_menu_tree($output) : '';
}



/**
 * FULL MENU TREE
 */
function main_menu_tree($tree) {	
  	if(theme_get_setting(presetstyle) == "custom")
  		$head_shadows = theme_get_setting(header_shadows);
  	else {
  		$rt_style_includes = path_to_theme() . "/styles.php";
		include $rt_style_includes;
		$style = $stylesList[theme_get_setting(presetstyle)];
  		$head_shadows = $style['header-shadows'];
  	}
  	return '<ul class="header-shadows-' . $head_shadows . ' menutop level1">'. $tree .'</ul>';
}

/**
 * SUB MENU TREE
 */
function sub_menu_tree($tree) {
  	$numCols = theme_get_setting(level2cols);
  	return '<div class="fusion-submenu-wrapper level2 columns' . $numCols . '"><div class="drop-top"></div><ul class="level2 columns' . $numCols . '">'. $tree .'</ul></div>';
}

/**
 * TRI MENU TREE
 */
function tri_menu_tree($tree) {
	$numCols = theme_get_setting(level3cols);
  	return '<div class="fusion-submenu-wrapper level3 columns' . $numCols . '"><div class="drop-top"></div><ul class="level3 columns' . $numCols . '">'. $tree .'</ul></div>';
}




/**
  * MENU ITEM 
 */
function main_menu_item($link, $has_children, $menu = '', $in_active_trail = FALSE, $extra_class = NULL) {
  //$class = ($menu ? 'expanded' : ($has_children ? 'collapsed' : 'leaf'));
  $class = "item";
  $id = "";
  if (!empty($extra_class)) {
    $class .= " " . $extra_class;
  }
  if ($in_active_trail) {
    $class .= ' active';
  }
  
  $class .= " root f-main-parent f-mainparent-item";
  
  	
  return '<li class="'. $class .'">'. $link . $menu . "</li>\n";
	

}

/**
  * SUB MENU ITEM 
 */
function sub_menu_item($link, $has_children, $menu = '', $in_active_trail = FALSE, $extra_class = NULL) {
  //$class = ($menu ? 'expanded' : ($has_children ? 'collapsed' : 'leaf'));
  $class = "";
  if (!empty($extra_class)) {
    $class .= $extra_class;
  }
  if ($in_active_trail) {
    $class .= ' active';
  }
  return '<li class=" item1'. $class .'">'. $link . $menu . "</li>\n";
}

  /* TRI MENU ITEM 
 */
function tri_menu_item($link, $has_children, $menu = '', $in_active_trail = FALSE, $extra_class = NULL) {
  //$class = ($menu ? 'expanded' : ($has_children ? 'collapsed' : 'leaf'));
  $class = "";
  if (!empty($extra_class)) {
    $class .= $extra_class;
  }
  if ($in_active_trail) {
    $class .= ' active';
  }
  return '<li class="'. $class .' item1">'. $link . $menu . "</li>\n";
}


 
 
function main_menu_item_link($link, $has_children = FALSE) {
  if (empty($link['localized_options'])) {
    $link['localized_options'] = array();
  }
  if(strlen(strstr($link['href'],"http"))>0) {
  	$href = $link['href'];	
  }
  else {
  	if(variable_get('clean_url', 0)) {
  		$href = $link['href'] == "<front>" ? base_path() : base_path() . drupal_get_path_alias($link['href']);
  	}
  	else {
  		$href = $link['href'] == "<front>" ? base_path() : base_path() . "?q=" . drupal_get_path_alias($link['href']);
  	}
  }
  
  $subtext = $link['localized_options']['attributes']['title'];
  
  $class = "orphan item bullet";
  
  if($link['title'] == $subtext) {
  	$subtext = "";
  }
  
  if($subtext != "" AND theme_get_setting(show_subtext_1)) {
  	$class .= " subtext";
  }
  
  if(theme_get_setting(show_subtext_1)) {
  	$this_link = "<a class='" . $class . "' href='" . $href . "' title='" . $subtext . "'><span>" . $link['title'] . "<em>" . $subtext . "</em></span></a>";
  }
  else {
  	$this_link = "<a class='" . $class . "' href='" . $href . "' title='" . $subtext . "'><span>" . $link['title'] . "</span></a>";
  }
  
  //return l($link['title'], $link['href'], $link['localized_options']);
  return $this_link;
}

function sub_menu_item_link($link, $has_children = FALSE) {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $thisBrowser = _checkBrowser($user_agent);
    $browser_name = $thisBrowser[0];
    $browser_version = $thisBrowser[1];
    $ver = preg_replace ('/\.(.*)/','',$browser_version);
    $bname = $browser_name . $ver;

  if (empty($link['localized_options'])) {
    $link['localized_options'] = array();
  }
  if(strlen(strstr($link['href'],"http"))>0) {
  	$href = $link['href'];	
  }
  else {
  	if(variable_get('clean_url', 0)) {
  		$href = $link['href'] == "<front>" ? base_path() : base_path() . drupal_get_path_alias($link['href']);
  	}
  	else {
  		$href = $link['href'] == "<front>" ? base_path() : base_path() . "?q=" . drupal_get_path_alias($link['href']);
  	}
  }	
  
  $subtext = $link['localized_options']['attributes']['title'];
  
  if($link['title'] == $subtext) {
  	$subtext = "";
  }

  $class = "";
  
  if($subtext != "" AND theme_get_setting(show_subtext_2)) {
  	$class .= "subtext ";
  }
  
  
  if($has_children) {
  	$class .= "daddy ";
  }
  else {
  	$class .= "orphan ";
  }
  
  $class .= "item bullet";
  if($bname == "ie7"){
  	$this_link = "<a class='" . $class . "' href='" . $href . "' title='" . $subtext . "'>" . $link['title'] . "</a>";
  
  }
  else {
    if(theme_get_setting(show_subtext_2)) {
    	$this_link = "<a class='" . $class . "' href='" . $href . "' title='" . $subtext . "'><span>" . $link['title'] . "<em>" . $subtext . "</em></span></a>";
    }
    else {
    	$this_link = "<a class='" . $class . "' href='" . $href . "' title='" . $subtext . "'><span>" . $link['title'] . "</span></a>";
    }
    
  }
  //return l($link['title'], $link['href'], $link['localized_options']);
  return $this_link;
}

function tri_menu_item_link($link, $has_children = FALSE) {
  $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $thisBrowser = _checkBrowser($user_agent);
    $browser_name = $thisBrowser[0];
    $browser_version = $thisBrowser[1];
    $ver = preg_replace ('/\.(.*)/','',$browser_version);
    $bname = $browser_name . $ver;

  if (empty($link['localized_options'])) {
    $link['localized_options'] = array();
  }
  if(strlen(strstr($link['href'],"http"))>0) {
  	$href = $link['href'];	
  }
  else {
  	if(variable_get('clean_url', 0)) {
  		$href = $link['href'] == "<front>" ? base_path() : base_path() . drupal_get_path_alias($link['href']);
  	}
  	else {
  		$href = $link['href'] == "<front>" ? base_path() : base_path() . "?q=" . drupal_get_path_alias($link['href']);
  	}
  }	
  
  $subtext = $link['localized_options']['attributes']['title'];
  
  if($link['title'] == $subtext) {
  	$subtext = "";
  }
  
  
  $class = "";
  
  if($subtext != "" AND theme_get_setting(show_subtext_3)) {
  	$class .= "subtext ";
  }
  
  if($has_children) {
  	$class .= "daddy ";
  }
  else {
  	$class .= "orphan ";
  }
  
  $class .= "item bullet";

  if($bname == "ie7"){
    $this_link = "<a class='" . $class . "' href='" . $href . "' title='" . $subtext . "'>" . $link['title'] . "</a>";

  }
  else {
    if(theme_get_setting(show_subtext_3)) {
    	$this_link = "<a class='" . $class . "' href='" . $href . "' title='" . $subtext . "'><span>" . $link['title'] . "<em>" . $subtext . "</em></span></a>";
    }
    else {
    	$this_link = "<a class='" . $class . "' href='" . $href . "' title='" . $subtext . "'><span>" . $link['title'] . "</span></a>";
    }
    
  }

  //return l($link['title'], $link['href'], $link['localized_options']);
  return $this_link;
}




//******************************************************************************

//********************************************
// SECONDARY LINK MENU ITEM INFO
//********************************************

/**
 * Returns a rendered menu tree.
 *
 * @param $tree
 *   A data structure representing the tree as returned from menu_tree_data.
 * @return
 *   The rendered HTML of that data structure.
 */
function sec_menu_tree_output($tree) {
  $output = '';
  $items = array();

  if( isset( $_COOKIE['somaxiom_menu_type'] ) )
	$this_mtype = $_COOKIE['somaxiom_menu_type']; 
  else
	$this_mtype = theme_get_setting('menu_type');
  // Pull out just the menu items we are going to render so that we
  // get an accurate count for the first/last classes.
  foreach ($tree as $data) {
    if (!$data['link']['hidden']) {
      $items[] = $data;
    }
  }

  $num_items = count($items);
  foreach ($items as $i => $data) {
    
    $extra_class = NULL;
    //$extra_class = get_link_color($items[$i]['title']);
    
    if (stristr($i, 'active')) {
        $extra_class .= " active";
      }
    
    
    if ($i == 0) {
      //$extra_class = 'first';
    }
    if ($i == $num_items - 1) {
      //$extra_class = 'last';
    }
    $link = sec_menu_item_link($data['link'], $data['link']['has_children']);
    
    $output .= sec_menu_item($link, $data['link']['has_children'], '', $data['link']['in_active_trail'], $extra_class);
    
  }
  return $output ? sec_menu_tree($output) : '';
}


/**
 * FULL MENU TREE
 */
function sec_menu_tree($tree) {
  	return '<div class="moduletable"><ul id="mainlevel-top">'. $tree .'</ul></div>';
}


/**
  * MENU ITEM 
 */
function sec_menu_item($link, $has_children, $menu = '', $in_active_trail = FALSE, $extra_class = NULL) {
  //$class = ($menu ? 'expanded' : ($has_children ? 'collapsed' : 'leaf'));
  $class = "item1 png";
  $id = "";
  if (!empty($extra_class)) {
    $class .= " " . $extra_class;
  }
  if ($in_active_trail) {
    $class .= ' active';
    $id .= 'current';
  }
  if($id == ""){
  	return '<li class="'. $class .'">'. $link . $menu . "</li>\n";
  }
  else {
  	return '<li id="' . $id . '" class="'. $class .'">'. $link . $menu . "</li>\n";
  }
}
 
 
function sec_menu_item_link($link, $has_children = FALSE) {
  if (empty($link['localized_options'])) {
    $link['localized_options'] = array();
  }
  if(strlen(strstr($link['href'],"http"))>0) {
  	$href = $link['href'];	
  }
  else {
  	if(variable_get('clean_url', 0)) {
  		$href = $link['href'] == "<front>" ? base_path() : base_path() . drupal_get_path_alias($link['href']);
  	}
  	else {
  		$href = $link['href'] == "<front>" ? base_path() : base_path() . "?q=" . drupal_get_path_alias($link['href']);
  	}
  }
  
  $subtext = $link['localized_options']['attributes']['title'];
  
  $this_link = "<a class='mainlevel-top' href='" . $href . "' title='" . $subtext . "'><span class='banner-big'>" . $link['title'] . "</span><span class='banner-small'>" . $subtext . "</span></a>"; 	
  //return l($link['title'], $link['href'], $link['localized_options']);
  return $this_link;
}



//******************************************************************************


//******************************************************************************

//********************************************
// SPLIT MENU ITEM INFO
//********************************************

/**
 * Returns a rendered menu tree.
 *
 * @param $tree
 *   A data structure representing the tree as returned from menu_tree_data.
 * @return
 *   The rendered HTML of that data structure.
 */
function split_menu_tree_output($tree) {
  $output = '';
  $items = array();

  if( isset( $_COOKIE['somaxiom_menu_type'] ) )
	$this_mtype = $_COOKIE['somaxiom_menu_type']; 
  else
	$this_mtype = theme_get_setting('menu_type');
  // Pull out just the menu items we are going to render so that we
  // get an accurate count for the first/last classes.
  foreach ($tree as $data) {
    if (!$data['link']['hidden']) {
      $items[] = $data;
    }
  }

  $num_items = count($items);
  foreach ($items as $i => $data) {
    
    $extra_class = NULL;
    //$extra_class = get_link_color($items[$i]['title']);
    
    if (stristr($i, 'active')) {
        $extra_class .= " active";
      }
    
    
    if ($i == 0) {
      //$extra_class = 'first';
    }
    if ($i == $num_items - 1) {
      //$extra_class = 'last';
    }
    $link = split_menu_item_link($data['link'], $data['link']['has_children']);
    
    $output .= split_menu_item($link, $data['link']['has_children'], '', $data['link']['in_active_trail'], $extra_class);
    
  }
  return $output ? split_menu_tree($output) : '';
}


/**
 * FULL MENU TREE
 */
function split_menu_tree($tree) {
  	return '<ul class="menu level1">'. $tree .'</ul>';
}


/**
  * MENU ITEM 
 */
function split_menu_item($link, $has_children, $menu = '', $in_active_trail = FALSE, $extra_class = NULL) {
  //$class = ($menu ? 'expanded' : ($has_children ? 'collapsed' : 'leaf'));
  $class = "";
  $id = "";
  if (!empty($extra_class)) {
    $class .= " " . $extra_class;
  }
  if ($in_active_trail) {
    $class .= 'active';
    $id .= 'current';
  }
  if($id == ""){
  	return '<li class="'. $class .'">'. $link . $menu . "</li>\n";
  }
  else {
  	return '<li id="' . $id . '" class="'. $class .'">'. $link . $menu . "</li>\n";
  }
}
 
 
function split_menu_item_link($link, $has_children = FALSE) {
  if (empty($link['localized_options'])) {
    $link['localized_options'] = array();
  }
  if(strlen(strstr($link['href'],"http"))>0) {
  	$href = $link['href'];	
  }
  else {
  	if(variable_get('clean_url', 0)) {
  		$href = $link['href'] == "<front>" ? base_path() : base_path() . drupal_get_path_alias($link['href']);
  	}
  	else {
  		$href = $link['href'] == "<front>" ? base_path() : base_path() . "?q=" . drupal_get_path_alias($link['href']);
  	}
  }
  
  $subtext = $link['localized_options']['attributes']['title'];
  
  $this_link = "<a class='item' href='" . $href . "' title='" . $subtext . "'><span>" . $link['title'] . "</span></a>"; 	
  //return l($link['title'], $link['href'], $link['localized_options']);
  return $this_link;
}



//******************************************************************************


/**
 * Generate the HTML output for a single menu link.
 *
 * @ingroup themeable
 */
function somaxiom_links__system_navigation_menu($variables) {
  $output = '';
  foreach ($variables['links'] as $link) {
    $output .= l($link['title'], $link['href'], $link);
  }
  return $output;
}


function somaxiom_views_view_field_Showcase($view, $type, $nodes) {

    $fields = _views_get_fields();
    $output .= '<div id="info"></div><ul id="test-list">';
    foreach ($nodes as $node) {
        $item = "";
        $i = $node->nid;
        foreach ($view->field as $field) {
            $item .= views_theme_field("views_handle_field",$field['queryname'], $fields, $field, $node, $type);
        }
        $output .= '<li id="listItem_'.$i.'"><div class="handle" />'.$item.'</div></li>';
    }
    $output .= '</ul>';

return $output;
}



/**
* Implementation of hook_theme.
*
* Register custom theme functions.
*/
function somaxiom_theme() {
  return array(
    // The form ID.
    'user_login_block' => array(
      // Forms always take the form argument.
      'arguments' => array('form' => NULL),
    ),
	'user_login_top_section' => array(
    // Forms always take the form argument.
    'arguments' => array(),
  ),
  );
}


function somaxiom_user_login_block($form) {
  $form['name']['#title'] = t(''); //wrap any text in a t function
  $form['name']['#value'] = t('Username');
  $form['pass']['#title'] = t('');
  $form['pass']['#value'] = t('Password');
  $form['submit']['#title'] = t('submit');  
  //unset($form['links']['#value']); //remove links under fields
  return (drupal_render($form));
}







function somaxiom_button($element) {
  // Make sure not to overwrite classes.
  if (isset($element['#attributes']['class'])) {
    $element['#attributes']['class'] = 'Button form-' . $element['#button_type'] . ' ' . $element['#attributes']['class'];
  }
  else {
    $element['#attributes']['class'] = 'Button form-' . $element['#button_type'];
  }

  // Skip admin pages due to some issues with ajax not being able to find buttons.
  if (arg(0) == 'admin') {
    //return '<input type="submit" '. (empty($element['#name']) ? '' : 'name="'. $element['#name'] .'" ') .'id="'. $element['#id'] .'" value="'. check_plain($element['#value']) .'" '. drupal_attributes($element['#attributes']) ." />\n";
  }
  
  if ($element['#value'] == 'Search') {
    return '<input type="submit" '. (empty($element['#name']) ? '' : 'name="'. $element['#name'] .'" ') .'id="'. $element['#id'] .'" value="'. check_plain($element['#value']) .'" '. drupal_attributes($element['#attributes']) ." />\n";
  }

  return '<div class="readon"><input class="button" type="submit" ' . (empty($element['#name']) ? '' : 'name="' . $element['#name']
         . '" ')  . 'id="' . $element['#id'] . '" value="' . check_plain($element['#value']) . '" ' . ' />'
         
         /*
         . '<span class="btn">'
         . '<span class="l"></span>'
         . '<span class="r"></span>'
         . '<span class="t">' . check_plain($element['#value']) . '</span>'
         . '</span></button>';
         */
         
        //.  check_plain($element['#value']) 
		. '</div>';

}




function somaxiom_get_theme_headers($theme){
	
	$themes = array (
		2 => 10,
		3 => 2,
		6 => 3
	);

	return $themes[$theme];
	
}



/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return a string containing the breadcrumb output.
 */
 /*
function somaxiom_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
		$breadcrumb[$_GET['q']] = drupal_get_title(); 
    return '<span class="breadcrumbs pathway">'. implode('<img src="/jul09/templates/rt_somaxiom_j15/images/arrow.png" />', $breadcrumb) .'</span>';
  }
}
*/

function somaxiom_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
	$breadcrumb_new = array();
	// Create new breadcrumb array without the top level image gallery link
	foreach ($breadcrumb as $crumb) {
		if (strstr($crumb, '<a href="/image">') != TRUE) {
			$breadcrumb_new[] = $crumb;
		}
	}
	$breadcrumb_new[] = drupal_get_title();
	$newCrumb = "";
	foreach ( $breadcrumb_new as $crumb ) {
  		if(!strpos($crumb, "a href")) {
  			$newCrumb .= '<span class="no-link">' . $crumb . '</span>';
  		}
  		else {
  			$newCrumb .= $crumb . '<img src="' . base_path() . path_to_theme() . '/images/arrow.png">';
  		}
  		
	}
	
	//$newCrumb = implode( $breadcrumb_new, '<img src="' . base_path() . path_to_theme() . '/images/arrow.png">');
	
	return '<div class="rt-breadcrumb-surround"><a id="breadcrumbs-home" href="' . base_path() . '"></a><span class="breadcrumbs pathway">' . $newCrumb . '</span></div>';

  }
}

/**
 * Allow themable wrapping of all comments.
 */
function somaxiom_comment_wrapper($content, $node) {
  if (!$content || $node->type == 'forum') {
    return '<div id="comments">'. $content .'</div>';
  }
  else {
    return '<br /><div id="jc"><div id="comments"><h2 class="title comments-title">'. t('Comments') .'</h2><div class="comments-list">'. $content .'</div></div></div>';
  }
}

function somaxiom_adv_count_words($str) {
	$words = 0;
	$str = eregi_replace(" +", " ", $str);
	$array = explode(" ", $str);
	for($i=0;$i < count($array);$i++) {
		if (eregi("[0-9A-Za-zÀ-ÖØ-öø-ÿ]", $array[$i]))
		$words++;
	}
	return $words;
}	





/**
 * Returns the rendered local tasks. The default implementation renders
 * them as tabs. Overridden to split the secondary tasks.
 *
 * @ingroup themeable
 */
function somaxiom_menu_local_tasks() {
  return menu_primary_local_tasks();
}

function somaxiom_comment_submitted($comment) {
  return t('!datetime — !username',
    array(
      '!username' => theme('username', $comment),
      '!datetime' => format_date($comment->timestamp)
    ));
}

function somaxiom_node_submitted($node) {
  return t('!datetime — !username',
    array(
      '!username' => theme('username', $node),
      '!datetime' => format_date($node->created),
    ));
}