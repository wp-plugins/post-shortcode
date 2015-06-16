<?php
/**
 * @since 2.0
 * Adds PCS_Widget widget.
 * @version 2.0.1
 */
class PCS_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'PCS_Widget', // Base ID
			__( 'PS Widget', 'pcs' ), // Name
			array( 'description' => __( 'Post Shortcode widget', 'pcs' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			$as = (!empty($instance['titleurl'])) ? "<a href='".$instance['titleurl']."'>" : "" ;
			$ae = (!empty($instance['titleurl'])) ? "</a>" : "" ;
			echo $args['before_title'] . $as. apply_filters( 'widget_title', $instance['title'] ). $ae. $args['after_title'];
		}
		$shortcode = "[pcs template='".$instance['template']."' postcount='".$instance['postno']."' showfield='".$instance['showfield']."' expertlength='".$instance['expertl']."' readmoretitle='".$instance['rmt']."' customfield='".$instance['scf']."' posttype='".$instance['postt']."' categories='".$instance['categories']."' orderby='".$instance['orderby']."' order='".$instance['order']."']";
		echo do_shortcode($shortcode);
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Recent Posts', 'pcs' );
		$titleurl = ! empty( $instance['titleurl'] ) ? $instance['titleurl'] : "";
		$template = ! empty( $instance['template'] ) ? $instance['template'] :"ws";
		$postno = ! empty( $instance['postno'] ) ? $instance['postno'] : "3";
		$showfield = ! empty( $instance['showfield'] ) ? $instance['showfield'] : 'title,thumbnail,excerpt';
		$expertl = ! empty( $instance['expertl'] ) ? $instance['expertl'] : __( '100', 'pcs' );
		$rmt = ! empty( $instance['rmt'] ) ? $instance['rmt'] : __( 'Read more', 'pcs' );
		$scf = ! empty( $instance['scf'] ) ? $instance['scf'] : "";
		$postt = ! empty( $instance['postt'] ) ? $instance['postt'] : "post";
		$categories = ! empty( $instance['categories'] ) ? $instance['categories'] : "";
		$orderby = ! empty( $instance['orderby'] ) ? $instance['orderby'] : "";
		$order = ! empty( $instance['order'] ) ? $instance['order'] : "";
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'titleurl' ); ?>"><?php _e( 'Title URL:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'titleurl' ); ?>" name="<?php echo $this->get_field_name( 'titleurl' ); ?>" type="text" value="<?php echo esc_attr( $titleurl ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'template' ); ?>"><?php _e( 'Template:' ); ?></label> 
		<?php $atl = array(	"ws" 	=> "Widget Style",
							"iws" 	=> "Inverse Widget Style",
							"gws"	=> "Grid Widget Style",
							"igws"	=> "Inverse Grid Widget Style",
							); ?>
		<select  class="widefat" id="<?php echo $this->get_field_id( 'template' ); ?>" name="<?php echo $this->get_field_name( 'template' ); ?>" >
			<?php foreach ($atl as $tkey => $tvalue) {
				?>
				<option value="<?php echo $tkey; ?>" <?php if(esc_attr( $template ) == $tkey ) echo "selected"; ?>>
				<?php echo $tvalue; ?>
			</option>
			<?php } ?>
		</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'postno' ); ?>"><?php _e( 'Number of Post:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'postno' ); ?>" name="<?php echo $this->get_field_name( 'postno' ); ?>" type="text" value="<?php echo esc_attr( $postno ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'showfield' ); ?>"><?php _e( 'Show Field:' ); ?></label> 
		<?php $asf = array(	"title" 	=> "Show title",
							"thumbnail"	=> "Show thumbnail",
							"excerpt" 	=> "Show excerpt",
							"date" 		=> "Show published date",
							"author"	=> "Show post author",
							"cc"		=> "Show comments count",
							"content"	=> "Show content",
							"readme" 	=> "Show read more link",
							"category"	=> "Show post categories",
							"tag"		=> "Show post tags",							
							);print_r($showfield); ?>

		<select  class="widefat" id="<?php echo $this->get_field_id( 'showfield' ); ?>" name="<?php echo $this->get_field_name( 'showfield' ); ?>[]" multiple >
			<?php 
				if(!empty($showfield)):
					$showfield = explode(",", $showfield);
				else:
					$showfield = array();
				endif;
				foreach ($asf as $skey => $svalue) {
				
				?>
				<option value="<?php echo $skey; ?>" <?php if(in_array( $skey, $showfield ) ) echo "selected"; ?>>
				<?php echo $svalue; ?>
			</option>
			<?php } ?>
		</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'expertl' ); ?>"><?php _e( 'Excerpt length (in words):200' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'expertl' ); ?>" name="<?php echo $this->get_field_name( 'expertl' ); ?>" type="text" value="<?php echo esc_attr( $expertl ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'rmt' ); ?>"><?php _e( 'Read more title : Read more' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'rmt' ); ?>" name="<?php echo $this->get_field_name( 'rmt' ); ?>" type="text" value="<?php echo esc_attr( $rmt ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'scf' ); ?>"><?php _e( 'Show custom fields (comma separated):' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'scf' ); ?>" name="<?php echo $this->get_field_name( 'scf' ); ?>" type="text" value="<?php echo esc_attr( $scf ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'postt' ); ?>"><?php _e( 'Post Type:' ); ?></label> 
		<select  class="widefat" id="<?php echo $this->get_field_id( 'postt' ); ?>" name="<?php echo $this->get_field_name( 'postt' ); ?>[]" multiple >
			<?php 
			$apt = pcs_get_all_post_name();
			if(!empty($postt)):
				$postt = explode(",", $postt);
			else:
				$postt = array();
			endif;
			foreach ($apt as $pkey => $pvalue) {
				?>
				<option value="<?php echo $pvalue; ?>" <?php if(in_array( $pvalue, $postt )  ) echo "selected"; ?>>
				<?php echo $pvalue; ?>
			</option>
			<?php } ?>
		</select>
		</p>
		<p>
		<script type="text/javascript" >
			jQuery(document).ready(function($) {
				$(document).on("change","#<?php echo $this->get_field_id( 'postt' ); ?>",function(){
					$val = $(this).val();
					var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
					var data = {
					'action': 'pcs_get_cat',
					'postt': $val.toString(),
					'categories':"<?php echo $categories; ?>"
					};
					$.post(ajaxurl, data, function(response) {
						jQuery("#<?php echo $this->get_field_id( 'categories' ); ?>").html(response);
					});
				})				
			});
		</script> 
		<label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Categories:' ); ?></label> 
		<?php $acs = pcs_get_all_category($postt);
		//print_r($acs);
			if(!empty($categories)):
				$categories = explode(",", $categories);
			else:
				$categories = array();
			endif; ?>
		<select  class="widefat" id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ); ?>[]" multiple >
			<?php 
			foreach ($acs as $ckey => $cvalue) {
				foreach ($cvalue as $ck => $cv) {
					$cckey = $ckey."$".$cv->slug;
					?>
					<option value="<?php echo $cckey; ?>" <?php if(in_array( $cckey, $categories )  ) echo "selected"; ?>>
					<?php echo $cv->slug." ( ".$ckey." )"; ?>
					</option>
					<?php
				}
			} ?>
		</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Order By:' ); ?></label> 
		<?php $aob = array(	"ID" 			=> "Order by post id",
							"author" 		=> "Order by author",
							"title"			=> "Order by title",
							"name"			=> "Order by post name (post slug)",
							"date" 			=> "Order by date. ",
							"modified"		=> "Order by last modified date",
							"rand" 			=> "Random order",
							"comment_count"	=> "Order by number of comments",
							"menu_order"	=> "Order by Page Order (menu_order) ",							
							); ?>
		<select  class="widefat" id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" >
			<?php foreach ($aob as $okey => $ovalue) {
				?>
				<option value="<?php echo $okey; ?>" <?php if(esc_attr( $orderby ) == $okey ) echo "selected"; ?>>
				<?php echo $ovalue; ?>
			</option>
			<?php } ?>
		</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e( 'Order:' ); ?></label> 
		<?php $aor = array(	"DESC" 	=> "Descending order from highest to lowest values ",
							"ASC" 	=> "Ascending order from lowest to highest values",							
							); ?>
		<select  class="widefat" id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>" >
			<?php foreach ($aor as $rkey => $rvalue) {
				?>
				<option value="<?php echo $rkey; ?>" <?php if(esc_attr( $order ) == $rkey ) echo "selected"; ?>>
				<?php echo $rvalue; ?>
			</option>
			<?php } ?>
		</select>
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['titleurl'] = ( ! empty( $new_instance['titleurl'] ) ) ? strip_tags( $new_instance['titleurl'] ) : '';
		$instance['template'] = ( ! empty( $new_instance['template'] ) ) ? strip_tags( $new_instance['template'] ) : '';
		$instance['postno'] = ( ! empty( $new_instance['postno'] ) ) ? strip_tags( $new_instance['postno'] ) : '';
		$instance['showfield'] = ( ! empty( $new_instance['showfield'] ) ) ? strip_tags( implode(",", $new_instance['showfield']) ) : '';
		$instance['expertl'] = ( ! empty( $new_instance['expertl'] ) ) ? strip_tags( $new_instance['expertl'] ) : '';
		$instance['rmt'] = ( ! empty( $new_instance['rmt'] ) ) ? strip_tags( $new_instance['rmt'] ) : '';
		$instance['scf'] = ( ! empty( $new_instance['scf'] ) ) ? strip_tags( $new_instance['scf'] ) : '';
		$instance['postt'] = ( ! empty( $new_instance['postt'] ) ) ? strip_tags( implode(",", $new_instance['postt']) ) : '';
		$instance['categories'] = ( ! empty( $new_instance['categories'] ) ) ? strip_tags( implode(",", $new_instance['categories']) ) : '';
		$instance['orderby'] = ( ! empty( $new_instance['orderby'] ) ) ? strip_tags( $new_instance['orderby'] ) : '';
		$instance['order'] = ( ! empty( $new_instance['order'] ) ) ? strip_tags( $new_instance['order'] ) : '';

		return $instance;
	}

} // class PCS_Widget