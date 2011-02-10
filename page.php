<?php
/**
 * edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); 
 */
global $_page;
$_page = $_GET['id'];
get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post();?>

	<content>
		<left>
			<post>
				
					<header>

						<h1><?php the_title(); ?> </h1>
							</header>

							<?php the_content();?>
			</post>
		</left>
		<right>
			<?php get_sidebar(); ?>
		</right>
	</content>
<?php endwhile;?>
<?php get_footer(); ?>
