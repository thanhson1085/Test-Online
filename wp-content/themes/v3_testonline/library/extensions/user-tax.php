<?php
/**
 * Tue Feb 21, 2012 11:03:49 added by Thanh Son 
 * Email: thanhson1085@gmail.com 
 */
/**
 * Registers the 'class' taxonomy for users.  This is a taxonomy for the 'user' object type rather than a
 * post being the object type.
 */
/*
 * Function for updating the 'class' taxonomy count.  What this does is update the count of a specific term
 * by the number of users that have been given the term.  We're not doing any checks for users specifically here.
 * We're just updating the count with no specifics for simplicity.
 *
 * See the _update_post_term_count() function in WordPress for more info.
 *
 * @param array $terms List of Term taxonomy IDs
 * @param object $taxonomy Current taxonomy object of terms
 */
/*function my_update_class_count( $terms, $taxonomy ) {
	global $wpdb;

	foreach ( (array) $terms as $term ) {

		$count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->term_relationships WHERE term_taxonomy_id = %d", $term ) );

		do_action( 'edit_term_taxonomy', $term, $taxonomy );
		$wpdb->update( $wpdb->term_taxonomy, compact( 'count' ), array( 'term_taxonomy_id' => $term ) );
		do_action( 'edited_term_taxonomy', $term, $taxonomy );
	}
}*/
/* Adds the taxonomy page in the admin. */
add_action( 'admin_menu', 'my_add_class_admin_page' );

/**
 * Creates the admin page for the 'class' taxonomy under the 'Users' menu.  It works the same as any
 * other taxonomy page in the admin.  However, this is kind of hacky and is meant as a quick solution.  When
 * clicking on the menu item in the admin, WordPress' menu system thinks you're viewing something under 'Posts'
 * instead of 'Users'.  We really need WP core support for this.
 */
function my_add_class_admin_page() {

	$tax = get_taxonomy( 'class' );

	add_users_page(
		esc_attr( $tax->labels->menu_name ),
		esc_attr( $tax->labels->menu_name ),
		$tax->cap->manage_terms,
		'edit-tags.php?taxonomy=' . $tax->name
	);
}
/* Create custom columns for the manage class page. */
add_filter( 'manage_edit-class_columns', 'my_manage_class_user_column' );

/**
 * Unsets the 'posts' column and adds a 'users' column on the manage class admin page.
 *
 * @param array $columns An array of columns to be shown in the manage terms table.
 */
function my_manage_class_user_column( $columns ) {

	unset( $columns['posts'] );

	$columns['users'] = __( 'Users' );

	return $columns;
}

/* Customize the output of the custom column on the manage classes page. */
add_action( 'manage_class_custom_column', 'my_manage_class_column', 10, 3 );

/**
 * Displays content for custom columns on the manage classes page in the admin.
 *
 * @param string $display WP just passes an empty string here.
 * @param string $column The name of the custom column.
 * @param int $term_id The ID of the term being displayed in the table.
 */
function my_manage_class_column( $display, $column, $term_id ) {

	if ( 'users' === $column ) {
		$term = get_term( $term_id, 'class' );
		echo $term->count;
	}
}
/* Add section to the edit user page in the admin to select class. */
add_action( 'show_user_profile', 'my_edit_user_class_section' );
add_action( 'edit_user_profile', 'my_edit_user_class_section' );

/**
 * Adds an additional settings section on the edit user/profile page in the admin.  This section allows users to
 * select a class from a checkbox of terms from the class taxonomy.  This is just one example of
 * many ways this can be handled.
 *
 * @param object $user The user object currently being edited.
 */
function my_edit_user_class_section( $user ) {

	$tax = get_taxonomy( 'class' );

	/* Make sure the user can assign terms of the class taxonomy before proceeding. */
	if ( !current_user_can( $tax->cap->assign_terms ) )
		return;

	/* Get the terms of the 'class' taxonomy. */
	$terms = get_terms( 'class', array( 'hide_empty' => false ) ); ?>

	<h3><?php _e( 'Class' ); ?></h3>

	<table class="form-table">

		<tr>
			<th><label for="class"><?php _e( 'Select Class' ); ?></label></th>

			<td><?php

			/* If there are any class terms, loop through them and display checkboxes. */
			if ( !empty( $terms ) ) {

				foreach ( $terms as $term ) { 
					if ($term->parent){?>
						<input type="radio" name="class" id="class-<?php echo esc_attr( $term->slug ); ?>" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( true, is_object_in_term( $user->ID, 'class', $term ) ); ?> /> <label for="class-<?php echo esc_attr( $term->slug ); ?>"><?php echo 'Lop '.$term->name; ?></label> <br />
					
				<?php
					}
				}
			}

			/* If there are no class terms, display a message. */
			else {
				_e( 'There are no classes available.' );
			}

			?></td>
		</tr>

	</table>
<?php }
/* Update the class terms when the edit user page is updated. */
add_action( 'personal_options_update', 'my_save_user_class_terms' );
add_action( 'edit_user_profile_update', 'my_save_user_class_terms' );

/**
 * Saves the term selected on the edit user/profile page in the admin. This function is triggered when the page
 * is updated.  We just grab the posted data and use wp_set_object_terms() to save it.
 *
 * @param int $user_id The ID of the user to save the terms for.
 */
function my_save_user_class_terms( $user_id ) {

	$tax = get_taxonomy( 'class' );

	/* Make sure the current user can edit the user and assign terms before proceeding. */
	if ( !current_user_can( 'edit_user', $user_id ) && current_user_can( $tax->cap->assign_terms ) )
		return false;

	$term = esc_attr( $_POST['class'] );

	/* Sets the terms (we're just using a single term) for the user. */
	wp_set_object_terms( $user_id, array( $term ), 'class', false);

	clean_object_term_cache( $user_id, 'class' );
}
