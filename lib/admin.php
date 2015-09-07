<?php
namespace netup\admin;

class NetupAdmin extends Netup {

	private $url;

    private $options_slug = 'netup_options';

    protected $options_page = '';

    protected $title = '';

	public static function get_instance()
    {
        static $instance = null;

        if ( null === $instance ) {
            $instance = new static();
        }

        return $instance;
    }

    private function __clone(){
    }

    private function __wakeup(){
    }

	protected function __construct() {

		parent::get_instance();

        // Maybe Include CMB2
        $this->maybe_include_cmb2();

        $this->title = __( 'Network Upload Settings', 'netup' );

        // Uncomment these lines to create an Options page for the plugin
        // add_action( 'admin_init', array( $this, 'init' ) );
        // add_action( 'admin_menu', array( $this, 'add_options_page' ) );
        // add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ), 15 );
        // add_action( 'cmb2_init',  array( $this, 'add_options_metaboxes' ) );

	}

    /**
     * Include the CMB2 framework
     * only if not already loaded
     */
    private function maybe_include_cmb2() {

        global $netup_path;

        if ( ! class_exists( 'CMB2_Bootstrap_208' ) && file_exists( $netup_path . '/inc/cmb2/init.php' ) ) {
            require_once $netup_path . '/inc/cmb2/init.php';
        }
    }

    /**
     * Register our setting to WP
     * @since  0.1.0
     */
    public function init() {
        register_setting( $this->options_slug, $this->options_slug );
    }

    /**
     * Enqueue all our needed styles and scripts
     * @since 0.1.0
     */
    public function enqueue_admin_styles() {
        wp_enqueue_style( 'cmb2-styles' );
    }

    /**
     * Add menu options page
     * @since 0.1.0
     */
    public function add_options_page() {

        $this->options_page = add_menetup_page( $this->title, $this->title, 'manage_options', $this->options_slug, array( $this, 'admin_page_display' ) );

        // Include CMB CSS in the head to avoid FOUT
        add_action( "admin_print_styles-{$this->options_slug}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
    }

    /**
     * Admin page markup. Mostly handled by CMB2
     * @since  0.1.0
     */
    public function admin_page_display() {
        ?>
        <div class="wrap cmb2-options-page <?php echo $this->options_slug; ?>">
            <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
            <?php cmb2_metabox_form( $this->options_slug . 'analytics', $this->options_slug, array( 'cmb_styles' => false ) ); ?>
        </div>
        <?php
    }

    /**
     * Create an options page
     *
     * Create an options page for the plugin
     */
    public function add_options_metaboxes() {

        $cmb_options = new_cmb2_box( array(
            'id'      => $this->options_slug . 'plugin',
            'title'   => __( 'WP Engine Plugin Options', 'netup' ),
            'hookup'  => false,
            'show_on' => array(
                'key'   => 'options-page',
                'value' => array( $this->options_slug )
            ),
        ) );
    }
}
