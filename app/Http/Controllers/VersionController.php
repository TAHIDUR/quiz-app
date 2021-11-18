<?php

namespace App\Http\Controllers;

use App\Models\Version;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VersionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $version = Version::latest()->get();

        return response()->json($version, 200);
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
        ]);

        $version = Version::create([
             'name' => $request->name
        ]);

        return response()->json('success', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $version
     * @return \Illuminate\Http\Response
     */
    public function show(Version $version)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $version
     * @return \Illuminate\Http\Response
     */
    public function edit(Version $version)
    {
        if($version){
            return response()->json($version, 200);
        }else{
            return response()->json('failed', 404);


        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $version
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Version $version)
    {
        $this->validate($request, [
            'name' => "required|unique:versions,name, $version->id"
        ]);

        $version->update([
            'name' => $request->name
        ]);
        return response()->json('Success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $version
     * @return \Illuminate\Http\Response
     */
    public function destroy(Version $version)
    {
        if($version){
            $version->delete();

            return response()->json('success', 200);
        }else {
            return response()->json('failed', 404);
        }
    }
}
