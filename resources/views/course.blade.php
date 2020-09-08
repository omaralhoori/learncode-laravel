@extends('layouts.user_layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="course-header">
            <div class="row">
                <div class="col-sm-8">
                    <h2>{{$course->title}}</h2>
                    <p>{{$course->description}}</p>
                    <h4>{{__('Track: ')}}
                        <a href="/tracks/{{$course->track->name}}">
                            {{$course->track->name}}
                        </a>
                        <span style="float: right">
                            @if($course->status == 0)
                                <span class="free-badge">{{__('FREE')}}</span>
                            @else
                                <span class="paid-badge">{{__('PAID')}}</span>
                            @endif
                            <span>{{count($course->users)}}</span>
                            <span> users enrolled</span>
                        </span>
                    </h4>
                </div>
                <div class="col-sm">
                    @if($course->photo)
                        <img class="course-image" alt="Course Image" src="/storage/courseImgs/{{$course->photo->filename}}">
                    @else
                        <img class="course-image" alt="Course Image" src="/imgs/course_no_photo.jpg">
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="videos">
        <h3>{{__('Course Videos')}}</h3>
        <div class="row">
            <div class="col-sm-12">
                @if(count($course->videos) > 0)
                    @foreach($course->videos as $video)
                        <div class="video">
                            <a data-toggle="modal" data-target="#show-video" href="{{$video->link}}">
                                <i class="fab fa-youtube"></i> {{$video->title}}
                            </a>
                        </div>
                    @endforeach
                @else
                <div class="alert alert-secondary">
                    {{__('This course does not include any video')}}
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="quizzes">
        <h3>{{__('Course Quizzes')}}</h3>
        <div class="row">
            <div class="col-sm-12">
                @if(count($course->quizzes) > 0)
                    @foreach($course->quizzes as $quiz)
                        <div class="quiz">
                            <a href="{{$quiz->id}}" target="_blank">
                                {{$quiz->name}}
                            </a>
                        </div>
                    @endforeach
                @else
                <div class="alert alert-secondary">
                    {{__('This course does not include any quiz')}}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="show-video" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 590px;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Video Preview')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe width="560" height="315" src="" frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>
@endsection
