<?php

/**
 * Class for rendering static pages
 * Only one page with data from the database - blog
 */
class Pages extends Controller {

	private Post $postModel;

	public function __construct() {
		require_once APPROOT . '/models/Post.php';
		$this->postModel = new Post();
	}

	public function about() : void {
		$data = [
			'title' => 'About'
		];
		$this->view('pages/about', $data);
	}

	/**
	 * Renders all posts from the database
	 * @return void
	 */
	public function blog(): void {
		$data = [
			'title' => 'Blog',
			'posts' => $this->postModel->fetchAllPosts()
		];
		$this->view('pages/blog', $data);
	}

	public function contact() : void {
		$data = [
			'title' => 'Contact'
		];
		$this->view('pages/contact', $data);
	}

	public function gallery(): void {
		$data = [
			'title' => 'Gallery'
		];
		$this->view('pages/gallery', $data);
	}

	public function help(): void {
		$data = [
			'title' => 'Help'
		];
		$this->view('pages/help', $data);
	}

	/**
	 * Renders main page
	 * Called with args when booking form on main page has errors
	 * @return void
	 */
	public function index(): void {
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