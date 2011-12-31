<?php
/**
 * @file droksidemenu.tpl.php
 * Default theme implementation for roksidemenu.
 *
 * Available variables:
 * - $links: Array of primary links available to for the menu.
 *
 * @see template_preprocess_droksidemenu()
 * @see theme_droksidemenu()
 */
?>

<?php 
	if(variable_get('clean_url', 0)) {
		$preURL = "";
	}
	else {
		$preURL = "?q=";
	}
?>

<ul class="menu level1">
<?php foreach ($links as $link):
    
	$href = $link['link']['href'] == "<front>" ? base_path() : base_path() . $preURL . drupal_get_path_alias($link['link']['href']);
 	$subtext = $link['link']['localized_options']['attributes']['title'];
    $title = t($link['link']['title']);
    ?>
    
    <?php 
    	$class = ""; 
    	$linkclass = "";
    ?>
    <?php 
    	if($link['link']['in_active_trail']) {
    		$class = "expanded active";
    		$linkclass = "active";
    	}
    	
    	if($subtext != "") {
		  	$linkclass .= " subtext";
		}
		if($title == $subtext) {
		  	$subtext = "";
		}
		
    ?>
    
    
    
    
    <li class="<?php echo $class; ?>">
        
        <a href="<?php echo $href; ?>" class="<?php echo $linkclass; ?>"><span><?php echo $title;?><em><?php echo $subtext;?></em></span></a>
        
    <?php if ($link['link']['in_active_trail'] AND $link['below']): ?>
        <ul class="level2">
        <?php foreach ($link['below'] as $sublink):
            $subhref = $sublink['link']['href'] == "<front>" ? base_path() : base_path() . $preURL . drupal_get_path_alias($sublink['link']['href']);
       		$subclass = "";	
            if($sublink['link']['in_active_trail']) {
            	$subclass = "active";
            }
            $subtext2 = $sublink['link']['localized_options']['attributes']['title'];
            if($subtext2 != "") {
			  	$subclass .= " subtext";
			}
            $subtitle = t($sublink['link']['title']);
            if($subtitle == $subtext2) {
			  	$subtext2 = "";
			}
        ?>
            <li class="<?php echo $subclass; ?>">
                <a href="<?php echo $subhref;?>" class="<?php echo $subclass; ?>"><span><?php echo $subtitle;?><em><?php echo $subtext2; ?></em></span></a>
             </li>
           <?php endforeach;?>
        </ul>
    <?php endif; ?>
    
    </li>
<?php endforeach;?>
</ul>