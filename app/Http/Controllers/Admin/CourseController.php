<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Photo;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::orderBy('id', 'desc')->paginate(15);
        return view('admin.courses.index', ['courses'=>$courses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            return  redirect('/admin/courses')->withStatus('Course successfully created.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('admin.courses.show', ['course'=> $course]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('admin.courses.edit', ['course'=>$course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $rules = [
            'title'=> 'required|min:10|max:150',
            'status' => 'required|integer|in:0,1',
            'link' => 'required|url',
            'track_id' => 'required|integer'
        ];

        $this->validate($request, $rules);

        $course->update($request->all());

        if($file = $request->file('image')){

            $filename = $file->getClientOriginalName();
            $file_extension = $file->getClientOriginalExtension();
            $file_to_store = time() . '_' . explode('.', $filename)[0] . '_.' . $file_extension;

            if($file->move('storage/courseImgs', $file_to_store)){
                if($photo = $course->photo)
                {
                    // Delete Photo from Server
                    $filename = $course->photo->filename;
                    unlink('storage/courseImgs/' . $filename);


                    $photo->filename = $file_to_store;
                    $photo->save();
                }
                else{
                    Photo::create([
                        'filename' => $file_to_store,
                        'photoable_id' => $course->id,
                        'photoable_type' => 'App\Course'
                    ]);
                }
            }
        }
        return  redirect('/admin/courses')->withStatus('Course successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        if($course->photo){
            // Delete Photo from Server
            $filename = $course->photo->filename;
            unlink('storage/courseImgs/' . $filename);
            // Delete Photo from DB
            $course->photo->delete();
        }
        $course->delete();
        return redirect('/admin/courses')->withStatus('Course successfully deleted.');
    }
}
