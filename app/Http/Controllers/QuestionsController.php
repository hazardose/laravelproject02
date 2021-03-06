<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests\AskQuestionRequest;
  
class QuestionsController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except'=> ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Add shandy here for index pagenate
        #this is resource from folder views

       # \DB::enableQueryLog(); debuger
        #$questions = Question::latest()->paginate(5);

        $questions = Question::with('user')->latest()->paginate(5);
        return view('questions.index', compact('questions'));
        
        # view('questions.index', compact('questions'))->render(); test for debuger
        #dd(\DB::getQueryLog()); debuger
        //end here
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $question = new Question ();
       
       return view('questions.create', compact('question'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {
        //location: Requests/AskQuestionRequest.php 
        //dd( $request);
        #note: change DB default tables into double quote " . 
        $request->user()->questions()->create($request->only('title', 'body',''));

        return redirect()->route('questions.index')->with('success', "Your Question has been submitted");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //display the slug into a page
        #dd($question->body);
        $question->increment('views');
        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    #public function edit($id) -> you use this with line #82
    public function edit(Question $question)
    {
        $this->authorize("update", $question);
        //index.blade.php line 45
        return view("questions.edit", compact('question'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request, Question $question)
    {
        
        //edit.blade.php
        $this->authorize("update", $question);
        $question->update($request->only('title', 'body'));
        return redirect('/questions')->with('success', "Your question has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
       

        $this->authorize("delete", $question);
        //action see on index.blade.php
        $question->delete();
        return redirect('/questions')->with('success', "You question has been deleted");
    }
}
