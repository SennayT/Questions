<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Requests\AskQuestionRequest;
use Illuminate\Support\Facades\Gate;
class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
//        $questions = Question::latest()->paginate(5);
        $questions = Question::with('user')->latest()->paginate(5);
        return view('questions.index',compact('questions'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $question = new Question();
       return view('questions.create',compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {
        //
        $request->user()->questions()->create($request->only('title','body'));
        return redirect(route('questions.index'))->with('success','Your question has been submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param Question $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
        $question->increment('views');
        return view('questions.show',compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Question $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        /*^^same as doing
         * function edit($id) {
         *
         * $question = Question::findOrFail($id)
         * }
         * */
        if(Gate::allows('update-question',$question)) {
            return view('questions.edit',compact('question'));
        }
        else{
            abort(403,'Access denied');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AskQuestionRequest $request
     * @param Question $question
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request, Question $question)
    {
        // To be safe, added the gate here in addition to the edit method
        if(Gate::allows('update-question',$question)) {
            $question->update($request->only('title', 'body'));
            return redirect(route('questions.index'))->with('success', 'Question Updated');
        }
        else{
            abort(403,'Access Denied');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Question $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
        if(Gate::allows('delete-question',$question)) {
            try {
                $question->delete();
            } catch (\Exception $e) {
                dd($e);
            }
            return redirect(route('questions.index'))->with('success', 'Question Deleted');
        }
        else{
            abort(403,'Access Denied');
        }
    }
}
