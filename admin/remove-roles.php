<?php

use \Delight\Auth\Auth;

require_once( __DIR__ . '/../bootstrap.php' );
require_once( __DIR__ . '/functions.php' );
require_once( __DIR__ . '/config.php' );

// Report all errors except E_NOTICE
//error_reporting(E_ALL & ~E_WARNING);

$current_roles = isset( $_POST[ "current_roles" ] ) ? $_POST[ "current_roles" ] : $_POST[ "current_roles" ] = array ( "SUBSCRIBER" );

if ( isset( $_POST[ 'id' ] ) ) {
	$id            = $_POST[ 'id' ];
	$current_roles = $_POST[ 'current_roles' ];
} else {
	//echo "both null in current_roles";
}

$current_roles = @json_decode( json_encode( json_decode( $current_roles ), true ), true );

$file = 'roles.txt';
// Open the file to get existing content
$current = file_get_contents( $file );

file_put_contents( $file, $current );

if ( is_array( $current_roles ) && count( $current_roles ) !== 1 ) {
	foreach ( $current_roles as $key => $value ) {

		$current .= "key:\t" . $key . "\t\t";
		$current .= "value:\t" . $value . "\n";
		$index   = '\Delight\Auth\Role::' . $value;
		$current .= '$auth->admin()->removeRoleForUserById( ' . $id . ', ' . $index . ' );' . "\n";

		$current .= print_r( $current_roles, true );

		if ( is_object( $current_roles ) ) {
			$current .= 'is object' . "\n";
		} else if ( is_array( $current_roles ) ) {
			$current .= 'is array' . "\n";
		} else {
			$current .= gettype( $current_roles ) . "\n";
		}

		try {
			$auth->admin()->removeRoleForUserById( $id, $index );

		} catch ( \Delight\Auth\UnknownIdException $e ) {
			echo "unknown user ID" . "<br>";
		}
	}
}

// Write the contents back to the file
file_put_contents( $file, $current );
//reset( $current_roles );
//reset( $ROLES );

//$auth->admin()->removeRoleForUserById( 2, \Delight\Auth\Role::ADMIN );
//$auth->admin()->removeRoleForUserById( 2, \Delight\Auth\Role::DEVELOPER );
//$auth->admin()->removeRoleForUserById( 2, \Delight\Auth\Role::SUPER_ADMIN );



