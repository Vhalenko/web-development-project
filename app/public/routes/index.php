<?php

Route::add('/', function () {
    require(__DIR__. "/../views/pages/index.php");
});

Route::add('/signup-page', function () {
    require(__DIR__. "/../views/pages/sign_up.php");
});

Route::add('/login-page', function () {
    require(__DIR__. "/../views/pages/login.php");
});