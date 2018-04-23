<?php
/**
 * Description
 *
 * @package CampFirePixels\${MY_NAMESPACE}
 * @since   1.0.0
 * @author  Danny G Smith
 * @link    https://CampFirePixels.com
 * @license GNU General Public License 2.0+
 */

require_once( __DIR__ . "/head.php" );
require_once( __DIR__ . '/../bootstrap.php' );
require_once( __DIR__ . '/functions.php' );

//$userId = $auth->register('dgs@riskiii.com', 'nikatnit', 'dgs');
//$auth->admin()->addRoleForUserById($userId, \Delight\Auth\Role::ADMIN);
//$auth->admin()->addRoleForUserById($userId, \Delight\Auth\Role::DEVELOPER);
//$auth->admin()->addRoleForUserById($userId, \Delight\Auth\Role::SUPER_ADMIN);

echo "<br><br><br><br><br>";
if ( $auth->isLoggedIn() ) {
	$email = $auth->getEmail();
	echo "Howdy " . $email . "<br>";
}
echo $auth->getUserId() . "<br>";
echo $auth->getEmail() . "<br>";
echo $auth->getUsername() . "<br>";

if ($auth->isNormal()) {
	echo "user is in default state";
}

if ($auth->isArchived()) {
	echo "user has been archived";
}

if ($auth->isBanned()) {
	echo "user has been banned";
}

if ($auth->isLocked()) {
	echo "user has been locked";
}

if ($auth->isPendingReview()) {
	echo "user is pending review";
}

if ($auth->isSuspended()) {
	echo "user has been suspended";
}

if ($auth->isRemembered()) {
	echo "user did not sign in but was logged in through their long-lived cookie";
}
else {
	echo "user signed in manually";
}

echo "Roles<br>";
$auth->admin()->addRoleForUserById( 2, \Delight\Auth\Role::ADMIN);
$auth->admin()->addRoleForUserById( 2, \Delight\Auth\Role::DEVELOPER);
$auth->admin()->addRoleForUserById( 2, \Delight\Auth\Role::SUPER_ADMIN);
d( $auth->admin()->getRolesForUserById(2 ) );

//$auth->admin()->removeRoleForUserById(2, \Delight\Auth\Role::ADMIN );
//$auth->admin()->removeRoleForUserById(2, \Delight\Auth\Role::DEVELOPER );
//$auth->admin()->removeRoleForUserById(2, \Delight\Auth\Role::SUPER_ADMIN );
//d( $auth->admin()->getRolesForUserById(2 ) );
//$auth->admin()->removeRoleForUserById( 2, \Delight\Auth\Role::ADMIN );
//$auth->admin()->removeRoleForUserById( 2, \Delight\Auth\Role::DEVELOPER );
//$auth->admin()->removeRoleForUserById( 2, \Delight\Auth\Role::SUPER_ADMIN );
//d( $auth->admin()->getRolesForUserById(2 ) );
//
$dgs =\Delight\Auth\Role::getMap();

//d( $dgs );





//$current_roles = isset( $_POST[ "current_roles" ] ) ? $_POST[ "current_roles" ] : $_POST[ "current_roles" ] = array ("SUBSCRIBER") ;
//d( $current_roles );
//if ( isset( $_POST[ 'id' ] ) ) {
//	$id            = $_POST[ 'id' ];
//	$current_roles = $_POST[ 'current_roles' ];
//} else {
//	echo "both null in current_roles";
//}

$id = 2;

$current_roles = $auth->admin()->getRolesForUserById( $id );


foreach ( $current_roles as $key => $value ) {

	if ( array_key_exists( $key, $ROLES ) ) {

		$index =  "\Delight\Auth\Role::" . $value;
		echo $index . "\n";
		//exit;
		$file = 'roles.txt';
		// Open the file to get existing content
		$current = file_get_contents( $file );
		$current .= '$auth->admin()->removeRoleForUserById( ' . $id . ', ' .  $index . ' );'. "\n";
		// Write the contents back to the file
		file_put_contents( $file, $current );

		try {
			$auth->admin()->removeRoleForUserById( $id, $index );
		} catch ( \Delight\Auth\UnknownIdException $e ) {
			echo "unknown user ID" . "<br>";
		}

		reset( $ROLES );
	}
}
