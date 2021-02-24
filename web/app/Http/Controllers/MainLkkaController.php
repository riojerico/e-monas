<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MainLkkaController extends Controller
{
    public function LKKA_View(){
    	$program = DB::table('view_lkka_raw')->select('id_prog','kode_prog','nama_program')->distinct()->orderBy('kode_prog')->get();

        $curr_year = date("Y");
        $first_day = date("Y-m-d", strtotime("first day of January"));
        $first_day_month = date("Y-m-d", strtotime("first day of this month"));
        $curr_month = date('Y-m-d');
        $prev_month = date('Y-m',strtotime("-1 month"));
        $lastdate_prevmonth = DB::table('view_trans_sp2d_akun')->select('tanggal')->where('tanggal','like', $prev_month.'%')->orderBy('tanggal','desc')->limit(1)->get();
        $res_lastdate_prevmonth = $lastdate_prevmonth[0]->tanggal;
                
        $i=0;
        $i2=0;
        $i3=0;
        $i4=0;
        $i5=0;
        $i6=0;
        $i7=0;

        foreach ($program as $prog) {
        	##pagu program
            $pagu_program[] = DB::table('view_lkka_raw')
            				->where('id_prog', $prog->id_prog)
            				->orderBy('id_prog')
            				->sum('anggaran');
            ##pagu program

        	####### Aktivitas ########
            ${'aktivitas'.$i} = DB::table('view_lkka_raw')
            				->select('id_prog_act','id_act','kode_act','nama_aktivitas')
            				->distinct()
				            ->where('id_prog_act', $prog->id_prog)
				            ->orderBy('kode_act')
				            ->get();
            $aktivitas[] = ${'aktivitas'.$i};
            ####### Aktivitas ########

            foreach (${'aktivitas'.$i} as $act) {

            	if (isset($act->id_act)) {
            		######## KRO ########
                    ${'kro'.$i2} = DB::table('view_lkka_raw')
                    				->select('kode_act','id_act','id_kro','kode_kro','kro')
                    				->distinct()
                    				->where('id_act', $act->id_act)
                    				->orderBy('kode_kro')
                    				->get();
                    $kro[] = ${'kro'.$i2};
                    ######## KRO ########
                    foreach (${'kro'.$i2} as $kros) {
                      	if (isset($kros->id_kro)) {
                      		######### RO ########
                            ${'ro'.$i3} = DB::table('view_lkka_raw')
                            			->select('kode_kro','id_kro','id_ro','kode_ro','ro')
                            			->distinct()
                            			->where('id_kro', $kros->id_kro)
                            			->orderBy('kode_ro')
                            			->get();
                            $ro[] = ${'ro'.$i3};
                            ######### RO ########
                            foreach (${'ro'.$i3} as $ros) {
                            	if (isset($ros->id_ro)) {
                            		## Komponen
	                                ${'komponen'.$i4} = DB::table('view_lkka_raw')
	                                ->select('kode_ro','id_ro','id_komp','kode_komponen','komponen')
	                                ->distinct()
	                                ->where('id_ro', $ros->id_ro)->orderBy('kode_komponen')
	                                ->get();
	                                $komponen[] = ${'komponen'.$i4};
	                                ## Komponen
	                                foreach (${'komponen'.$i4} as $komp) {
                                        if (isset($komp->kode_komponen)) {
                                        ## Subkomponen
                                        ${'subkomponen'.$i5} = DB::table('view_lkka_raw')
                                        ->select('kode_komponen','id_komp','id_sub','kode_subkomponen','subkomponen')
                                        ->distinct()
                                        ->where('id_komp', $komp->id_komp)
                                        ->orderBy('kode_subkomponen')
                                        ->get();
                                        $subkomponen[] = ${'subkomponen'.$i5};
                                        ## Subkomponen
	                                        foreach (${'subkomponen'.$i5} as $sub) {
	                                        	if (isset($sub->kode_subkomponen)) {
	                                        		### AKUN
	                                        		${'akun'.$i6} = DB::table('view_lkka_raw')->select('view_lkka_raw.kode_subkomponen','view_lkka_raw.id_sub','view_lkka_raw.akun','view_lkka_raw.anggaran','view_lkka_raw.sumber_dana','rjw_akun.uraian')->distinct()->leftjoin('rjw_akun','rjw_akun.akun','=','view_lkka_raw.akun')->where('id_sub', $sub->id_sub)->orderBy('akun')->get();
                                            		$akuns[] = ${'akun'.$i6};
	                                        		### AKUN
	                                        		foreach (${'akun'.$i6} as $akun) {





	                                        		$i7++;
	                                        		}// end for akun
	                                        	} //endif subkomponen
	                                        $i6++;
	                                        } // endfor subkomponen
                                        } // endif komponen
	                                $i5++;	
	                                } // endfor komponen
                            	} // endif ro
                            $i4++;	
                            } // endfor ro
                      	} //endif kro
                    $i3++;
                    } // endfor kro  
            	} // endif act
            $i2++;
            } //endfor aktivitas
        $i++;
        } //endfor program

      return view('pages.lkka', compact(
            'program',
                'pagu_program',
                // 'real_prog_last','real_prog_curr','real_prog_tott',
            'aktivitas',
                // 'pagu_aktivitas',
                // 'real_act_last','real_act_curr','real_act_tott',
            'kro',
                // 'pagu_kro',
                // 'real_kro_last','real_kro_curr','real_kro_tott',
            'ro',
                // 'pagu_ro',
            'komponen',
                // 'pagu_komp',
            'subkomponen',
                // 'pagu_sub',
            'akuns',
                // 'real_akun_last','real_akun_curr','real_akun_tott'
        ));

    }


    



}
