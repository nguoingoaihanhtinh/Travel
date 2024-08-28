<?php

include '../components/display/connect.php';

session_start();
session_unset();
session_destroy();

header('admin_login.php');

?>