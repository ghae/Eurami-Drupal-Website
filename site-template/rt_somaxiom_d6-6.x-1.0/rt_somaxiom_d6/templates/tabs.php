
<script>
	$(document).ready(function() {

	//When page loads...
	$(".roktabs-tab").hide(); //Hide all content
	$("ul.roktabs-top li:first").addClass("active").show(); //Activate first tab
	$(".roktabs-tab:first").show(); //Show first tab content

	//On Click Event
	$("ul.roktabs-top li").click(function() {

		$("ul.roktabs-top li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".roktabs-tab").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
</script>

<?php
$tabs = views_get_view_result('Tabs');
?>



<div class="roktabs-wrapper">
	<div class="roktabs base">
		
		<div class="roktabs-topbar">
			<div class="roktabs-topbar2">
				<div class="roktabs-topbar3">
					<div class="roktabs-links">
						<ul class="roktabs-top">
							<?php $i=1; ?>
							<?php foreach ($tabs as $tab) : ?>
								<li><span class="tab1"><span class="tab2"><a href="#tab<?php echo $i; ?>"><?php print $tab->node_title; ?></a></span></span></li>
								<?php $i++; ?>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<div class="roktabs-container-tr">
			<div class="roktabs-container-tl">
				<div class="roktabs-container-br">
					<div class="roktabs-container-bl">
						<div class="roktabs-container-inner">
							<div class="roktabs-container-wrapper">
								
								<?php $i=1; ?>
								<?php foreach ($tabs as $tab) : ?>
									<div id="tab<?php echo $i; ?>" class="roktabs-tab" style="width: 590px;">
										<?php print check_markup($tab->node_revisions_body); ?>
									
									</div>
									<?php $i++; ?>
								<?php endforeach; ?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

