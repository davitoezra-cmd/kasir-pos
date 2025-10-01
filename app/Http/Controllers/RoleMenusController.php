<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;   
use App\Models\Menu;   
use App\Models\RoleMenu;

class RoleMenusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role_menus = RoleMenu::paginate(10);
        return view('role-menus.index', compact('role_menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $menus = Menu::all();
        return view('role-menus.create', compact('roles', 'menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'menu_id' => 'required|exists:menus,id',
            "can_view" => 'sometimes|boolean',
            "can_create" => 'sometimes|boolean',
            "can_update" => 'sometimes|boolean',
            "can_delete" => 'sometimes|boolean',
        ]); 
        RoleMenu::create($validated);
        return redirect()->route('role-menus.index')->with('success', 'Role Menu created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role_menu = RoleMenu::find($id);
        $roles = Role::all();
        $menus = Menu::all();
        return view('role-menus.edit', compact('role_menu', 'roles', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role_menu = RoleMenu::find($id);
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'menu_id' => 'required|exists:menus,id',
            "can_view" => 'sometimes|boolean',
            "can_create" => 'sometimes|boolean',
            "can_update" => 'sometimes|boolean',
            "can_delete" => 'sometimes|boolean',
        ]); 
        $role_menu->update($validated);
        return redirect()->route('role-menus.index')->with('success', 'Role Menu updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role_menu = RoleMenu::find($id);
        if ($role_menu) {
            $role_menu->delete();
            return redirect()->route('role-menus.index')->with('success', 'Role Menu deleted successfully.');
        }
        return redirect()->route('role-menus.index')->with('error', 'Role Menu not found.');
    }
}
