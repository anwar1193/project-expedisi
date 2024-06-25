<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\KonversiPoint;
use App\Models\Merchandise;
use App\Models\PenukaranPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenukaranPointController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->id;
        $data['customers'] = Customer::orderBy('id')->get();

        if ($id) {
            $data['customer'] = Customer::where('id', $id)->first();
        }

        $merchandise = Merchandise::orderBy('id', 'ASC')->get();
        foreach ($merchandise as $item) {
            $point = KonversiPoint::orderBy('id', 'asc')->first();

            $item->points = round($item->nilai / $point->nominal);
        }
        $data['merchandise'] = $merchandise;

        return view('penukaran-point.index', $data);
    }

    public function penukaran_point(Request $request)
    {
        $customer_id = $request->customer;
        if (!$customer_id) {
            return back()->with('error', 'Pilih Customer terlebih Dahulu');
        }

        $customer = Customer::find($customer_id);
        if (!$customer) {
            return back()->with('error', 'Customer tidak ditemukan');
        }

        $merchandise = Merchandise::orderBy('id', 'ASC')->get();

        return view('penukaran-point.hasil', compact('customer', 'merchandise'));
    }

    public function proses_penukaran(Request $request) 
    {
        $merchandise = Merchandise::where('id', $request->marchendise_id)->first();
        $point = KonversiPoint::orderBy('id', 'asc')->first();

        $point_merchandise = round($merchandise->nilai / $point->nominal);

        // dd($request->customer_id, $request->marchendise_id);
        // Proses Tukar Point
        PenukaranPoint::create([
            "customer_id" => $request->customer_id,
            "marchendise_id" => $request->marchendise_id
        ]);

        // Prosese Update Point Customer
        $customer = Customer::where('id', '=', $request->customer_id)->first();
        $customer->point = round($customer->point - $point_merchandise);
        if ($customer->point < $point_merchandise) {
            return back()->with('error', 'Point Anda Tidak Cukup Untuk Menukarkan Item Tersebut');
        }
        $customer->save(); 

        return redirect()->route('list-penukaran-point')->with('success', 'Point Berhasil Ditukarkan');
    }

    public function list_penukaran()
    {
        $data = PenukaranPoint::select('penukaran_points.id', 'customers.nama AS name', 'customers.point', 'merchandises.nama', 'merchandises.nilai', DB::raw('DATE(penukaran_points.created_at) AS tgl_tukar'))
                ->leftjoin('customers', 'customers.id', '=', 'penukaran_points.customer_id')
                ->leftjoin('merchandises', 'merchandises.id', '=', 'penukaran_points.marchendise_id')
                ->orderBy('penukaran_points.id', 'DESC')->get();

        return view('penukaran-point.list-penukaran-point', compact('data'));
    }
}
