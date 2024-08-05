<?php

namespace App\Composers;

use Illuminate\View\View;
use DB;

class ChartsListDataComposer
{

    public function compose(View $view,)
    {


        $data = [];
        $data['total_funds'] = DB::table('ifn_funds as f')->where('f.fund_status', 'confirmed')->count();
        $data['total_amount_funds'] = number_format(DB::table('ifn_funds as f')->where('f.fund_status', 'confirmed')->sum('f.fund_expense_ratio'), 2);
        $data['total_companies'] = DB::table('ifn_companies as c')->count();

        $r_results = DB::table('ifn_funds as f')
            ->select('c.region as region', DB::raw('count(f.fund_id) as count'))
            ->join('ifn_country as c', 'c.iso', '=', 'f.fund_country')
            ->groupBy('c.region')
            ->get();

        $asset_results = DB::table('ifn_funds as f')
            ->select('f.asset_class as asset_class', DB::raw('count(f.asset_class) as count'))
            ->where('f.asset_class', '<>', null)
            ->groupBy('f.asset_class')
            ->get();

        $process_data = [];
        $fill_colors = array('#015130', '#145BBD', '#00768C', '#800000', '#FFD236', '#FDEAEA');
        $stroke_colors = array('#015130', '#145BBD', '#00768C', '#800000', '#FFD236', '#800000');
        $legend_colors = array('#015130', '#145BBD', '#00768C', '#800000', '#FFD236', '#FDEAEA');
        
        foreach($r_results as $k => $res ){
            $process_data['label'][$k] = $res->region;
            $process_data['series'][$k] = $res->count;
            $process_data['fill_colors'][$k] = $fill_colors[$k];
            $process_data['stroke_colors'][$k] = $stroke_colors[$k];
            $process_data['legend_colors'][$k] = $legend_colors[$k];
        }


        $chartRessultdata = array(
            'series' => $process_data['series'],
            'labels' => $process_data['label'],
            'fill' => array(
                'opacity' => 1,
                'colors' => $process_data['fill_colors']
            ),
            'stroke' => array(
                'width' => 1,
                'colors' =>$process_data['stroke_colors']
            ),
            'legend' => array(
                'position' => 'top',
                'markers' => array(
                    'fillColors' => $process_data['legend_colors']
                )
            )
        );

        $view->with('reports', $data)
        ->with('chart_data', $chartRessultdata);
    }
}
