<!-- Start the Loop. -->
<loop>
	<?php
	require_once "polska-data.php";

	 if ( have_posts() ) while ( have_posts() ) : the_post();?>
		<post>
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
						$childs = get_categories('child_of=' . HUNK_ACTIVECAT);


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

	<?php endwhile; ?>
</loop>