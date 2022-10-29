<?php

class Users extends Controller {

    public function __construct() {

    }

    public function login() {
        $data = [
            'title' => 'Login'
        ];
        $this->view('users/login',$data);
    }

    public function registration() {
        $data = [
            'title' => 'Login'
        ];
        $this->view('users/registration',$data);
    }

}