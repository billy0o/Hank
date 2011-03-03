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
		if ( have_posts() ) while ( have_posts() ) : the_post();
		global $ID;
		$ID = $post -> ID;
		?>
		
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
							    	$html .= "<a href=\"\" alt=\"\" class='category'>{$category->cat_name}</a>";

							if($html == "") {
								$html = "no tags";
							} 

							echo $html;
							
						?>
						
						
					<?php 
						ob_start();

						comments_template( '', true );

					    $comments = ob_get_contents();
					    ob_end_clean();

						endwhile; 
					?>
</tags>
					<comments>
					<?php echo hank_comment("count"); ?></comments>
				</header>
				<?php the_content("more »"); ?>
				<br />
			</post>
			
			
	</left>	
	<right>
	<?php get_sidebar(); ?></right>	
		<br />
		<?php echo $comments; ?>
</content>

