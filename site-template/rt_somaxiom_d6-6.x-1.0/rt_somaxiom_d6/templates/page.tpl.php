<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
	<title><?php print $head_title ?></title>
		<?php
			$rt_utils_includes = path_to_theme() . "/rt_utils.php";
			include $rt_utils_includes;
			$style_switcher = path_to_theme() . "/rt_styleswitcher.php";
			include $style_switcher;
		?>
		<?php print $head; ?>
		<?php print $styles; ?>		
		<?php print $scripts; ?>
		
		<?php
			$head_includes = path_to_theme() . "/rt_head_includes.php";
			include $head_includes;
		?>	
		
		<?php
			if (isset($_GET['tstyle']) ) {
				$change = "tstyle";
				$styleVar = $_GET['tstyle'];
				somaxiom_change_theme($change, $styleVar);
			}
			
			if(isset($_GET['chooser']) ) {
				$thisPage = $_GET['page'];
				somaxiom_set_chooser($thisPage);
			}
			
			if (isset($_GET['reset-settings']) ) {
				somaxiom_restore_defaults();
			}
		?>
		
		<link href="<?php echo base_path() . path_to_theme(); ?>/css/general.css" rel="stylesheet" type="text/css" />

		<?php 
			global $user;
            $thisMenuType = $somaxiom_menutype;
        ?>

