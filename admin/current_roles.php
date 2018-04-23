<?php

require_once( __DIR__ . '/../bootstrap.php' );
require_once( __DIR__ . '/functions.php' );
global $id;

$current_roles = isset( $_POST[ "current_roles" ] ) ? $_POST[ "current_roles" ] : $_POST[ "current_roles" ] = "SUBSCRIBER" ;

//if ( isset( $_POST[ 'croles' ] ) && isset( $_POST[ 'id' ] ) ) {
if ( isset( $_POST[ 'id' ] ) ) {
	$id            = $_POST[ 'id' ];
	$current_roles = $_POST[ 'current_roles' ];

} else {
	echo "both null in current_roles";
	$id             = null;
	$current_roles  = null;
}

$current_roles = $auth->admin()->getRolesForUserById( $id );

echo json_encode( $current_roles );

