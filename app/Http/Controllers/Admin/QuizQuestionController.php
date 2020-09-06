<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Quiz;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{

    public function create(Quiz $quiz)
    {
        return view('admin.quizzes.createquestion', ['quiz'=>$quiz]);
    }
    public function store(Request $request)
    {
        //
    }

}
