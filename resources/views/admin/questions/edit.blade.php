@extends('layouts.app', ['title' => __('Question Management')])

@section('content')
    @include('admin.admins.partials.header', ['title' => __('Edit Question')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Question Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('questions.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('questions.update', $question) }}" autocomplete="off">
                            @csrf
                            @method('PATCH')
                            <h6 class="heading-small text-muted mb-4">{{ __('Question information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-answers">{{ __('Title') }}</label>
                                    <input type="text" name="title" id="input-answers"
                                           class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Title') }}" value="{{ $question->title }}" required>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('answers') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Answers') }}</label>
                                    <input type="text" name="answers" id="input-title"
                                           class="form-control form-control-alternative{{ $errors->has('answers') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Answers') }}" value="{{ $question->answers }}" required autofocus>

                                    @if ($errors->has('answers'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('answers') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('right_answer') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-right_answer">{{ __('Right Answer') }}</label>
                                    <input type="text" name="right_answer" id="input-right_answer" class="form-control form-control-alternative{{ $errors->has('right_answer') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Right Answer') }}" value="{{ $question->right_answer }}" required >

                                    @if ($errors->has('right_answer'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('right_answer') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('score') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-score">{{ __('Score') }}</label>

                                    <select name="score" id="input-score" required class="form-control">
                                        <option value="5" <?php if($question->score == 5) echo 'selected'; ?> >5</option>
                                        <option value="10" <?php if($question->score == 10) echo 'selected'; ?> >10</option>
                                        <option value="15" <?php if($question->score == 15) echo 'selected'; ?> >15</option>
                                        <option value="20" <?php if($question->score == 20) echo 'selected'; ?> >20</option>
                                        <option value="25" <?php if($question->score == 25) echo 'selected'; ?> >25</option>
                                        <option value="30" <?php if($question->score == 30) echo 'selected'; ?> >30</option>
                                    </select>

                                    @if ($errors->has('score'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('score') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('quiz_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-quiz">{{ __('Quiz') }}</label>

                                    <select name="quiz_id" id="input-quiz" required class="form-control">
                                        @foreach(\App\Quiz::orderBy('id', 'desc')->get() as $quiz)
                                            <option value="{{$quiz->id}}" <?php if($question->quiz->id == $quiz->id) echo 'selected'; ?> >{{$quiz->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('quiz_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('quiz_id') }}</strong>
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
