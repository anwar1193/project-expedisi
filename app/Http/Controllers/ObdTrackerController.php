<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Obd;
use App\Models\SurveilanceCar;
use Illuminate\Http\Request;

class ObdTrackerController extends Controller
{
    public function index()
    {
        $items = Obd::select('cars.merk AS cars_merk', 'cars.nopol', 'cars.engine_status', 'obds.*')
                ->leftjoin('surveilance_cars AS cars', 'cars.id', '=', 'obds.car_id')->orderBy('obds.id', 'DESC')->get();
        
        $cars = SurveilanceCar::all();

        $data['items'] = $items;
        $data['cars'] = $cars;

        return view('obd-tracker.index', $data);
    }

    public function hubungkan_obd(Request $request)
    {
        $obd = Obd::where('id', $request->id)->first();
        try {
            if (!$request->car_id) {
                return back()->with('error', 'Silahkan pilih armada terlebih dahulu');
            }
            
            Obd::where('id', '=', $request->id)->update([
                'car_id' => $request->car_id
            ]);
    
            Helper::logActivity('Armada berhasil dihubungkan dengan obd '.$obd->merk);
    
            return back()->with('success', 'Armada berhasil dihubungkan dengan obd '.$obd->merk);
        } catch (\Throwable $th) {
            return back()->with('error', 'Armada tersebut telah terpasang obd');
        }
    }
    
    public function lepaskan_obd(Request $request)
    {
        $obd = Obd::select('cars.merk AS cars_merk', 'cars.nopol', 'cars.engine_status', 'obds.*')
               ->leftjoin('surveilance_cars AS cars', 'cars.id', '=', 'obds.car_id')
               ->where('obds.id', $request->id)
               ->first();
             
        if ($obd->engine_status == 0) {
            Obd::where('id', '=', $request->id)->update([
                'car_id' => NULL
            ]);
    
            Helper::logActivity("Obd berhasil dilepaskan dari armada");
    
            return back()->with('success', 'Obd ' . $obd->merk . ' berhasil dilepaskan');
        } else {
            return back()->with('error', 'Matikan mesin armada terlebih dahulu');
        }
    }

    public function switch_engine(Request $request)
    {
        $car_id = $request->car_id;
        $car = SurveilanceCar::where('id', $car_id)->first();

        try {
            $car->engine_status = ($car->engine_status == 0) ? 1 : 0;
            $car->save();

            $word = $car->engine_status == 1 ? "dihidupkan" : "dimatikan";

            Helper::logActivity('Mesin ' . $car->merk . ' (' . $car->nopol . ')' . ' berhasil '. $word);

            return back()->with('success', 'Mesin ' . $car->merk . ' (' . $car->nopol . ')' .' berhasil '. $word);
        } catch (\Throwable $th) {
            return back()->with('error', 'OBD belum terhubung dengan armada');
        }
    }
}
