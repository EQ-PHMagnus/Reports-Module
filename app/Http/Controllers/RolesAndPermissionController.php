<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\ResponseResource;
use App\Http\Requests\RolesAndPermissions\RolesRequest;
use App\Http\Requests\RolesAndPermissions\PermissionsRequest;

class RolesAndPermissionController extends Controller
{
	public function __construct(){

	}
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $roles = Role::get();
        return view('roles-permissions.roles',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolesRequest $request)
    {

		try{

			$role = Role::create(['name' => $request->role_name]);
			return new ResponseResource($role);
		} catch( \Exception $e){
			return response()->json(['error' => $e->getMessage()],500);
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $role =  Role::where('name','!=','Super Admin')->find($id);
      $permissions = $role->getAllPermissions();

      return new ResponseResource($permissions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $role = Role::find($id);
      $permissionByRole  = $role->getAllPermissions()->pluck('id');
      $permissions = Permission::all();
      return view('roles-permissions.assign-permissions',compact('role','permissions','permissionByRole'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      try{

        $role = Role::updateOrCreate(['id' => $id],['name' => $request->role_name]);

        return new ResponseResource($role);
      } catch( \Exception $e){
        return response()->json(['error' => $e->getMessage()],500);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		try {
            $role = Role::find($id);
            $delete = $role->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(null, 500);
        }
    }

	public function assignPermissions(Request $request){
		try{
			$role           = Role::find($request->role_id);
			$oldPermission  = $role->getAllPermissions()->pluck('id');

      app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
			$permissions    = $role->syncPermissions($request->permissions);
			$newPermission  = $role->getAllPermissions()->pluck('id');

			flashMessage("successfully assigned permissions to role ". $role->name);

		} catch( \Exception $e){
			flashMessage($e->getMessage(),false);
		}
		return redirect()->back();
	}

	public function getPermissionsViaRoles(){
		$user = auth()->user();
		$permissions = $user->getPermissionsViaRoles();;
		return response()->json($permissions,200);
	}

}
