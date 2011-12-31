<?php
// $Id: node.tpl.php,v 1.4 2008/01/25 21:21:44 goba Exp $

/**
 * @file node.tpl.php
 *
 * Theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: Node body or teaser depending on $teaser flag.
 * - $picture: The authors picture of the node output from
 *   theme_user_picture().
 * - $date: Formatted creation date (use $created to reformat with
 *   format_date()).
 * - $links: Themed links like "Read more", "Add new comment", etc. output
 *   from theme_links().
 * - $name: Themed username of node author output from theme_user().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $submitted: themed submission information output from
 *   theme_node_submitted().
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $teaser: Flag for the teaser state.
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 */
?>
<?php
define('ICON_PATH', '/stage/sites/all/themes/rt_somaxiom_d6-6.x-1.0/rt_somaxiom_d6/images/icons/');

function getSafeValue($node, $field) {
  $data = $node->$field;
  return $data[0]['safe'];
}

//print_r($node->locations);

//echo '<pre>';print_r($node);exit;
?>

<div class="rt-article company-node-detail">

<table width="100%" border="0" cellpadding="0">
	<tr colspan="2">
		<td width="66%">
			<h1><?php echo $node->title?></h1>
        	<h2><?php echo $accreditation_status?></h2>
    	</td>
    	<td width="34%">
    		<?php echo $node->field_company_logo[0]['view']?>
    		<?php if($accreditation_from && $accreditation_to):?>
      		Accredited since <strong><?php echo $accreditation_from?></strong><br />
        	Accreditation valid to <strong><?php echo $accreditation_to?></strong>
	     <?php endif;?>
     	</td>
	</tr>
	
	<?php $facebookUrl = $node->field_facebook_cn[0]['url'];?>
    <?php if(getSafeValue($node, 'field_telephone')
		|| getSafeValue($node, 'field_telephone_alternate')
		|| getSafeValue($node, 'field_company_fax')
		|| getSafeValue($node, 'field_email_cn')
		|| getSafeValue($node, 'field_website_cn')
        || $facebookUrl
        || getSafeValue($node, 'field_twitter_cn')
        || getSafeValue($node, 'field_linkedin_cn')):?>
        
	<tr>
		<td>
		<?php if(getSafeValue($node, 'field_telephone')):?>
        <div class="telephone">
          <strong><img src="<?php echo ICON_PATH?>phone-icon.jpg" /> <span><?php echo getSafeValue($node, 'field_telephone')?></span></strong>
        </div>
        <?php endif;?>
   		
   		<?php if(getSafeValue($node, 'field_telephone_alternate')):?>
        <div class="telephone">
          <strong><img src="<?php echo ICON_PATH?>phone-icon.jpg" /> <span><?php echo getSafeValue($node, 'field_telephone_alternate')?></span></strong>
        </div>
        <?php endif;?>
  
  		<?php if(getSafeValue($node, 'field_company_fax')):?>
        <div class="telephone">
          <strong><img src="<?php echo ICON_PATH?>icon-doc.png" /> <span><?php echo getSafeValue($node, 'field_company_fax')?></span></strong>
        </div>
        <?php endif;?>
        
        <?php if(getSafeValue($node, 'field_email_cn')):?>
        <div class="telephone">
          <strong><img src="<?php echo ICON_PATH?>icon-email.png" /> <span><?php echo getSafeValue($node, 'field_email_cn')?></span></strong>
        </div>
        <?php endif;?>
        
        <?php if(getSafeValue($node, 'field_website_cn')):?>
        <div class="telephone">
          <strong><img src="<?php echo ICON_PATH?>icon-email.png" /> <span><?php echo getSafeValue($node, 'field_email_cn')?></span></strong>
        </div>
        <?php endif;?>
        
        </td>
        <td>
        <?php
          if(!empty($facebookUrl)):?>
            <a href="<?php echo $facebookUrl?>"><img src="<?php echo ICON_PATH?>icon-facebook.png" alt="Facebook"/></a>
          <?php endif;?>
          
          <?php if(getSafeValue($node, 'field_twitter_cn')):?>
            <a href="http://twitter.com/<?php echo getSafeValue($node, 'field_twitter_cn')?>"><img src="<?php echo ICON_PATH?>icon-twitter.png" alt="Twitter" /></a>
          <?php endif;?>
          
          <?php if(getSafeValue($node, 'field_linkedin_cn')):?>
            <a href="http://be.linkedin.com/pub/<?php echo str_replace(' ','-',getSafeValue($node, 'field_linkedin_cn'))?>"><img src="<?php echo ICON_PATH?>icon-linkedin.png" alt="Linked in" /></a>
          <?php endif;?>
        </div>
      	</div>
		</td>
	</tr>
	<?php endif;?>
</table>

<?php/* if($node->locations[0]['street']
               || $node->locations[0]['postal_code']
               || $node->locations[0]['city']
               || $node->locations[0]['province_name']
               || $node->locations[0]['country_name']):*/?>
               
<table width="100%" border="0" cellpadding="0">
	<tr colspan="2">
		<td width="50%">
		<?php 
		echo $node->locations[0]['name'].'<br>';               
        echo $node->locations[0]['street'].'<br>';
        echo $node->locations[0]['postal_code'] .' '. $node->locations[0]['city'].'<br>';
        if(!empty($node->locations[0]['province_name'])) {
          echo $node->locations[0]['province_name'] .' ';
        }
        echo $node->locations[0]['country_name'];
//    	endif;
?>
    	</td>
		<td width="50%">
		<?php echo $node->locations[1]['name'].'<br>';               
        echo $node->locations[1]['street'].'<br>';
        echo $node->locations[1]['postal_code'] .' '. $node->locations[0]['city'].'<br>';
        if(!empty($node->locations[1]['province_name'])) {
          echo $node->locations[1]['province_name'] .' ';
        }
        echo $node->locations[1]['country_name']; ?>
    	</td>
    </tr>
</table>
<?php //endif; ?>

<table width="100%" cellpadding="0" border="0">
	<tr colspan="2">
		<td width="66%">

	    <?php if(getSafeValue($node, 'field_medical_director')):?>
        <div class="line">
          <strong>Medical Director:</strong><br />
          <?php echo getSafeValue($node, 'field_medical_director');?><br />
        </div>
        <?php endif;?>
     
     	<?php if(getSafeValue($node, 'field_chief_nurse')):?>
        <div class="line">
          <strong>Chief Nurse:</strong><br />
          <?php echo getSafeValue($node, 'field_chief_nurse');?><br />
        </div>
        <?php endif;?>
        
        <?php if(getSafeValue($node, 'field_chief_pilot')):?>
        <div class="line">
          <strong>Chief Pilot:</strong><br />
          <?php echo getSafeValue($node, 'field_chief_pilot');?>
        </div>
        <?php endif;?>
     	
     	</td>
		
		<td width="34%">          
			<?php
			if($node->field_aircraft_cn[0]['safe']):?>
				<strong>Aircraft:</strong>
				<ul>
				  <?php foreach($node->field_aircraft_cn AS $aircraft) {
					echo '<li>' . $aircraft['safe'] . '</li>';
				  }?>
				</ul>
			<?php endif;?>
		</td>
		
	</tr>
</table>

</div>		
<br clear="all" />
<div style="clear: both;">&nbsp;</div>
<?php print $node->content['body']['#value'];?>