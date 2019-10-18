@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>Ask a Questions</h2>
                        <div class="ml-auto">
                            <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">
                                Back to all questions
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('questions.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="question-title">Question Title</label>
                            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                name="title" id="question-title" value="{{ old('title') }}">
                            @if ($errors->has('title'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('title') }}</strong>
                            </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="question-body">Explain your question</label>
                            <textarea name="body" id="question-body" rows="10"
                                class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"
                                >{{ old('body') }}</textarea>
                            @if ($errors->has('body'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('body') }}</strong>
                            </div>
                            @endif
                        </div>
                        <button class="btn btn-outline-primary btn-lg" type="submit" value="Submit">Ask
                            Question</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection