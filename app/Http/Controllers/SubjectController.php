<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subject = Subject::latest()->get()
        ->map(function($item){
            return[
                'name' => $item->name,
                'class_id' => $item->class_id,
                'id' => $item->id,
                'class' => $item->class->name,
            ];
        });
        return response()->json($subject, 200);
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
            'class_id' => 'required',
        ]);

        $subject = Subject::create([
             'name' => $request->name,
             'class_id' => $request->class_id
        ]);

        return response()->json('success', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        if($subject){
            return response()->json($subject, 200);
        }else{
            return response()->json('failed', 404);


        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $this->validate($request, [
            'name' => "required|unique:subjects,name, $subject->id",
            'class_id' => 'required'
        ]);
        $subject->update([
            'name' => $request->name,
            'class_id' => $request->class_id
        ]);
        return response()->json('Success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        if($subject){
            $subject->delete();

            return response()->json('success', 200);
        }else {
            return response()->json('failed', 404);
        }
    }
}
