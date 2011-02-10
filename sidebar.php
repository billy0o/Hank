<sidebar>
	<form action="search" method="get" accept-charset="utf-8" class="inactive">
		<input type="submit" value="Search!" onmousedown="return false;" />
		<input type="text" name="key" value="search" />
		
	</form>	
	
	<ul class="categories">
		
		 <?php wp_list_categories('orderby=name&show_count=0&title_li=0&child_of=4'); ?>
		<li>
			<a href="#" class="category">
				JavaScript
			</a>
		</li>		
	    <li>
	     	<a href="#" class="category">
   				css3
   			</a>
   		</li>
      
	    <li>
			<a href="#" class="category">
				crossbrowser
			</a>
		</li>
	    <li>
 			<a href="#" class="category">
				html5
			</a>
		</li>
		<li>
 			<a href="#" class="category">
				IE
			</a>
		</li>
		<li>
 			<a href="#" class="category">
				canvas
			</a>
		</li>

	</ul>
	
	<ul class="recent-posts">
		<?php $args = array( 'numberposts' => 5, 'offset'=> 0, 'category' => 4 );
		$myposts = get_posts( $args );
		foreach( $myposts as $post ) :	setup_postdata($post); ?>
			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
		<?php endforeach; ?>
		
	</ul>
	
	<div class="comments">
		
			<?php
			$categories = array(HUNK_ACTIVECAT);
			$childs = get_categories('child_of=' . HUNK_ACTIVECAT);


		 	foreach ($childs as $category) {
				array_push($categories, $category->cat_ID);
		  	}


			$show_comments = 5;
			$offset = 0;
			$found = 0;

			while (true)
			{
				list($comment) = get_comments("number=1&status=approve&offset=". $offset);
				$comm_post_id = $comment->comment_post_ID;

				$offset++;

				if($comment == null) break;

				if (!in_category($categories, $comm_post_id))
					continue;


				$found++;

				echo "<a href=\"?p=".$comment->comment_post_ID."\" class=\"recent-comment\">";

				echo strip_tags(chlimit($comment -> comment_content, 50));

				echo "<small>";

				echo "~" . $comment -> comment_author  . ", " . polskaData(strtotime($comment -> comment_date_gmt), true)  . " w 'loled owned me'";

				echo "</small>";

				echo "</a>";

				if($found > $show_comments) break;
			}
			?>
	</div>
		
</sidebar>