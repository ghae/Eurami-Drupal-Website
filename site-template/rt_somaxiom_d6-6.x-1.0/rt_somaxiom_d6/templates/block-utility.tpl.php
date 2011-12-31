<?php 
	if($block->extraclass=="first") $blocknum = " rt-alpha";
	elseif($block->extraclass=="last") $blocknum = " rt-omega";
	else $blocknum = "";
	
	if($block_count == 1) {$thisGridCount = 12;}
	elseif($block_count == 6) {$thisGridCount = 2;}
	else {
		$thisVar = "utilitygrid_" . $block_count;
		$thislayout = theme_get_setting($thisVar);
		$gridCount = explode("|", $thislayout);
		$thisCount = $block_id - 1;
		$thisGridCount = $gridCount[$thisCount];
	}
	//$block_id;
?>
<div class="rt-grid-<?=$thisGridCount;?><?=$blocknum;?>">


		<?php if ($block->subject) : ?>
			<h2 class="title"><?php print $block->subject; ?></h2>
		<?php endif; ?>

		<?php print $block->content; ?>						

	
</div>

