<?php
require('../public/utils.php');

session_start();
redirect('index.php');
session_destroy();
?>