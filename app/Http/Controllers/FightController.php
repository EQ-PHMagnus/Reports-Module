<?php

namespace App\Http\Controllers;

use App\Models\Fight;
use App\Models\Arena;
use Illuminate\Http\Request;
use App\Http\Requests\FightRequest;
use DB;

class FightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fights = Fight::with('arena')->orderBy('schedule')->paginate(10)->withQueryString();

        return view('fights.index',compact('fights'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arenas = Arena::orderBy('name')->get();
        return view('fights.create',compact('arenas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FightRequest $request)
    {
        DB::beginTransaction();
        try{
            $data = $request->except('_token');
         
            $fight = Fight::create($data);

            DB::commit();
            flashMessage('Fight created successfully!');
            return redirect()->back();
        } catch( \Exception $e){
            DB::rollback();
            return config('app.debug') ? dd($e) : flashMessage($e->getMessage,400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fight  $fight
     * @return \Illuminate\Http\Response
     */
    public function show(Fight $fight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fight  $fight
     * @return \Illuminate\Http\Response
     */
    public function edit(Fight $fight)
    {
        $arenas = Arena::orderBy('name')->get();
        
        return view('fights.edit',compact('fight','arenas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fight  $fight
     * @return \Illuminate\Http\Response
     */
    public function update(FightRequest $request, Fight $fight)
    {
        DB::beginTransaction();
        try{
            $data =  $request->except('_token','_method');
            $fight->update($data);
            DB::commit();
            flashMessage('Fight updated successfully!');
            return redirect()->back();
        } catch( \Exception $e){
            DB::rollback();
            return config('app.debug') ? dd($e) : flashMessage($e->getMessage,400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fight  $fight
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fight $fight)
    {
        DB::beginTransaction();
        try{
            $fight->delete();

            DB::commit();
            return response()->json('Deleted successfully!.');
        } catch( \Exception $e){
            DB::rollback();
            return config('app.debug') ? dd($e) : abort(400);
        }
    }
}
