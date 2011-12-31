<?php

// This information has been pulled out to make the template more readible.
// This data goes between the <head></head> tags of the template
$theme_path = path_to_theme();
$ver = preg_replace ('/\.(.*)/','',$browser_version);
$bname = $browser_name . $ver;
?>

<script src="<?php echo base_path() . path_to_theme(); ?>/js/jquery-1.4.3.min.js" type="text/javascript"></script>
<script type="text/javascript"> 
var $jq = jQuery.noConflict(); 
</script> 



<link href="<?php echo base_path() . path_to_theme(); ?>/css/slides.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_path() . path_to_theme(); ?>/css/gantry.css" rel="stylesheet" type="text/css" />
<?php if($bname == "ie6") :?><link href="<?php echo base_path() . path_to_theme(); ?>/css/gantry-<?php echo $bname; ?>.css" rel="stylesheet" type="text/css" /><?php endif; ?>
<link href="<?php echo base_path() . path_to_theme(); ?>/css/grid-12.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_path() . path_to_theme(); ?>/css/joomla-gantry.css" rel="stylesheet" type="text/css" />
<?php if($bname == "ie6" OR $bname == "ie7") :?><link href="<?php echo base_path() . path_to_theme(); ?>/css/joomla-gantry-<?php echo $bname; ?>.css" rel="stylesheet" type="text/css" /><?php endif; ?>
<?php if($bname == "ie6") :?><link href="<?php echo base_path() . path_to_theme(); ?>/css/joomla-gantry-<?php echo $bname; ?>.css" rel="stylesheet" type="text/css" /><?php endif; ?>

<link href="<?php echo base_path() . path_to_theme(); ?>/css/joomla.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_path() . path_to_theme(); ?>/css/demo-styles.css" rel="stylesheet" type="text/css" />
<?php if($bname == "ie6") :?><link href="<?php echo base_path() . path_to_theme(); ?>/css/joomla-<?php echo $bname; ?>.css" rel="stylesheet" type="text/css" /><?php endif; ?>

<?php if($somaxiom_menutype=="splitmenu") :?>
<link href="<?php echo base_path() . path_to_theme(); ?>/css/splitmenu.css" rel="stylesheet" type="text/css" />
<?php endif; ?>

<link href="<?php echo base_path() . path_to_theme(); ?>/css/rokstories.css" rel="stylesheet" type="text/css" />


<link href="<?php echo base_path() . path_to_theme(); ?>/css/template.css" rel="stylesheet" type="text/css" />

<?php if($bname == "ie6" OR $bname == "ie7" OR $bname == "ie8") :?><link href="<?php echo base_path() . path_to_theme(); ?>/css/template-<?php echo $bname; ?>.css" rel="stylesheet" type="text/css" /><?php endif; ?>

<?php if($somaxiom_presetstyle == "style8"): ?>
	<link href="<?php echo base_path() . path_to_theme(); ?>/css/dark.css" rel="stylesheet" type="text/css" />
<?php else: ?>
	<link href="<?php echo base_path() . path_to_theme(); ?>/css/light.css" rel="stylesheet" type="text/css" />
<?php endif; ?>

<?php if($browser_name == "iphone"): ?>
    <link href="<?php echo base_path() . path_to_theme(); ?>/css/iphone-gantry.css" rel="stylesheet" type="text/css" />
<?php endif; ?>

<?php if($browser_name == "ie") : ?>
    <?php if($ver == 6): ?>
        
        <script src="<?php echo base_path() . path_to_theme(); ?>/js/DD_belatedPNG.js"></script>
        <script>
            DD_belatedPNG.fix('.png');
        </script>

    <?php endif; ?>
    
<?php endif; ?>


<link href="<?php echo base_path() . path_to_theme(); ?>/css/<?php echo $somaxiom_presetstyle; ?>.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_path() . path_to_theme(); ?>/css/typography.css" rel="stylesheet" type="text/css" />

<?php if($somaxiom_menutype=="dfission" OR $somaxiom_menutype=="suckerfish" OR $somaxiom_menutype=="splitmenu") :?>
	<?php if($bname=="ie6"): ?>
        <link href="<?php echo base_path() . path_to_theme(); ?>/css/suckerfish.css" rel="stylesheet" type="text/css" />
    <?php else: ?>
        <link href="<?php echo base_path() . path_to_theme(); ?>/css/fusionmenu.css" rel="stylesheet" type="text/css" />
    <?php endif; ?>
