<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Models\Masterlist;
use App\Http\Resources\ResponseResource;
use App\Http\Requests\RolesAndPermissions\PermissionsRequest;
use Route;
class PermissionsAndRoutesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        $routeCollection = Route::getRoutes();
        $apiPrefixes = ['oauth','api','api/v1'];
        $excludedWebRoutes = ['login','logout','register','password'];
        $permissableRoutes = [];
        foreach ($routeCollection as $route) {
          if(!in_array($route->getPrefix(),$apiPrefixes) && $route->getName() !== null){
            $namedRoute = explode(".",$route->getName());
            if(!in_array($namedRoute[0],$excludedWebRoutes)  && count($namedRoute) >= 2){
              $permissableRoutes[$namedRoute[0]][] = $namedRoute[1];
            }
          }
		}
		// dd($permissableRoutes);
		return view('roles-permissions.action-permissions',compact('permissions','permissableRoutes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionsRequest $request)
    {
		try{
			$permission = Permission::create(['name' => $request->permission_name]);
			return new ResponseResource($permission);
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
		$getPermissableAction = $this->getPermissionsByRouteName($id);
		// dd($getPermissableAction);
		$permissions = isset($getPermissableAction) ? Permission::whereIn('id',json_decode($getPermissableAction->option_value))->get() : [];
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
        $routeName = $id;
		$getPermissableAction = $this->getPermissionsByRouteName($routeName);
		$permissionByAction = isset($getPermissableAction) ? json_decode($getPermissableAction->option_value) : null;
		$permissionByAction = $permissionByAction ?? [];
		$permissions = Permission::get();
		return view('roles-permissions.assign-action-permissions',compact('permissionByAction','routeName','permissions'));
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
			$route_name = $request->route_name;
			$savePermissionByAction = Masterlist::updateOrCreate(['option_key' => $route_name],['option_value' => json_encode($request->permissions)]);
			flashMessage("successfully assigned permissions to action ". $route_name);
		} catch( \Exception $e){
			flashMessage($e->getMessage(),false);
		}
		return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

	private function getPermissionsByRouteName($routeName = null){
		if(!isset($routeName)) throw new Exception ("Empty action/route name found");
		return Masterlist::where('option_key',$routeName)->first();
	}
}
