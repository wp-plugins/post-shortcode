<?php 
/**
 * Function fn_box_style_posts()  is used to create shortcode for plugin.
 * @param array $atts is to pass attributes to the function. spin frame animation
 *[box-style-posts posttype=product ]
*/
function fn_box_style_posts($atts){
	extract(shortcode_atts(array(
   		'posttype' 	=> 'post',
   		'orderby'	=> 'menu_order',
   		'order'		=> 'ASC',
      	'effects' 	=> 'animation',
      	'color' 	=> '#fff',
      	'hcolor'	=> '#000',
      	'ids'		=> '',
      	'width'		=> '8',
      	'totalposts'=> '-1',
      	'image'		=> 'medium',
      ), $atts));
  ob_start();
?>
	<style type="text/css">
		/* Color */
		.box-animation .box {
			box-shadow: inset 0 0 0 10px <?php echo $color; ?>;
		}
		.box-animation{
			clear: both;
		}
		.box-animation .box:hover h3,
		.box-animation .box:hover span {
			color: <?php echo $hcolor; ?>;
		}

		.box-animation .box svg line {
			stroke-width: <?php echo $width; ?>;
		}

		.box-animation .box:hover svg line {
			stroke: <?php echo $hcolor; ?>;
		}
		.box svg line{
			stroke-width: <?php echo $width*3; ?>;
		}
		.frame .box:hover svg line {
			stroke-width: <?php echo $width; ?>;
		}
		.spin .box svg line {
			stroke-width: <?php echo $width; ?>;
		}
		.box{overflow: hidden;height:460px;width: 300px;padding: 15px;position: relative;float: left;margin: 20px;}
		.box .imglink{overflow: hidden;position: absolute;top: 30px;left: 30px;text-decoration: none;}
		.box .imglink img{width: 240px;max-height: 200px;overflow: hidden;}
		.box .content{max-height: 200px;overflow: hidden;position: absolute;top: 250px;left: 30px;}
		.box .content a{display: block;margin-bottom: 5px;font-weight: bold;}
	</style>
	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<div class="grid box-animation <?php echo $effects; ?>">
		<?php $args=array('post_type' => $posttype,'post_status' => 'publish','posts_per_page' => $totalposts,'orderby' => $orderby,'order'   => $order,);
		if(!empty($ids)):
			$args['post__in'] = array( $ids );
		endif;
    	$my_query = null;
    	$my_query = new WP_Query($args);
    	if( $my_query->have_posts() ) {
	    	while ($my_query->have_posts()) : $my_query->the_post(); 
	    	if(function_exists("wc_get_product")):
		    	$product = wc_get_product( get_the_ID() );
		    	if(!empty($product)):
			    	$rating_count = $product->get_rating_count();
			    	$review_count = $product->get_review_count();
			    	$average      = $product->get_average_rating();
		    	endif;
		    endif;
	    	?>
			<div class="box">
				<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
					<line class="top" x1="0" y1="0" x2="900" y2="0"/>
					<line class="left" x1="0" y1="460" x2="0" y2="-920"/>
					<line class="bottom" x1="300" y1="460" x2="-600" y2="460"/>
					<line class="right" x1="300" y1="0" x2="300" y2="1380"/>
				</svg>
				<a href="<?php the_permalink(); ?>" class="imglink">
	            	<img alt="<?php the_title(); ?>" src="<?php $image_url =  wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $image ); echo $image_url[0];  ?>" class="img-responsive">
	            </a>
	            <span class="content">
		            <a href="<?php the_permalink(); ?>"><strong><?php the_title(); ?></strong></a>
		            <?php if(!empty($product)): ?>
			            	<p class="price"><?php echo $product->get_price_html(); ?></p>
			           		 <?php $addcart = "[add_to_cart id=".get_the_ID()."]";
			            	echo do_shortcode($addcart);
		            	endif; 
		        	if($posttype != 'product'){
		        	$content = wp_strip_all_tags( get_the_content('Read more') );
					echo substr($content,0,150)."...";
		        	}?>
	            </span>			           
			</div>	
			<?php
		    endwhile;
		}
		wp_reset_query();  
		?>		
	</div><!-- /grid -->
<?php 
  	$shortcodeData = ob_get_contents();	
    ob_end_clean();
    return $shortcodeData;
}
add_shortcode('box-style-posts', 'fn_box_style_posts');
?>