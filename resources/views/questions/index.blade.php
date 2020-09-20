@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center" >
                            <h2>All Questions</h2>
                            <div class="ml-auto">
                                <a href="#" class="btn btn-outline-secondary" >Ask Question</a>
                            </div>
                        </div>

                    </div>

                    <div class="card-body">
                        @foreach($questions as $question)
                            <div class="media">
                                <div class="media-body">
                                    <h3 class="mt-0">
                                        <a href="{{$question->url}}">{{$question->title}}</a>
                                    </h3>
                                    <p class="lead">Asked by <a href="{{$question->user->url}}">{{$question->user->name}}</a>
                                    <small class="text-muted">
                                        {{$question->createdDate}}
                                    </small>
                                    </p>
                                    {{\Illuminate\Support\Str::limit($question->body,250)}}
                                    <hr>
                                </div>
                            </div>
                        @endforeach

                            <div class="" >
                                {{$questions->links()}}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