<?php endif; ?>



<?php if($somaxiom_menutype=="dfission" AND $bname != "ie6") :?>

	<script type="text/javascript">
			
		$jq(document).ready(function(){	
			$jq("ul.menutop li a").hover(function() { 
		
		        //Drop down the subnav on click
				$jq(this).parent().children("div.fusion-submenu-wrapper").slideDown(<?php echo theme_get_setting(menu_duration); ?>).show();
		
				$jq(this).parent().hover(function() {
				}, function(){
					//When the mouse hovers out of the subnav, move it back up
                    $jq(this).parent().find("div.fusion-submenu-wrapper").slideUp(<?php echo theme_get_setting(menu_duration); ?>);
				});
		
			});
			
	
			//back to top
			$jq('a[href=#top]').click(function(){
                $jq('html, body').animate({scrollTop:0}, 'slow');
                    return false;
                });    
            });


	</script>
<?php endif; ?>
<?php if($somaxiom_menutype=="dfission"): ?>
	<style type="text/css">
		.menutop li .fusion-submenu-wrapper {float: none;display: none;position: absolute;z-index: 1500; top: 25px; left: 0px;}
		.menutop li li .fusion-submenu-wrapper {float: none;display: none;position: absolute;z-index: 1500; top: 0px; left: 179px;}
	</style>
<?php elseif($somaxiom_menutype=="suckerfish"): ?>
	<style type="text/css">
		.menutop li .fusion-submenu-wrapper {float: none;left: -999em;position: absolute;z-index: 500;}
		.menutop li .fusion-submenu-wrapper2 {float: none;left: -999em;position: absolute;z-index: 500;}
	</style>
<?php endif; ?>


<style type="text/css"> 
    <!--
	.module-content ul.menu li.active > a, .module-content ul.menu li.active > .separator, .module-content ul.menu li.active > .item {color:<?php echo $somaxiom_link_color; ?>;}
	a, .module-content ul.menu a:hover, .module-content ul.menu .separator:hover, .module-content ul.menu .item:hover, .roktabs-wrapper .roktabs-links li span, body .rokstories-layout5 .vertical-list li.active {color:<?php echo $somaxiom_link_color; ?>;}
	body #rt-logo {width:420px;height:180px;}
    -->
  </style> 

<?php if (theme_get_setting(enable_ie6warn) AND $bname == "ie6") : ?>

    <div id="ie-warn">
        <h3>Your are currently browsing this site with Internet Explorer 6 (IE6).</h3>
        <p>The last version of Internet Explorer 6 was called Service Pack 1 for Internet Explorer 6 and was released in December of 2004.  By continuing to run Internet Explorer 6 you are open to any and all security vulnerabilities discovered since that date.  In October of 2006, Microsoft released version 7 of Internet Explorer that, in addition to providing greater safety in navigation, which allows the Internet Explorer browser to identify as' modern browsers'. Microsoft has launched Internet Explorer 7 as a high-priority update, and is now available to download for free without any certification requirements. As of Feb 12th, 2008 Microsoft is forcing updates to Internet Explorer 6 in order to move people towards the much improved and secure version 7. Please ensure you don't hamper this process.  It's for your own good!</p>
        <br />
        <a class="external"  href="http://www.microsoft.com/downloads/details.aspx?FamilyId=9AE91EBE-3385-447C-8A30-081805B2F90B">Download Internet Explorer 7 NOW!</a>
        <br />
        <a href="#" class="closeiewarn">Close Window</a>
    </div>
    <script>

        $jq(document).ready(function(){
             $jq("#ie-warn").slideDown("slow");
        });
        $jq("#ie-warn a").click(function() {
           $jq("#ie-warn").slideUp("slow");
        });


    </script>
<?php endif; ?>




<?php if(theme_get_setting(fontspan)): ?>
<script type="text/javascript">
	//<![CDATA[
	$jq(document).ready(function() {
	  $jq('h1').each(function(){
	      var fs = $jq(this);
	      fs.html( fs.text().replace(/(^\w+)/,'<span>$1</span>') );
	  });
	  $jq('h2').each(function(){
	      var fs = $jq(this);
	      fs.html( fs.text().replace(/(^\w+)/,'<span>$1</span>') );
	  });
	  $jq('h3').each(function(){
	      var fs = $jq(this);
	      fs.html( fs.text().replace(/(^\w+)/,'<span>$1</span>') );
	  });
	});
//]]>	
</script>
<?php endif; ?>
	
