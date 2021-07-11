<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MainLkkaController extends Controller
{
    public function LKKA_View(Request $request){




    	$program = DB::table('view_lkka_raw')->select('id_prog','kode_prog','nama_program')->distinct()->orderBy('kode_prog')->get();

        $curr_year = date("Y");
        $first_day = date("Y-m-d", strtotime("first day of January"));
        $first_day_month = date("Y-m-d", strtotime("first day of this month"));

        if (isset($request->month)) {
            $curr_month = date('Y-'.$request->month.'-t');
            $prev_month = date('Y-'.$request->month,strtotime("-1 month"));
            $month_select = $request->month;
        }else{
            $curr_month = date('Y-m-d'); 
            $prev_month = date('Y-m',strtotime("-1 month"));
            $month_select = '';
        }
        

        

        $curr_month_only = date('m');

        //view_trans_sp2d_akun untuk ambil data realisasi dari sp2d SPAN
        $trans_sp2d_akun = DB::table('view_trans_sp2d_akun')->get();

        if (isset($trans_sp2d_akun[0]->akun)) {
            $lastdate_prevmonth = DB::table('view_trans_sp2d_akun')->select('tanggal')->where('tanggal','like', $prev_month.'%')->orderBy('tanggal','desc')->limit(1)->get();
            if (empty($lastdate_prevmonth[0]->tanggal)) {
                $res_lastdate_prevmonth = $prev_month.'-01';                
            }else{
                $res_lastdate_prevmonth = $lastdate_prevmonth[0]->tanggal;
            }
        }else{
            
           
          
        }
        

        // dd($trans_sp2d_akun);

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
            				->orderBy('kode_prog')
            				->sum('anggaran');
            ##pagu program

            if (isset($trans_sp2d_akun[0]->akun)) {
            ## Realisasi sampai dengan bulan lalu
            $real_prog_last[] = DB::table('view_trans_sp2d_akun')
                                ->where('program', $prog->kode_prog)
                                ->where('ro','<>',null)
                                ->whereBetween('tanggal', [$first_day, $res_lastdate_prevmonth])
                                ->sum('nilai');
            
            ## Realisasi sampai dengan bulan lalu

            ## Realisasi sampai dengan bulan ini
            $real_prog_curr[] = DB::table('view_trans_sp2d_akun')
                                ->where('program', $prog->kode_prog)
                                ->where('ro','<>',null)
                                ->whereBetween('tanggal', [$first_day_month, $curr_month])
                                ->sum('nilai');
            ## Realisasi sampai dengan bulan ini

            ## Realisasi total
            $real_prog_tott[] = DB::table('view_trans_sp2d_akun')
                                ->where('program', $prog->kode_prog)
                                ->where('ro','<>',null)
                                ->whereBetween('tanggal', [$first_day, $curr_month])
                                ->sum('nilai');
            ## Realisasi total
            }else{
                $real_prog_last[] = 0;
                $real_prog_curr[] = 0;
                $real_prog_tott[] = 0;
            }




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
            	##pagu aktivitas
            	if ($act->id_act) {

                    if (isset($trans_sp2d_akun[0]->akun)) {
                    ## Realisasi sampai dengan bulan lalu
                    $real_act_last[] = DB::table('view_trans_sp2d_akun')
                    ->where('kegiatan', $act->kode_act)
                    ->where('program', $prog->kode_prog)
                    ->where('ro','<>',null)
                    ->whereBetween('tanggal', [$first_day, $res_lastdate_prevmonth])
                    ->sum('nilai');
                    ## Realisasi sampai dengan bulan lalu

                    ## Realisasi sampai dengan bulan ini
                    $real_act_curr[] = DB::table('view_trans_sp2d_akun')
                    ->where('kegiatan', $act->kode_act)
                    ->where('program', $prog->kode_prog)
                    ->where('ro','<>',null)
                    ->whereBetween('tanggal', [$first_day_month, $curr_month])
                    ->sum('nilai');
                    ## Realisasi sampai dengan bulan ini

                    ## Realisasi total
                    $real_act_tott[] = DB::table('view_trans_sp2d_akun')
                    ->where('kegiatan', $act->kode_act)
                    ->where('program', $prog->kode_prog)
                    ->where('ro','<>',null)
                    ->whereBetween('tanggal', [$first_day, $curr_month])
                    ->sum('nilai');
                    ## Realisasi total
                    }else{
                        $real_act_last[] = 0;
                        $real_act_curr[] = 0;
                        $real_act_tott[] = 0;
                    }

            		$pagu_aktivitas[] = DB::table('view_lkka_raw')
	            				->where('id_act', $act->id_act)
	            				->orderBy('kode_act')
	            				->sum('anggaran');
            	}	            
	            ##pagu aktivitas

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
                    
                    ##pagu kro
                    if ($kros->id_kro) {

                        if (isset($trans_sp2d_akun[0]->akun)) {
                        ## Realisasi sampai dengan bulan lalu
                        $real_kro_last[] = DB::table('view_trans_sp2d_akun')
                        ->where('kro', $kros->kode_kro)
                        ->where('kegiatan', $act->kode_act)
                        ->where('program', $prog->kode_prog)
                        ->where('ro','<>',null)
                        ->whereBetween('tanggal', [$first_day, $res_lastdate_prevmonth])
                        ->sum('nilai');
                        ## Realisasi sampai dengan bulan lalu

                        ## Realisasi sampai dengan bulan ini
                        $real_kro_curr[] = DB::table('view_trans_sp2d_akun')
                        ->where('kro', $kros->kode_kro)
                        ->where('kegiatan', $act->kode_act)
                        ->where('program', $prog->kode_prog)
                        ->where('ro','<>',null)
                        ->whereBetween('tanggal', [$first_day_month, $curr_month])
                        ->sum('nilai');
                        ## Realisasi sampai dengan bulan ini

                        ## Realisasi total
                        $real_kro_tott[] = DB::table('view_trans_sp2d_akun')
                        ->where('kro', $kros->kode_kro)
                        ->where('kegiatan', $act->kode_act)
                        ->where('program', $prog->kode_prog)
                        ->where('ro','<>',null)
                        ->whereBetween('tanggal', [$first_day, $curr_month])
                        ->sum('nilai');
                        ## Realisasi total
                        }else{
                            $real_kro_last[] = 0;
                            $real_kro_curr[] = 0;
                            $real_kro_tott[] = 0;
                        }

                    	$pagu_kro[] = DB::table('view_lkka_raw')
		            				->where('id_kro', $kros->id_kro)
		            				->orderBy('kode_kro')
		            				->sum('anggaran');		            	
                    }
		            ##pagu kro

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

                            ##pagu ro
		                    if (isset($ros->id_ro)) {

                                if (isset($trans_sp2d_akun[0]->akun)) {
                                ## Realisasi sampai dengan bulan lalu
                                $real_ro_last[] = DB::table('view_trans_sp2d_akun')
                                ->where('ro', $ros->kode_ro)
                                ->where('kro', $kros->kode_kro)
                                ->where('kegiatan', $act->kode_act)
                                ->where('program', $prog->kode_prog)
                                ->whereBetween('tanggal', [$first_day, $res_lastdate_prevmonth])
                                ->sum('nilai');
                                ## Realisasi sampai dengan bulan lalu

                                ## Realisasi sampai dengan bulan ini
                                $real_ro_curr[] = DB::table('view_trans_sp2d_akun')
                                ->where('ro', $ros->kode_ro)
                                ->where('kro', $kros->kode_kro)
                                ->where('kegiatan', $act->kode_act)
                                ->where('program', $prog->kode_prog)
                                ->whereBetween('tanggal', [$first_day_month, $curr_month])
                                ->sum('nilai');
                                ## Realisasi sampai dengan bulan ini

                                ## Realisasi total
                                $real_ro_tott[] = DB::table('view_trans_sp2d_akun')
                                ->where('ro', $ros->kode_ro)
                                ->where('kro', $kros->kode_kro)
                                ->where('kegiatan', $act->kode_act)
                                ->where('program', $prog->kode_prog)
                                ->whereBetween('tanggal', [$first_day, $curr_month])
                                ->sum('nilai');
                                ## Realisasi total
                                }else{
                                    $real_ro_last[] = 0;
                                    $real_ro_curr[] = 0;
                                    $real_ro_tott[] = 0;
                                }

		                    	$pagu_ro[] = DB::table('view_lkka_raw')
				            				->where('id_ro', $ros->id_ro)
				            				->orderBy('kode_ro')
				            				->sum('anggaran');		            	
		                    }
				            ##pagu ro

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
	                                ##pagu komponen
				                    if (isset($komp->id_komp)) {

                                        if (isset($trans_sp2d_akun[0]->akun)) {
                                        ## Realisasi sampai dengan bulan lalu
                                        $real_komp_last[] = DB::table('view_trans_sp2d_akun')
                                        ->where('komponen', $komp->kode_komponen)
                                        ->where('ro', $ros->kode_ro)
                                        ->where('kro', $kros->kode_kro)
                                        ->where('kegiatan', $act->kode_act)
                                        ->where('program', $prog->kode_prog)
                                        ->whereBetween('tanggal', [$first_day, $res_lastdate_prevmonth])
                                        ->sum('nilai');
                                        ## Realisasi sampai dengan bulan lalu

                                        ## Realisasi sampai dengan bulan ini
                                        $real_komp_curr[] = DB::table('view_trans_sp2d_akun')
                                        ->where('komponen', $komp->kode_komponen)
                                        ->where('ro', $ros->kode_ro)
                                        ->where('kro', $kros->kode_kro)
                                        ->where('kegiatan', $act->kode_act)
                                        ->where('program', $prog->kode_prog)
                                        ->whereBetween('tanggal', [$first_day_month, $curr_month])
                                        ->sum('nilai');
                                        ## Realisasi sampai dengan bulan ini

                                        ## Realisasi total
                                        $real_komp_tott[] = DB::table('view_trans_sp2d_akun')
                                        ->where('komponen', $komp->kode_komponen)
                                        ->where('ro', $ros->kode_ro)
                                        ->where('kro', $kros->kode_kro)
                                        ->where('kegiatan', $act->kode_act)
                                        ->where('program', $prog->kode_prog)
                                        ->whereBetween('tanggal', [$first_day, $curr_month])
                                        ->sum('nilai');
                                        ## Realisasi total
                                        }else{
                                            $real_komp_last[] = 0;
                                            $real_komp_curr[] = 0;
                                            $real_komp_tott[] = 0;
                                        }

				                    	$pagu_komponen[] = DB::table('view_lkka_raw')
						            				->where('id_komp', $komp->id_komp)
						            				->orderBy('kode_komponen')
						            				->sum('anggaran');		            	
				                    }
						            ##pagu komponen

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
	                                        ##pagu komponen
						                    if (isset($sub->id_sub)) {
                                                ### jika merupakan gaji tidak perlu cek komponen
                                                ${'cek_trans_sp2d_akun'.$i6} = DB::table('view_trans_sp2d_akun')
                                                ->get();
                                                

                                                    if (isset($trans_sp2d_akun[0]->akun)) {
                                                    ## Realisasi sampai dengan bulan lalu
                                                    $real_sub_last[] = DB::table('view_trans_sp2d_akun')
                                                    ->where('subkomponen', $sub->kode_subkomponen)
                                                    ->where('komponen', $komp->kode_komponen)
                                                    ->where('ro', $ros->kode_ro)
                                                    ->where('kro', $kros->kode_kro)
                                                    ->where('kegiatan', $act->kode_act)
                                                    ->where('program', $prog->kode_prog)
                                                    ->whereBetween('tanggal', [$first_day, $res_lastdate_prevmonth])
                                                    ->sum('nilai');
                                                    ## Realisasi sampai dengan bulan lalu

                                                    ## Realisasi sampai dengan bulan ini
                                                    $real_sub_curr[] = DB::table('view_trans_sp2d_akun')
                                                    ->where('subkomponen', $sub->kode_subkomponen)
                                                    ->where('komponen', $komp->kode_komponen)
                                                    ->where('ro', $ros->kode_ro)
                                                    ->where('kro', $kros->kode_kro)
                                                    ->where('kegiatan', $act->kode_act)
                                                    ->where('program', $prog->kode_prog)
                                                    ->whereBetween('tanggal', [$first_day_month, $curr_month])
                                                    ->sum('nilai');
                                                    ## Realisasi sampai dengan bulan ini

                                                    ## Realisasi total
                                                    $real_sub_tott[] = DB::table('view_trans_sp2d_akun')
                                                    ->where('subkomponen', $sub->kode_subkomponen)
                                                    ->where('komponen', $komp->kode_komponen)
                                                    ->where('ro', $ros->kode_ro)
                                                    ->where('kro', $kros->kode_kro)
                                                    ->where('kegiatan', $act->kode_act)
                                                    ->where('program', $prog->kode_prog)
                                                    ->whereBetween('tanggal', [$first_day, $curr_month])
                                                    ->sum('nilai');
                                                    ## Realisasi total
                                                    }else{
                                                        $real_sub_last[] = 0;
                                                        $real_sub_curr[] = 0;
                                                        $real_sub_tott[] = 0;
                                                    }



						                    	$pagu_subkomponen[] = DB::table('view_lkka_raw')
								            				->where('id_sub', $sub->id_sub)
								            				->orderBy('kode_subkomponen')
								            				->sum('anggaran');
                                                		            	
						                    }
								            ##pagu komponen

	                                        	if (isset($sub->kode_subkomponen)) {
	                                        		### AKUN
	                                        		${'akun'.$i6} = DB::table('view_lkka_raw')->select('view_lkka_raw.kode_subkomponen','view_lkka_raw.id_sub','view_lkka_raw.akun','view_lkka_raw.anggaran','view_lkka_raw.sumber_dana','rjw_akun.uraian')->distinct()->leftjoin('rjw_akun','rjw_akun.akun','=','view_lkka_raw.akun')->where('id_sub', $sub->id_sub)->orderBy('akun')->get();
                                            		$akuns[] = ${'akun'.$i6};
	                                        		### AKUN
	                                        		foreach (${'akun'.$i6} as $akun) {


                                                    if (isset($trans_sp2d_akun[0]->akun)) {
                                                    ## Realisasi sampai dengan bulan lalu
                                                    $real_akun_last[] = DB::table('view_trans_sp2d_akun')
                                                    ->where('akun', $akun->akun)
                                                    ->where('subkomponen', $sub->kode_subkomponen)
                                                    ->where('komponen', $komp->kode_komponen)
                                                    ->where('ro', $ros->kode_ro)
                                                    ->where('kro', $kros->kode_kro)
                                                    ->where('kegiatan', $act->kode_act)
                                                    ->where('program', $prog->kode_prog)
                                                    ->whereBetween('tanggal', [$first_day, $res_lastdate_prevmonth])
                                                    ->sum('nilai');
                                                    ## Realisasi sampai dengan bulan lalu
                                                    
                                                    ## Realisasi sampai dengan bulan ini
                                                    $real_akun_curr[] = DB::table('view_trans_sp2d_akun')
                                                    ->where('akun', $akun->akun)
                                                    ->where('subkomponen', $sub->kode_subkomponen)
                                                    ->where('komponen', $komp->kode_komponen)
                                                    ->where('ro', $ros->kode_ro)
                                                    ->where('kro', $kros->kode_kro)
                                                    ->where('kegiatan', $act->kode_act)
                                                    ->where('program', $prog->kode_prog)
                                                    ->whereBetween('tanggal', [$first_day_month, $curr_month])
                                                    ->sum('nilai');
                                                    ## Realisasi sampai dengan bulan ini

                                                    ## Realisasi total
                                                    $real_akun_tott[] = DB::table('view_trans_sp2d_akun')
                                                    ->where('akun', $akun->akun)
                                                    ->where('subkomponen', $sub->kode_subkomponen)
                                                    ->where('komponen', $komp->kode_komponen)
                                                    ->where('ro', $ros->kode_ro)
                                                    ->where('kro', $kros->kode_kro)
                                                    ->where('kegiatan', $act->kode_act)
                                                    ->where('program', $prog->kode_prog)
                                                    ->whereBetween('tanggal', [$first_day, $curr_month])
                                                    ->sum('nilai');
                                                    ## Realisasi total
                                                    }else{ 
                                                        $real_akun_last[] = 0;
                                                        $real_akun_curr[] = 0;
                                                        $real_akun_tott[] = 0;
                                                    }





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
            'curr_month_only','month_select',
            'program',
                'pagu_program',
                'real_prog_last','real_prog_curr','real_prog_tott',
            'aktivitas',
                'pagu_aktivitas',
                'real_act_last','real_act_curr','real_act_tott',
            'kro',
                'pagu_kro',
                'real_kro_last','real_kro_curr','real_kro_tott',
            'ro',
                'pagu_ro',
                'real_ro_last','real_ro_curr','real_ro_tott',
            'komponen',
                'pagu_komponen',
                'real_komp_last','real_komp_curr','real_komp_tott',
            'subkomponen',
                'pagu_subkomponen',
                'real_sub_last','real_sub_curr','real_sub_tott',
            'akuns',
                'real_akun_last','real_akun_curr','real_akun_tott'
        ));

    }






}
