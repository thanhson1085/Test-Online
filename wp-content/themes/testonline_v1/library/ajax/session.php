				<?php
				if (!empty($_POST['class'])) if ($_POST['class'] == 'all') $_POST['class'] = null;
				if (!empty($_POST['subject'])) if ($_POST['subject'] == 'all') $_POST['subject'] = null;
				if (!empty($_POST['classterm'])) if ($_POST['classterm'] == 'all') $_POST['classterm'] = null;
				require_once('../../../../../wp-blog-header.php');
				$tax_query = array();
				$tax_query['relation'] = 'AND';
				if ($_POST['class']){
					array_push($tax_query,array(
							'taxonomy' => 'class',
							'field' => 'slug',
							'terms' => array($_POST['class']),
							)
						);
				}
				if ($_POST['classterm']){
					array_push($tax_query,array(
							'taxonomy' => 'classterm',
							'field' => 'slug',
							'terms' => array($_POST['classterm']),
							)
						);
				}
				if ($_POST['subject']){
					array_push($tax_query,array(
							'taxonomy' => 'subject',
							'field' => 'slug',
							'terms' => array($_POST['subject']),
							)
						);
				}

				$args = array(
					'tax_query' => $tax_query,
					'posts_per_page' => '-1',
					'post_type' => 'session',
					'post_status' => 'pending,publish',
					'order' => 'ASC',
				);
				$query = new WP_Query( $args );
				?>
				<h3>Danh mục đề thi</h3>
				<ul>
				<?php
				while ( $query->have_posts() ) : $query->the_post();

				
				//foreach ($hidden_terms as $hidden_term){
					echo '<li><a href="?session='.$post->post_name.'">'.$post->post_title;
					echo '</a></li>';
				//}
			
				endwhile;
				if (!$query->post-count){
					echo '<li>Không có đề thi nào trong danh mục tìm kiếm</li>';
				}
					?>
				</ul>