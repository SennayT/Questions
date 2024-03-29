<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{$answersCount." ".\Illuminate\Support\Str::plural('answer',$answersCount)}}</h2>
                </div>
                <hr>

                @include('layouts._message')

                @foreach($answers as $answer)

                    <div class="media">

                        <div class="d-flex flex-column vote-controls">
                            <a title="This answer is useful" class="vote-up" >
                                <i class = "fas fa-caret-up fa-3x " ></i>
                            </a>
                            <span class="votes-count">
                                1
                            </span>
                            <a title="This answer is Not Useful" class="vote-down off" >
                                <i class = "fas fa-caret-down fa-3x" ></i>
                            </a>
                            @can('accept',$answer)

                            <a onclick="event.preventDefault(); document.getElementById('accept-answer-{{$answer->id}}').submit();"
                                title="Mark this answer as best answer" class="{{$answer->status}} mt-2 favorited" >
                                <i class = "fas fa-check fa-2x" ></i>
                                <span class="favorites-count">123</span>
                            </a>
                            <form style="display: none;" id="accept-answer-{{$answer->id}}" method="post" action="{{route('answers.accept',$answer->id)}}" >
                                @CSRF
                            </form>

                            @else
                                @if($answer->is_best)
                                    <a title="The question owner has accepted this answer" class=" {{$answer->status}} mt-2"><i class="fas fa-check fa-2x"></i></a>
                                @endif

                            @endcan
                        </div>

                        <div class="media-body">
                            {{$answer->body}}
                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        @can('update',$answer)
                                            <a class="btn btn-sm btn-outline-info" href="{{route('questions.answers.edit',[$question->id,$answer->id])}}">
                                                Edit
                                            </a>
                                        @endcan

                                        @can('delete',$answer)
                                            <form class="form-delete" method="post" action="{{ route('questions.answers.destroy', [$question->id,$answer->id]) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                                <div class="col-4"></div>

                                <div class="col-4">
                                        <span class="text-muted">
                                            Answered {{$answer->created_date}}
                                        </span>
                                    <div class="media mt-3">
                                        <a href="{{$answer->user->url}}" class="pr-2">
                                            <img src="{{$answer->user->avatar}}" alt="">
                                        </a>
                                        <div class="media-body mt-1">
                                            <a href="{{$answer->user->url}}">
                                                {{$answer->user->name}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
