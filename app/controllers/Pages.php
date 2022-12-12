<?php

class Pages extends Controller {

	private Post $postModel;

	public function __construct() {
		require_once APPROOT . '/models/Post.php';
		$this->postModel = new Post();
	}

	public function about() {
		$data = [
			'title' => 'About'
		];
		$this->view('pages/about', $data);
	}

	public function blog() {
		$data = [
			'title' => 'Blog',
			'posts' => $this->postModel->fetchAllPosts()
		];
		$this->view('pages/blog', $data);
	}

	public function contact() {
		$data = [
			'title' => 'Contact'
		];
		$this->view('pages/contact', $data);
	}

	public function gallery() {
		$data = [
			'title' => 'Gallery'
		];
		$this->view('pages/gallery', $data);
	}

	public function help() {
		$data = [
			'title' => 'Help'
		];
		$this->view('pages/help', $data);
	}

	public function index() {
		$data = [
			'title' => "Motel X"
		];
		if (func_num_args() > 0) {
			$temp = func_get_args();
			$data['arrival_err'] = $temp[0];
			$data['departure_err'] = $temp[1];
		}
		$this->view('pages/index', $data);
	}

}