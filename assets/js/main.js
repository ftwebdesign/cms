;(function ( $, window, document, undefined ) {
   'use strict';

   const $js_user = $( '#js_users' );
   const $js_role = $( '#js_roles' );
   var $jsUser;
   var $jsRole;
   var $current_roles;
   var $current_auth;
   var $new_roles;
   var id;

   var my_global           = new Object();
   my_global.id            = -1;
   my_global.current_roles = [ "SUBSCRIBER" ];

   // get user to work add / remove rules
   //
   $( document ).ready( function () {

      $( '.js_users' ).select2();
      $( '.js-multiple-roles' ).select2();

      // get existing roles to be used later
      $js_user.on( "change", function ( e ) {
         id = $( this ).val();

         if ( id === 0 ) {
            alert( "nothing selected" );
            return null;
         } else {
            $jsUser = id;

            var vars           = new Object();
            vars.id            = $jsUser = id;
            vars.current_roles = $current_roles;

            my_global.id            = $jsUser;
            my_global.current_roles = $current_roles;

            $.ajax( {
               url:      "current_roles.php",
               data:     vars,
               type:     "POST",                                 // GET, POST
               dataType: "text",

               success: function ( data, status, xhr ) {
                  my_global.current_roles = data;
                  $current_roles = data;
                  $jsUser        = vars.id;

                  console.log( $current_roles );
                  console.log( data );
                  console.log( status );
                  console.log( xhr );
               },
               error:   function ( data, status, xhr ) {
                  alert( "Some Error Occurred : " + error );
                  console.log( data );
                  console.log( status );
                  console.log( xhr );
               }
            } );
//======================================================================

            var varz           = new Object();
            varz.id            = $jsUser = id;
            varz.current_roles = $new_roles;

            // after user is selected we pass id of the user
            $.ajax( {

               url:      "roles.php",    // (default: The current page)
               type:     "POST",                // GET, POST
               data:     varz,                  // PlainObject or String or Array
               dataType: "text",                // xml, json, script, or html

               // todo creat $new_roles which are the changes made
               success: function ( data, status, xhr ) {
                  $new_roles = data;
                  //console.log( data );
                  //console.log( status );
                  //console.log( xhr );
                  $( '#js_roles' ).html( $new_roles );
               },
               error:   function ( data, status, xhr ) {
                  console.log( data );
                  console.log( status );
                  console.log( xhr );
                  alert( "Some Error Occurred : " + error );
               }
            } );
         }

      } );
//================================================================================
      $( '#btn-roles' ).click( function ( event ) {

         //var varsz           = new Object();
         //varsz.id            = $jsUser;
         //varsz.current_roles = $current_roles;
         //
         //var my_global  = new Object();
         $jsUser        = my_global.id;
         $current_roles = my_global.current_roles;

         // todo after user is selected and button is pushed we pass id of the user & and current
         // todo selection of roles in database via ajax
         $.ajax( {

            url:      "remove-roles.php",      // (default: The current page)
            //url:    "user-roles.php",      // (default: The current page)
            type:     "POST",
            data:     my_global,
            dataType: "text",                  // xml, json, script, or html

            success: function ( data, status, xhr ) {

               $jsUser        =  my_global.id;
               $current_roles =  my_global.current_roles;
               data           =  my_global.current_roles;

               console.log( $current_roles );
               //$current_roles  = data;
               //$jsUser         = id;
               //$current_roles = current_roles;

               //$current_roles = Object.keys($current_roles).map(function(key) {
               //   return [Number( key ), $current_roles[key]];
               //});

               //alert( "jsUser: "        + $jsUser  );
               //alert( "current_roles: " +  $current_roles );

               //$.each( JSON.parse( my_global.current_roles ), function( key, value ) {
               //   alert( key + ": " + value );
               //});

               //console.log( JSON.parse( my_global.current_roles ) );
               //console.log( status );
               //console.log( xhr );
            },
            error:   function ( data, status, xhr ) {
               alert( "Some Error Occurred : " + error );
               console.log( data );
               console.log( status );
               console.log( xhr );
            }
         } );
//====================================================================
         // todo add back selected roles
         //$('#js_roles').on('select2:select', function (e) {
         //   // Do something
         //});

      } );

      /*
      1 click on email <= ajax to get roles <= trigger database read to get roles
      2 add role => update database with new role
      3 delete role => update database to remove role

       */

   } );

   $( document ).ready( function () {
      $( '.js_user' ).select2( {
         placeholder: 'Select a user',
         width:       '350px'
      } );
   } );

   $( document ).ready( function () {
      $( '.js-multiple-roles' ).select2( {
         placeholder: 'Select one or more roles',
         multiple:    'multiple',
         width:       '350px'
      } );
   } );

})
( jQuery, window, document );

