<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageUploadRequest;
use App\Http\Requests\ImageUpdateRequest;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

use App\Models\Image;
use App\Models\User;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Returning a view with user's images.
        return view('images') -> with('images', auth() -> user() -> images);
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
     * @param  \App\Http\Requests\ImageUploadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImageUploadRequest $request)
    {
        // Checking if the user can create images.
        abort_if(!Gate::allows('create', Image::class), 403);

        // Storing the image and getting the path.
        $path = $request -> file('image') -> store('images/'.auth() -> id(), 'local');

        // Creating a database entry.
        Image::create([
            'id' => snowflake(),
            'user_id' => auth() -> id(),
            'path' => $path
        ]);

        // Returning the folder of the image.
        return 'images/'. auth() -> id(). '/';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Getting the image from the database.
        $image = Image::findOrFail($id);

        // Checking if the user can see the image.
        abort_if(!Gate::allows('view', $image), 403);

        // Creating a path.
        $path = storage_path('app\\'.$image -> path);

        // Returning the image from path.
        return response() -> file($path);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ImageUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ImageUpdateRequest $request, $id)
    {
        // Getting the image from the database.
        $image = Image::findOrFail($id);

        // Checking if the user can update the image.
        abort_if(!Gate::allows('update', $image), 403);

        // Updating the image.
        $image -> update($request -> validated());

        // Returning back.
        return back() -> with('success', 'The image has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Getting the image from the database.
        $image = Image::findOrFail($id);

        // Checking if the user can delete the image.
        abort_if(!Gate::allows('delete', $image), 403);

        // Deleting the image.
        $image -> delete();

        // Returning back.
        return back() -> with('success', 'The image has been successfully deleted.');
    }
}
