<?php

require_once( __DIR__ . '/../bootstrap.php' );
require_once( __DIR__ . '/functions.php' );
global $new_roles;
global $id;

// Make sure both have value or it will not work
$new_roles = isset( $_POST[ "new_roles" ] ) ? $_POST[ "new_roles" ] : $_POST[ "new_roles" ] = "SUBSCRIBER" ;

if ( isset( $_POST[ 'id' ] ) ) {
	$id        = $_POST[ 'id' ];
	$new_roles = $_POST[ 'new_roles' ];
} else {
	$new_roles = null;
}

function buildRoles( \Delight\Auth\Auth $auth, $id ) {
	$new_roles = \Delight\Auth\Role::getMap();

	$rolesJson = '';
	foreach ( $new_roles as $key => $value ) {

		$theRole = $auth->admin()->getRolesForUserById( $id );

		if ( in_array( $new_roles[ $key ], $theRole ) === true ) {
			$rolesJson .= "    <option selected='selected' value=$key >" . $value . "</option>";

		} else {
			$rolesJson .= "    <option value=$key>" . $value . "</option>";
		}
	}

	echo   $rolesJson ;
}

buildRoles( $auth, $id );
