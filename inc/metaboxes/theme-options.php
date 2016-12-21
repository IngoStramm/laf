<?php
/**
 * CMB2 Theme Options
 * @version 0.1.0
 */
class Laf_Admin {

	/**
 	 * Option key, and option page slug
 	 * @var string
 	 */
	private $key = 'laf_options';

	/**
 	 * Options page metabox id
 	 * @var string
 	 */
	private $metabox_id = 'laf_option_metabox';

	/**
	 * Options Page title
	 * @var string
	 */
	protected $title = '';

	/**
	 * Options Page hook
	 * @var string
	 */
	protected $options_page = '';

	/**
	 * Holds an instance of the object
	 *
	 * @var Laf_Admin
	 **/
	private static $instance = null;

	/**
	 * Constructor
	 * @since 0.1.0
	 */
	private function __construct() {
		// Set our title
		$this->title = __( 'Opções Gerais', 'laf' );
	}

	/**
	 * Returns the running object
	 *
	 * @return Laf_Admin
	 **/
	public static function get_instance() {
		if( is_null( self::$instance ) ) {
			self::$instance = new Laf_Admin();
			self::$instance->hooks();
		}
		return self::$instance;
	}

	/**
	 * Initiate our hooks
	 * @since 0.1.0
	 */
	public function hooks() {
		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_options_page_metabox' ) );
	}


	/**
	 * Register our setting to WP
	 * @since  0.1.0
	 */
	public function init() {
		register_setting( $this->key, $this->key );
	}

	/**
	 * Add menu options page
	 * @since 0.1.0
	 */
	public function add_options_page() {
		$this->options_page = add_menu_page( $this->title, $this->title, 'manage_options', $this->key, array( $this, 'admin_page_display' ) );

		// Include CMB CSS in the head to avoid FOUC
		add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
	}

	/**
	 * Admin page markup. Mostly handled by CMB2
	 * @since  0.1.0
	 */
	public function admin_page_display() {
		?>
		<div class="wrap cmb2-options-page <?php echo $this->key; ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			<?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
		</div>
		<?php
	}

	/**
	 * Add the options metabox to the array of metaboxes
	 * @since  0.1.0
	 */
	function add_options_page_metabox() {

		// hook in our save notices
		add_action( "cmb2_save_options-page_fields_{$this->metabox_id}", array( $this, 'settings_notices' ), 10, 2 );

		$cmb = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );

		// Set our CMB2 fields

		$cmb->add_field( array(
			'name' => __( 'Logo', 'laf' ),
			'desc' => __( 'Faça o upload de uma imagem ou digite uma URL.', 'laf' ),
			'id'   => 'logo',
			'type' => 'file',
			'attributes' => array('placeholder' => 'http://'),
		) );

/*		$cmb->add_field( array(
			'name' => __( 'Mídias Sociais', 'laf' ),
			'id'   => 'titulo_social_media',
			'type' => 'title',
		) );
		
		$cmb->add_field( array(
			'name' => __( 'Facebook', 'laf' ),
			'desc' => __( 'Url da página do Facebook', 'laf' ),
			'id'   => 'facebook_url',
			'type' => 'text_url',
			'attributes' => array('placeholder' => 'http://'),
		) );

		$cmb->add_field( array(
			'name' => __( 'Twitter', 'laf' ),
			'desc' => __( 'Url do Twitter', 'laf' ),
			'id'   => 'twitter_url',
			'type' => 'text_url',
			'attributes' => array('placeholder' => 'http://'),
		) );

		$cmb->add_field( array(
			'name' => __( 'Youtube', 'laf' ),
			'desc' => __( 'Url do canal do Youtube', 'laf' ),
			'id'   => 'youtube_url',
			'type' => 'text_url',
			'attributes' => array('placeholder' => 'http://'),
		) );

*/		$cmb->add_field( array(
			'name' => __( 'Informações da empresa', 'laf' ),
			'id'   => 'titulo_endereco',
			'type' => 'title',
		) );

		$cmb->add_field( array( 
			'name'    => __( 'Rua', 'laf' ),
			'id'      => 'rua',
			'type'    => 'text'
		) );

		$cmb->add_field( array(
			'name'    => __( 'Número', 'laf' ),
			'id'      => 'numero',
			'type'    => 'text_small'
		) );

		$cmb->add_field( array(
			'name'    => __( 'Cidade', 'laf' ),
			'id'      => 'cidade',
			'type'    => 'text_medium'
		) );

		$cmb->add_field( array(
			'name'    => __( 'Estado', 'laf' ),
			'id'      => 'uf',
			'type'    => 'text_small'
		) );

		$cmb->add_field( array(
			'name'    => __( 'CEP', 'laf' ),
			'id'      => 'cep',
			'type'    => 'text_medium',
			'attributes'  => array(
					'class'		  => 'cmb2-text-medium cep-input',
			        'placeholder' => '00000-000',
			    )
		) );

		$cmb->add_field( array(
			'name'    => __( 'Telefones', 'laf' ),
			'id'      => 'telefones',
			'type'    => 'text_medium',
			'desc'       => __( 'O primeiro número telefone é considerado o telefone principal', 'laf' ),
			'repeatable'      => true,
			'attributes'  => array(
					'class'		  => 'cmb2-text-medium cel-input',
			        'placeholder' => '(11) 12345-1234',
			    ),
		) );

		$cmb->add_field( array(
			'name'    => __( 'E-mail', 'laf' ),
			'id'      => 'email',
			'type'    => 'text_email'
		) );

		/*$cmb->add_field( array(
			'name' => __( 'Horário de funcionamento', 'laf' ),
			'id'   => 'horario_funcionamento_titulo',
			'type' => 'title',
		) );

		$cmb->add_field( array(
			'name'    => __( 'A partir de:', 'laf' ),
			'id'      => 'time_begin',
			'type'    => 'text_time',
		) );

		$cmb->add_field( array(
			'name'    => __( 'Até:', 'laf' ),
			'id'      => 'time_end',
			'type'    => 'text_time'
		) );*/
	}

	/**
	 * Register settings notices for display
	 *
	 * @since  0.1.0
	 * @param  int   $object_id Option key
	 * @param  array $updated   Array of updated fields
	 * @return void
	 */
	public function settings_notices( $object_id, $updated ) {
		if ( $object_id !== $this->key || empty( $updated ) ) {
			return;
		}

		add_settings_error( $this->key . '-notices', '', __( 'Settings updated.', 'laf' ), 'updated' );
		settings_errors( $this->key . '-notices' );
	}

	/**
	 * Public getter method for retrieving protected/private variables
	 * @since  0.1.0
	 * @param  string  $field Field to retrieve
	 * @return mixed          Field value or exception is thrown
	 */
	public function __get( $field ) {
		// Allowed fields to retrieve
		if ( in_array( $field, array( 'key', 'metabox_id', 'title', 'options_page' ), true ) ) {
			return $this->{$field};
		}

		throw new Exception( 'Invalid property: ' . $field );
	}

}

/**
 * Helper function to get/return the Laf_Admin object
 * @since  0.1.0
 * @return Laf_Admin object
 */
function laf_admin() {
	return Laf_Admin::get_instance();
}

/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string  $key Options array key
 * @return mixed        Option value
 */
function laf_get_option( $key = '' ) {
	return cmb2_get_option( laf_admin()->key, $key );
}

// Get it started
laf_admin();