<comments>
	<?php


	if ( have_comments() ):
		wp_list_comments( array( 'callback' => 'hank_comment' ) );
	endif;
	?>
	<form id="write-comment">
		<comment id="comment-new">
			<h1>
				<number id="comments-1"><?php echo 1 + hank_comment("count"); ?></number>
				<author>
					<avator><img src="/wp-includes/images/blank.gif" /></avator>
					<name>Mr WordPress</name>

					<time>teraz</time>
				</author>
			</h1>


			<content>
				<textarea name="content"></textarea>
			</content>

			<footer>
			</footer>
		</comment>
	</form>
	
</comments>
