<?php

/**
 * Base class for all services
 * Has model method to get model instance
 */
class Service {

	// Load model
	public function model($model) {
		// Require model file
		require_once '../app/models/' . $model . '.php';

		// Instantiate model
		return new $model();
	}

}