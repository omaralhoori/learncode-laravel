

@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-4 mb-xl-0 mb-5">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">{{__('Last 5. Tracks')}}</h3>
                            </div>
                            <div class="col text-right">
                                <a href="/admin/tracks" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{__('Track Name')}}</th>
                                    <th scope="col">{{__('NO. Users')}}</th>
                                    <th scope="col">{{__('NO. Courses')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($tracks as $track)
                                <tr>
                                    <th scope="row">
                                        <a href="/admin/tracks/{{$track->id}}">{{$track->name}}</a>
                                    </th>
                                    <td>
                                        {{$track->users->count()}}
                                    </td>
                                    <td>
                                        {{$track->courses->count()}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-8  ">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">{{__('Last 5. Courses')}}</h3>
                            </div>
                            <div class="col text-right">
                                <a href="/admin/courses" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">{{__('Course Title')}}</th>
                                <th scope="col">{{__('NO. Users')}}</th>
                                <th scope="col">{{__('NO. Videos')}}</th>
                                <th scope="col">{{__('NO. Quizzes')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    <th scope="row">
                                        <a href="/admin/courses/{{$course->id}}">{{\Str::limit($course->title, 30)}}</a>
                                    </th>
                                    <td>
                                        {{$course->users->count()}}
                                    </td>
                                    <td>
                                        {{$course->videos->count()}}
                                    </td>
                                    <td>
                                        {{$course->quizzes->count()}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-7  mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">{{__('Last 5. Users')}}</h3>
                            </div>
                            <div class="col text-right">
                                <a href="/admin/users" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">{{__('User Name')}}</th>
                                <th scope="col">{{__('Email')}}</th>
                                <th scope="col">{{__('Verified')}}</th>
                                <th scope="col">{{__('NO. Courses')}}</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">
                                        {{$user->name}}
                                    </th>
                                    <td>
                                        <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                                    </td>
                                    <td class="{{$user->email_verified_at ? 'text-success' : 'text-danger'}}">
                                        <?php
                                        if($user->email_verified_at){echo __('Verified');}else{echo __('Unverified');}
                                        ?>
                                    </td>
                                    <td>
                                        {{$user->courses->count()}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-5">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">{{__('Last 5. Quizzes')}}</h3>
                            </div>
                            <div class="col text-right">
                                <a href="/admin/quizzes" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">{{__('Quiz Name')}}</th>
                                <th scope="col">{{__('Course')}}</th>
                                <th scope="col">{{__('NO. Questions')}}</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($quizzes as $quiz)
                                <tr>
                                    <th scope="row">
                                        <a href="/admin/quizzes/{{$quiz->id}}">{{$quiz->name}}</a>
                                    </th>
                                    <td>
                                        <a href="/admin/courses/{{$quiz->course->id}}">{{\Str::limit($quiz->course->title, 10)}}</a>
                                    </td>
                                    <td>
                                        {{$quiz->questions->count()}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
