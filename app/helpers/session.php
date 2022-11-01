<?php
session_start();

// Flash message helper
// Example - flash('register_success','You are now registered')

function flash($name = '', $message = '', $class = 'alert alert-success') : void {
    if (!empty($message) && empty($_SESSION[$name])) {
        $_SESSION[$name] = $message;
        $_SESSION[$name . '_class'] = $class;
    } elseif(!empty($_SESSION[$name])) {
        $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : $class;
        echo '<div class="'.$class.'" id="msg-flash">'.$_SESSION[$name].'</div>';
        unset($_SESSION[$name],$_SESSION[$name . '_class']);
    }
}
