<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AgentRequest;
use App\Models\User;
use DB;
use Carbon\Carbon;
use Rap2hpoutre\FastExcel\FastExcel;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $from = $request->input('from', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $to = $request->input('to', date('Y-m-d'));
        $search = $request->input('search',false);
        $export = $request->input('export',false);

        $agentsQuery = User::with('agent')
            ->orderByDesc('created_at')
            ->when($search,function($query,$search){
                $_search = "%".$search."%";
                return $query->where('agent_code','LIKE',$_search)
                    ->orWhere('username','LIKE',$_search)
                    ->orWhere('name','LIKE',$_search);
            })
            ->whereBetween(DB::raw('date(created_at)'),[$from,$to])
            ->agents()
            ->orderByDesc('created_at');
            

        if($export === 'true'){
            $header_style = (new StyleBuilder())->setFontBold()->build();

            $rows_style = (new StyleBuilder())
                ->setShouldWrapText(false)
                ->build();

            // Export consumes only a few MB, even with 10M+ rows.
            return (new FastExcel($this->agentsGenerator($agentsQuery)))
                ->headerStyle($header_style)
                ->rowsStyle($rows_style)
                ->download(Carbon::now()->toDateString() . '_Agents_Reports.xlsx');
        }

        $agents = $agentsQuery->paginate(10)
            ->withQueryString();
        return view('agents.index',compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgentRequest $request)
    {
        DB::beginTransaction();
        try{
            $data = $request->except('_token','password_confirmation');
            $data['identification'] = $request->file('identification')->storePublicly('giids');
            $data['recent_photo'] = $request->file('recent_photo')->storePublicly('recent_photos');
            
            //TODO
            //Handle File uploads
            $agent = User::create($data);

            DB::commit();
            flashMessage('Agent created successfully!');
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
        $agent = User::with('agent')->findOrFail($id);

        return view('agents.edit',compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AgentRequest $request, $id)
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

            $agent = User::updateOrCreate(['id' => $id],$data);

            DB::commit();
            flashMessage('Agent updated successfully!');
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
            $agent = User::findOrFail($id);
            $agent->delete();

            DB::commit();
            return response()->json('Deleted successfully!.');
        } catch( \Exception $e){
            DB::rollback();
            return config('app.debug') ? dd($e) : abort(400);
        }
    }

    public function searchAgent(){
        $search = request('term');

        $agent = User::agents()
            ->where('name','LIKE','%'.$search.'%')
            ->orWhere('username','LIKE','%'.$search.'%')
            ->orWhere('agent_code','LIKE','%'.$search.'%')
            ->select('id','username','name','agent_code')
            ->limit(5)
            ->get();
        return response()->json($agent);
    }

    private function agentsGenerator($agentsQuery) {
        foreach ($agentsQuery->cursor() as $agent) {
            $recent_photo = $agent->recent_photo;
            if(strpos($recent_photo, 'picsum') === false){
                $recent_photo = asset('storage/'. $agent->recent_photo);
            }

            $identification = $agent->identification;
            if(strpos($recent_photo, 'picsum') === false){
                $recent_photo = asset('storage/'. $agent->identification);
            }
            $agent = collect([
                'Agent Code' => $agent->agent_code,
                'Agent/Super Agent' => $agent->role,
                'Agent Level' => $agent->level,
                'Player Account' => $agent->username,
                'Player Name' => $agent->name,
                'Current Credits' => moneyFormat($agent->points),
                'Phone Number' => $agent->mobile_number,
                'Joined Date(Agent)' => $agent->created_at->toDateTimeString(),
                'GIID' => $identification,
                'Recent Photo' => $recent_photo ,
            ]);
            yield $agent;
        }
    }
}
