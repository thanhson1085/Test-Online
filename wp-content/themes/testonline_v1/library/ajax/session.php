				<?php
				require_once('../../../../../wp-blog-header.php');
				$args = array(
					'tax_query' => array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'class',
							'field' => 'slug',
							'terms' => array( $_POST['class']) 
						),
						array(
							'taxonomy' => 'classterm',
							'field' => 'slug',
							'terms' => array( $_POST['classterm'] )
						),
					
					),
					'posts_per_page' => '-1',
					'post_type' => 'session',
					'post_status' => 'all',
					'order' => 'ASC',
				);
				$query = new WP_Query( $args );
				?>
				<ul>
				<?php
				while ( $query->have_posts() ) : $query->the_post();

				
				//foreach ($hidden_terms as $hidden_term){
					echo '<li><a href="?session='.$post->post_name.'">'.$post->post_title;
					echo '</a></li>';
				//}
			
				endwhile;
					?>
				</ul>