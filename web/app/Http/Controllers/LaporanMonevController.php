<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LaporanMonevController extends Controller
{
    public function index(){

        $curr_year = date("Y");
        $first_day = date("Y-m-d", strtotime("first day of January"));
        $first_day_month = date("Y-m-d", strtotime("first day of this month"));
        $curr_month = date('Y-m-d');
        $prev_month = date('Y-m',strtotime("-1 month"));

    	$list_aktivitas = DB::table('view_lkka_raw')
    				->select('kode_act','nama_aktivitas')
    				->groupBy('kode_act')
    				->orderBy('kode_act')
    				->get();
    	
    	$i=0;
    	$i2=0;
    	$i3=0;
        $i4=0;
        $i0=0;

        $sumber_dana = DB::table('view_lkka_raw')
                        ->select('sumber_dana')
                        ->groupBy('sumber_dana')
                        ->orderBy('sumber_dana','desc')
                        ->get(); 

        foreach ($sumber_dana as $sd) {
            //$s_d[] = 
            //echo $sd->sumber_dana; 
            //echo "string";
        $i0++;                    
        }        


        	foreach ($list_aktivitas as $act) {


        		${'list_kro_rm'.$i} = DB::table('view_lkka_raw')
        				->select('kode_kro','kro','kode_ro','ro')
        				->where('kode_act', $act->kode_act)
        				->where('sumber_dana','RM')
        				->groupBy('kode_ro')
        				->get();
        		$list_kro_rm[] = ${'list_kro_rm'.$i};

        		foreach (${'list_kro_rm'.$i} as $kro) {

                    $anggaran_ro_rm[] = DB::table('view_lkka_raw')
                                    ->where('kode_kro', $kro->kode_kro)
                                    ->where('kode_ro', $kro->kode_ro)
                                    ->where('sumber_dana','RM')
                                    ->groupBy('kode_ro')
                                    ->sum('anggaran');

                    $real_ro_last_rm[] = DB::table('view_trans_sp2d_akun')
                                    ->where('kegiatan', $act->kode_act)
                                    ->where('ro', $kro->kode_ro)
                                    ->where('ro','<>',null)
                                    ->where('sumber_dana','A') 
                                    ->whereBetween('tanggal', [$first_day, $curr_month])
                                    ->sum('nilai');
                    

        			${'list_komponen_rm'.$i2} = DB::table('view_lkka_raw')
        				->select('kode_komponen','komponen')
        				->where('kode_kro', $kro->kode_kro)
                        ->where('kode_ro', $kro->kode_ro)
        				->where('sumber_dana','RM')
        				->groupBy('kode_komponen')
        				->get();

    	    		$list_komponen_rm[] = ${'list_komponen_rm'.$i2};

    	    		foreach (${'list_komponen_rm'.$i2} as $komponen) {

                        $anggaran_komponen_rm[] = DB::table('view_lkka_raw')
                                    ->where('kode_komponen', $komponen->kode_komponen)
                                    ->where('kode_kro', $kro->kode_kro)
                                    ->where('kode_ro', $kro->kode_ro)
                                    ->where('sumber_dana','RM')
                                    ->groupBy('kode_komponen')
                                    ->sum('anggaran');

                        $real_komponen_last_rm[] = DB::table('view_trans_sp2d_akun')
                                    ->where('kegiatan', $act->kode_act)
                                    ->where('ro', $kro->kode_ro)
                                    ->where('komponen', $komponen->kode_komponen)
                                    ->where('ro','<>',null)
                                    ->where('sumber_dana','A') 
                                    ->whereBetween('tanggal', [$first_day, $curr_month])
                                    ->sum('nilai');

    	    			${'list_subkomponen_rm'.$i3} = DB::table('view_lkka_raw')
                    				->select('kode_subkomponen','subkomponen','id_sub')
                    				->where('kode_komponen', $komponen->kode_komponen)
                                    ->where('kode_kro', $kro->kode_kro)
                                    ->where('kode_ro', $kro->kode_ro)
                    				->where('sumber_dana','RM')
                    				->groupBy('kode_subkomponen')
                    				->get();
    	    			$list_subkomponen_rm[] = ${'list_subkomponen_rm'.$i3};

                        foreach (${'list_subkomponen_rm'.$i3} as $subkomponen) {
                            $anggaran_subkomponen_rm[] = DB::table('view_lkka_raw')
                                    ->where('id_sub', $subkomponen->id_sub)
                                    ->orderBy('kode_subkomponen')
                                    ->sum('anggaran');

                            $real_subkomponen_last_rm[] = DB::table('view_trans_sp2d_akun')
                                    ->where('kegiatan', $act->kode_act)
                                    ->where('kro', $kro->kode_kro)
                                    ->where('ro', $kro->kode_ro)
                                    ->where('komponen', $komponen->kode_komponen)
                                    ->where('subkomponen', $subkomponen->kode_subkomponen)
                                    ->where('ro','<>',null)
                                    ->where('sumber_dana','A') 
                                    ->whereBetween('tanggal', [$first_day, $curr_month])
                                    ->sum('nilai');
                        $i4++;
                        }
    	    		$i3++;
    	    		}
    	    	$i2++;
    	    	}

        	$i++;
    	}
    	
    	 //dd($real_ro_last_rm);

    	return view('pages.laporan.monev', 
    		compact('list_aktivitas','list_kro_rm','list_komponen_rm','list_subkomponen_rm'
                ,'anggaran_ro_rm','anggaran_komponen_rm','anggaran_subkomponen_rm'
                ,'real_ro_last_rm','real_komponen_last_rm','real_subkomponen_last_rm'
                )
    	);
    }
}
