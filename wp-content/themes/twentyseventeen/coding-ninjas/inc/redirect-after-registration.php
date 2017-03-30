<?php
/**
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @return string
 */
function ninja_login_redirect( $redirect_to, $request, $user ) {

	//is there a user to check?
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		//check for admins
		if ( in_array( 'administrator', $user->roles ) ) {
			// redirect them to the default place
			return $redirect_to;
		} else {
			return home_url().'/movies/?featured';
			// return home_url();
		}
	} else {
			// return home_url().'/movies';
		return $redirect_to;
	}
}

add_filter( 'login_redirect', 'ninja_login_redirect', 10, 3 );

// add_filter( 'registration_redirect', 'ninja_login_redirect', 10, 3 );

