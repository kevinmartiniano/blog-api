<?php

namespace App\Http\Controllers;

use App\Model\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private $postRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('layouts.pages.home', ['posts' => $this->postRepository->findAll()]);
    }
}
