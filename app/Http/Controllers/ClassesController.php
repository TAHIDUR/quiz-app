<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Version;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $class = Classes::get()
            ->map(function($item){
                return[
                    'name' => $item->name,
                    'version_id' => $item->version_id,
                    'id' => $item->id,
                    'version' => $item->version->name,
                ];
        });
        return response()->json($class, 200);
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
        ]);

        $class = Classes::create([
             'name'         => $request->name,
             'version_id'   => $request->version_id
        ]);

        return response()->json('success', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $class
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $class)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $class
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $class)
    {
        if($class){
            return response()->json($class, 200);
        }else{
            return response()->json('failed', 404);


        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $class
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classes $class)
    {
        $this->validate($request, [
            'name'          => "required|unique:clas,name, $class->id",
            'version_id'    => 'nullable',

        ]);

        $class->update([
            'name' => $request->name,
            'version_id' => $request->version_id
        ]);
        return response()->json('Success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $class
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $class)
    {
        if($class){
            $class->delete();

            return response()->json('success', 200);
        }else {
            return response()->json('failed', 404);
        }
    }
}
