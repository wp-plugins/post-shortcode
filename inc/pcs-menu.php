<?php
/**
* @since 2.0
* Add menu page
*/
function fn_pcs_menu()
{
	?>
	<style type="text/css">
	.pcs-ta{display: block;width: 90%;height: 200px;padding: 20px;margin: 20px;}
	.pcs-ttl{display: block;padding: 20px;margin: 20px;}
	</style>
	<div class="wrap">
		<h2>Post Shortcode</h2>
	</div>
	<div class="clear"></div>
	<div id="col-container">
	<div id="col-right">
		<div>
		<?php if(isset($_POST['pcs-code'])): 
			$categories = $postt = $categories = "";
			if(!empty($_POST['showfield'])) $showfield = implode(",", $_POST['showfield']);
			if(!empty($_POST['postt'])) $postt = implode(",", $_POST['postt']);
			if(!empty($_POST['categories'])) $categories = implode(",", $_POST['categories']);
			$shortcode = "[pcs template='".$_POST['template']."' postcount='".$_POST['postno']."' showfield='".$showfield."' expertlength='".$_POST['expertl']."' readmoretitle='".$_POST['rmt']."' customfield='".$_POST['scf']."' posttype='".$postt."' categories='".$categories."' orderby='".$_POST['orderby']."' order='".$_POST['order']."']";
			echo "<h2 class='pcs-ttl'>Generated Shortcode :</h2><textarea readonly class='pcs-ta'>". $shortcode."</textarea>";
			endif;
		?>
		<h3 class="pcs-ttl">
			You can use your custom layout use below function in functions.php<br/><br/>function pcs_get_custom_post_output($atts){

			}
		</h3>
		<p class="pcs-ttl">OR you can copy function pcs_get_post_output() from plugin folder inc/pcs-shortcode.php file, then rename as pcs_get_custom_post_output into your theme functions.php file and customize function.</p>
		</div>
		</div>
			<div id="col-left">
				<form method="post">
				<!-- <p>
				<label for="title">Title:</label> 
				<input class="widefat" id="title" name="title" type="text" value="<?php echo esc_attr( $title ); ?>">
				</p>
				<p>
				<label for="titleurl">Title URL:</label> 
				<input class="widefat" id="titleurl" name="titleurl" type="text" value="<?php echo esc_attr( $titleurl ); ?>">
				</p> -->
				<p>
				<label for="template">Template:</label> 
				<?php $atl = array(	"ws" 	=> "Widget Style",
									"iws" 	=> "Inverse Widget Style",
									"gws"	=> "Grid Widget Style",
									"igws"	=> "Inverse Grid Widget Style",
									); ?>
				<select  class="widefat" id="template" name="template" >
					<?php foreach ($atl as $tkey => $tvalue) {
						?>
						<option value="<?php echo $tkey; ?>" <?php if(esc_attr( $template ) == $tkey ) echo "selected"; ?>>
						<?php echo $tvalue; ?>
					</option>
					<?php } ?>
				</select>
				</p>
				<p>
				<label for="postno">Number of Post:</label> 
				<input class="widefat" id="postno" name="postno" type="text" value="<?php echo esc_attr( $postno ); ?>">
				</p>
				<p>
				<label for="showfield">Show Field:</label> 
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

				<select  class="widefat" id="showfield" name="showfield[]" multiple >
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
				<label for="expertl">Excerpt length (in words):200</label> 
				<input class="widefat" id="expertl" name="expertl" type="text" value="<?php echo esc_attr( $expertl ); ?>">
				</p>
				<p>
				<label for="rmt">Read more title : Read more →</label> 
				<input class="widefat" id="rmt" name="rmt" type="text" value="<?php echo esc_attr( $rmt ); ?>">
				</p>
				<p>
				<label for="scf">Show custom fields (comma separated):</label> 
				<input class="widefat" id="scf" name="scf" type="text" value="<?php echo esc_attr( $scf ); ?>">
				</p>
				<p>
				<label for="postt">Post Type:</label> 
				<select  class="widefat" id="postt" name="postt[]" multiple >
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
						$(document).on("change","#postt",function(){
							$val = $(this).val();
							var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
							var data = {
							'action': 'pcs_get_cat',
							'postt': $val.toString(),
							'categories':"<?php echo $categories; ?>"
							};
							$.post(ajaxurl, data, function(response) {
								jQuery("#categories").html(response);
							});
						})				
					});
				</script> 
				<label for="categories">Categories:</label> 
				<?php $acs = pcs_get_all_category($postt);
				//print_r($acs);
					if(!empty($categories)):
						$categories = explode(",", $categories);
					else:
						$categories = array();
					endif; ?>
				<select  class="widefat" id="categories" name="categories[]" multiple >
					<?php 
					foreach ($acs as $ckey => $cvalue) {
						foreach ($cvalue as $ck => $cv) {
							?>
							<option value="<?php echo $cv->slug; ?>" <?php if(in_array( $cv->slug, $categories )  ) echo "selected"; ?>>
							<?php echo $cv->slug; ?>
							</option>
							<?php
						}
						?>
					<?php } ?>
				</select>
				</p>
				<p>
				<label for="orderby">Order By:</label> 
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
				<select  class="widefat" id="orderby" name="orderby" >
					<?php foreach ($aob as $okey => $ovalue) {
						?>
						<option value="<?php echo $okey; ?>" <?php if(esc_attr( $orderby ) == $okey ) echo "selected"; ?>>
						<?php echo $ovalue; ?>
					</option>
					<?php } ?>
				</select>
				</p>
				<p>
				<label for="order">Order:</label> 
				<?php $aor = array(	"DESC" 	=> "Descending order from highest to lowest values ",
									"ASC" 	=> "Ascending order from lowest to highest values",							
									); ?>
				<select  class="widefat" id="order" name="order" >
					<?php foreach ($aor as $rkey => $rvalue) {
						?>
						<option value="<?php echo $rkey; ?>" <?php if(esc_attr( $order ) == $rkey ) echo "selected"; ?>>
						<?php echo $rvalue; ?>
					</option>
					<?php } ?>
				</select>
				</p>
				<p class="submit"><input type="submit" name="pcs-code" id="submit" class="button button-primary" value="Generate Shortcode"></p>
				</form>
			</div>
		
	</div>
	<?php
}
?>