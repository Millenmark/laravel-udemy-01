<?php

namespace App\Http\Controllers;

use App\Models\Sample;
use App\Http\Requests\StoreSampleRequest;
use App\Http\Requests\UpdateSampleRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

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

        $newImageName = time() . '.' . $request->avatar->extension();
        $request->avatar->move(public_path('avatars'), $newImageName);
        // dd($newImageName);
        // dd($test);

        Sample::create([
            'name' => $request->name,
            'avatar' => $newImageName,
        ]);

        return response()->json(['avatar' => $newImageName], 201);
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

        if ($request->hasFile('avatar')) {
            // Remove old avatar
            unlink(public_path('avatars/' . $sample->avatar));

            // Store new avatar
            $newImageName = time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('avatars'), $newImageName);
        }

        $sample->fill([
            'avatar' => $newImageName ?? $sample->avatar,
            'name' => $request->name,
        ])->save();

        return response()->json(['success' => 'Sample updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sample $sample)
    {
        if ($sample->avatar) {
            $avatarPath = public_path('avatars/' . $sample->avatar);
            if (file_exists($avatarPath)) {
                unlink($avatarPath);
            }
        }

        $sample->delete();

        return response()->json(['success' => 'Sample deleted successfully']);
    }
}
