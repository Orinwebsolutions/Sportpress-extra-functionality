<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/Orinwebsolutions
 * @since      1.0.0
 *
 * @package    Sportpress_Extra_Func
 * @subpackage Sportpress_Extra_Func/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Sportpress_Extra_Func
 * @subpackage Sportpress_Extra_Func/admin
 * @author     Amila Priyankara <amilapriyankara16@gmail.com>
 */
class Sportpress_Extra_Func_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sportpress-extra-func-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sportpress-extra-func-admin.js', array( 'jquery' ), $this->version, false );

	}


	function register_sportspress_metrics_taxonomy() {
 
		$labels = array(
			'name'              => _x( 'Metrics types', 'taxonomy general name', 'sportpress-extra-func' ),
			'singular_name'     => _x( 'Metric Type', 'taxonomy singular name', 'sportpress-extra-func' ),
			'search_items'      => __( 'Search Metrics types', 'sportpress-extra-func' ),
			'all_items'         => __( 'All Metrics types', 'sportpress-extra-func' ),
			'view_item'         => __( 'View Metric', 'sportpress-extra-func' ),
			'parent_item'       => __( 'Parent Metric', 'sportpress-extra-func' ),
			'parent_item_colon' => __( 'Parent Metric:', 'sportpress-extra-func' ),
			'edit_item'         => __( 'Edit Metric', 'sportpress-extra-func' ),
			'update_item'       => __( 'Update Metric', 'sportpress-extra-func' ),
			'add_new_item'      => __( 'Add New Metric', 'sportpress-extra-func' ),
			'new_item_name'     => __( 'New Metric Name', 'sportpress-extra-func' ),
			'not_found'         => __( 'No Metrics types Found', 'sportpress-extra-func' ),
			'back_to_items'     => __( 'Back to Metrics types', 'sportpress-extra-func' ),
			'menu_name'         => __( 'Metric Type', 'sportpress-extra-func' ),
		);
	 
		$args = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'metrics-type' ),
			'show_in_rest'      => true,
		);
	 
	 
		register_taxonomy( 'metrics-type', 'sp_metric', $args );
	 
	}

	function sportspress_player_custom_meta() {
		$screens = [ 'sp_player' ];
		foreach ( $screens as $screen ) {
			add_meta_box(
				'sportspress_metric_customs',                 // Unique ID
				'Monthly Metrics',      // Box title
				array($this,'sportspress_metric_customs_box_html'),  // Content callback, must be of type callable
				$screen                            // Post type
			);
		}
	}

	function sportspress_metric_customs_box_html($post)
	{
		?>
		<p><strong>Volleyball Metrics</strong></p>
		<div class="sp-data-table-container">
			<table class="widefat table table-striped">
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
					<tr class="alternate">
						<td></td>
						<td>1</td>
						<td>2</td>
						<td>3</td>
						<td>1</td>
						<td>2</td>
						<td>3</td>
						<td>1</td>
						<td>2</td>
						<td>3</td>
						<td>1</td>
						<td>2</td>
						<td>3</td>
					</tr>
				</tbody>
			</table>
		</div>
		<p><strong>Medical Metrics</strong></p>
		<div class="sp-data-table-container">
			<table class="widefat table table-striped">
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
					<tr class="alternate">
						<td></td>
						<td>1</td>
						<td>2</td>
						<td>3</td>
						<td>1</td>
						<td>2</td>
						<td>3</td>
						<td>1</td>
						<td>2</td>
						<td>3</td>
						<td>1</td>
						<td>2</td>
						<td>3</td>
					</tr>
				</tbody>
			</table>
		</div>
		<p><strong>Nutrition Metrics</strong></p>
		<div class="sp-data-table-container">
			<table class="widefat table table-striped">
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
					<tr class="alternate">
						<td></td>
						<td>1</td>
						<td>2</td>
						<td>3</td>
						<td>1</td>
						<td>2</td>
						<td>3</td>
						<td>1</td>
						<td>2</td>
						<td>3</td>
						<td>1</td>
						<td>2</td>
						<td>3</td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php
	}

}
