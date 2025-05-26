<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumData;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlbumController extends Controller
{
    public function index() {
        $albums = Album::with(['data.image'])
        ->where('album_user_id', auth()->id())
        ->latest()
        ->get();
        
        $images = Image::where('user_id', auth()->id())->get();
   
        return view('pages.album.index', compact('images', "albums"));        
    }
    
    public function dataFotoAdd() {
        $images = Image::where('user_id', auth()->id())->get();
        return view('pages.album.add', compact('images'));        
    }

    public function store(Request $request) {
        try {
            if (!$request['selected_images']) {
                return back()->with('error', 'Pilih Gambar Terlebih Dahulu!');
            }
            DB::beginTransaction();
            $data = $request->all();

            $album = Album::create([
                "album_user_id" => auth()->id(),
                "album_nama" => $data['judul']
            ]);

            $imageIds = explode(',', $data['selected_images'] ?? '');

            foreach ($imageIds as $imageId) {
                if (!empty($imageId)) {
                    AlbumData::create([
                        "album_id" => $album->id,
                        "image_id" => $imageId
                    ]);
                }
            }
            DB::commit();

            return redirect(route('albumPage'))->with('success', 'Berhasil membuat album');
            
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal membuat album');
        }
    }

    public function delete(Request $request)
    {
        try {
            $id = $request->input('id');

            $album = Album::where('id', $id)
                ->where('album_user_id', auth()->id())
                ->firstOrFail();

            AlbumData::where('album_id', $album->id)->delete();

            $album->delete();

            return redirect()->back()->with('success', 'Album berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menghapus album');
        }
    }

    public function edit($id)
    {
        $images = Image::where('user_id', auth()->id())->get();
        $album = Album::with(['data.image'])
            ->where('album_user_id', auth()->id())
            ->findOrFail($id);
        // dd($albums);
        $selectedImageIds = $album->data->pluck('image_id')->toArray(); // Ambil ID gambar

        return view('pages.album.edit', compact('album', 'images', 'selectedImageIds'));
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $album = Album::where('id', $request->id)
                ->where('album_user_id', auth()->id())
                ->firstOrFail();

            $album->update([
                'album_nama' => $request->judul,
            ]);

            AlbumData::where('album_id', $album->id)->delete();

            $imageIds = explode(',', $request->selected_images);
            foreach ($imageIds as $imageId) {
                if (!empty($imageId)) {
                    AlbumData::create([
                        'album_id' => $album->id,
                        'image_id' => $imageId,
                    ]);
                }
            }
            DB::commit();
            return redirect(route('albumPage'))->with('success', 'Album berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal memperbarui album.');
        }
    }
}
