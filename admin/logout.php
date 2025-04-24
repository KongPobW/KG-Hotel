<?php
require('inc/utils.php');

session_start();
session_destroy();
redirect('index.php');
?>