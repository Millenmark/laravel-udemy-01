<?php

namespace App\Http\Controllers;

use App\Models\Sample;
use App\Http\Requests\StoreSampleRequest;
use App\Http\Requests\UpdateSampleRequest;

class SampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSampleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSampleRequest $request)
    {
        // Methods we can use on $request
        // guessExtension()
        // getMimeType()
        // store()
        // asStore()
        // storePublicly()
        // move()
        // getClientOriginalName()
        // getClientMimeType()
        // guessClientExtension()
        // getSize()
        // getError()
        // isValid()
        // $test = $request->file('avatar')->guessExtension();

        // dd($test);
        // dd($request->all());
        $request->validate([
            'avatar' => 'required|mimes:png,jpg,jpeg|max:5048',
            'name' => 'required|string|max:255'
        ]);

        $newImageName = time() . '-' . $request->name . '.' . $request->avatar->extension();
        $request->avatar->move(resource_path('avatars'), $newImageName);
        // dd($newImageName);
        // dd($test);

        Sample::create([
            'name' => $request->name,
            'avatar' => $newImageName,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function show(Sample $sample)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSampleRequest  $request
     * @param  \App\Models\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSampleRequest $request, Sample $sample)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sample $sample)
    {
        //
    }
}
