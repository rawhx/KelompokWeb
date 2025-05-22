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
        $user = auth()->user();
        $images = Image::where('user_id', $user->id)->get();

        return view('pages.profile.index', compact('user', 'images'));
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
            'path' => 'required|mimes:png,jpg,jpeg,webp|max:1080'
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

        return redirect()->route('home')->with('success', 'file berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $image = Image::findOrFail($id);
        return view('pages.profile.update-image', compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $image = Image::findOrFail($id);
        return view('pages.profile.update-image', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate
        ([
            'judul' => 'nullable|string|max:300',
            'deskripsi' => 'nullable|string|max:3000',
        ]);

        $image = Image::findOrFail($id);

        $image->judul = $request->judul;
        $image->deskripsi = $request->deskripsi;
        $image->save();

        return redirect()->route('profil')->with('success', 'file berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $image = Image::findOrFail($id);

        $imagePath = public_path('storage/images'.$image->path);
        if(file_exists($imagePath))
        {
            unlink($imagePath);
        }

        $image->delete();

        return redirect()->route('profil')->with('success', 'file berhasil dihapus!');
    }

    // Menampilkan detail post
    public function showPost($id) {
        $image = Image::with(['comments.user', 'likes'])->findOrFail($id);
        return view('pages.post.index', compact('image'));
    }

    // Menampilkan gambar-gambar pada dashboard
    public function showHome() {
        $images = Image::with('user')->latest()->paginate(10);
        return view('pages.home.index', compact('images'));
    }
}
