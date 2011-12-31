<?php 
	if($block->extraclass=="first") $blocknum = " rt-alpha";
	elseif($block->extraclass=="last") $blocknum = " rt-omega";
	else $blocknum = "";
	
	if($block_count == 1) {$thisGridCount = 12;}
	elseif($block_count == 6) {$thisGridCount = 2;}
	else {
		$thisVar = "showcasegrid_" . $block_count;
		$thislayout = theme_get_setting($thisVar);
		$gridCount = explode("|", $thislayout);
		$thisCount = $block_id - 1;
		$thisGridCount = $gridCount[$thisCount];
	}
	//$block_id;
?>
<div class="rt-grid-<?=$thisGridCount;?><?=$blocknum;?>">
	<?php if($class != ""): ?>
		<div class="<?=$class;?>">
	<?php endif; ?>
	
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
	
</div>

