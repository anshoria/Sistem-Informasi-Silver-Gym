<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class Dashboard_Settings_Controller extends Controller
{
    public function settings()
    {
        $notif = auth()->user()->unreadNotifications;
        $kategori = Kategori::all();
        $gambar = Gallery::latest()->get();

        return view('dashboard/layouts/settings', compact('notif', 'kategori', 'gambar'));
    }

    public function pricelist_edit(Request $request, $id)
    {
        $ValidateData = $request->validate([
            'harga' => 'nullable',
            'keterangan' => 'nullable'
        ]);

        Kategori::where('id', $id)->update($ValidateData);
        return redirect('/dashboard/settings')->with('Sukses', 'Berhasil diubah.');
    }


    public function gallery(Request $request)
    {

        $request->validate([
            'gambar.*' => ['required', 'image', 'mimes:jpeg,jpg,png,gif,svg', 'max:4048']
        ], [
            'gambar.*.mimes' => 'Masukkan gambar dengan format jpeg, jpg, png, gif, atau svg',
            'gambar.*.max' => 'Maksimal ukuran gambar adalah 2 MB',
            'gambar.*.image' => 'Masukkan gambar dengan format jpeg, jpg, png, gif, atau svg',
        ]);

        foreach ($request->gambar as $image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('Gallery', $imageName);
            Gallery::create(['gambar' => $imageName]);
        }

        return redirect('/dashboard/settings')->with('Sukses', 'Berhasil ditambahkan.');
    }



    public function deletegallery(Request $request)
    {

        $selectedImages = $request->input('selected_images');

        if (!$selectedImages) {
            return back()->with('required', 'Pilih gambar!');
        }

        foreach ($selectedImages as $imageId) {

            $imageName = Gallery::where('id', $imageId)->value('gambar');

            if ($imageName) {
                Storage::delete('Gallery/' . $imageName);
            }
        }

        Gallery::whereIn('id', $selectedImages)->delete();
        return redirect('/dashboard/settings')->with('Sukses', 'Gambar berhasil dihapus.');
    }
}
