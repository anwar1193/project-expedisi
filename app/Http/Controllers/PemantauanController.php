<?php

namespace App\Http\Controllers;

use App\Models\Maps;
use App\Models\SurveilanceCar;
use Illuminate\Http\Request;


class PemantauanController extends Controller
{
    public function index()
    {
        $surveilance_cars = SurveilanceCar::orderBy('id', 'DESC')->get();
        $data['surveilance_cars'] = $surveilance_cars;

        $maps = Maps::first();
        $data['maps'] = $maps;

        return view('pemantauan-gps.index', $data);
    }

    public function view_mobile()
    {
        $surveilance_cars = SurveilanceCar::orderBy('id', 'DESC')->get();
        $data['surveilance_cars'] = $surveilance_cars;

        $maps = Maps::first();
        $data['maps'] = $maps;

        return view('pemantauan-gps.mobile', $data);
    }
}
