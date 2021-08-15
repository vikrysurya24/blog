<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    private $page = 5;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = [];
        if ($request->has('keyword')) {
            $roles = Role::where('name', 'LIKE', "%{$request->keyword}%")->paginate($this->page);
        } else {
            $roles = Role::paginate($this->page);
        }
        return view('roles.index', [
            'roles' => $roles->appends(['keyword' => $request->keyword])
        ]);
    }

    public function select(Request $request)
    {
        $roles = Role::select('id', 'name')->limit(7);
        if ($request->has('key')) {
            $roles->where('name', 'LIKE', "%{$request->key}%");
        }

        return response()->json($roles->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create', [
            'authorities' => config('permission.authorities'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:50|unique:roles,name',
                'permissions' => 'required'
            ],
            [],
            $this->attributes()
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // Proses Input
        DB::beginTransaction();
        try {
            $role = Role::create(['name' => $request->name]);
            $role->givePermissionTo($request->permissions);
            toast(trans('roles.alert.create.message.success'), 'success');
            return redirect()->route('roles.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error(
                trans('roles.alert.create.title'),
                trans('roles.alert.create.message.error'),
                ['error' => $th->getMessage()]
            );
            return redirect()->back()->withInput($request->all());
        } finally {
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('roles.show', [
            'role' => $role,
            'authorities' => config('permission.authorities'),
            'rolePermissions' => $role->permissions->pluck('name')->toArray()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('roles.edit', [
            'role' => $role,
            'authorities' => config('permission.authorities'),
            'checked' => $role->permissions->pluck('name')->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:50|unique:roles,name,' . $role->id,
                'permissions' => 'required'
            ],
            [],
            $this->attributes()
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // Proses Update
        DB::beginTransaction();
        try {
            $role->name = $request->name;
            $role->syncPermissions($request->permissions);
            $role->save();
            toast(trans('roles.alert.update.message.success'), 'success');
            return redirect()->route('roles.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error(
                trans('roles.alert.update.title'),
                trans('roles.alert.update.message.error'),
                ['error' => $th->getMessage()]
            );
            return redirect()->back()->withInput($request->all());
        } finally {
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        // Validasi
        if (User::role($role->name)->count()) {
            Alert::warning(
                trans('roles.alert.delete.title'),
                trans('roles.alert.delete.message.warning', ['name' => $role->name])
            );
            return redirect()->route('roles.index');
        }
        // Proses Delete
        DB::beginTransaction();
        try {
            $role->revokePermissionTo($role->permissions->pluck('name')->toArray());
            $role->delete();
            toast(trans('roles.alert.delete.message.success'), 'success');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error(
                trans('roles.alert.delete.title'),
                trans('roles.alert.delete.message.error'),
                ['error' => $th->getMessage()]
            );
        } finally {
            DB::commit();
        }
        return redirect()->route('roles.index');
    }

    private function attributes()
    {
        return [
            'name' => trans('roles.form_control.input.name.attribute'),
            'permissions' => trans('roles.form_control.input.permission.attribute')
        ];
    }
}
