<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    JuezLTI
 * @subpackage JuezLTI/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
    function JuezLTIWidgetPublicForm($args, $instance) {
    $title = apply_filters( 'widget_title', $instance['title'] );

    // los argumentos before y after del widget son definidos por el tema
    echo $args['before_widget'];
    if ( ! empty( $title ) )
    echo $args['before_title'] . $title . $args['after_title'];

    // Aquí es donde ejecutaremos el código y mostramos la salida
    echo __( 'Suscríbete para participar en el proyecto piloto', 'JuezLTIParticipantes_widget_domain' );
    echo $args['after_widget'];
    ?>
    <form class="widget_form_participantes" action="<?php echo esc_url( admin_url('admin-ajax.php') ); ?>" method="POST">
        <input type="hidden" name="action" value="JuezLTI_participantes">

        <p>
            <label for="solo-participantes-nombreinstitucion"><?php _e('Nombre institución:'); ?>
                <input type="nombreinstitucion" name="nombreinstitucion" id="solo-participantes-nombreinstitucion" size="22" value="" />
            </label>

            <br>
            <label for="solo-participantes-emailinstitucion"><?php _e('E-Mail:'); ?>
                <input type="emailinstitucion" name="emailinstitucion" id="solo-participantes-emailinstitucion" size="22" value="" />
            </label>
            <br>
            <label for="solo-participantes-urllogotipo"><?php _e('URL logotipo:'); ?>
                <input type="urllogotipo" name="urllogotipo" id="solo-participantes-urllogotipo" size="22" value="" />
            </label>
            <br>
            <input type="submit" name="submit" value="<?php _e('Registrar', 'participantes-to-comments'); ?>" />
        </p>
    </form>
<?php
}
?>
