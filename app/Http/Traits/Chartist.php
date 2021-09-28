<?php
namespace App\Http\Traits;

trait Chartist {

	public function formatLine($data){
		$formatted = [
            'labels' => [],
            'series' => []
        ];

        foreach($data as $key1 => $key1Data ){
            $subSeries = [];
            foreach($key1Data as $key2 => $key2Data){   
            if(!in_array($key2, $formatted['labels']))
                $formatted['labels'][] = $key2;
                $subSeries[] = $key2Data;
            }
            $formatted['series'][] = $subSeries;   
        }

        return $formatted;
	}

	public function formatBar($data,$string = '',$type,$count){

		$formatted = [
            'labels' => [],
            'series' => []
        ];


        if($type == 'yearly'){
            foreach($data as $key1 => $key1Data ){
                $subSeries = [];
                foreach($key1Data as $key2 => $key2Data){   
                if(!in_array($key2, $formatted['labels']))
                    $formatted['labels'][] = $key2;
                    $subSeries[] = $key2Data;
                }
                $formatted['series'][] = $subSeries;   
            }
        }else{
            foreach($data as $key => $val){
                $decodeVal = json_decode($data);
                $formatted['labels'][] = $key;
                $formatted['series'] = $decodeVal;
            }
        }
        return $formatted;
	}

	public function formatPie($data){
		$formatted = [
            'labels' => [],
            'series' => []
        ];

        foreach($data as $key => $count ){
            if(!in_array($key, $formatted['labels'])){
                $formatted['labels'][] = $key;
                $formatted['series'][] = $count;   
            }
        }

        return $formatted;
	}
}