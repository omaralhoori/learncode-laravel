<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Video;
use Illuminate\Http\Request;

class CourseVideoController extends Controller
{

    public function create(Course $course)
    {
        return view('admin.courses.createvideo', ['course' => $course]);
    }


    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|min:10|max:100',
            'link' => 'required|url',
            'course_id' => 'required|integer'
        ];

        $this->validate($request, $rules);
        $video = Video::create($request->all());

        if($video){
            return redirect('/admin/courses/'. $video->course->id)->withStatus('Video successfully created.');
        }else{
            return redirect('/admin/courses/'. $video->course->id.'/videos/create')->withStatus('Something went wrong! Try again.');
        }
    }

}
