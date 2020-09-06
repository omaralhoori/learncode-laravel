<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Question;
use App\Quiz;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{

    public function create(Quiz $quiz)
    {
        return view('admin.quizzes.createquestion', ['quiz'=>$quiz]);
    }
    public function store(Request $request, Quiz $quiz)
    {
        $rules = [
            'title' => 'required|min:10|max:1000',
            'answers' => 'required|min:10|max:1000',
            'right_answer' => 'required|min:3|max:50',
            'score' => 'required|integer|in:5,10,15,20,25,30',
            'quiz_id' => 'required|integer'
        ];

        $this->validate($request, $rules);
        if(Question::create($request->all())){
            return  redirect('/admin/quizzes/'. $quiz->id)->withStatus('Question successfully created.');
        }else{
            return  redirect('/admin/quizzes/'.$quiz->id.'/question/create')->withStatus('Something went wrong! Try again.');
        }
    }

}
