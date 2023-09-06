<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{
    //

    public function index(): View
    {
        $assets = Asset::latest()->paginate(2);

        return View('assets.index', compact('assets'));
    }

    // create

    public function create(): View
    {
        return View('assets.create');
    }
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'image'     => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nama_barang'     => 'required|min:5',
            'deskripsi'   => 'required|min:10'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/assets', $image->hashName());

        //create post
        asset::create([
            'image'       => $image->hashName(),
            'nama_barang' => $request->nama_barang,
            'deskripsi'   => $request->deskripsi
        ]);


        //redirect to index
        return redirect()->route('assets.index')->with(['success' => 'Data Barang Berhasil Disimpan!']);
    }
        public function show(string $id): View
        {
            //get post by ID barang
        $asset = Asset::findOrFail($id);

        //render view with post
        return view('assets.show', compact('asset'));
        }
        public function edit(string $id): View
        {
            //get post by ID
            $asset = asset::findOrFail($id);

            //render view with post
            return view('assets.edit', compact('asset'));
        }

        public function update(Request $request, $id): RedirectResponse
        {
            //validate form
            $this->validate($request, [
                'image'     => 'image|mimes:jpeg,jpg,png|max:2048',
                'nama_barang'     => 'required|min:5',
                'deskripsi'   => 'required|min:10'
            ]);

            //get post by ID
            $asset = Asset::findOrFail($id);

            //check if image is uploaded
            if ($request->hasFile('image')) {

                //upload new image
                $image = $request->file('image');
                $image->storeAs('public/assets', $image->hashName());

                //delete old image
                 Storage::delete('public/assets/'.$asset->image);

                //update post with new image
                $asset->update([
                    'image'     => $image->hashName(),
                    'nama_barang'     => $request->nama_barang,
                    'deskripsi'   => $request->deskripsi
                ]);

            } else {

                //update post without image
                $asset->update([
                    'nama_barang'     => $request->nama_barang,
                    'deskripsi'   => $request->deskripsi
                ]);
            }

            //redirect to index
            return redirect()->route('assets.index')->with(['success' => 'Data Berhasil Diubah!']);
        }

    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $asset = asset::findOrFail($id);

        //delete image
        Storage::delete('public/assets/'. $asset->image);

        //delete post
        $asset->delete();

        //redirect to index
        return redirect()->route('assets.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
    }

