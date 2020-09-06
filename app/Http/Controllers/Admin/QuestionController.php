<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::orderBy('id', 'desc')->paginate(20);
        return view('admin.questions.index', ['questions'=>$questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.questions.create');

    }

    public function store(Request $request)
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
            return  redirect('/admin/questions')->withStatus('Question successfully created.');
        }else{
            return  redirect('/admin/questions/create')->withStatus('Something went wrong! Try again.');
        }

    }
    

    public function edit(Question $question)
    {
        return view('admin.questions.edit', ["question"=> $question]);

    }

    public function update(Request $request, Question $question)
    {
        $rules = [
            'title' => 'required|min:10|max:1000',
            'answers' => 'required|min:10|max:1000',
            'right_answer' => 'required|min:3|max:50',
            'score' => 'required|integer|in:5,10,15,20,25,30',
            'quiz_id' => 'required|integer'
        ];

        $this->validate($request, $rules);
        if($question->update($request->all())){
            return  redirect('/admin/questions')->withStatus('Question successfully updated.');
        }else{
            return  redirect('/admin/questions/'. $question->id .'/edit')->withStatus('Something went wrong! Try again.');
        }
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return  redirect('/admin/questions')->withStatus('Question successfully deleted.');
    }
}
