<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quiz = Quiz::latest()->get();
        return response()->json($quiz, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'version_id' => 'required',
            'class_id' => 'required',
            'subject_id' => 'required',
            'start_date' => 'nullable',
            'start_time' => 'nullable',
            'end_date' => 'nullable',
            'end_time' => 'nullable',
        ]);

        $data = $request->all();

        $quiz = Quiz::create($data);

        return response()->json('success', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quiz  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quiz  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        if($quiz){
            return response()->json($quiz, 200);
        }else{
            return response()->json('failed', 404);


        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quiz  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {
        $this->validate($request, [
            'name' => 'required',
            'version_id' => 'required',
            'class_id' => 'required',
            'subject_id' => 'required',
            'start_date' => 'nullable',
            'start_time' => 'nullable',
            'end_date' => 'nullable',
            'end_time' => 'nullable',
        ]);

        $data = $request->all();


        $quiz->update($data);
        return response()->json('Success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quiz  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $subject)
    {
        if($quiz){
            $quiz->delete();

            return response()->json('success', 200);
        }else {
            return response()->json('failed', 404);
        }
    }
}
