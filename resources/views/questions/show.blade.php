@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <!-- notes this is display
                add by: shandy start here !
            -->
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h1>{{ $question->title}}
                        <div class="ml-auto">
                           <a href=" {{ route('questions.index') }}" class="btn btn-outline-secondary">
                               Back to all Questions
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                        {!! $question->body_html !!} <!--See convert in Question.php modules line 47  -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
