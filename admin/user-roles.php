<?php

require_once( __DIR__ . "/head.php" );
require_once( __DIR__ . '/../bootstrap.php' );
require_once( __DIR__ . '/functions.php' );
require_once( __DIR__ . '/../assets/vendor/autoload.php' );
//// enable error reporting
//\error_reporting(\E_ALL);
//\ini_set('display_errors', 'stdout');
//
//// enable assertions
//\ini_set('assert.active', 1);
//@\ini_set('zend.assertions', 1);
//\ini_set('assert.exception', 1);

$list_of_roles = \Delight\Auth\Role::getNames();

$roles = json_encode( $list_of_roles );
//var_dump( $roles );

$j = 0;
// event not selecting single select2 with jQuery
?>
<form class="signup-form-container" method="get" id="roles-form" name="roles-form">

   <div class="form-header">
      <h3><span class="login-title"><img src="../assets/fonts/solid/user.svg" alt="icon of user"
                                         class="user"> Add / Remove Roles</span> <span
               class="login-title-right">
               <img src="../assets/fonts/solid/pencil-alt.svg" alt="icon of pencil" class="pencil-alt"></span>
      </h3>

      <div id="error">
		  <?php
		  if ( isset( $error ) ) {
			  ?>
             <div class="alert alert-danger"> exclamation-triangle
                <img src="../assets/fonts/solid/exclamation-triangle.svg" class="user" alt="icon
              of triangle" >&nbsp; <?php echo $error; ?> !
             </div>
			  <?php
		  }
		  ?>
      </div>
   </div>  <!-- .form-header -->

   <div class="form-body">

      <!-- json response will be here -->
      <div id="errorDiv"></div>
      <!-- json response will be here -->

      <div class="form-group">
         <div class="input-group input-group-relative">
            <label class="control-label" for="js_users">Select email of user to change roles</label><br>
            <div class="input-group-addon">
               <img src="../assets/fonts/solid/envelope.svg" alt="icon of mail" class="user">
            </div>
            <select id="js_users" class="js_users" style='width: 350px' >
               <option value="" data-select2-id=""></option>
			      <?php require_once( __DIR__ . "/users.php" ); ?> <!-- populate users  -->
            </select>
         </div>
         <span class="help-block" id="check-u"></span>
      </div>
      <div class="form-group">
         <div class="input-group input-group-relative">
            <label class="control-label" for="js-roles">Add or subtract roles</label><br>
            <div class="input-group-addon">
               <img src="../assets/fonts/solid/user-alt.svg" alt="icon of user" class="user">
            </div>
            <select id="js_roles" class="js-multiple-roles" style='width: 340px' multiple='multiple'>
	            <?php //require_once( __DIR__ . '/get-id-ajax.php' ); ?><!-- <!-- populate user role choices -->
            </select>
         </div>
         <span class="help-block" id="check-s"></span>
      </div>
      <div id="dgs"></div>
   </div>
   <div class="form-footer">
      <div class="row">
         <div class="form-group left-col col-lg-6">
            <button type="button" name="btn-roles" class="btn btn-info" id="btn-roles">
               <img src="../assets/fonts/solid/sign-in.svg" alt="sign-in icon" class="sign-in"> &nbsp; Select Roles
            </button>
         </div>
      </div>
   </div>  <!-- .form-footer -->
</form> <!-- form-horizontal -->

<?php

////$auth->admin()->getRolesForUserById(1);
//
////$current_roles = isset( $_POST[ "current_roles" ] ) ? $_POST[ "current_roles" ] : $_POST[ "current_roles" ] = array ("SUBSCRIBER") ;
////if ( isset( $_POST[ 'id' ] ) ) {
////	$id            = $_POST[ 'id' ];
////	$current_roles = $_POST[ 'current_roles' ];
////} else {
////	echo "both null in current_roles";
////}
//
//$id = 2;
//
//$current_roles = $auth->admin()->getRolesForUserById( $id );
//d( $current_roles );
////echo '\Delight\Auth\Role::' . 'EDITOR';
//foreach (  $current_roles  as $key => $value ) {
//
//	if ( array_key_exists( $key, $ROLES ) ) {
//		//echo $index . "\n";
//		////exit;
//
//		//$file = 'roles.txt';
//		//// Open the file to get existing content
//		//$current = file_get_contents( $file );
//		//$current .= '$auth->admin()->removeRoleForUserById( ' . $id . ', ' .  $value . ' );'. "\n";
//		//// Write the contents back to the file
//		//file_put_contents( $file, $current );
//
//		try {
//		  $index = '\Delight\Auth\Role::' . $value;
//		  $auth->admin()->removeRoleForUserById( $id, $index );
//         echo "done<br>";
//	  } catch ( \Delight\Auth\UnknownIdException $e ) {
//			echo "unknown user ID" . "<br>";
//		}
//
//	   //$auth->admin()->removeRoleForUserById( 2, \Delight\Auth\Role::ADMIN );
//	   //$auth->admin()->removeRoleForUserById( 2, \Delight\Auth\Role::DEVELOPER );
//	   //$auth->admin()->removeRoleForUserById( 2, \Delight\Auth\Role::EDITOR );
//	   //$auth->admin()->removeRoleForUserById( 2, \Delight\Auth\Role::SUPER_ADMIN );
//
//	}
//}
//reset( $ROLES );
//
//function my_role( $id, $value ) {
//
//   return( '$auth->admin()->removeRoleForUserById( ' . $id . ", \Delight\Auth\Role::" . $value . " );");
//}




require_once( __DIR__ . "/footer.php" );

