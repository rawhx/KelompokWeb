<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Koleksi;
use App\Models\KoleksiData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KoleksiController extends Controller
{
    public function index() {
        $koleksis = Koleksi::with(['data.image'])
        ->where('koleksi_user_id', auth()->id())
        ->latest()
        ->get();

        return view('pages.koleksi.index', compact('koleksis'));
    }

    public function dataFotoKoleksi() {
        $images = Image::with('user')->latest()->get();
        return view('pages.koleksi.add', compact('images'));
    }

   public function store(Request $request) {
        try {
            if (!$request['selected_images']) {
                return back()->with('error', 'Pilih Gambar Terlebih Dahulu!');
            }
            DB::beginTransaction();
            $data = $request->all();

            $koleksi = Koleksi::create([
                "koleksi_user_id" => auth()->id(),
                "koleksi_nama" => $data['judul']
            ]);

            // Ambil image_id dari input hidden dan pecah menjadi array
            $imageIds = explode(',', $data['selected_images'] ?? '');

            // Simpan semua image_id ke tabel koleksi_data
            foreach ($imageIds as $imageId) {
                // Pastikan imageId tidak kosong
                if (!empty($imageId)) {
                    KoleksiData::create([
                        "koleksi_id" => $koleksi->id,
                        "image_id" => $imageId
                    ]);
                }
            }
            DB::commit();

            return redirect(route('koleksiPage'))->with('success', 'Berhasil membuat koleksi');
            
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal membuat koleksi');
        }
    }

    public function delete(Request $request)
    {
        try {
            $id = $request->input('id');

            $koleksi = Koleksi::where('id', $id)
                ->where('koleksi_user_id', auth()->id())
                ->firstOrFail();

            KoleksiData::where('koleksi_id', $koleksi->id)->delete();

            $koleksi->delete();

            return redirect()->back()->with('success', 'Koleksi berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menghapus koleksi');
        }
    }

    public function edit($id)
    {
        $images = Image::with('user')->latest()->get();
        $koleksi = Koleksi::with(['data.image'])
            ->where('koleksi_user_id', auth()->id())
            ->findOrFail($id);

        $selectedImageIds = $koleksi->data->pluck('image_id')->toArray(); // Ambil ID gambar

        return view('pages.koleksi.edit', compact('koleksi', 'images', 'selectedImageIds'));
    }

    public function update(Request $request)
    {
        try {
            $koleksi = Koleksi::where('id', $request->id)
                ->where('koleksi_user_id', auth()->id())
                ->firstOrFail();

            $koleksi->update([
                'koleksi_nama' => $request->judul,
            ]);

            KoleksiData::where('koleksi_id', $koleksi->id)->delete();

            $imageIds = explode(',', $request->selected_images);
            foreach ($imageIds as $imageId) {
                if (!empty($imageId)) {
                    KoleksiData::create([
                        'koleksi_id' => $koleksi->id,
                        'image_id' => $imageId,
                    ]);
                }
            }

            return redirect(route('koleksiPage'))->with('success', 'Koleksi berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal memperbarui koleksi.');
        }
    }
}
