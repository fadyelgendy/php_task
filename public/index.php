<?php
session_start();

// CSRF token
$_SESSION['_token'] = hash('sha256', $_SERVER['SERVER_ADDR']);

include dirname(__DIR__) . "/helpers.php";
include dirname(__DIR__) . "/handler.php";
include dirname(__DIR__) . "/views/base.php";

