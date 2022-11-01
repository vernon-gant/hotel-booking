<?php
    // Load config
    require_once 'config/config.php';
    // Load Helpers
    require_once 'helpers/general.php';
    require_once 'helpers/validation.php';
    require_once 'helpers/session.php';
    // Autoload core libraries
    spl_autoload_register(function ($className) {
        require_once 'libraries/' . $className .'.php';
    });