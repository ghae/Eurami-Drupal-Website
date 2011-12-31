

<?php
	$presets = array(
  		'crystalline' 	=> 'Crystalline',  
  		'military'	 	=> 'Military', 
  		'woody'		 	=> 'Woody',  
  		'moderna'	 	=> 'Moderna',
  		'hotpepper' 	=> 'Hot Pepper',  
  		'mildpepper' 	=> 'Mild Pepper',
  		'elegance'		=> 'Elegance',
  		'richvintage' 	=> 'Rich Vintage',
  		'brightday'		=> 'Bright Day',
  		'velvetine'		=> 'Velvetine',
  		'butterfly'		=> 'Butterfly',
  		'entrapped'		=> 'Entrapped'
	);
	
	$headergraphics = array(
  		'none' 			=> 'None',  
  		'header-1'	 	=> 'Header 1', 
  		'header-2'	 	=> 'Header 2',
  		'header-3'	 	=> 'Header 3',
  		'header-4'	 	=> 'Header 4',
  		'header-5'	 	=> 'Header 5',
  		'header-6'	 	=> 'Header 6',
  		'header-7'	 	=> 'Header 7',
  		'header-8'	 	=> 'Header 8',
  		'header-9'	 	=> 'Header 9',
	);
	
	$overlays = array(
		'none' 					=> 'None', 
		'bark' 					=> 'Bark', 
		'blocks' 				=> 'Blocks', 
		'burlap' 				=> 'Burlap',
		'carbon' 				=> 'Carbon', 
		'circles' 				=> 'Circles',
		'cracked' 				=> 'Cracked', 
		'digital' 				=> 'Digital',
		'elegant-1' 			=> 'Elegant 1', 
		'elegant-2' 			=> 'Elegant 2',
		'elegant-3' 			=> 'Elegant 3', 
		'elegant-4' 			=> 'Elegant 4', 
		'gatorskin' 			=> 'Gatorskin', 
		'grunge-1' 				=> 'Grunge 1',
		'grunge-2' 				=> 'Grunge 2', 
		'grunge-3' 				=> 'Grunge 3',
		'grunge-4' 				=> 'Grunge 4', 
		'grunge-5' 				=> 'Grunge 5',
		'grunge-6' 				=> 'Grunge 6', 
		'isometric' 			=> 'Isometric',
		'lines-1' 				=> 'Lines 1', 
		'lines-2' 				=> 'Lines 2', 
		'lines-3' 				=> 'Lines 3', 
		'lines-4' 				=> 'Lines 4',
		'lines-5' 				=> 'Lines 5', 
		'overlapping-targets' 	=> 'Overlapping Targets',
		'paper' 				=> 'Paper', 
		'perforation' 			=> 'Perforation',
		'plusses-1' 			=> 'Plusses 1', 
		'plusses-2' 			=> 'Plusses 2',
		'spirals-1' 			=> 'Spirals 1', 
		'spirals-2' 			=> 'Spirals 2', 
		'square-wave' 			=> 'Square Wave', 
		'tape-worm' 			=> 'Tape Worm',
		'triangle' 				=> 'Triangle', 
		'weave' 				=> 'Weave',
		'wood-1' 				=> 'Wood 1', 
		'wood-2' 				=> 'Wood 2',
		'wood-3' 				=> 'Wood 3', 
		'wood-4' 				=> 'Wood 4'
	);
	
	$shadows = array(
		'none' 	=> 'None',
		'light' => 'Light',
		'dark' 	=> 'Dark'
	);
	
	$overlays = array(
		'none' 					=> 'None', 
		'bark' 					=> 'Bark', 
		'blocks' 				=> 'Blocks', 
		'burlap' 				=> 'Burlap',
		'carbon' 				=> 'Carbon', 
		'circles' 				=> 'Circles',
		'cracked' 				=> 'Cracked', 
		'digital' 				=> 'Digital',
		'elegant-1' 			=> 'Elegant 1', 
		'elegant-2' 			=> 'Elegant 2',
		'elegant-3' 			=> 'Elegant 3', 
		'elegant-4' 			=> 'Elegant 4', 
		'gatorskin' 			=> 'Gatorskin', 
		'grunge-1' 				=> 'Grunge 1',
		'grunge-2' 				=> 'Grunge 2', 
		'grunge-3' 				=> 'Grunge 3',
		'grunge-4' 				=> 'Grunge 4', 
		'grunge-5' 				=> 'Grunge 5',
		'grunge-6' 				=> 'Grunge 6', 
		'isometric' 			=> 'Isometric',
		'lines-1' 				=> 'Lines 1', 
		'lines-2' 				=> 'Lines 2', 
		'lines-3' 				=> 'Lines 3', 
		'lines-4' 				=> 'Lines 4',
		'lines-5' 				=> 'Lines 5', 
		'overlapping-targets' 	=> 'Overlapping Targets',
		'paper' 				=> 'Paper', 
		'perforation' 			=> 'Perforation',
		'plusses-1' 			=> 'Plusses 1', 
		'plusses-2' 			=> 'Plusses 2',
		'spirals-1' 			=> 'Spirals 1', 
		'spirals-2' 			=> 'Spirals 2', 
		'square-wave' 			=> 'Square Wave', 
		'tape-worm' 			=> 'Tape Worm',
		'triangle' 				=> 'Triangle', 
		'weave' 				=> 'Weave',
		'wood-1' 				=> 'Wood 1', 
		'wood-2' 				=> 'Wood 2',
		'wood-3' 				=> 'Wood 3', 
		'wood-4' 				=> 'Wood 4'
	);
	
	$sections = array(
		'header'	=> 'Header',
		'main' 		=> 'Main',
		'feature' 	=> 'Feature',
		'body'		=> 'Body',
		'bottom'	=> 'Bottom'
	);

	$rt_style_includes = path_to_theme() . "/styles.php";
	include $rt_style_includes;
