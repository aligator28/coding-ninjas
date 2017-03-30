<?php

// add any filelocation to include to the theme
$reveal_includes = [
	'coding-ninjas/inc/custom-post-types.php',
	'coding-ninjas/inc/movies-metaboxes.php',
	'coding-ninjas/inc/ninja-registration-form.php',
	'coding-ninjas/inc/redirect-after-registration.php',
	'coding-ninjas/inc/featured-movies.php',
	'coding-ninjas/inc/redirect-to-paypal.php',
	'coding-ninjas/inc/add-movies-to-woocommerce.php'
];




foreach ($reveal_includes as $file) {

  if (!$filepath = locate_template($file)) {  
    trigger_error(sprintf(__('Error locating %s for inclusion', 'revealpresentation'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);


add_theme_support( 'woocommerce' );






