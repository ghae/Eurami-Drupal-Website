
<?php if($thisTitle != "") : ?>

<div class="rt-block">
			
	<div class="module-content">
		<div class="module-tm">
			<div class="module-tl">
				<div class="module-tr"></div>
			</div>
		</div>
		<div class="module-l">
			<div class="module-r">
			
				<div class="module-title">
					<div class="module-title2">
						<h2 class="title"><?php echo $thisTitle; ?> Menu</h2>
					</div>
				</div>
			
				
				<div class="module-inner">
					<div class="module-inner2">
						<?php
							foreach($menus as $menu) {
							    if(!empty($menu['link']['in_active_trail']))
							        echo split_menu_tree_output($menu['below']);
							}
						?>	
					</div>
				</div>
				
			</div>
			
		</div>
		<div class="module-bm">
			<div class="module-bl">
				<div class="module-br"></div>
			</div>
		</div>
							
	</div>
		
</div>




<?php endif; ?>