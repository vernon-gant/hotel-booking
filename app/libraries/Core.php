<?php

/**
 * App core class
 * Creates URL and loads core controllers
 * URL FORMAT - /controllers/method/params
 */
class Core {

	protected mixed $currentController = 'Pages';
	protected string $currentMethod = 'index';
	protected array $params = [];

    public function __construct() {

        $url = $this->getUrl();

		if (isset($_SESSION['admin_email']) and !in_array("admin",$url)) redirect("admin/index");
		elseif (isset($_SESSION['user_email']) and in_array("admin",$url)) redirect("pages/index");
		elseif ($url[0] == 'admin' and !isset($_SESSION['admin_email']) and $url[1] != 'login') redirect("admin/login");
		elseif ($url[0] == 'bookings' and !isset($_SESSION['user_email'])) redirect("pages/index");
		elseif ($url[0] == 'users' and !($url[1] == 'login' or $url[1] == 'registration') and !isset($_SESSION['user_email'])) redirect("users/login");

        // Look in controllers for first value
        if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            // If exists set as controllers
            $this->currentController = ucwords($url[0]);
            // Unset 0 Index
            unset($url[0]);
        }

        // Require the controllers
        require_once '../app/controllers/' . $this->currentController . '.php';

        // Instantiate controllers class
        $this->currentController = new $this->currentController;

        // Check for second part of url
        if (isset($url[1])) {
            // Check to see if method exists
            if (method_exists($this->currentController,$url[1])) {
                $this->currentMethod = $url[1];
                // Unset method in array
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->currentController,$this->currentMethod],$this->params);
    }


    public function getUrl():array {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'],'/');
            $url = filter_var($url,FILTER_SANITIZE_URL);
            return explode('/',$url);
        }
        return [$this->currentController];
    }
}