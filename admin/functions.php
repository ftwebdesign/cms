<?php

require_once( __DIR__ . '/../bootstrap.php' );

function confirmQuery( $result ) {

	global $connection;

	if ( ! $result ) {
		die( "QUERY FAILED ." . mysqli_error( $connection ) );
	}

}

/**
 * Appends a trailing slash.
 *
 * Will remove trailing forward and backslashes if it exists already before adding
 * a trailing forward slash. This prevents double slashing a string or path.
 *
 * The primary use of this is for paths and thus should be used for paths. It is
 * not restricted to paths and offers no specific path support.
 *
 * @since 1.2.0
 *
 * @param string $string What to add the trailing slash to.
 *
 * @return string String with trailing slash added.
 */
function trailingslashit( $string ) {
	return untrailingslashit( $string ) . '/';
}

/**
 * Removes trailing forward slashes and backslashes if they exist.
 *
 * The primary use of this is for paths and thus should be used for paths. It is
 * not restricted to paths and offers no specific path support.
 *
 * @since 2.2.0
 *
 * @param string $string What to remove the trailing slashes from.
 *
 * @return string String without the trailing slashes.
 */
function untrailingslashit( $string ) {
	return rtrim( $string, '/\\' );
}

/**
 * Determines if SSL is used.
 *
 * @since 2.6.0
 * @since 4.6.0 Moved from functions.php to load.php.
 *
 * @return bool True if SSL, otherwise false.
 */
function is_ssl() {
	if ( isset( $_SERVER[ 'HTTPS' ] ) ) {
		if ( 'on' == strtolower( $_SERVER[ 'HTTPS' ] ) ) {
			return true;
		}

		if ( '1' == $_SERVER[ 'HTTPS' ] ) {
			return true;
		}
	} elseif ( isset( $_SERVER[ 'SERVER_PORT' ] ) && ( '443' == $_SERVER[ 'SERVER_PORT' ] ) ) {
		return true;
	}

	return false;
}

/**
 * Determines if SSL is used.
 *
 * @since 2.6.0
 * @since 4.6.0 Moved from functions.php to load.php.
 *
 * @return bool True if SSL, otherwise false.
 */
function base_uri() {
	if ( isset( $_SERVER[ 'HTTPS' ] ) ) {
		if ( 'on' == strtolower( $_SERVER[ 'HTTPS' ] ) ) {
			return "https://";
		}

		if ( '1' == $_SERVER[ 'HTTPS' ] ) {
			return "https://";
		}
	} elseif ( isset( $_SERVER[ 'SERVER_PORT' ] ) && ( '443' == $_SERVER[ 'SERVER_PORT' ] ) ) {
		return "https://";
	}

	return "http://";
}

function sendMail( $selector, $token ) {
	$uname       = strip_tags( trim( $_POST[ 'uname_uid' ] ) );
	$umail       = strip_tags( trim( $_POST[ 'uname_email' ] ) );
	$server_name = strip_tags( trim( $_SERVER[ 'SERVER_NAME' ] ) );

	$resetUrl = "http://" . $server_name . "/admin/verify_email.php?selector=";
	$resetUrl .= \urlencode( $selector ) . '&token=';
	$resetUrl .= \urlencode( $token );

	$from    = 'From: ' . "php" . ' ' . "CMS";
	$to      = $umail . ', dgs@riskiii.com';
	$subject = $_SERVER[ 'SERVER_NAME' ] . '  Password Reset';

	$headers = $from . "\r\n";
	$headers .= "Reply-To: " . $umail . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	$message = "<!DOCTYPE html>";
	$message .= "<html lang='en'>";
	$message .= "<head>";
	$message .= "   <meta charset='UTF-8'>";
	$message .= "   <title>Title</title>";
	$message .= "</head>";
	$message .= "<body>";
	$message .= 'Someone has requested a password reset for the following account:<br><br>';
	$message .= '<a href="http://' . $server_name . '">http://' . $server_name . '/</a><br><br>';
	$message .= 'Username: ' . $uname . '<br><br>';
	$message .= 'If this was a mistake, just ignore this email and nothing will happen.<br>';
	$message .= 'To reset your password, visit the following address:<br><br>';
	$message .= '<a href="' . $resetUrl . '">' . $resetUrl . '</a><br>';
	$message .= '<br><br>';
	$message .= "</body>";
	$message .= "</html>";

	mail( $to, $subject, $message, $headers );
}


function getEmailForUserById( $id ) {

	$email = "";
	$db    = new PDO( 'mysql:dbname=phpcmsDB;host=localhost;charset=utf8mb4', 'phpcmsDB', 'T)Pu.WuRE6zW8X' );
	try {

		$stmt = $db->prepare( 'SELECT id, email FROM users WHERE id = :id' );
		$stmt->execute( [ 'id' => $id ] );
		$users = $stmt->fetch();

	} catch ( Error $e ) {
		throw new DatabaseError();
	}

	if ( empty( $users ) ) {
		throw new Exception( 'No users.' );
	} else {
		if ( count( $users ) > 0 ) {
			return $users;
		} else {
			throw new Exception( 'No users' );
		}
	}

}


