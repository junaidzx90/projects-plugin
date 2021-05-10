<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       peterkeyser.ca
 * @since      1.0.0
 *
 * @package    Projects_Plugin
 * @subpackage Projects_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Projects_Plugin
 * @subpackage Projects_Plugin/admin
 * @author     Peter Keyser <peterkeyser1@gmail.com>
 */
class Projects_Plugin_Admin {

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
	 * Admin Hooks
	 */
	public function pp_admin_hooks(){
		// This hook for custom post type {pp_projects_post_type} It's enable to register (Projects) post type
		$this->pp_projects_post_type();
		// This hook for custom texonomy {pp_technologies_taxonomy} It's enable to register (technologies)
		$this->pp_technologies_taxonomy();
		
		// Changing Excerpt Field Title
		add_filter( 'gettext', array($this, 'pp_excerpt_title_to_shortdescription'), 10, 2 );
		// Managing projects archive page
		add_action( 'pre_get_posts', array($this,'pp_projects_archive_page') );
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
		 * defined in Projects_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Projects_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/projects-plugin-admin.css', array(), $this->version, 'all' );

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
		 * defined in Projects_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Projects_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/projects-plugin-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register Menu In menu List
	 * @package MenuPage
	 */
	public function pp_menupage_register(){
		add_menu_page( 'Projects plugin', 'Projects plugin', 'manage_options', 'ppprojects-menu', array($this,'ppprojects_menupage_display'), 'dashicons-text', 45 );
	}

	// Callback for menupage
	public function ppprojects_menupage_display(){
		echo 'PROJECTS PLUGIN - General Settings';
	}

	/**
	 * Register CPT For Projects
	 * @package (USED PREFIX)
	 */
	function pp_projects_post_type() {
		// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Projects', 'Projects', $this->plugin_name ),
			'singular_name'       => _x( 'Project', 'Project', $this->plugin_name ),
			'menu_name'           => __( 'Projects', $this->plugin_name ),
			'parent_item_colon'   => __( 'Parent Project', $this->plugin_name ),
			'all_items'           => __( 'All Projects', $this->plugin_name ),
			'view_item'           => __( 'View Project', $this->plugin_name ),
			'add_new_item'        => __( 'Add New Project', $this->plugin_name ),
			'add_new'             => __( 'Add New', $this->plugin_name ),
			'edit_item'           => __( 'Edit Project', $this->plugin_name ),
			'update_item'         => __( 'Update Project', $this->plugin_name ),
			'search_items'        => __( 'Search Project', $this->plugin_name ),
			'not_found'           => __( 'Not Found', $this->plugin_name ),
			'not_found_in_trash'  => __( 'Not found in Trash', $this->plugin_name ),
		);
		// Set other options for Custom Post Type
		$args = array(
			'label'               => __( 'project', $this->plugin_name ),
			'description'         => __( 'Project expands', $this->plugin_name ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
			'taxonomies'          => array( 'technologies' ),
			
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/ 
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'menu_icon'       	  => 'dashicons-text-page',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest' => true,
	
		);
		
		// Registering your Custom Post Type
		register_post_type( 'ppprojects', $args );
		
	}

	/**
	 * Registering Technology texonomy
	 * @package Tags
	 */
    public function pp_technologies_taxonomy(){
        $labels = array(
            'name' => _x('Technologies', 'technologies'),
            'singular_name' => _x('Technology', 'technology'),
            'search_items' => __('Search technology'),
            'all_items' => __('All technologies'),
            'edit_item' => __('Edit technology'),
			'parent_item' => null,
    		'parent_item_colon' => null,
			'separate_items_with_commas' => __( 'Separate technology with commas' ),
			'add_or_remove_items' => __( 'Add or remove technology' ),
			'choose_from_most_used' => __( 'Choose from the most used technologies' ),
			'not_found'	=> __('No technology found'),
            'update_item' => __('Update technology'),
            'add_new_item' => __('Add New technology'),
            'new_item_name' => __('New technology Name'),
            'menu_name' => __('Technologies'),
        );

        // Register the Technology
        register_taxonomy('technologies', array('ppprojects'), array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'show_in_rest' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'technologies'),
        ));
    }

	// Replacing Excerpt to short-description-> title with placeholder
	function pp_excerpt_title_to_shortdescription( $translation, $original ){
		if ( 'Excerpt' == $original ){
				return 'Short description';
		}else{
			$pos = strpos($original, 'Excerpts are optional hand-crafted summaries of your');
		
			if ($pos !== false){
				return  'Write short description here';
			}
		}
		return $translation;
	}

	// Managing archive page
	function pp_projects_archive_page( $query ) {
		if(is_post_type_archive( 'ppprojects' )){
			
		}
	}
}
