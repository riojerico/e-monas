<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomepageController extends Controller
{
    public function index(){
    	$month = date('m');

    	$pagu_dipa = DB::table('view_lkka_raw')
    				->where('id_kodesatker', 1)
    				->sum('anggaran');

    	$pagu_rm = DB::table('view_lkka_raw')
    				->where('id_kodesatker', 1)
    				->where('sumber_dana', 'RM')
    				->sum('anggaran');

    	$pagu_pnbp = DB::table('view_lkka_raw')
    				->where('id_kodesatker', 1)
    				->where('sumber_dana', 'PNBP')    				
    				->sum('anggaran');

    	$penyerapan = DB::table('view_trans_sp2d_akun')
    				->where('id_kd_satker', 1)
    				->where('ro', '!=','')
    				->where('program', '!=','000.00.00')    				
    				->sum('nilai');

    	$persen_penyerapan = $penyerapan/$pagu_dipa*100; 
    	//$users = Auth::user();
        // dd($persen_penyerapan);

    	$year = date('Y-0');


    	for ($i=1; $i <= $month ; $i++) {     		
    		$penyerapan_chart_rm[] = DB::table('view_trans_sp2d_akun')
        				->where('tanggal','like',$year.''.$i.'%')
        				->where('id_kd_satker',1)
        				->where('sumber_dana','A')
        				->where('ro', '!=','')
        				->sum('nilai');

        	$penyerapan_chart_pnbp[] = DB::table('view_trans_sp2d_akun')
        				->where('tanggal','like',$year.''.$i.'%')
        				->where('id_kd_satker',1)
        				->where('sumber_dana','D')
        				->where('ro', '!=','')
        				->sum('nilai');

        	//$bulan[] = $i;
        	if ($i==1) {
        		$bulan_raw = 'Jan';
        	}elseif ($i==2) {
        		$bulan_raw = 'Feb';
        	}elseif ($i==3) {
        		$bulan_raw = 'Mar';
        	}elseif ($i==4) {
        		$bulan_raw = 'Apr';
        	}elseif ($i==5) {
        		$bulan_raw = 'Mei';
        	}elseif ($i==6) {
        		$bulan_raw = 'Jun';
        	}elseif ($i==7) {
        		$bulan_raw = 'Jul';
        	}elseif ($i==8) {
        		$bulan_raw = 'Ags';
        	}elseif ($i==9) {
        		$bulan_raw = 'Sep';
        	}elseif ($i==10) {
        		$bulan_raw = 'Okt';
        	}elseif ($i==11) {
        		$bulan_raw = 'Nov';
        	}elseif ($i==12) {
        		$bulan_raw = 'Des';
        	}

        	$bulan[] = $bulan_raw;


    	}
    	//dd($penyerapan_chart_rm);
    	$res = array_merge($penyerapan_chart_rm,$penyerapan_chart_pnbp);
    	$max = max($res);
        return view('pages.home', compact(
        	'pagu_dipa','pagu_rm','pagu_pnbp','penyerapan','persen_penyerapan',
        	'penyerapan_chart_rm','penyerapan_chart_pnbp','bulan','max'
        ));

    }


}
