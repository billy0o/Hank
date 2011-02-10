<?php
/*
get_comments_number()
comment_form();
*/
?>

<?php if ( have_comments() )

					wp_list_comments( array( 'callback' => 'twentyten_comment' ) );
					
					
	?>

