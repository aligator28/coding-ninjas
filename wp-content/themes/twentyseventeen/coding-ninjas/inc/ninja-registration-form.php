<?php
//1. Add a new form element...
add_action( 'register_form', 'myplugin_register_form' );

function myplugin_register_form() {

    $ninja_skype_id = ( ! empty( $_POST['ninja_skype_id'] ) ) ? trim( $_POST['ninja_skype_id'] ) : '';
        
        ?>
        <p>
            <label for="ninja_skype_id"><?php _e( 'Your Skype ID', 'twentyseventeen' ) ?><br />
                <input type="text" name="ninja_skype_id" id="ninja_skype_id" class="input" value="<?php echo esc_attr( wp_unslash( $ninja_skype_id ) ); ?>" size="25" /></label>
        </p>
        <?php
    }

    //2. Add validation. In this case, we make sure ninja_skype_id is required.
    add_filter( 'registration_errors', 'myplugin_registration_errors', 10, 3 );
    function myplugin_registration_errors( $errors, $sanitized_user_login, $user_email ) {
        
        if ( empty( $_POST['ninja_skype_id'] ) || ! empty( $_POST['ninja_skype_id'] ) && trim( $_POST['ninja_skype_id'] ) == '' ) {
            $errors->add( 'ninja_skype_id_error', __( '<strong>ERROR</strong>: You must include a Your Skype ID.', 'twentyseventeen' ) );
        }

        return $errors;
    }

    //3. Finally, save our extra registration user meta.
    add_action( 'user_register', 'myplugin_user_register' );
    function myplugin_user_register( $user_id ) {
        if ( ! empty( $_POST['ninja_skype_id'] ) ) {
            update_user_meta( $user_id, 'ninja_skype_id', trim( $_POST['ninja_skype_id'] ) );
        }
}