function insert_categories() {

	global $connection;

	if ( isset( $_POST[ 'submit' ] ) ) {

		$cat_title = $_POST[ 'cat_title' ];

		if ( $cat_title == "" || empty( $cat_title ) ) {

			echo "This Field should not be empty";

		} else {


			$stmt = mysqli_prepare( $connection, "INSERT INTO categories(cat_title) VALUES(?) " );

			mysqli_stmt_bind_param( $stmt, 's', $cat_title );

			mysqli_stmt_execute( $stmt );


			if ( ! $stmt ) {
				die( 'QUERY FAILED' . mysqli_error( $connection ) );

			}


		}


		mysqli_stmt_close( $stmt );


	}

}


function findAllCategories() {
	global $connection;

	$query             = "SELECT * FROM categories";
	$select_categories = mysqli_query( $connection, $query );

	while ( $row = mysqli_fetch_assoc( $select_categories ) ) {
		$cat_id    = $row[ 'cat_id' ];
		$cat_title = $row[ 'cat_title' ];
		echo "<tr>";
		echo "<td>{$cat_id}</td>";
		echo "<td>{$cat_title}</td>";
		echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
		echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
		echo "</tr>";
	}
}

function deleteCategories() {
	global $connection;

	if ( isset( $_GET[ 'delete' ] ) ) {
		$the_cat_id   = $_GET[ 'delete' ];
		$query        = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
		$delete_query = mysqli_query( $connection, $query );
//		header("Location: categories.php");

	}
}

function redirect( $url ) {
	$baseUri = base_uri();

	if ( headers_sent() ) {
		$string = '<script type="text/javascript">';
		$string .= 'window.location = "' . $baseUri . $url . '"';
		$string .= '</script>';

		echo $string;
	} else {
		if ( isset( $_SERVER[ 'HTTP_REFERER' ] ) AND ( $url == $_SERVER[ 'HTTP_REFERER' ] ) ) {
			header( 'Location: ' . $_SERVER[ 'HTTP_REFERER' ] );
		} else {
			header( 'Location: ' . $baseUri . $url );
		}

	}
	exit;
}

function debug_to_console( $data ) {
	$output = $data;
	if ( is_array( $output ) )
		$output = implode( ',', $output);

	echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}

function debug_to_alert( $data ) {
	$output = $data;
	if ( is_array( $output ) ) {
		$output = print_r( $output, true);
	}

	echo "<script>alert( 'Debug Objects: " . $output . "' );</script>";
}

$ROLES = \Delight\Auth\Role::getMap();

//$ROLES = array (
//   "ADMIN"            =>     "\Delight\Auth\Role::ADMIN",
//   "AUTHOR"           =>     "\Delight\Auth\Role::AUTHOR",
//   "COLLABORATOR"     =>     "\Delight\Auth\Role::COLLABORATOR",
//   "CONSULTANT"       =>     "\Delight\Auth\Role::CONSULTANT",
//   "CONSUMER"         =>     "\Delight\Auth\Role::CONSUMER",
//   "CONTRIBUTOR"      =>     "\Delight\Auth\Role::CONTRIBUTOR",
//   "COORDINATOR"      =>     "\Delight\Auth\Role::COORDINATOR",
//   "CREATOR"          =>     "\Delight\Auth\Role::CREATOR",
//   "DEVELOPER"        =>     "\Delight\Auth\Role::DEVELOPER",
//   "DIRECTOR"         =>     "\Delight\Auth\Role::DIRECTOR",
//   "EDITOR"           =>     "\Delight\Auth\Role::EDITOR",
//   "EMPLOYEE"         =>     "\Delight\Auth\Role::EMPLOYEE",
//   "MAINTAINER"       =>      "\Delight\Auth\Role::MAINTAINER",
//   "MANAGER"          =>      "\Delight\Auth\Role::MANAGER",
//   "MODERATOR"        =>     "\Delight\Auth\Role::MODERATOR",
//   "PUBLISHER"        =>     "\Delight\Auth\Role::PUBLISHER",
//   "REVIEWER"         =>     "\Delight\Auth\Role::REVIEWER",
//   "SUBSCRIBER"       =>      "\Delight\Auth\Role::SUBSCRIBER",
//   "SUPER_ADMIN"      =>      "\Delight\Auth\Role::SUPER_ADMIN",
//   "SUPER_EDITOR"     =>      "\Delight\Auth\Role::SUPER_EDITOR",
//   "SUPER_MODERATOR"  =>      "\Delight\Auth\Role::SUPER_MODERATOR",
//   "TRANSLATOR"       =>      "\Delight\Auth\Role::TRANSLATOR",
//);
