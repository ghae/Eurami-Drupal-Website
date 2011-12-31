
<?php if($thisTitle != "") : ?>


<div class="no pill"></div>


		<?php
			foreach($menus as $menu) {
			    if(!empty($menu['link']['in_active_trail']))
			        echo split_menu_tree_output($menu['below']);
			}
		?>	
		<div class="clear"></div>					
												
											
<div class="clear"></div>



<?php endif; ?>