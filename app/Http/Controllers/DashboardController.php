<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Classes\Reports\Reporter;
use App\Http\Classes\Reports\CustomReports;
use Carbon\Carbon;

class DashboardController extends Controller
{
    use Reporter;

    public function index(Request $request){
        try{


            $from = $request->from ? Carbon::parse($request->from)->startOfDay() : Carbon::now()->startOfWeek();
            $to = $request->to ? Carbon::parse($request->to)->endOfDay() : Carbon::now()->endOfDay();
            if($from->greaterThan($to)) throw new \Exception("'From' date must be lower than 'To' date");
            $counters = [
                "total_registrants"     => [
                    "filtered"  => $this->getCounters("total_registrants",[$from,$to]),
                    "count"     => $this->getCounters("total_registrants"),
                    "icon"      => "accounts"
                ] ,
                "total_gma_registrants" => [
                    "filtered"  => $this->getCounters("total_gma_registrants",[$from,$to]),
                    "count"     => $this->getCounters("total_gma_registrants"),
                    "icon"      => "accounts"
                ] ,
                "total_rejected"        => [
                    "filtered"  => $this->getCounters("total_rejected",[$from,$to]),
                    "count"     => $this->getCounters("total_rejected"),
                    "icon"      => "block"
                ] ,
                "total_pending"         => [
                    "filtered"  => $this->getCounters("total_pending",[$from,$to]),
                    "count"     => $this->getCounters("total_pending"),
                    "icon"      => "hourglass"
                ] ,
                "total_approved"        => [
                    "filtered"  => $this->getCounters("total_approved",[$from,$to]),
                    "count"     => $this->getCounters("total_approved"),
                    "icon"      => "check"
                ] ,
            ];

            $common_reject_reason = $this->getCounters("common_reject_reason");

            $customReportKeys   = CustomReports::REPORTS;

            //Custom Reports
            $bumo_of_registrants                          = [
                'title' => ucwords(str_replace("_"," ",$customReportKeys[0])),
                'data' => $this->getCustomReport($customReportKeys[0])
            ];
            $common_reject_reasons                  = [
                'title' => ucwords(str_replace("_"," ",$customReportKeys[1])),
                'data' => $this->getCustomReport($customReportKeys[1])
            ];
            $daily_registration_trend = [
                'title' => ucwords(str_replace("_"," ",$customReportKeys[2])),
                'data' => $this->getCustomReport($customReportKeys[2],[
                    "from"  => $from,
                    "to"    => $to
                ])
            ];
            $profile_of_registrants                               = [
                'title' => ucwords(str_replace("_"," ",$customReportKeys[3])),
                'data' => $this->getCustomReport($customReportKeys[3])
            ];
            $scratch_card_codes_redeemed_vs_total_registrants     = [
                'title' => ucwords(str_replace("_"," ",$customReportKeys[4])),
                'data' => $this->getCustomReport($customReportKeys[4])
            ];
            $reward_redemptions                          = [
                'title' => ucwords(str_replace("_"," ",$customReportKeys[5])),
                'data' => [
                    'rewards_redeemed'                   => $this->getCounters("rewards_redeemed"),
                    'rewards_redeemed_filtered'          => $this->getCounters("rewards_redeemed",[$from,$to]),
                    'unique_users_who_redeemed'          => $this->getCounters("unique_users_who_redeemed"),
                    'unique_users_who_redeemed_filtered' => $this->getCounters("unique_users_who_redeemed",[$from,$to]),
                    'all_time'                           => $this->getCustomReport($customReportKeys[5]),
                    'filtered'                           => $this->getCustomReport($customReportKeys[5],[
                                                        "from"  => $from,
                                                        "to"    => $to
                                                    ]),
                ]
            ];
            // dd($reward_redemptions);
            return view('admin.dashboard.index',compact(
                "counters",
                "common_reject_reason",
                "bumo_of_registrants",
                "common_reject_reasons",
                "daily_registration_trend",
                "profile_of_registrants",
                "scratch_card_codes_redeemed_vs_total_registrants",
                "reward_redemptions"
            ));
        } catch (\Exception $e){
             flashMessage($e->getMessage(),false);
             abort(422);
        }
    }
}
