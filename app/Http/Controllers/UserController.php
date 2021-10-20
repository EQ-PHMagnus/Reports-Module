<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderByDesc('created_at')
            ->with('roles')
            ->role(config('defaults.system-users'))
            ->whereNotIn('id',[auth()->user()->id,1])
            ->paginate(10)
            ->withQueryString();

        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'username' => 'required|unique:users',
                'email' => 'email',
                'password' => 'required|min:4|confirmed',
                'mobile_number' => 'digits:11',
                'role' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            //TODO
            //Handle File uploads
            $user = User::create($validator->validated());
            $user->assignRole($request->role);

            DB::commit();
            flashMessage('User created successfully!');
            return redirect()->route('users.edit',$user->id);
        } catch( \Exception $e){
            DB::rollback();
            return config('app.debug') ? dd($e) : flashMessage($e->getMessage,400);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit',compact('user'));
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
        DB::beginTransaction();
        try{
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'username' => [
                    'required',
                    Rule::unique('users')->ignore($id),
                ],
                'email' => 'email',
                'password' => 'nullable|min:4|confirmed',
                'mobile_number' => 'digits:11',
                'role' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $data = array_filter($validator->validated());

            $user = User::updateOrCreate(['id' => $id],$data);
            $user->syncRoles([$request->role]);

            DB::commit();
            flashMessage('User updated successfully!');
            return redirect()->back();
        } catch( \Exception $e){
            DB::rollback();
            return config('app.debug') ? dd($e) : flashMessage($e->getMessage,400);
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
        DB::beginTransaction();
        try{
            $user = User::findOrFail($id);
            $user->delete();

            DB::commit();
            return response()->json('Deleted successfully!.');
        } catch( \Exception $e){
            DB::rollback();
            return config('app.debug') ? dd($e) : abort(400);
        }
    }
}
