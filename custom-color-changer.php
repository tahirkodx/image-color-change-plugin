<?php
/*
Plugin Name: Custom Color Changer
Description: Change product image color on product detail page based on selected categories and hue-rotate values.
Version: 1.0
Author: Tahir Amjad
*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'components/load-scripts.php';
include 'functions.php';
include 'menu.php';
if (isset($_GET['page']) && $_GET['page'] === 'custom-color-changer-add-new') {
    include 'pages/add-new-page.php';
}
if (isset($_GET['page']) && $_GET['page'] === 'custom-color-changer-edit') {
    include 'pages/edit-page.php';
}
if (isset($_GET['page']) && $_GET['page'] === 'custom-color-changer-settings') {
    if (!isset($_GET['action'])) {
        include 'pages/list-page.php';
    }
}

include 'components/handle-submit.php';

include 'db/create-tables.php';
