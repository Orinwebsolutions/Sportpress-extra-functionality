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
		$options = get_option( 'sp_metrics_monthly' );
		$current_post = get_post($post);
		$post_id = $current_post->ID;
		// echo $post_id;
		$sp_metrics = get_post_meta( $post_id, 'custom_sp_metrics', true);
		// var_dump($sp_metrics);
		$tax01 = isset( $options[ 'volley_metrics' ] )? $options[ 'volley_metrics' ]: '';

		// echo $tax01.'tax01';
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
			<p><strong>Volleyball Metrics</strong></p>
			<div class="sp-data-table-container">
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
								<td><input type="text" name="sp_metrics_<?= $metric->post_name.'_'.$i;?>" value="<?= $value?>" placeholder="0" ></td>
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
			<p><strong>Medical Metrics</strong></p>
			<div class="sp-data-table-container">
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
								<td><input type="text" name="sp_metrics_<?= $metric->post_name.'_'.$i;?>" value="<?= $value?>" placeholder="0" ></td>
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
			<p><strong>Nutrition Metrics</strong></p>
			<div class="sp-data-table-container">
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
								<td><input type="text" name="sp_metrics_<?= $metric->post_name.'_'.$i;?>" value="<?= $value?>" placeholder="0" ></td>
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
	}

	function sportspress_save_player_custom_meta($post_id, $post){

		$args = array(
			'numberposts' => -1,
			'post_type'   => 'sp_metric'
		);
		   
		$sp_metrics = get_posts( $args );

		/* Get the post type object. */
		$post_type = get_post_type_object( $post->post_type );

		  /* Check if the current user has permission to edit the post. */
		if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

		/* Get the posted data and sanitize it for use as an HTML class. */
		$new_meta_value = [];
		foreach ($sp_metrics as $metric) {
			for ($i=0; $i < 12 ; $i++) {
				$new_meta_value['sp_metrics_'.$metric->post_name.'_'.$i] = ( isset( $_POST['sp_metrics_'.$metric->post_name.'_'.$i] ) ? sanitize_html_class( $_POST['sp_metrics_'.$metric->post_name.'_'.$i] ) : '' );
			}
		}
		// echo "<pre>";
		// var_dump($new_meta_value);
		// echo "</pre>";
		// wp_die(  );
		update_post_meta( $post_id, 'custom_sp_metrics', $new_meta_value );

	}



	function sportspress_admin_init() {
		// Register a new setting for "wporg" page.
		register_setting( 'sp_metrics_value', 'sp_metrics_monthly' );
	 
		// Register a new section in the "wporg" page.
		add_settings_section(
			'wporg_section_developers',
			'Mapped sportspress metrics.', 
			array($this, 'sportspress_section_header_callback'),
			'sp_metrics_value'
		);
	 
		// Register a new field in the "wporg_section_developers" section, inside the "wporg" page.
		add_settings_field(
			'wporg_field_pill',
			'Metrics mappings',
			array($this, 'sportspress_field_tax_mapped_cb'),
			'sp_metrics_value',
			'wporg_section_developers',
			array(
				'label_for'         => 'wporg_field_pill',
				'class'             => 'wporg_row',
				'wporg_custom_data' => 'custom',
			)
		);
	}
	 
	 
	 
	/**
	 * Custom option and settings:
	 *  - callback functions
	 */
	 
	 
	/**
	 * Developers section callback function.
	 *
	 * @param array $args  The settings array, defining title, id, callback.
	 */
	function sportspress_section_header_callback( $args ) {
		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?= 'Mapped to correct category'; ?></p>
		<?php
	}
	 
	/**
	 * Pill field callbakc function.
	 *
	 * WordPress has magic interaction with the following keys: label_for, class.
	 * - the "label_for" key value is used for the "for" attribute of the <label>.
	 * - the "class" key value is used for the "class" attribute of the <tr> containing the field.
	 * Note: you can add custom key value pairs to be used inside your callbacks.
	 *
	 * @param array $args
	 */
	function sportspress_field_tax_mapped_cb( $args ) {
		// Get the value of the setting we've registered with register_setting()
		$options = get_option( 'sp_metrics_monthly' );
		$terms = get_terms([
			'taxonomy' => 'metrics-type',
			'hide_empty' => false,
		]);
		?>
		<label>Volleyball Metrics</label>
		<select id="volley_metrics"
			data-custom="<?php echo esc_attr( $args['wporg_custom_data'] ); ?>"
			name="sp_metrics_monthly[volley_metrics]">
			<?php
				foreach ( $terms as $term ) {
			?>
				<option value="<?= $term->name; ?>" <?php echo isset( $options[ 'volley_metrics' ] ) ? ( selected( $options[ 'volley_metrics' ], $term->name, false ) ) : ( '' ); ?>>
					<?= $term->name;?>
				</option>
			<?php
				}
			?>
		</select>
		<label>Medical Metrics</label>
		<select
				id="medical_metrics"
				data-custom="<?php echo esc_attr( $args['wporg_custom_data'] ); ?>"
				name="sp_metrics_monthly[medical_metrics]">
				<?php
					foreach ( $terms as $term ) {
				?>
					<option value="<?= $term->name; ?>" <?php echo isset( $options[ 'medical_metrics' ] ) ? ( selected( $options[ 'medical_metrics' ], $term->name, false ) ) : ( '' ); ?>>
						<?= $term->name; ?>
					</option>
				<?php
					}
				?>
		</select>
		<label>Nutrition Metrics</label>
		<select
				id="nutrition_metrics"
				data-custom="<?php echo esc_attr( $args['wporg_custom_data'] ); ?>"
				name="sp_metrics_monthly[nutrition_metrics]">
				<?php
					foreach ( $terms as $term ) {
				?>
					<option value="<?= $term->name; ?>"<?php echo isset( $options[ 'nutrition_metrics' ] ) ? ( selected( $options[ 'nutrition_metrics' ], $term->name, false ) ) : ( '' ); ?>>
						<?= $term->name; ?>
					</option>
				<?php
					}
				?>
		</select>					
		<?php
	}
	 
	/**
	 * Add the top level menu page.
	 */
	function sportspress_admin_menu() {
		add_menu_page(
			'sp_metrics_value',
			'SP metrics mapping Options',
			'manage_options',
			'sp_metrics_value',
			array($this, 'sp_metrics_monthly_page_html')
		);
	}
	 
	 
	/**
	 * Register our sp_metrics_monthly_page to the admin_menu action hook.
	 */
	
	 
	 
	/**
	 * Top level menu callback function
	 */
	function sp_metrics_monthly_page_html() {
		// check user capabilities
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
	 
		// add error/update messages
	 
		// check if the user have submitted the settings
		// WordPress will add the "settings-updated" $_GET parameter to the url
		if ( isset( $_GET['settings-updated'] ) ) {
			// add settings saved message with the class of "updated"
			add_settings_error( 'wporg_messages', 'wporg_message', __( 'Settings Saved', 'sp_metrics_value' ), 'updated' );
		}
	 
		// show error/update messages
		settings_errors( 'wporg_messages' );
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<form action="options.php" method="post">
				<?php
				// output security fields for the registered setting "wporg"
				settings_fields( 'sp_metrics_value' );
				// output setting sections and their fields
				// (sections are registered for "wporg", each field is registered to a specific section)
				do_settings_sections( 'sp_metrics_value' );
				// output save settings button
				submit_button( 'Save Settings' );
				?>
			</form>
		</div>
		<?php
	}

}
