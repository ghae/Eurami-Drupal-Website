	<?php if($class != ""): ?>
		<div class="<?=$class;?>">
	<?php endif; ?>
	
	<div class="clear"></div>			

	<div class="rt-block">
		
		<?php if ($block->subject) : ?>
			<div class="module-title-surround">
				<div class="module-title">
					<h2 class="title"><?php print $block->subject; ?></h2>
				</div>
			</div>
		<?php endif; ?>
		
		<div class="rt-module-surround">
			<div class="rt-module-inner">
				<div class="module-content">
					<?php print $block->content; ?>
					<div class="clear"></div>
				</div>
			</div>
		</div>
				
	</div>
	
	<?php if($class != ""): ?>
	</div>
	<?php endif; ?>