<?php

namespace App\Http\Controllers;

use App\Models\Arena;
use Illuminate\Http\Request;
use App\Http\Requests\ArenaRequest;
use DB;

class ArenaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arenas = Arena::orderBy('name')->paginate(10)->withQueryString();

        return view('arenas.index',compact('arenas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('arenas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArenaRequest $request)
    {
        DB::beginTransaction();
        try{
            $data = $request->except('_token');
         
            $arena = Arena::create($data);

            DB::commit();
            flashMessage('Arena created successfully!');
            return redirect()->back();
        } catch( \Exception $e){
            DB::rollback();
            return config('app.debug') ? dd($e) : flashMessage($e->getMessage,400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Arena  $arena
     * @return \Illuminate\Http\Response
     */
    public function show(Arena $arena)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Arena  $arena
     * @return \Illuminate\Http\Response
     */
    public function edit(Arena $arena)
    {
        return view('arenas.edit',compact('arena'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Arena  $arena
     * @return \Illuminate\Http\Response
     */
    public function update(ArenaRequest $request, Arena $arena)
    {
        DB::beginTransaction();
        try{
            $data =  $request->except('_token','_method');

            $arena->update($data);

            DB::commit();
            flashMessage('Arena updated successfully!');
            return redirect()->back();
        } catch( \Exception $e){
            DB::rollback();
            return config('app.debug') ? dd($e) : flashMessage($e->getMessage,400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Arena  $arena
     * @return \Illuminate\Http\Response
     */
    public function destroy(Arena $arena)
    {
        DB::beginTransaction();
        try{
            $arena->delete();

            DB::commit();
            return response()->json('Deleted successfully!.');
        } catch( \Exception $e){
            DB::rollback();
            return config('app.debug') ? dd($e) : abort(400);
        }
    }
}
