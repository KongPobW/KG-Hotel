<?php
require('inc/utils.php');

session_start();
redirect('index.php');
session_destroy();
?>