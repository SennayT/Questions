<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswersController extends Controller
{




    public function store(Question $question, Request $request)
    {
        $request->validate([
            'body' => 'required'
        ]);

        $question->answers()->create(['body' => $request->body, 'user_id' => Auth::id()]);

        return back()->with('success',"Answer Submitted");

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {
        //
        $this->authorize('update',$answer);
        return view('answers._edit',compact('question','answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        //
        $this->authorize('update',$answer);
        $answer->update($request->validate([
            'body' => 'required'
        ]));

        return redirect()->route('questions.show',$question->slug)->with('success','Answer Updated');

    }


    public function destroy(Question $question, Answer $answer)
    {
        $this->authorize('delete',$answer);
        $answer->delete();


        return back()->with('success',"Answer Deleted");
    }
}
