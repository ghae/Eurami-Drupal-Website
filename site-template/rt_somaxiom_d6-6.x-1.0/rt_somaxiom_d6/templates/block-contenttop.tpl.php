

<?php 
	if($block->extraclass=="first") $blocknum = " rt-alpha";
	elseif($block->extraclass=="last") $blocknum = " rt-omega";
	else $blocknum = "";
	
	$sidebarCount = count(block_list('sidebar')); 
	$sidebarCount2 = count(block_list('sidebar2'));
	
	$totalSidebar = $sidebarCount + $sidebarCount2;
	
	if($sidebarCount > 0 AND $sidebarCount2 > 0)
		$mbGrid = getMBgrid(2);
	elseif(($sidebarCount > 0 AND $sidebarCount2 == 0) OR ($sidebarCount == 0 AND $sidebarCount2 > 0))
		$mbGrid = getMBgrid(1);
	
	$maingrid = $mbGrid[0];
	
	if($block_count>3) {
		$topgrid = $maingrid/3;
	}
	else {
		$topgrid = $maingrid/$block_count;
	}
	

	if($blocknum == " rt-alpha") {
		$topgrid = ceil($topgrid);
	}
	else {
		$topgrid = floor($topgrid);
	}
?>


<?php if($block_id <= 3) : ?>

<div class="rt-grid-<?=$topgrid;?><?=$blocknum;?>">


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
<?php endif; ?>