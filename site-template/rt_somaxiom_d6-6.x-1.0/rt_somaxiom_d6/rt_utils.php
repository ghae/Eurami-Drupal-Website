<?php

	$thisTitle = "";
	$menus = menu_tree_page_data('primary-links'); 
	foreach($menus as $menu) {
	    if(!empty($menu['link']['in_active_trail']) AND $menu['link']['has_children'])
	        $thisTitle = $menu['link']['title'];
	       
	}
	
	
	function rok_isIe($version = false) {   
	
		$agent=$_SERVER['HTTP_USER_AGENT'];  
	
		$found = strpos($agent,'MSIE ');  
		if ($found) { 
		        if ($version) {
		            $ieversion = substr(substr($agent,$found+5),0,1);   
		            if ($ieversion == $version) return true;
		            else return false;
		        } else {
		            return true;
		        }
		        
	        } else {
	                return false;
	        }
		if (stristr($agent, 'msie'.$ieversion)) return true;
		return false;        
	}

?>