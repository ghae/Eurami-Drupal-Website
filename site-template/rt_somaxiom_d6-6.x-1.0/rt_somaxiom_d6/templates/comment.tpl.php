<?php
// $Id: comment.tpl.php,v 1.4.2.1 2008/03/21 21:58:28 goba Exp $

/**
 * @file comment.tpl.php
 * Default theme implementation for comments.
 *
 * Available variables:
 * - $author: Comment author. Can be link or plain text.
 * - $content: Body of the post.
 * - $date: Date and time of posting.
 * - $links: Various operational links.
 * - $new: New comment marker.
 * - $picture: Authors picture.
 * - $signature: Authors signature.
 * - $status: Comment status. Possible values are:
 *   comment-unpublished, comment-published or comment-preview.
 * - $submitted: By line with date and time.
 * - $title: Linked title.
 *
 * These two variables are provided for context.
 * - $comment: Full comment object.
 * - $node: Node object the comments are attached to.
 *
 * @see template_preprocess_comment()
 * @see theme_comment()
 */
?>

<div id="comment-item" class="even">
	<div class="rok-comment-entry"> 
  		
  		<div class="comment-info">
			<div class="comment-avatar"><?php print $picture; ?></div>
			<div class="clear"></div>
			<b>Posted On</b>: <span class="comment-date"><?php print format_date($comment->timestamp, 'custom', "F j, Y") ?></span>
			<br />
			<b>Posted By</b>: <span class="comment-author"><?php print $author; ?></span>
			<br />
		</div>
		
		<div class="comment-box avatar-indent">	
			<div class="comment-body">
				<div class="comment-body-top">
					<div class="cbt-1"></div>
					<div class="cbt-2"></div>
					<div class="cbt-3"></div>
				</div>
				
				<div class="comment-body-middle">
					
					<h4><?php print $title ?></h4>
					
					<?php print $content ?>
					
					<?php if ($signature): ?>
						<?php print $signature ?>
					<?php endif; ?>
					
					<div class="comments-buttons">
						<?php print $links ?>
					</div>
			
					
				</div>
				
				<div class="comment-body-bottom">
					<div class="cbt-1"></div>
					<div class="cbt-2"></div>
				</div>
				
			</div>	
				
		</div>
		<div class="clear"></div>
	</div> 
</div>
