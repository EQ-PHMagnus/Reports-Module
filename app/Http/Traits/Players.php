<?php
namespace App\Http\Traits;
use DB;

trait Players {
    

    public function getPlayers($request,$type,$format) {

      
        $sort           = request()->input('sort') == "" ? 'transaction_date' : request()->input('sort');
        $order          = request()->input('order', 'desc');
        $search         = request()->input('filters.search');
        $min_amount     = request()->input('filters.min_amount');
        $max_amount     = request()->input('filters.max_amount');
        $from           = $request->input('filters.from') ? date('Y-m-d h:i:s', strtotime($request->input('filters.from'))) : null;
        $to             = date('Y-m-d h:i:s', strtotime($request->input('filters.to'))) ?? $from;
        $stat           =  request()->input('filters.status');

        $data   = DB::table('transactions as trans')
                        ->leftJoin('users as user','user.id', '=','trans.user_id')
                        ->selectRaw('user.name as name,
                        user.dob,
                        trans.amount,
                        user.mobile_number,
                        trans.transaction_date')
                        ->when($search, function($query,$search){
                            return $query->where('name', 'like' ,'%'.$search.'%');
                        })
                        ->when($from, function ($query , $from) use ($to) {
                            return $query->whereBetween('trans.transaction_date', [$from, $to]);
                        })
                        ->when($min_amount, function ($query , $min_amount) use ($max_amount) {
                            return $query->whereBetween('trans.amount', [$min_amount, $max_amount]);
                        })
                        ->when($sort, function($query, $sort) use ($order){
                            return $query->orderBy('trans.'.$sort, $order);
                        })
                        ->where('trans.type', $type)
                        // ->whereNull('ac.deleted_at')
                        ;

        if($format == 'excel'){
            return $data->get();
        }
       
        $dataCount  = $data->count();
        $formData   = $data->skip(intval(request()->input('offset', 0)))
                            ->limit(intval(request()->input('limit', 10)))
                            ->get();

        $finalData  = [];
        $offset     = request()->input('offset', 0) + 1;
     

        foreach($formData as $i => $data){
            

            $finalData[] = [
              
                'id'                      => $offset++ ,
                'player_name'             => $data->name,
                'bday'                    => date('m-d-Y',strtotime($data->dob)),
                'current_credits'         => $data->amount ? moneyFormat($data->amount): '',
                'phone_no'                => $data->mobile_number,
                'transaction_date'        => date('m-d-Y',strtotime($data->transaction_date)),
                'actions' => ''
            ];
            
        }

        return [
        
            'rows'             => $finalData,
            'total'            => $dataCount,
            'totalNotFiltered' => $dataCount,
            
        ];

    }
  
    
}