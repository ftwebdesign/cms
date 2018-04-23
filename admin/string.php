<?php

require_once( "../bootstrap.php" );
//require_once( __DIR__ . "/functions.php" );

$c_roles = array (  "ADMIN"       => "ADMIN",
                    "DEVELOPER"   => "DEVELOPER",
                    "SUPER_ADMIN" => "SUPER_ADMIN" );
$id = 2;

foreach ( $c_roles as $key => $value ) {
	$key = array_key_exists( $c_roles[ $key ], $ROLES );
	echo $key . "\n";
	echo '$auth->admin()->removeRoleForUserById( ' . $id . ', ' . $ROLES[ $value ] . ' )'. "\n";
}
echo "\n";
