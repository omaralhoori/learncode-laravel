@extends('layouts.app', ['title' => __('Course Management')])

@section('content')
    @include('admin.admins.partials.header', ['title' => __('Edit Course')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Course Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('courses.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('courses.update', $course)}}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('PATCH')
                            <h6 class="heading-small text-muted mb-4">{{ __('Course information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Title') }}</label>
                                    <input type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}"
                                           value="{{ $course->title }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('link') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-link">{{ __('Link') }}</label>
                                    <input type="text" name="link" id="input-link" class="form-control form-control-alternative{{ $errors->has('link') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Link') }}" value="{{ $course->link }}" required>

                                    @if ($errors->has('link'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('link') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-status">{{ __('Status') }}</label>

                                    <select name="status" id="" required class="form-control">
                                        <option value="0" <?php if ($course->status == '0') echo 'selected';?> >{{__('Free')}}</option>
                                        <option value="1" <?php if ($course->status == '1') echo 'selected';?> >{{__('Paid')}}</option>
                                    </select>

                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('track_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-track">{{ __('Track') }}</label>

                                    <select name="track_id" id="input-track" required class="form-control">
                                        @foreach(\App\Track::all() as $track)
                                            <option value="{{$track->id}}" <?php if ($course->track->id == $track->id) echo 'selected';?>>{{$track->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('track_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('track_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-image">{{ __('Image') }}</label>
                                    <input type="file" name="image" id="input-image"
                                           class="form-control form-control-alternative{{ $errors->has('image') ? ' is-invalid' : '' }}">

                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
