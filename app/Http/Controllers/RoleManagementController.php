<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Level;
use App\Models\MasterMenu;
use App\Models\MenuPermission;

class RoleManagementController extends Controller
{
    public  function index()
    {
        $datas = Level::orderBy('id', 'ASC')->get();
        $data['datas'] = $datas;
        return view('role-management.index', $data);
    }

    public function changePermission($id)
    {
        $menu = MasterMenu::orderBy('id', 'ASC')->get();
        $level = Level::where('id', $id)->first();

        $data['menu'] = $menu;
        $data['level'] = $level;
        return view('role-management.permission', $data);
    }

    public function addPermission(Request $request)
    {
        $level_id = $request->level_id;
        $menu_id = $request->menu_id;

        MenuPermission::where('level_id', '=', $level_id)->delete();

        for($i=0; $i<sizeof($menu_id); $i++){
            MenuPermission::create([
                'level_id' => $level_id,
                'menu_id' => $menu_id[$i]
            ]);
        }

        return redirect()->route('role-management')->with('success', 'Permission Has Changed');
    }
}
