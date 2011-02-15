<?php
/**
 * 
 * 	
 * 
 * @author biLLy
 */
get_header(); ?>
<content>
	<left>
		
		
		<!-- Start the Loop. -->
		<?php 
		if ( have_posts() ) while ( have_posts() ) : the_post();?>
			<post class="single">
				<header>
					<date><?php 

					echo polskaData(strtotime($post -> post_date_gmt), 24 * 3600);

					?></date>
				    <h1><?php the_title(); ?></h1>
					<tags>
						<?php

							$html = "";

							$posttags = get_the_tags();

							if($posttags)
								foreach ($posttags as $tag){
									$tag_link = get_tag_link($tag->term_id);
									$html .= "<a href='{$tag_link}' title='{$tag->name}' class='{$tag->slug}'>{$tag->name}</a>";
								}


							$posttags = false;

							$allowedCategories = array();
							$childs = get_categories('child_of=' . 4);


						 	foreach ($childs as $category) {
								array_push($allowedCategories, $category->cat_ID);
						  	}


							foreach((get_the_category()) as $category) 
								if(in_array($category -> cat_ID, $allowedCategories))
							    	$html .= "<a href=\"\" alt=\"\" class='category'> {$category->cat_name} </a>";

							if($html == "") {
								$html = "no tags";
							} 

							echo $html;

						?>


						</tags>
					<?php if($post -> comment_count > 0 || 1 ) {?><comments><?=$post -> comment_count;?></comments><?php } ?>
				</header>
				<?php the_content("more »"); ?>
			</post>
			
			
			<?php comments_template( '', true ); ?>

		<?php endwhile; ?>
	</left>
	<right>
	<?php get_sidebar(); ?></right>
</content>

