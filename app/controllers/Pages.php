<?php

class Pages extends Controller {

    public function __construct() {

    }

    public function about() {
        $data = [
            'title' => 'About'
        ];
        $this->view('pages/about',$data);
    }

    public function blog() {
        $data = [
            'title' => 'Blog'
        ];
        $this->view('pages/blog',$data);
    }

    public function contact() {
        $data = [
            'title' => 'Contact'
        ];
        $this->view('pages/contact',$data);
    }

    public function gallery() {
        $data = [
            'title' => 'Gallery'
        ];
        $this->view('pages/gallery',$data);
    }

    public function help() {
        $data = [
            'title' => 'Help'
        ];
        $this->view('pages/help',$data);
    }

    public function index() {
        $data = [
            'title' => 'Motel X'
        ];
        $this->view('pages/index',$data);
    }

}