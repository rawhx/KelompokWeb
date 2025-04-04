<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Post;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.create.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate
        ([
            'judul' => 'required|string|max:300',
            'deskripsi' => 'nullable|string|max:3000',
            'path' => 'required|mimes:png, jpg, jpeg, webp|max:1080'
        ]);

        $imageName = time().'.'.$request->path->extension();
        $request->path->move(public_path('storage/images'), $imageName);

        Image::create
        ([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'path' => $imageName,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('profil')->with('success', 'file berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
