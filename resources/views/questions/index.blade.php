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
                                <a href="{{route('questions.create')}}" class="btn btn-outline-secondary" >Ask Question</a>
                            </div>
                        </div>

                    </div>

                    <div class="card-body">
                        @include('layouts._message')
                        @foreach($questions as $question)
                            <div class="media">
                                <div class="d-flex flex-column counters">
                                    <div class="vote">
                                        <strong>
                                          {{$question->votes}}
                                        </strong>
                                        {{\Illuminate\Support\Str::plural('vote',$question->votes)}}

                                    </div>
                                    <div class="status {{$question->status}} ">
                                        <strong>
                                            {{$question->answers_count}}
                                        </strong>
                                            {{\Illuminate\Support\Str::plural('answer',$question->answers_count)}}
                                    </div>

                                    <div class="views">
                                            {{$question->views}}  {{\Illuminate\Support\Str::plural('view',$question->views)}}
                                    </div>

                                </div>
                                <div class="media-body">
                                    <div class="d-flex align-items-center">
                                        <h3 class="mt-0">
                                            <a href="{{$question->url}}">{{$question->title}}</a>
                                        </h3>
                                        <div class="ml-auto">
                                            @can('update',$question)
                                                <a class="btn btn-sm btn-outline-info" href="{{route('questions.edit',$question->id)}}">
                                                    Edit
                                                </a>
                                            @endcan

                                            @can('delete',$question)
                                            <form class="form-delete" method="post" action="{{ route('questions.destroy', $question->id) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                             @endcan
                                        </div>
                                    </div>

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
