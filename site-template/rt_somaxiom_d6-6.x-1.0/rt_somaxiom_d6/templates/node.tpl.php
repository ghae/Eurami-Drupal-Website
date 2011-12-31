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

<div class="rt-article">

		<?php print $picture ?>
		
		
		<div class="module-content">
			<div class="module-tm">
				<div class="module-tl">
					<div class="module-tr"></div>
				</div>
			</div>
			<div class="module-l">
				<div class="module-r">
					
					<?php if (substr($title,0,1) != "!"): ?>
					<div class="rt-headline">
						<div class="module-title">
							<div class="module-title2">
								<?php if(theme_get_setting(link_title)): ?>
									<h1 class="title"><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h1>
								<?php else: ?>
									<h1 class="title"><?php print $title ?></h1>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<?php endif; ?>
					
					<div class="module-inner">
						<div class="module-inner2">
							<?php if ($submitted AND !$is_front) : ?>
								<div class="rt-articleinfo">
									
									<span class="rt-date-posted"><?php print format_date($node->created, 'custom', "F j, Y") ?></span>
									<span class="rt-author">Written by <span><?php print $name; ?></span>
									<div class="clear"></div>

									
								</div>	
							<?php endif; ?>	
							
					
							
							<?php print $content ?>
						
							<?php if($links): ?>
							
							
								<?php print $links; ?>
								
								<?php if ($terms): ?>
									<?php print $terms ?><br /><br />
								<?php endif;?>
								<div class="clear"></div>
							<?php endif; ?>	
						</div>
					</div>
					
				</div>
				
			</div>
			<div class="module-bm">
				<div class="module-bl">
					<div class="module-br"></div>
				</div>
			</div>
								
		</div>
									
				
</div>
