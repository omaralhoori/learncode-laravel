<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Quiz;
use Illuminate\Http\Request;

class CourseQuizController extends Controller
{
    public function create(Course $course)
    {
        return view('admin.courses.createquiz', ['course' => $course]);
    }


    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3|max:50',
            'course_id' => 'required|integer'
        ];

        $this->validate($request, $rules);
        $quiz = Quiz::create($request->all());

        if($quiz){
            return redirect('/admin/courses/'. $quiz->course->id)->withStatus('Quiz successfully created.');
        }else{
            return redirect('/admin/courses/'. $quiz->course->id.'/videos/create')->withStatus('Something went wrong! Try again.');
        }
    }
}
