@extends('layouts.app')

@section('content')
    <div class="container">
        <row class="justify-content-center">
            <col-md-12>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h2>Edit Question</h2>
                        </div>
                        <div class="ml-auto">
                            <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to all Questions</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{route('questions.update',$question->id)}}" method="post" >
                            @method('PUT')
                            @include('questions._form',['buttonText'=>'Update Question'])
                        </form>
                    </div>
                </div>
            </col-md-12>
        </row>
    </div>
@endsection
