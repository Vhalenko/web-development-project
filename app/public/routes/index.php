<?php

Route::add('/', function () {
    // homepage is simply loading a static page
    // view the user routes for example following the MVC pattern
    require(__DIR__. "/../views/pages/index.php");
});

Route::add('/signup-page', function () {
    require(__DIR__. "/../views/pages/sign_up.php");
});

Route::add('/login-page', function () {
    require(__DIR__. "/../views/pages/login.php");
});