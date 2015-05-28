<?php 
/**
 * * @since 2.0
 */
/**
* get all post slug / name
*/
function pcs_get_all_post_name(){
	$apost = array();
	$post_types = get_post_types( '', 'names' ); 
	foreach ( $post_types as $post_type ) {
		if($post_type == "attachment" || $post_type =="revision" || $post_type == "nav_menu_item" || $post_type == "product_variation" || $post_type == "shop_order" || $post_type == "shop_order_refund" || $post_type == "shop_coupon" || $post_type == "shop_webhook"){
			
		} else {
			$apost[$post_type] = $post_type;
		}
	}
	return $apost;
}
function pcs_get_all_categories($post_type = array()){
	$aCategories = array();
	if(is_array($post_type) && !empty($post_type)):
		foreach ($post_type as $ptkey => $ptvalue) {
			$aCategories[] = pcs_get_all_category($ptvalue);
		}
	else:
		$aCategories[] = pcs_get_all_category($ptvalue);
	endif;
	return $aCategories;
}
/**
* get all category of relative post type
*/
function pcs_get_all_category($post_type="post"){
		$aCategory = array();
		$customPostTaxonomies = get_object_taxonomies($post_type);
		if(count($customPostTaxonomies) > 0)
		{
		     foreach($customPostTaxonomies as $tax)
		     {
			     $args = array(
		         	  	'type'                     => $post_type,
						'child_of'                 => 0,
						'parent'                   => '',
						'orderby'                  => 'name',
						'order'                    => 'ASC',
						'hide_empty'               => 1,
						'hierarchical'             => 1,
						'exclude'                  => '',
						'include'                  => '',
						'number'                   => '',
						'taxonomy'                 => $tax,
						'pad_counts'               => false 
		        	);

			    $aCategory[] =  get_categories( $args );
		     }
		}
	return $aCategory;
}