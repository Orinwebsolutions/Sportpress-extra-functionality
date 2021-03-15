<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/Orinwebsolutions
 * @since      1.0.0
 *
 * @package    Sportpress_Extra_Func
 * @subpackage Sportpress_Extra_Func/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Sportpress_Extra_Func
 * @subpackage Sportpress_Extra_Func/public
 * @author     Amila Priyankara <amilapriyankara16@gmail.com>
 */
class Sportpress_Extra_Func_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sportpress_Extra_Func_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sportpress_Extra_Func_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sportpress-extra-func-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sportpress_Extra_Func_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sportpress_Extra_Func_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sportpress-extra-func-public.js', array( 'jquery' ), $this->version, false );

	}


	
	/**
	 * Adding menu item for WC my-account menu items
	 */
	function sportspress_wc_account_menu_items($items){

		$items['player-metrics'] = __( 'My Metrics', 'woocommerce' );

		return $items;

	}

	function sportspress_custom_endpoint_content(){
		$post_author = get_current_user_id();
		$args = array(
			'posts_per_page' => 1,
			'post_type'   => 'sp_player',
			'author' => $post_author,
		);
		   
		$query = new WP_Query($args);
		while ( $query->have_posts() ) {
			$query->the_post();
			$this->sportspress_metrics_tabs($query->post);
		}
		wp_reset_postdata();
	}


	/**
	 * @important-note	Resave Permalinks or it will give 404 error
	 */
	function sportspress_custom_endpoint_rewite_rule() {
		add_rewrite_endpoint( 'player-metrics', EP_ROOT | EP_PAGES );
	}
	
	/**
	 * 2. Add new query var
	 */
	
	function sportspress_custom_endpoint_query_vars( $vars ) {
		$vars[] = 'player-metrics';
		return $vars;
	}


	function sportspress_metrics_tabs($post)
	{
		$options = get_option( 'sp_metrics_monthly' );
		$current_post = get_post($post);
		$post_id = $current_post->ID;
		$sp_metrics = get_post_meta( $post_id, 'custom_sp_metrics', true);
		?>

		<div class="header-tabs-container">
			<div class="header-tabs current-parent"><a href="#volley">Volleyball Metrics</a></div>
			<div class="header-tabs"><a href="#medical">Medical Metrics</a></div>
			<div class="header-tabs"><a href="#nutrition">Nutrition Metrics</a></div>
		</div>

		<div class="tabs-content-container">
			<?php
			$months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov','Dec' ];
			$tax01 = isset( $options[ 'volley_metrics' ] )? $options[ 'volley_metrics' ]: '';
			if(!empty($tax01)){

				$args = array(
					'numberposts' => -1,
					'post_type'   => 'sp_metric',
					'tax_query' => array(
						array(
							'taxonomy' => 'metrics-type',
							'field'    => 'slug',
							'terms'    => $tax01
						)
					)
				);
				
				$metrics_volleyball = get_posts( $args );
				if(!empty($metrics_volleyball)){
				?>
				<div id="volley" class="sp-data-table-container fadein">
					<p><strong>Volleyball Metrics</strong></p>
					<table class="widefat sp-data-table sp-player-statistics-table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Jan</th>
								<th scope="col">Feb</th>
								<th scope="col">Mar</th>
								<th scope="col">Apr</th>
								<th scope="col">May</th>
								<th scope="col">Jun</th>
								<th scope="col">Jul</th>
								<th scope="col">Aug</th>
								<th scope="col">Sep</th>
								<th scope="col">Oct</th>
								<th scope="col">Nov</th>
								<th scope="col">Dec</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($metrics_volleyball as $metric) {
							?>
							<tr class="alternate">
								<td><?= $metric->post_title;?></td>
								<?php
									for ($i=0; $i < 12 ; $i++) {
										$value = ( isset( $sp_metrics['sp_metrics_'.$metric->post_name.'_'.$i] ) ? sanitize_html_class( $sp_metrics['sp_metrics_'.$metric->post_name.'_'.$i] ) : '' );
										// echo $sp_metrics["'sp_metrics_'.$metric->post_name.'_'$i"];
								?>
									<td data-label="<?php echo $months[$i]; ?>"><input class="sp_metrics_front" type="text" readonly="readonly" disable="disable" name="sp_metrics_<?= $metric->post_name.'_'.$i;?>" value="<?= $value?>" placeholder="0" ></td>
								<?php
									}
								?>
							</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
				<?php
				}
			}

			$tax02 = isset( $options[ 'medical_metrics' ] )? $options[ 'medical_metrics' ]: '';
			// echo $tax02.'tax02';
			if(!empty($tax02)){

				$args = array(
					'numberposts' => -1,
					'post_type'   => 'sp_metric',
					'tax_query' => array(
						array(
							'taxonomy' => 'metrics-type',
							'field'    => 'slug',
							'terms'    => $tax02
						)
					)
				);
				
				$medical_volleyball = get_posts( $args );

				if(!empty($medical_volleyball)){
				?>		
				<div id="medical" class="sp-data-table-container">
					<p><strong>Medical Metrics</strong></p>
					<table class="widefat sp-data-table sp-player-statistics-table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Jan</th>
								<th scope="col">Feb</th>
								<th scope="col">Mar</th>
								<th scope="col">Apr</th>
								<th scope="col">May</th>
								<th scope="col">Jun</th>
								<th scope="col">Jul</th>
								<th scope="col">Aug</th>
								<th scope="col">Sep</th>
								<th scope="col">Oct</th>
								<th scope="col">Nov</th>
								<th scope="col">Dec</th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach ($medical_volleyball as $metric) {
							?>
							<tr class="alternate">
								<td><?= $metric->post_title;?></td>
								<?php
									for ($i=0; $i < 12 ; $i++) {
										$value = ( isset( $sp_metrics['sp_metrics_'.$metric->post_name.'_'.$i] ) ? sanitize_html_class( $sp_metrics['sp_metrics_'.$metric->post_name.'_'.$i] ) : '' );
								?>
									<td data-label="<?php echo $months[$i]; ?>"><input class="sp_metrics_front" type="text" readonly="readonly" disable="disable" name="sp_metrics_<?= $metric->post_name.'_'.$i;?>" value="<?= $value?>" placeholder="0" ></td>
								<?php
									}
								?>
							</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
				<?php
				}

			}

			$tax03 = isset( $options[ 'nutrition_metrics' ] )? $options[ 'nutrition_metrics' ]: '';
			// echo $tax03.'tax03';
			if(!empty($tax03)){

				$args = array(
					'numberposts' => -1,
					'post_type'   => 'sp_metric',
					'tax_query' => array(
						array(
							'taxonomy' => 'metrics-type',
							'field'    => 'slug',
							'terms'    => $tax03
						)
					)
				);
				
				$nutrition_volleyball = get_posts( $args );

				if(!empty($nutrition_volleyball)){
				?>				
				<div id="nutrition" class="sp-data-table-container">
					<p><strong>Nutrition Metrics</strong></p>
					<table class="widefat sp-data-table sp-player-statistics-table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Jan</th>
								<th scope="col">Feb</th>
								<th scope="col">Mar</th>
								<th scope="col">Apr</th>
								<th scope="col">May</th>
								<th scope="col">Jun</th>
								<th scope="col">Jul</th>
								<th scope="col">Aug</th>
								<th scope="col">Sep</th>
								<th scope="col">Oct</th>
								<th scope="col">Nov</th>
								<th scope="col">Dec</th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach ($nutrition_volleyball as $metric) {
							?>
							<tr class="alternate">
								<td><?= $metric->post_title;?></td>
								<?php
									for ($i=0; $i < 12 ; $i++) {
										$value = ( isset( $sp_metrics['sp_metrics_'.$metric->post_name.'_'.$i] ) ? sanitize_html_class( $sp_metrics['sp_metrics_'.$metric->post_name.'_'.$i] ) : '' );
								?>
									<td data-label="<?php echo $months[$i]; ?>"><input class="sp_metrics_front" type="text" readonly="readonly" disable="disable" name="sp_metrics_<?= $metric->post_name.'_'.$i;?>" value="<?= $value?>" placeholder="0" ></td>
								<?php
									}
								?>
							</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
				<?php
				}

			}
			?>
		</div>
		<?php
	}

}
