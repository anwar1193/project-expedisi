<?php

namespace App\Http\Controllers;

use App\Models\FrontCamera;
use App\Models\RearCamera;
use App\Models\SurveilanceCar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CameraController extends Controller
{
    public function index() 
    {
        $item = SurveilanceCar::orderBy('id', 'DESC')->get();
        $data['item'] = $item;

        return view('pemantauan-camera.index', $data);
    }

    public function detail($id) 
    {
        $item = SurveilanceCar::where('id', $id)->orderBy('id', 'DESC')->first();
        $data['item'] = $item;

        return view('pemantauan-camera.detail', $data);
    }

    public function store_front_camera(Request $request)
    {
        $img = $request->image;
        $folderPath = "public/front-camera/";
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';
        $file = $folderPath . $fileName;
        
        Storage::disk('local')->put($file, $image_base64);
        $car_id = $request->id;

        $image = new FrontCamera;
        $image->car_id = $car_id;
        $image->foto = $fileName;
        $image->save();

        return response()->json(['success' => 'Image from front camera saved successfully.']);
    }
    
    public function store_rear_camera(Request $request)
    {
        $img = $request->image;
        $folderPath = "public/rear-camera/";
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';
        $file = $folderPath . $fileName;

        Storage::disk('local')->put($file, $image_base64);
        $car_id = $request->id;

        $image = new RearCamera;
        $image->car_id = $car_id;
        $image->foto = $fileName;
        $image->save();

        return response()->json(['success' => 'Image from rear camera saved successfully.']);
    }

    public function detail_front_camera($id)
    {
        $item = FrontCamera::where('car_id', $id)->orderBy('id', 'DESC')->get();
        $data['item'] = $item;

        return view('pemantauan-camera.image.front', $data);
    }
    
    public function detail_rear_camera($id)
    {
        $item = RearCamera::where('car_id', $id)->orderBy('id', 'DESC')->get();
        $data['item'] = $item;

        return view('pemantauan-camera.image.rear', $data);
    }

    public function front_camera()
    {
        $items = SurveilanceCar::orderBy('id', 'DESC')->get();
        $data['items'] = $items;

        return view('pemantauan-camera.front-camera', $data);
    }

    public function rear_camera()
    {
        $items = SurveilanceCar::orderBy('id', 'DESC')->get();
        $data['items'] = $items;

        return view('pemantauan-camera.rear-camera', $data);
    }
}
