<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MerchandiseController extends Controller
{
    public function index()
    {
        $data = Merchandise::orderBy('id', 'desc')->get();

        return view('merchandise.index', compact('data'));
    }

    public function create()
    {
        return view('merchandise.create');
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'nama' => 'required',
                'nilai' => 'required',
                'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $foto = $request->file('gambar');

            if($foto != '')
            {
                $foto->storeAs('public/merchandise', $foto->hashName());
            }
            Merchandise::create([
                'nama' => $request->nama,
                'nilai' => $request->nilai,
                'gambar' => ($foto!= ''? $foto->hashName() : '')
            ]);

            Helper::logActivity('Data Merchandise ' . $request->nama . ' berhasil ditambahkan');
            return redirect()->route('merchandise')->with('success', 'Data Merchandise berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $data = Merchandise::findOrFail($id);
        if (!$data) {
            return view('errors.404');
        }
        return view('merchandise.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'nama' => 'required',
                'nilai' => 'required',
                'gambar' => 'image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $foto = $request->file('foto');

            $getImage = Merchandise::find($id);

            if($foto != ''){
                Storage::delete('public/merchandise/', $getImage->gambar);
                $foto->storeAs('public/merchandise', $foto->hashName());
            }

            Merchandise::where('id', $id)->update([
                'nama' => $request->nama,
                'nilai' => $request->nilai,
                'gambar' => ($foto != '' ? $foto->hashName() : $getImage->gambar)
            ]);

            Helper::logActivity('Data Merchandise ' . $request->nama . ' berhasil diupdate');

            return redirect()->route('merchandise')->with('success', 'Data Merchandise berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function delete($id)
    {
        $data = Merchandise::findOrFail($id);
        $data->delete();

        Helper::logActivity('Data Merchandise ' . $data->nama . ' berhasil dihapus');
        return redirect()->route('merchandise')->with('success', 'Data Merchandise berhasil dihapus');
    }
}
