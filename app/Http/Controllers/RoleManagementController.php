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
        foreach ($datas as $item) {
            $menu = MasterMenu::join('menu_permissions', 'menu_permissions.menu_id', '=', 'master_menus.id')
                    ->where('level_id', $item->id)
                    ->orderBy('master_menus.id', 'ASC')->get();
            $item->menu = $menu;
        }
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

    public function create(Request $request)
    {
        return view('role-management.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'level' => ['required'],
        ]);

        $validateData['deskripsi'] = $request->deskripsi;

        Level::create($validateData);
        return redirect()->route('role-management')->with('success', 'Role added successfully');
    }

    public function edit($id)
    {
        $level = Level::where('id', $id)->first();
        $data['level'] = $level;

        return view('role-management.edit', $data);
    }

    public function update(Request $request)
    {
        $validateData = $request->validate([
            'level' => ['required'],
        ]);

        $validateData['deskripsi'] = $request->deskripsi;

        Level::find($request->id)->update($validateData);

        return redirect()->route('role-management')->with('success', 'Role updated successfully');
    }

    public function delete($id)
    {
        Level::find($id)->delete();
        return redirect()->route('role-management')->with('success', 'Role deleted successfully');
    }
}
