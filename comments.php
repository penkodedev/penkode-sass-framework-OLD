<?php 
$default_avatar = 'https://simulacionymedicina.es/wp-content/uploads/2015/11/default-avatar-300x300-1.jpg';
?>

<section class="comments-container">
<a id="comments"></a>
<h2 class="comments-main-title"><?php _e('Comentarios', 'letras'); ?></h2>

<?php if($comments) : ?>
<ol class="comments">
	<?php foreach($comments as $comment) : ?>
	<li id="comment-<?php comment_ID(); ?>" class="<?php if ($comment->user_id == 1) echo "authcomment";?>">
		<?php if ($comment->comment_approved == '0') : ?>
		
		<p class="comment-waiting"><?php _e('Tu comentario está aguardando aprobación', 'letras'); ?></p>
		
		<?php endif; ?>
		<?php echo get_avatar(get_comment_author_email(), 78, $default_avatar); ?>
		<cite>
			<h3><?php comment_author(); ?></h3><small><?php comment_date(); ?></small>
		</cite><br />
		
		<div class="comment-text"><?php comment_text(); ?></div>
		
	</li>
	<?php endforeach; ?>
</ol>
<?php endif; ?>

<?php if(comments_open()) : ?>

<h4><?php _e('Añadir comentario', 'letras'); ?></h4>

<?php if(get_option('comment_registration') && !$user_ID) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p><?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
	<?php if($user_ID) : ?>
	<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Log out &raquo;</a></p>
	<?php else : ?>
	
	<p>
		<label for="author"><?php _e('Nombre', 'letras'); ?> <?php if($req) echo "(obligatório)"; ?></label>
		<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />	
	</p>
	
	<p>
		<label for="email">Email (no será publicado <?php if($req) echo ", obligatório"; ?>)</label>
		<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
	</p>

	<?php endif; ?>
	<p>
		<label for="message"><?php _e('Mensaje', 'letras'); ?> <?php if($req) echo ""; ?></label>
		<textarea name="comment" id="comment" rows="8" tabindex="4"></textarea>
	</p>

	<p>
		<input name="submit" type="submit" id="submit" tabindex="5" value="enviar/send" />
		<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
	</p>
	
	<?php do_action('comment_form', $post->ID); ?>
</form>

<?php endif; ?>
<?php else : ?>
<p><?php _e('Los comentarios están cerrados', 'letras'); ?></p>
<?php endif; ?>
</section>