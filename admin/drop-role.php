<?php
require_once( __DIR__ . '/../bootstrap.php' );

$auth->admin()->removeRoleForUserById($_POST['id'], $_POST['role']);
