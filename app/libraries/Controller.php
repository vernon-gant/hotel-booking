<?php


/**
 * Base Controller
 * Loads models and views
 */
class Controller {

    // Load model
    public function model($model) {
        // Require model file
        require_once '../app/models/' . $model . '.php';

        // Instantiate model
        return new $model();
    }

	public function service($service) {
		// Require service file
		require_once '../app/services/' . $service . '.php';

		// Instantiate service
		return new $service;
	}

    // Load view
    public function view($view, $data = []): void {
        // Check for view file
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die("View does not exist");
        }
    }
}