?>		
	
	

	<div style="display:none">
		
		
		<div id="preset-creator-content">
			<a id="close_x" class="close png" href="#">close</a>
			<form name="colorchooser" action="<?php base_path(); ?>?chooser&amp;page&#61;<?php print arg(1); ?>" method="post">
			
			<input type="hidden" name="page" value="<?php print arg(1); ?>" />
			<table width="100%" class="chooser_table">
				<tr>
					<td class="title">Presets</td>
					<td colspan="2">
						<table class="text-colors" cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td class="right">Load Preset</td>
								<td>
									<select name="preset" id="preset">
										<?php 
											$selected = $crystalline_presetstyle; 
											foreach ($presets as $preset => $label) {
										    	echo '<option value="' . $preset . '"';
										    	if ($selected == $preset) {
										        	echo ' selected="selected"';
										    	}
										    	echo '>' . $label . '</option>';
											}
										?>
									</select>
								</td>
								<td class="submit" align="right">
									<input type="image" class="submit-button" src="<?php echo base_path() . path_to_theme(); ?>/images/popup/button-apply.png" value="Submit" alt="Submit" />
								</td>
							</tr>
							
						</table>
					</td>
				</tr>

				<?php foreach ($sections as $section => $label) : ?>

					<tr>
						<td class="title lines"><?php echo $label; ?></td>
						<td class="lines">
							<table class="text-colors" cellpadding="0" cellspacing="0">
								<tr>
									<td class="right">Background</td>
									<td>
										<input class="input-text" type="text" id="<?php echo $section; ?>-bg-color" name="<?php echo $section; ?>-bg-color" value="" maxlength="7" />
										<div id="<?php echo $section; ?>-bg-box" class="box"></div>
									</td>
								</tr>
								<tr>
									<td class="right">Text</td>
									<td>
										<input class="input-text" type="text" id="<?php echo $section; ?>-text-color" name="<?php echo $section; ?>-text-color" value="" maxlength="7" />
										<div id="<?php echo $section; ?>-text-box" class="box"></div>
									</td>
								</tr>
								<tr>
									<td class="right">Link</td>
									<td>
										<input class="input-text" type="text" id="<?php echo $section; ?>-link-color" name="<?php echo $section; ?>-link-color" value="" maxlength="7" />
										<div id="<?php echo $section; ?>-link-box" class="box"></div>	
									</td>
								</tr>
							</table>
						</td>
						<td class="lines" valign="top">
							<table class="text-colors" cellpadding="0" cellspacing="0">
								<tr>
									<td class="right">Overlay</td>
									<td>
										<select name="<?php echo $section; ?>-overlay" id="<?php echo $section; ?>-overlay" class="noshow">
											<?php 
												foreach ($overlays as $overlay => $label) {
											    	echo '<option value="' . $overlay . '">' . $label . '</option>';
												}
											?>
										</select>
										
									</td>
								</tr>
								<tr>
									<td class="right">Shadows</td>
									<td>
										<div style="width: 150px;"></div>
										<select name="<?php echo $section; ?>-shadows" id="<?php echo $section; ?>-shadows" class="noshow">
											<?php 
												foreach ($shadows as $shadow => $label) {
											    	echo '<option value="' . $shadow . '">' . $label . '</option>';
												}
											?>
										</select>
									</td>
								</tr>
								<?php if($section == "header"): ?>
								<tr>
									<td class="right">Graphic</td>
									<td>
										<select name="header-graphic" id="header-graphic" class="noshow">
											<?php 
												foreach ($headergraphics as $headergraphic => $label) {
											    	echo '<option value="' . $headergraphic . '">' . $label . '</option>';
												}
											?>
										</select>
									</td>
								</tr>
								<?php endif; ?>
							</table>
						</td>
					</tr>
				
				<?php endforeach; ?>
				
				<tr>
					<td colspan="3" class="restore" align="right">
						<a href="<?php echo base_path(); ?>?reset-settings=true">Restore System Defaults</a>
					</td>
				</tr>
				
			</table>
			</form>
			
		</div>
		
		
		<script type="text/javascript">
			
			// set box color values when hex changes
		    
		    //header
		    $jq("input#header-bg-color").change(function() { var str = ""; str = $jq(this).val();$jq("#header-bg-box").css('background-color', str); }).change();
		    $jq("input#header-text-color").change(function() { var str = ""; str = $jq(this).val();$jq("#header-text-box").css('background-color', str); }).change();
		    $jq("input#header-link-color").change(function() { var str = ""; str = $jq(this).val();$jq("#header-link-box").css('background-color', str); }).change();
			//main
			$jq("input#main-bg-color").change(function() { var str = ""; str = $jq(this).val();$jq("#main-bg-box").css('background-color', str); }).change();
		    $jq("input#main-text-color").change(function() { var str = ""; str = $jq(this).val();$jq("#main-text-box").css('background-color', str); }).change();
		    $jq("input#main-link-color").change(function() { var str = ""; str = $jq(this).val();$jq("#main-link-box").css('background-color', str); }).change();
		    //feature
			$jq("input#feature-bg-color").change(function() { var str = ""; str = $jq(this).val();$jq("#feature-bg-box").css('background-color', str); }).change();
		    $jq("input#feature-text-color").change(function() { var str = ""; str = $jq(this).val();$jq("#feature-text-box").css('background-color', str); }).change();
		    $jq("input#feature-link-color").change(function() { var str = ""; str = $jq(this).val();$jq("#feature-link-box").css('background-color', str); }).change();
		    //body
			$jq("input#body-bg-color").change(function() { var str = ""; str = $jq(this).val();$jq("#body-bg-box").css('background-color', str); }).change();
		    $jq("input#body-text-color").change(function() { var str = ""; str = $jq(this).val();$jq("#body-text-box").css('background-color', str); }).change();
		    $jq("input#body-link-color").change(function() { var str = ""; str = $jq(this).val();$jq("#body-link-box").css('background-color', str); }).change();
		    //bottom
			$jq("input#bottom-bg-color").change(function() { var str = ""; str = $jq(this).val();$jq("#bottom-bg-box").css('background-color', str); }).change();
		    $jq("input#bottom-text-color").change(function() { var str = ""; str = $jq(this).val();$jq("#bottom-text-box").css('background-color', str); }).change();
		    $jq("input#bottom-link-color").change(function() { var str = ""; str = $jq(this).val();$jq("#bottom-link-box").css('background-color', str); }).change();
			
			//------------------------------------------------------------
			
			// change all of the values when preset selector is changed
		    $jq("#preset").change(function () {
            	var str = "";
          		var thePresets;
		          
                str = $jq(this).val();
                thePresets = $jq.parseJSON(<?php print json_encode(json_encode($stylesList)); ?>);
                var imgPath = "<?php echo path_to_theme(); ?>";
                
                // set the values based on the presets when preset selector is changed
                
                //header
                $jq("input#header-bg-color").val(thePresets[str]['header-background']);
                $jq("#header-bg-box").css('background-color',thePresets[str]['header-background']);
                $jq("input#header-text-color").val(thePresets[str]['header-text']);
                $jq("#header-text-box").css('background-color',thePresets[str]['header-text']);
                $jq("input#header-link-color").val(thePresets[str]['header-link']);
                $jq("#header-link-box").css('background-color',thePresets[str]['header-link']);
                $jq("select#header-shadows").val(thePresets[str]['header-shadows']);
                $jq("select#header-overlay").val(thePresets[str]['header-overlay']);
                $jq("select#header-graphic").val(thePresets[str]['header-graphic']);
		        //main
                $jq("input#main-bg-color").val(thePresets[str]['main-background']);
                $jq("#main-bg-box").css('background-color',thePresets[str]['main-background']);
                $jq("input#main-text-color").val(thePresets[str]['main-text']);
                $jq("#main-text-box").css('background-color',thePresets[str]['main-text']);
                $jq("input#main-link-color").val(thePresets[str]['main-link']);
                $jq("#main-link-box").css('background-color',thePresets[str]['main-link']);
                $jq("select#main-shadows").val(thePresets[str]['main-shadows']);
                $jq("select#main-overlay").val(thePresets[str]['main-overlay']);
                //feature
                $jq("input#feature-bg-color").val(thePresets[str]['feature-background']);
                $jq("#feature-bg-box").css('background-color',thePresets[str]['feature-background']);
                $jq("input#feature-text-color").val(thePresets[str]['feature-text']);
                $jq("#feature-text-box").css('background-color',thePresets[str]['feature-text']);
                $jq("input#feature-link-color").val(thePresets[str]['feature-link']);
                $jq("#feature-link-box").css('background-color',thePresets[str]['feature-link']);
                $jq("select#feature-shadows").val(thePresets[str]['feature-shadows']);
                $jq("select#feature-overlay").val(thePresets[str]['feature-overlay']);
                //body
                $jq("input#body-bg-color").val(thePresets[str]['body-background']);
                $jq("#body-bg-box").css('background-color',thePresets[str]['body-background']);
                $jq("input#body-text-color").val(thePresets[str]['body-text']);
                $jq("#body-text-box").css('background-color',thePresets[str]['body-text']);
                $jq("input#body-link-color").val(thePresets[str]['body-link']);
                $jq("#body-link-box").css('background-color',thePresets[str]['body-link']);
                $jq("select#body-shadows").val(thePresets[str]['body-shadows']);
                $jq("select#body-overlay").val(thePresets[str]['body-overlay']);
                //bottom
                $jq("input#bottom-bg-color").val(thePresets[str]['bottom-background']);
                $jq("#bottom-bg-box").css('background-color',thePresets[str]['bottom-background']);
                $jq("input#bottom-text-color").val(thePresets[str]['bottom-text']);
                $jq("#bottom-text-box").css('background-color',thePresets[str]['bottom-text']);
                $jq("input#bottom-link-color").val(thePresets[str]['bottom-link']);
                $jq("#bottom-link-box").css('background-color',thePresets[str]['bottom-link']);
                $jq("select#bottom-shadows").val(thePresets[str]['bottom-shadows']);
                $jq("select#bottom-overlay").val(thePresets[str]['bottom-overlay']);
		          
		    })
		    .change();
		    
		    
		 	
		 	// set the options to the current values
		 	
		 	//header
		 	$jq("input#header-bg-color").val('<?php echo $crystalline_header_bg_color; ?>');
		 	$jq("#header-bg-box").css('background-color', '<?php echo $crystalline_header_bg_color; ?>');
		 	$jq("input#header-text-color").val('<?php echo $crystalline_header_text_color; ?>');
		 	$jq("#header-text-box").css('background-color', '<?php echo $crystalline_header_text_color; ?>');
		 	$jq("input#header-link-color").val('<?php echo $crystalline_header_link_color; ?>');
		 	$jq("#header-link-box").css('background-color', '<?php echo $crystalline_header_link_color; ?>');
		 	$jq("select#header-shadows").val('<?php echo $crystalline_header_shadows; ?>');
            $jq("select#header-overlay").val('<?php echo $crystalline_header_overlay; ?>');
            $jq("select#header-graphic").val('<?php echo $crystalline_header_graphic; ?>');
            //main
		 	$jq("input#main-bg-color").val('<?php echo $crystalline_main_bg_color; ?>');
		 	$jq("#main-bg-box").css('background-color', '<?php echo $crystalline_main_bg_color; ?>');
		 	$jq("input#main-text-color").val('<?php echo $crystalline_main_text_color; ?>');
		 	$jq("#main-text-box").css('background-color', '<?php echo $crystalline_main_text_color; ?>');
		 	$jq("input#main-link-color").val('<?php echo $crystalline_main_link_color; ?>');
		 	$jq("#main-link-box").css('background-color', '<?php echo $crystalline_main_link_color; ?>');
		 	$jq("select#main-shadows").val('<?php echo $crystalline_main_shadows; ?>');
            $jq("select#main-overlay").val('<?php echo $crystalline_main_overlay; ?>');
            //feature
		 	$jq("input#feature-bg-color").val('<?php echo $crystalline_feature_bg_color; ?>');
		 	$jq("#feature-bg-box").css('background-color', '<?php echo $crystalline_feature_bg_color; ?>');
		 	$jq("input#feature-text-color").val('<?php echo $crystalline_feature_text_color; ?>');
		 	$jq("#feature-text-box").css('background-color', '<?php echo $crystalline_feature_text_color; ?>');
		 	$jq("input#feature-link-color").val('<?php echo $crystalline_feature_link_color; ?>');
		 	$jq("#feature-link-box").css('background-color', '<?php echo $crystalline_feature_link_color; ?>');
		 	$jq("select#feature-shadows").val('<?php echo $crystalline_feature_shadows; ?>');
            $jq("select#feature-overlay").val('<?php echo $crystalline_feature_overlay; ?>');
            //body
		 	$jq("input#body-bg-color").val('<?php echo $crystalline_body_bg_color; ?>');
		 	$jq("#body-bg-box").css('background-color', '<?php echo $crystalline_body_bg_color; ?>');
		 	$jq("input#body-text-color").val('<?php echo $crystalline_body_text_color; ?>');
		 	$jq("#body-text-box").css('background-color', '<?php echo $crystalline_body_text_color; ?>');
		 	$jq("input#body-link-color").val('<?php echo $crystalline_body_link_color; ?>');
		 	$jq("#body-link-box").css('background-color', '<?php echo $crystalline_body_link_color; ?>');
		 	$jq("select#body-shadows").val('<?php echo $crystalline_body_shadows; ?>');
            $jq("select#body-overlay").val('<?php echo $crystalline_body_overlay; ?>');
            //bottom
		 	$jq("input#bottom-bg-color").val('<?php echo $crystalline_bottom_bg_color; ?>');
		 	$jq("#bottom-bg-box").css('background-color', '<?php echo $crystalline_bottom_bg_color; ?>');
		 	$jq("input#bottom-text-color").val('<?php echo $crystalline_bottom_text_color; ?>');
		 	$jq("#bottom-text-box").css('background-color', '<?php echo $crystalline_bottom_text_color; ?>');
		 	$jq("input#bottom-link-color").val('<?php echo $crystalline_bottom_link_color; ?>');
		 	$jq("#bottom-link-box").css('background-color', '<?php echo $crystalline_bottom_link_color; ?>');
		 	$jq("select#bottom-shadows").val('<?php echo $crystalline_bottom_shadows; ?>');
            $jq("select#bottom-overlay").val('<?php echo $crystalline_bottom_overlay; ?>');
		 	
		</script>
	</div>
	
		
