<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\KonversiPoint;
use App\Models\Merchandise;
use Illuminate\Http\Request;

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
}
