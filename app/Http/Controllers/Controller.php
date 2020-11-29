<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Visit;
use App\Category;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function data()
    {
        $categories=[];
        $categories_labels=[];
        $categories_values=[];

        $all_categories=Category::get();
        foreach ($all_categories as $category) {
            foreach ($category->news as $new) {
                if (array_key_exists($category->slug, $categories)) {
                    $categories[$category->slug]['value']=$categories[$category->slug]['value']+count($new->visits);
                } else {
                    $categories[$category->slug]=array('name' => $category->name, 'value' => count($new->visits));
                }
            }
        }

        $num=0;
        usort($categories, function($a, $b) {
            return $a['value'] - $b['value'];
        });
        $categories=array_reverse($categories);

        $categories_labels="";
        foreach ($categories as $category) {
            if ($num<5) {
                $categories_labels.='"'.$category['name'].'",';
                $categories_values[$num]=$category['value'];
                $num++;
            }
        }
        $categories_labels=substr($categories_labels, 0, -1);

        $today=date('D');
        $week_days='"'.date("D",strtotime($today."- 6 days")).'", "'.date("D",strtotime($today."- 5 days")).'", "'.date("D",strtotime($today."- 4 days")).'", "'.date("D",strtotime($today."- 3 days")).'", "'.date("D",strtotime($today."- 2 days")).'", "'.date("D",strtotime($today."- 1 days")).'", "'.$today.'"';

        $month=date('d-m-Y');
        $month_year='"'.date("M",strtotime($month."- 11 month")).'", "'.date("M",strtotime($month."- 10 month")).'", "'.date("M",strtotime($month."- 9 month")).'", "'.date("M",strtotime($month."- 8 month")).'", "'.date("M",strtotime($month."- 7 month")).'", "'.date("M",strtotime($month."- 6 month")).'", "'.date("M",strtotime($month."- 5 month")).'", "'.date("M",strtotime($month."- 4 month")).'", "'.date("M",strtotime($month."- 3 month")).'", "'.date("M",strtotime($month."- 2 month")).'", "'.date("M",strtotime($month."- 1 month")).'", "'.date("M",strtotime($month)).'"';

        $day=date('Y-m-d');
        $day_one=Visit::whereBetween('created_at', [date('Y-m-d')." 00:00:00", date('Y-m-d')." 23:59:59"])->count();
        $day_two=Visit::whereBetween('created_at', [date('Y-m-d',strtotime($day."- 1 days"))." 00:00:00", date('Y-m-d',strtotime($day."- 1 days"))." 23:59:59"])->count();
        $day_three=Visit::whereBetween('created_at', [date('Y-m-d',strtotime($day."- 2 days"))." 00:00:00", date('Y-m-d',strtotime($day."- 2 days"))." 23:59:59"])->count();
        $day_four=Visit::whereBetween('created_at', [date('Y-m-d',strtotime($day."- 3 days"))." 00:00:00", date('Y-m-d',strtotime($day."- 3 days"))." 23:59:59"])->count();
        $day_five=Visit::whereBetween('created_at', [date('Y-m-d',strtotime($day."- 4 days"))." 00:00:00", date('Y-m-d',strtotime($day."- 4 days"))." 23:59:59"])->count();
        $day_six=Visit::whereBetween('created_at', [date('Y-m-d',strtotime($day."- 5 days"))." 00:00:00", date('Y-m-d',strtotime($day."- 5 days"))." 23:59:59"])->count();
        $day_seven=Visit::whereBetween('created_at', [date('Y-m-d',strtotime($day."- 6 days"))." 00:00:00", date('Y-m-d',strtotime($day."- 6 days"))." 23:59:59"])->count();

        $month=date('Y-m');
        $month_one=Visit::whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->count();
        $month_two=Visit::whereYear('created_at', date('Y', strtotime($month."- 1 month")))->whereMonth('created_at', date('m', strtotime($month."- 1 month")))->count();
        $month_three=Visit::whereYear('created_at', date('Y', strtotime($month."- 2 month")))->whereMonth('created_at', date('m', strtotime($month."- 2 month")))->count();
        $month_four=Visit::whereYear('created_at', date('Y', strtotime($month."- 3 month")))->whereMonth('created_at', date('m', strtotime($month."- 3 month")))->count();
        $month_five=Visit::whereYear('created_at', date('Y', strtotime($month."- 4 month")))->whereMonth('created_at', date('m', strtotime($month."- 4 month")))->count();
        $month_six=Visit::whereYear('created_at', date('Y', strtotime($month."- 5 month")))->whereMonth('created_at', date('m', strtotime($month."- 5 month")))->count();
        $month_seven=Visit::whereYear('created_at', date('Y', strtotime($month."- 6 month")))->whereMonth('created_at', date('m', strtotime($month."- 6 month")))->count();
        $month_eight=Visit::whereYear('created_at', date('Y', strtotime($month."- 7 month")))->whereMonth('created_at', date('m', strtotime($month."- 7 month")))->count();
        $month_nine=Visit::whereYear('created_at', date('Y', strtotime($month."- 8 month")))->whereMonth('created_at', date('m', strtotime($month."- 8 month")))->count();
        $month_ten=Visit::whereYear('created_at', date('Y', strtotime($month."- 9 month")))->whereMonth('created_at', date('m', strtotime($month."- 9 month")))->count();
        $month_eleven=Visit::whereYear('created_at', date('Y', strtotime($month."- 10 month")))->whereMonth('created_at', date('m', strtotime($month."- 10 month")))->count();
        $month_twentytwo=Visit::whereYear('created_at', date('Y', strtotime($month."- 11 month")))->whereMonth('created_at', date('m', strtotime($month."- 11 month")))->count();

        $week_values=[$day_seven, $day_six, $day_five, $day_four, $day_three, $day_two, $day_one];
        $month_values=[$month_twentytwo, $month_eleven, $month_ten, $month_nine, $month_eight, $month_seven, $month_six, $month_five, $month_four, $month_three, $month_two, $month_one];

        return ['categories_labels' => $categories_labels, 'categories_values' => $categories_values, 'week_days' => $week_days, 'week_values' => $week_values, 'month_year' => $month_year, 'month_values' => $month_values];
    }
}
