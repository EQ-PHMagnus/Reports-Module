<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\Tax;
class TaxController extends Controller
{

    use Tax;

    public function grossReceipts(request $request){
        try{
            if(request()->ajax()){
                $result = $this->getTax($request,null); 
                return response()->json($result);
            }
            // export file
            $export = $request->input('export',false);
            if($export === 'true'){
                $exportQuery    = $this->getTax($request,'excel');
                $exportFileName = '_Gross_Reciepts_from_Bets_Tax_Reports.xlsx';
                return exportFiles($exportQuery,$exportFileName);
            }
            // render components
            return view('tax.gross-receipts.index');
        }catch(\Exception $e){
            dd($e);
            return $e->getMessage();
        }
       
    }

    public function totalGBR(request $request){
        try{
            if(request()->ajax()){
                $result = $this->getTax($request,null); 
                return response()->json($result);
            }
            // export file
            $export = $request->input('export',false);
            if($export === 'true'){
                $exportQuery    = $this->getTax($request,'excel');
                $exportFileName = '_Total_GBR_Tax_Reports.xlsx';
                return exportFiles($exportQuery,$exportFileName);
            }
            // render components
            return view('tax.total-GBR.index');
        }catch(\Exception $e){
            dd($e);
            return $e->getMessage();
        }
    }

    public function grossCommission(request $request){
        try{
            if(request()->ajax()){
                $result = $this->getTax($request,null); 
                return response()->json($result);
            }
            // export file
            $export = $request->input('export',false);
            if($export === 'true'){
                $exportQuery    = $this->getTax($request,'excel');
                $exportFileName = '_Gross_Commission_Tax_Reports.xlsx';
                return exportFiles($exportQuery,$exportFileName);
            }
            // render components
            return view('tax.gross-commission.index');
        }catch(\Exception $e){
            dd($e);
            return $e->getMessage();
        }
    }
    
    public function netCommission(request $request){
        try{
            if(request()->ajax()){
                $result = $this->getTax($request,null); 
                return response()->json($result);
            }
            // export file
            $export = $request->input('export',false);
            if($export === 'true'){
                $exportQuery    = $this->getTax($request,'excel');
                $exportFileName = '_Net_Commission_Tax_Reports.xlsx';
                return exportFiles($exportQuery,$exportFileName);
            }
            // render components
            return view('tax.net-commission.index');
        }catch(\Exception $e){
            dd($e);
            return $e->getMessage();
        }
    }

    public function finalTaxesWinnings(request $request){
        try{
            if(request()->ajax()){
                $result = $this->getTax($request,null,'final-tax'); 
                return response()->json($result);
            }
            // export file
            $export = $request->input('export',false);
            if($export === 'true'){
                $exportQuery    = $this->getTax($request,'excel');
                $exportFileName = '_Final_Taxes_Winnings_Reports.xlsx';
                return exportFiles($exportQuery,$exportFileName);
            }
            // render components
            return view('tax.final-taxes-winnings.index');
        }catch(\Exception $e){
            dd($e);
            return $e->getMessage();
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
}
