<?php

get_header();



?>


<content>
	<left>
			<?php
			
			 get_template_part( 'loop', 'index' );
			?>
	</left>
	<right>
		<?php get_sidebar(); ?>
	</right>
</content>
