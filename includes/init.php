<?php

/**
 * Initialisations
 *
 * Register an autoloader, start or resume the session etc.
 */

spl_autoload_register(function ($class) {
    //require "classes/{$class}.php";
    //require "../classes/{$class}.php";
    require dirname(__DIR__) . "/classes/{$class}.php";
});

session_start();