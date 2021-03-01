<?php
class JuezLTI_Options {

    public function JuezLTI_options_menu() {

	    $hookname = add_submenu_page(
	        'edit.php?post_type=' . JuezLTI_commit_type::POST_TYPE,
	        __( 'Options del plugin JuezLTI', 'textdomain' ),
	        __( 'Commits Options', 'textdomain' ),
	        'manage_options',
	        'commits-options',
	        array( $this, 'commits_options_callback' )
	    );

	    add_action( 'load-' . $hookname, array($this, 'JuezLTI_save_options') );

	}

	function commits_options_callback() {

		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/commits-options-form.php';

	}

	public function JuezLTIRegistraOpciones() {

		$opciones = array(

			array(
				'name' => 'nElementos',
				'title' => 'N&uacute;mero de elementos en Shortcode',
				'args' => array(
					'type' => 'integer',
					'default' => NULL,
				),
			),

		);

		foreach ($opciones as $opcion) {

		    register_setting( 'JuezLTI_options', $opcion['name'], $opcion['args'] );

		}

		add_settings_section( 'JuezLTI_options_section', 'Opciones', array($this, 'commits_options_section_callback'), 'commits-options');

		foreach ($opciones as $opcion) {

		    add_settings_field( $opcion['name'], $opcion['title'], array($this, 'commits_options_' . $opcion['name'] . '_callback'), 'commits-options', 'JuezLTI_options_section');

		}

	}

    public function commits_options_nElementos_callback($args) {

    	echo '<input type="number" id="JuezLTI_options_nElementos" name="JuezLTI_options_nElementos" value="'. get_option('JuezLTI_options_nElementos') .'">';

    }

    public function commits_options_section_callback( $arg ) {

        echo '<hr>';       // title: Example settings section in reading

    }

	public function JuezLTI_save_options() {

		if ('POST' === $_SERVER['REQUEST_METHOD']) {

			update_option('JuezLTI_options_nElementos', htmlspecialchars($_POST["JuezLTI_options_nElementos"]));
			wp_redirect( admin_url( 'edit.php?post_type=' . JuezLTI_commit_type::POST_TYPE) );

		}

	}

}