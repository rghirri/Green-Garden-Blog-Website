<?php
//======================================================================
// This code is used to logout of website
//======================================================================

//-----------------------------------------------------
// PHP debug code which I used to test page for errors
// This code must be remove when the site is ready for 
// live production.
//-----------------------------------------------------
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* This code includes init.php file 
   which has the class autoloader */
require 'includes/init.php';

/* This code calls the logout() method in the Auth class to log user out */
Auth::logout();

/* This code redirects to home page after user has logged out */
Url::redirect('/');