</head>
	<?php if($bname == "ie6") :?>
		<body  class="bodylevel-low bodystyle-none cssstyle-<?php print  $somaxiom_presetstyle;?> font-family-<?php print $somaxiom_fontfamily;?> font-size-is-<?php print  $somaxiom_default_font;?> menu-type-suckerfish col12 menu-logo-editing -coresettings,-presets,-layouts option-com-content view-article">
	<?php else: ?>
		<body  class="bodylevel-<?php print  $somaxiom_body_level;?> bodystyle-<?php print  $somaxiom_body_style;?> cssstyle-<?php print  $somaxiom_presetstyle;?> font-family-<?php print $somaxiom_fontfamily;?> font-size-is-<?php print  $somaxiom_default_font;?> menu-type-<?php print $thisMenuType; ?> col12 menu-logo-editing -coresettings,-presets,-layouts option-com-content view-article">
		
	<?php endif; ?>

		<?php /** Begin Top **/ if ($top) : ?>
		<div id="rt-top">
			<div class="rt-container">
				<?php echo $top; ?>
				<div class="clear"></div>
			</div>
		</div>
		<?php /** End Top **/ endif; ?>
		<?php /** Begin Menu **/ if($somaxiom_menutype != "none") : ?>
		<div id="rt-navigation">
			<div class="rt-container">
				
					<?php
						$tree = menu_tree_page_data('primary-links');  
						$main_menu = main_menu_tree_output($tree, 1);
					   	print $main_menu;	
					?>
				
		    	<div class="clear"></div>
			</div>
		</div>
		<?php /** End Menu **/ endif; ?>
		<?php /** Begin Sub Menu **/ if ($somaxiom_menutype == "splitmenu" AND $thisTitle != "") : ?>
		<div id="rt-subnavigation">
			<div class="rt-container">
				<?php include 'subnavH.php'; ?>
		    	<div class="clear"></div>
			</div>
		</div>
		<?php /** End Sub Menu **/ endif; ?>
		<?php /** Begin Header **/ if ($header) : ?>
		<div id="rt-header">
			<div class="rt-container">
				<?php echo $header; ?>
				<div class="clear"></div>
			</div>
		</div>
		<?php /** End Header **/ endif; ?>
		<?php /** Begin Showcase **/ if ($showcase) : ?>
		<div id="rt-showcase">
			<div class="rt-container">
				<?php echo $showcase; ?>
				<div class="clear"></div>
			</div>
		</div>
		<?php /** End Showcase **/ endif; ?>
		<div class="rt-container">
			<?php /** Begin Feature **/ if ($feature) : ?>
			<div id="rt-feature">
				<?php echo $feature; ?>
				<div class="clear"></div>
			</div>
			<?php /** End Feature **/ endif; ?>
			<?php /** Begin Utility **/ if ($utility) : ?>
			<div id="rt-utility">
				<?php echo $utility; ?>
				<div class="clear"></div>
			</div>
			<?php /** End Utility **/ endif; ?>
			<?php /** Begin Breadcrumbs **/ if (theme_get_setting(show_breadcrumb)) : ?>
			<div id="rt-breadcrumbs">
				<?php print $breadcrumb; ?>
				<div class="clear"></div>
			</div>
			<?php /** End Breadcrumbs **/ endif; ?>
			<?php /** Begin Main Top **/ if ($maintop) : ?>
			<div id="rt-maintop">
				<?php echo $maintop; ?>
				<div class="clear"></div>
			</div>
			<?php /** End Main Top **/ endif; ?>
		</div>
		<?php /** Begin Main Body **/ ?>
		
	   		<?php 
	    		//$sidebar_count = $sidebar_number + $sidebar2_number;
	    		$sidebar_count = 0;
	    		if($sidebar) {$sidebar_count++;}
	    		if($sidebar2) {$sidebar_count++;}
	    		//echo $sidebar_count;
	    		if($sidebar_count==1) {
					$mbGrid = getMBgrid(1);
					$mbNumber = $mbGrid[3];
					$maingrid = $mbGrid[0];
					$sidegrid = $mbGrid[1];
					if($mbNumber >= 3) {
						$gridClass = "sa".$sidegrid."-sb"."-mb".$maingrid;
					}
					else {
						$gridClass = "mb".$maingrid."-sa".$sidegrid;
					}
				}	
				elseif($sidebar_count==2) {
					$mbGrid = getMBgrid(2);
					$mbNumber = $mbGrid[3];
					$maingrid = $mbGrid[0];
					$sidegrid = $mbGrid[1];
					$sidegrid2 = $mbGrid[2];
					if($mbNumber >= 2) {
						$gridClass = "sa".$sidegrid."-sb".$sidegrid2."-mb".$maingrid;
					}
					else {
						$gridClass = "mb".$maingrid."-sa".$sidegrid."-sb".$sidegrid2;
					}
				}
				
                
			?>			
			
				<div id="rt-main" class="<?php echo $gridClass; ?>">
					
					<div class="rt-container">
                	<div class="rt-main-inner">
                		
                		<?php if($sidebar AND (($sidebar_count==1 AND $mbNumber >= 3) OR ($sidebar_count==2 AND $mbNumber >= 2) )): ?>
                			<div class="rt-grid-<?php print $sidegrid;?>">
								<div id="rt-sidebar-a">
									<?php if ($crystalline_menutype == "splitmenu") : ?>
										<?php include 'subnav.php'; ?>
									<?php endif; ?>
									<?php print $sidebar; ?>
								</div>
							</div>
							<div class="rt-grid-<?php print $sidegrid2;?>">
								<div id="rt-sidebar-b">
									<?php print $sidebar2; ?>
								</div>
							</div>
                		<?php endif; ?>
                		
                		<div class="rt-grid-<?php print $maingrid;?>">
                        	
                        	<?php if($contenttop): ?>
                        	<div id="rt-content-top">
                        		<?php print $contenttop; ?>
                        		<div class="clear"></div>
                        	</div>
                        	<?php endif; ?>
                        	
                        	<div class="rt-block">
                           		<div id="rt-mainbody">
									<div class="rt-joomla ">
										
											<!-- Begin Admin Tabs -->
											<?php if ($tabs): print '<ul class="primary png">' . $tabs .'</ul>'; print "<br>"; endif; ?>
											<?php if ($tabs2): print '<ul class="secondary">' . $tabs2 .'</ul>'; print "<br>"; endif; ?>
										  	<!-- End Admin Tabs -->
										  	
										  	<?php if ($messages AND !$is_front): ?>
												<?php print $messages; ?><br />
											<?php endif; ?>
											
											<!-- Print Section Heading -->
											<?php if (arg(0) == 'admin' OR arg(1) == 'add' OR arg(0) == 'user') : ?>
												<h2><?php print $title ?></h2>
											<?php endif; ?>
											
                                            <?php print $content; ?>
										  	
										 
									</div>
								</div>
							</div>
							<?php if($contentbottom): ?>
                        	<div id="rt-content-bottom">
                        		<?php print $contentbottom; ?>
                        		<div class="clear"></div>
                        	</div>
                        	<?php endif; ?>
							<!-- content bottom here -->
						</div>
						
						<?php if($sidebar_count AND (($sidebar_count==1 AND $mbNumber < 3) OR ($sidebar_count==2 AND $mbNumber < 2) )): ?>
					
                			<?php if($sidebar2): ?>
                    			<div class="rt-grid-<?php print $sidegrid2;?>">
									<div id="rt-sidebar-b">
										<?php print $sidebar2; ?>
									</div>
								</div>
							<?php endif; ?>
                			<div class="rt-grid-<?php print $sidegrid;?>">
								<div id="rt-sidebar-a">
									<?php if ($crystalline_menutype == "splitmenu") : ?>
										<?php include 'subnav.php'; ?>
									<?php endif; ?>
									<?php print $sidebar; ?>
								</div>
							</div>
							
                		<?php endif; ?>
						
						<div class="clear"></div>
					</div>	
					</div>
				</div>					
							
		
		
		
		
		
		<?php /** End Main Body **/ ?>
		<div class="rt-container">
			<?php /** Begin Main Bottom **/ if ($mainbottom) : ?>
			<div id="rt-mainbottom">
				<?php echo $mainbottom; ?>
				<div class="clear"></div>
			</div>
			<?php /** End Main Bottom **/ endif; ?>
			<?php /** Begin Bottom **/ if ($bottom) : ?>
			<div id="rt-bottom">
				<?php echo $bottom; ?>
				<div class="clear"></div>
			</div>
			<?php /** End Bottom **/ endif; ?>
		</div>
		<?php if ($footer or $copyright) : ?>
		<div id="rt-footer-surround"><div id="rt-footer-surround2">
			<?php /** Begin Footer **/ if ($footer) : ?>
			<div id="rt-footer">
				<div class="rt-container">
					<?php echo $footer; ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Footer **/ endif; ?>
			<?php /** Begin Copyright **/ if ($copyright) : ?>
			<div id="rt-copyright">
				<div class="rt-container">
					<?php echo $copyright; ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Copyright **/ endif; ?>
		</div></div>
		<?php endif; ?>
		<?php /** Begin Debug **/ if ($debug) : ?>
		<div id="rt-debug">
			<?php echo $debug; ?>
			<div class="clear"></div>
		</div>
		<?php /** End Debug **/ endif; ?>
		<?php /** Begin Analytics **/ if ($analytics) : ?>
		<?php echo $analytics; ?>
		<?php /** End Analytics **/ endif; ?>
	
		<?php print $closure;?>
	</body>
</html>
