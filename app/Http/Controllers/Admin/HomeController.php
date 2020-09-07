<?php

namespace App\Http\Controllers\Admin;


use App\Course;
use App\Http\Controllers\Controller;
use App\Quiz;
use App\Track;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $courses = Course::orderBy('id', 'desc')->take(5)->get();
        $tracks = Track::orderBy('id', 'desc')->take(5)->get();
        $users = User::where('admin', '0')->orderBy('id', 'desc')->take(5)->get();
        $quizzes = Quiz::orderBy('id', 'desc')->take(5)->get();

        return view('admin.dashboard',
            ['courses'=>$courses, 'tracks' => $tracks, 'users' => $users, 'quizzes' => $quizzes]);
    }
}
