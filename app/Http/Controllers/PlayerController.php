<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use DB;
use Carbon\Carbon;
use Rap2hpoutre\FastExcel\FastExcel;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $from = $request->input('from', Carbon::now()->subDays('30')->format('Y-m-d'));
        $to = $request->input('to', date('Y-m-d'));
        $search = $request->input('search',false);
        $export =  $request->input('export',false);
        
        $playersQuery = User::with('agent')
            ->orderByDesc('created_at')
            ->when($search,function($query,$search){
                $_search = "%".$search."%";
                return $query->where('agent_code','LIKE',$_search)
                    ->orWhere('username','LIKE',$_search)
                    ->orWhere('name','LIKE',$_search);
            })
            ->whereBetween(DB::raw('date(created_at)'),[$from,$to])
            ->bettors()
            ->orderByDesc('created_at');
            
            
        if($export === 'true'){
            
            $header_style = (new StyleBuilder())->setFontBold()->build();

            $rows_style = (new StyleBuilder())
                ->setShouldWrapText(false)
                ->build();

            // Export consumes only a few MB, even with 10M+ rows.
            return (new FastExcel($this->playersGenerator($playersQuery)))
                ->headerStyle($header_style)
                ->rowsStyle($rows_style)
                ->download(Carbon::now()->toDateString() . '_Players_Reports.xlsx');
        }

        $players = $playersQuery->paginate(10)
            ->withQueryString();
        return view('players.index',compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('players.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        DB::beginTransaction();
        try{
            $data = $request->except('_token','password_confirmation');
            $data['identification'] = $request->file('identification')->storePublicly('giids');
            $data['recent_photo'] = $request->file('recent_photo')->storePublicly('recent_photos');
            $player = User::create($data);

            DB::commit();
            flashMessage('User created successfully!');
            return redirect()->back();
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
        $player = User::with('agent')->findOrFail($id);

        return view('players.edit',compact('player'));
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
            $data =  $request->except('_token','_method');
            if($request->hasFile('identification')){
                $data['identification'] = $request->file('identification')->storePublicly('giids');
            }
            if($request->hasFile('recent_photo')){
                $data['recent_photo'] = $request->file('recent_photo')->storePublicly('recent_photos');
            }
            $player = User::updateOrCreate(['id' => $id],$data);

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
            $player = User::findOrFail($id);
            $player->delete();

            DB::commit();
            return response()->json('Deleted successfully!.');
        } catch( \Exception $e){
            DB::rollback();
            return config('app.debug') ? dd($e) : abort(400);
        }
    }


    private function playersGenerator($playersQuery) {
        foreach ($playersQuery->cursor() as $player) {
            $recent_photo = $player->recent_photo;
            if(strpos($recent_photo, 'picsum') === false){
                $recent_photo = asset('storage/'. $player->recent_photo);
            }

            $identification = $player->identification;
            if(strpos($recent_photo, 'picsum') === false){
                $recent_photo = asset('storage/'. $player->identification);
            }
            $player = collect([
                'Agent Code' => $player->agent_code,
                'Agent Level' => $player->level,
                'Player Account' => $player->username,
                'Player Name' => $player->name,
                'Birthday' => $player->dob->toDateString(),
                'Current Credits' => moneyFormat($player->points),
                'Phone Number' => $player->mobile_number,
                'Joined Date(Agent)' => $player->created_at->toDateTimeString(),
                'GIID' => $identification,
                'Recent Photo' => $recent_photo ,
            ]);
            yield $player;
        }
    }
}
