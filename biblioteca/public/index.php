<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../core/Router.php';
require_once '../core/Database.php';
require_once '../core/Controller.php';

$url = isset($_GET['url']) ? $_GET['url'] : '';
Router::route($url);
