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

	public function formatBar($data = [],$yearCollection = [],$monthYearCollection = [],$type){
        $formatted = [
            'labels' => [],
            'series' => []
        ];
        
        if($type == 'monthly'){
            // 2. get all the months with count
            $series = [];
            foreach($monthYearCollection as $key => $val){
                $decodeVal = json_decode($val);
                $arrayValues = [];
                foreach($decodeVal as $key2 => $val2){
                    $arrayValues[] = $val2;
                }
                $series[$key] = [
                    "name" => $key,
                    "data" => $arrayValues
                ];
            }
            // 3. convert months with values to json array
            $getData = [];
            $seriesArrayValues = array_values($series);
            foreach($seriesArrayValues as $data){
                $getData[$data['name']] = $data['data'];
            }
            $arraySeries = [];
            foreach($getData as $key => $data){
                $arraySeries[] = [
                    "name" => (string)$key,
                    "data" => $data];
            }
            $formatted = [
                'labels' => [],
                'series' => $arraySeries
            ];
            
            $labels = json_decode($yearCollection);
            foreach($labels as $key => $data){
                $formatted['labels'][] = $key;
            }

            return $formatted;
        }

        foreach($data as $key1 => $key1Data ){
            $subSeries = [];
            foreach($key1Data as $key2 => $key2Data){   
               
            if(!in_array($key2, $formatted['labels']))
                $formatted['labels'][] = $key2;
                $subSeries[] = [
                    "name" => $key2,
                    "data" => array($key2Data[$key2])
                ];
            }
            $formatted['series'] = $subSeries;   
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