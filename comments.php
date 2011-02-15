<?php
/*
get_comments_number()
comment_form();
*/
?>
<comments>
	
<?php 

if ( have_comments() )
	wp_list_comments( array( 'callback' => 'hank_comment' ) );


?>

</comments>
