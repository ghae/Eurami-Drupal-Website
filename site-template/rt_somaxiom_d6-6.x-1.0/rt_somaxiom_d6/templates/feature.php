



<?php
$slides = views_get_view_result('Showcase');
?>

<?php if($slides): ?>

<div class="rokstories-layout5" style="height: 302px;">


<div id="slides">
	<div class="slides_container">

	
		
		
		<div class="feature-block">
				
				<?php foreach ($slides as $slide) : ?>
					<?php 
						//print_r($slide); 
						$path = 'node/' . $slide->nid;
						$path = drupal_get_path_alias($path);
					?>
			
					<div class="image-container feature-pad" style="float: right;">
						<div class="image-full" style="height: 275px; width: 350px;">
							<img style="visibility: visible; opacity: 1; top: 0px;" src="<?php print $slide->files_upload_filepath; ?>" alt="Feature" />
						</div>
						<div class="image-mask"></div>
						<div class="feature-block-tl"></div>
						<div class="feature-block-tr"></div>
						<div class="feature-block-bl"></div>
						<div class="feature-block-br"></div>
					</div>
					
					
					<div class="slide">
						
									<div style="height: 320px;" class="desc-container">
							    	        
										<div class="description">
											<div class="feature-desc">
					
												<div class="rokstories-demo-surround">
													<?php 
														$final_text = preg_replace("/<?php[^>]+\?>/i", "", $slide->node_revisions_teaser);
														$final_text = preg_replace("/<img[^>]+\>/i", "", $final_text);
										  				$final_text = str_replace("<?", "", $final_text);
														print $final_text; 
													?>
													<!--
													<span class="rokstories-demo-title">You</span><span class="rokstories-demo-title2">Have</span><span class="rokstories-demo-title3">Choices</span>
												
													<p class="rokstories-demo-desc">An array of integrated third party extensions, ranging from the social networking component <strong>JomSocial</strong>, to the expansive content extension K2, with JComments &amp; RokQuickCart also.</p>
													-->
												</div>
					
											</div>
											    
											<div class="clr"></div>
											
											<div class="readon-wrap1">
												<div class="readon1-l"></div>
												<a href="<?php echo base_path() . $path; ?>" class="readon-main"><span class="readon1-m"><span class="readon1-r"> Read the Full Story</span></span></a>
											</div>
											
											<div class="clr"></div>
										</div>
									</div>
					</div>
	
				<?php endforeach; ?>
				
				<div class="clear"></div>
					
				
		
			
		</div>			
		
			

		<div class="clr"></div>


	</div>
	<div class="clr"></div>
</div>
</div>

<?php endif; ?>