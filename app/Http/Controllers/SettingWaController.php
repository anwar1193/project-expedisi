<?php

namespace App\Http\Controllers;

use App\Models\SettingWa;
use Illuminate\Http\Request;

class SettingWaController extends Controller
{
    public function index()
    {
        $data['settings'] = SettingWa::orderBy('id', 'desc')->first();

        return view('setting-wa.index', $data);
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $validateData = $request->validate([
            'api_key' => 'required|',
            'sender' => 'required',
            'url_message' => 'required',
            'url_media' => 'required'
        ]);

        $setting = SettingWa::findOrFail($id);

        $setting->update($validateData);

        return redirect()->route('setting-wa')->with('success', 'Konfigurasi Wa berhasil diupdate');
    }
}
