<?php
// Include FB config file
require_once 'config.php';

session_destroy();

// Redirect to the homepage
header("Location:index.php");
?>