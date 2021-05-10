<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       peterkeyser.ca
 * @since      1.0.0
 *
 * @package    Projects_Plugin
 * @subpackage Projects_Plugin/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Projects_Plugin
 * @subpackage Projects_Plugin/public
 * @author     Peter Keyser <peterkeyser1@gmail.com>
 */
class Projects_Plugin_Public {

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
	 * Public Hooks
	 */
	public function pp_public_hooks(){
		// This shortcode gives a single page view
		add_shortcode( 'pp_project', array($this,'pp_single_project_view') );
		// This shortcode gives a archive page view
		add_shortcode( 'pp_projects', array($this,'pp_archive_project_view') );
		// Adding body class
		add_filter( 'body_class', array($this, 'pp_body_class') );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_register_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/projects-plugin-public.css', array(), $this->version, 'all' );
	}

	// Adding body class for compatible with other plugins
	public function pp_body_class( $classes ) {
		$classes[] = 'pp_post__view';
		return $classes;
	}

	// Single page view
	public function pp_single_project_view($atts){
		global $post;
		// If id is not define then not will be exicute
		if(!$atts){
			exit;
		}

		$atts = shortcode_atts(
			array(
				'pp_id' => 'null',
			), $atts, 'pp_project' 
		);
		
		$args = array(
			'post_type' => 'ppprojects',
			'post_status'    => 'publish',
			'post__in'	=> [$atts['pp_id']]
		);
		global $wp_query;
		$project = new WP_Query($args);
		if($project->have_posts()){
			ob_start();
			// Settings colors
			require_once plugin_dir_path( __FILE__ )."partials/ppprojects-colors.php";
			wp_enqueue_style($this->plugin_name);
			while($project->have_posts()){
				$project->the_post();
				// Require html dom with dynamic contents
				require_once plugin_dir_path( __FILE__ )."partials/projects-plugin-single.php";
			}
			wp_reset_query(  );
			return ob_get_clean();
		}
	}

	// Archive page
	public function pp_archive_project_view($atts){

		$atts = shortcode_atts(
			array(
				'show' => '',
			), $atts, 'pp_projects' 
		);

		// Default Limits
		$limit = 10;
		if($atts){
			if($atts['show'] && $atts['show'] != ""){
				$limit = intval($atts['show']);
			}
		}

		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
			'post_type' => 'ppprojects',
			'post_status'    => 'publish',
			'order'     => 'DESC',
			'paged'     => $paged,
			'posts_per_page'     => $limit,
			'order_by'     => 'date'
		);

		$projects = new WP_Query($args);
		if($projects->have_posts()){
			ob_start();
			// Settings colors
			require_once plugin_dir_path( __FILE__ )."partials/ppprojects-colors.php";
			wp_enqueue_style($this->plugin_name);
			while($projects->have_posts()){
				$projects->the_post();
				// Require html dom with dynamic contents
				include plugin_dir_path( __FILE__ ).'partials/projects-plugin-archive.php';
			}

			echo '<div class="pagination"> <div class="paginate">';
			if($projects->max_num_pages > 1){
				global $wp_query;

				$big = 999999999; // need an unlikely integer
				$translated = __( 'Page', $this->plugin_name ); // Supply translatable string
				
				echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $projects->max_num_pages,
						'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>'
				) );
			}
			echo '</div></div>';
			wp_reset_query(  );
			return ob_get_clean();
		}
	}
}