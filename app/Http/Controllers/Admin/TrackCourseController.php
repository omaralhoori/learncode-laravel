<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Photo;
use App\Track;
use Illuminate\Http\Request;

class TrackCourseController extends Controller
{
    public function create(Track $track)
    {
        return view('admin.tracks.createcourse', ['track' => $track]);
    }


    public function store(Request $request)
    {
        $rules = [
            'title'=> 'required|min:10|max:150',
            'status' => 'required|integer|in:0,1',
            'link' => 'required|url',
            'track_id' => 'required|integer'
        ];

        $this->validate($request, $rules);

        $course = Course::create($request->all());
        if($course){

            if($file = $request->file('image')){
                $filename = $file->getClientOriginalName();
                $file_extension = $file->getClientOriginalExtension();

                $file_to_store = time() . '_' . explode('.', $filename)[0] . '_.' . $file_extension;
                if($file->move('storage/courseImgs', $file_to_store)){
                    Photo::create([
                        'filename' => $file_to_store,
                        'photoable_id' => $course->id,
                        'photoable_type' => 'App\Course'
                    ]);
                }
            }
            return  redirect('/admin/tracks/'.$course->track->id)->withStatus('Course successfully created.');
        }
    }
}
