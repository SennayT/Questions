@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center" >
                            <h1>{{$question->title}}</h1>
                            <div class="ml-auto">
                                <a href="{{route('questions.index')}}" class="btn btn-outline-secondary" >All Questions</a>
                            </div>
                        </div>

                    </div>
                        <hr>
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a title="This question is useful" class="vote-up" >
                                <i class = "fas fa-caret-up fa-3x " ></i>
                            </a>
                            <span class="votes-count">
                                1
                            </span>
                            <a title="This Question is Not Useful" class="vote-down off" >
                                <i class = "fas fa-caret-down fa-3x" ></i>
                            </a>
                            <a title="Click to mark as favorite" class="favorite mt-2 favorited" >
                                <i class = "fas fa-star fa-2x" ></i>
                                <span class="favorites-count">123</span>
                            </a>
                        </div>
                    <div class="media-body">
                        {{ $question->body }}
                        <div class="float-right">
                            <span class="text-muted">
                                Asked {{$question->created_date}}
                                <div class="media mt-2">
                                    <a href="{{$question->user->url}}" class="pr-2">
                                        <img src="{{$question->user->avatar}}" alt="">
                                    </a>
                                    <div class="media-body mt-1">
                                        <a href="{{$question->user->url}}">
                                            {{$question->user->name}}
                                        </a>
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        @include('answers._index',[
    'answers' => $question->answers,
    'answersCount' => $question->answers_count
    ])

        @include('answers._create')
    </div>
@endsection
