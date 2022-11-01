<?php

// Simple page redirect
function redirect($page): void {
    header('Location: ' . URL_ROOT . '/' . $page);
}
