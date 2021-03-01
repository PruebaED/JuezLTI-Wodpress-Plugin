<?php

// Registrar y cargar el widget
function JuezLTIParticipantes_load_widget() {
    register_widget( 'JuezLTIWidgetParticipantes' );
}
add_action( 'widgets_init', 'JuezLTIParticipantes_load_widget' );

// Creando el widget
class JuezLTIWidgetParticipantes extends WP_Widget {

    function __construct() {
        parent::__construct(

// ID base del widget
            'JuezLTIWidgetParticipantes',

// Nombre del widget que aparecerá en la UI
            __('JuezLTI Participantes Widget', 'JuezLTIParticipantes_widget_domain'),

// Descripción del widget
            array( 'description' => __( 'Instituciones interesadas en participar en el proyecto piloto del C.I.F.P. Carlos III', 'JuezLTIParticipantes_widget_domain' ), )
        );
    }

// Creando la vista del widget del Frontend

    public function widget( $args, $instance ) {

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/JuezLTI-public-display.php';

        JuezLTIWidgetPublicForm($args, $instance);
    }


// Creando la vista del widget del Backend
    public function form( $instance ) {

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/JuezLTI-admin-display.php';


        JuezLTIWidgetAdminForm($instance, $this);
    }

// Actualizando el widget reemplazando la instancia antigua por la nueva
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Class JuezLTIWidgetParticipantes ends here