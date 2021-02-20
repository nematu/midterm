<?php

//Turn on error reporting -- this is critical!
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require the autoload file
require_once('vendor/autoload.php');


$f3 = Base::instance();
$f3->set('DEBUG', 3);


// First route
$f3->route('GET /', function() {
    $view = new Template();
    echo $view->render('views/home.html');
});

// Second route
$f3->route('GET /survey', function() {

    $view = new Template();
    echo $view->render('views/survey.html');
});

// summary
$f3->route('POST /summary', function() {
    if(isset($_POST['name'])){
        $_SESSION['name'] = $_POST['name'];
    }
    if (isset($_POST['selections'])) {
        $selections = $_POST['selections'];
        $_SESSION['selections'] = implode(", ", $selections);
    }
    $view = new Template();
    echo $view->render('views/summary.html');
    session_destroy();
});

$f3->run();
