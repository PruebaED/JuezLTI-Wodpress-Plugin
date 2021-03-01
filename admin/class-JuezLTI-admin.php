<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    JuezLTI
 * @subpackage JuezLTI/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    JuezLTI
 * @subpackage JuezLTI/admin
 * @author     Your Name <email@example.com>
 */
class JuezLTI_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $JuezLTI    The ID of this plugin.
	 */
	private $JuezLTI;

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
	 * @param      string    $JuezLTI       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $JuezLTI, $version ) {

		$this->JuezLTI = $JuezLTI;
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
		 * defined in JuezLTI_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The JuezLTI_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->JuezLTI, plugin_dir_url( __FILE__ ) . 'css/JuezLTI-admin.css', array(), $this->version, 'all' );

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
		 * defined in JuezLTI_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The JuezLTI_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->JuezLTI, plugin_dir_url( __FILE__ ) . 'js/JuezLTI-admin.js', array( 'jquery' ), $this->version, false );

	}

    public function JuezLTI_participantes() {

        $response = array(
            'error' => false,
        );

        $nombreInstitucion = htmlspecialchars($_POST["nombreinstitucion"]);

        $emailInstitucion = htmlspecialchars($_POST["emailinstitucion"]);

        $logotipoInstitucion = htmlspecialchars($_POST["urllogotipo"]);

        if(!$this->getParticipante($emailInstitucion)) {

           	$this->addParticipante($nombreInstitucion, $emailInstitucion, $logotipoInstitucion); 

        	$response['message'] = __("Solicitud registrada correctamente");

        } else {

            $response['message'] = __("Usted ya solicitó subscribirse");

        }

        exit(json_encode($response));
    }

    public function getParticipante($emailInstitucion) {

       global $wpdb;

       	$table_name = $wpdb->prefix . "c3jParticipantes";
           // convendría no duplicar este código
           // Una buena forma sería crear una constante en la clase CarlosIIIJobs con:
           // const C3JSUSCRIPTORES_TABLE = 'c3jSuscriptores';
           // y acceder a ella desde este código
           // $table_name = $wpdb->prefix . CarlosIIIJobs::C3JSUSCRIPTORES_TABLE;
       	$query = "SELECT count(email) FROM $table_name WHERE email = %s";
       	$existeParticipante = $wpdb->get_var( $wpdb->prepare($query, $emailInstitucion));
       	return $existeParticipante > 0;

    }

    public function addParticipante($nombreInstitucion, $emailInstitucion, $logotipoInstitucion) {

    	global $wpdb;

       	$table_name = $wpdb->prefix . "c3jParticipantes";
       	$wpdb->insert(
           	$table_name,
           	array(
                   'nombre' => $nombreInstitucion,
                   'email' => $emailInstitucion,
                   'url' => $logotipoInstitucion,
           	),
           	array('%s')
       	);

       }

}
