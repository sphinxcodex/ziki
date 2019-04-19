<?php
include 'config/config.php';
session_destroy();

unset($_SESSION);
header("Location: /");
?>
