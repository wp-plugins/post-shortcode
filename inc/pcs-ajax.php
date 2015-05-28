<?php 
/**
* @since 2.0
 * Adds ajax function.
 */
add_action( 'wp_ajax_pcs_get_cat', 'pcs_get_cat_callback' );
add_action( 'wp_ajax_nopriv_pcs_get_cat', 'pcs_get_cat_callback' );
function pcs_get_cat_callback() {
	$postt = explode(",", $_POST['postt']);
	$categories = explode(",", $_POST['categories']);
    $acs = pcs_get_all_category($postt);
	foreach ($acs as $ckey => $cvalue) {
		foreach ($cvalue as $ck => $cv) {
			?>
			<option value="<?php echo $cv->slug; ?>" <?php if(in_array( $cv->slug, $categories )  ) echo "selected"; ?>>
			<?php echo $cv->slug; ?>
			</option>
			<?php
		}
	} 
	wp_die();
}
?>