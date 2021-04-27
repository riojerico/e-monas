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

        $loop_sumber_dana = DB::table('view_lkka_raw')
                        ->select('sumber_dana')
                        ->where('id_kodesatker',1)
                        ->groupBy('sumber_dana')
                        ->orderBy('sumber_dana','desc')
                        ->get();
        $count_loop_sd = count($loop_sumber_dana);
        
        $i0=0;
        $i=0;
        $i2=0;
        $i3=0;
        $i4=0;
        $i0=0;

        foreach ($list_aktivitas as $act) {

             

            for ($i_sd=0; $i_sd < $count_loop_sd ; $i_sd++) { 
                    
                ${'sum_anggaran'.$i_sd.$act->kode_act}[$i_sd] = DB::table('view_lkka_raw')
                            ->where('kode_act', $act->kode_act)
                            ->where('id_kodesatker',1)
                            ->where('sumber_dana', $loop_sumber_dana[$i_sd]->sumber_dana)
                            ->sum('anggaran');

                $sum_anggaran[] = 'sum_anggaran'.$i_sd.$act->kode_act;

                if ($loop_sumber_dana[$i_sd]->sumber_dana == 'RM') {
                    $kode_sd = 'A';                    
                }elseif ($loop_sumber_dana[$i_sd]->sumber_dana == 'PNBP') {
                    $kode_sd = 'D';                    
                }

                ${'sum_realisasi_anggaran'.$i_sd.$act->kode_act}[$i_sd] = DB::table('view_trans_sp2d_akun')
                            ->where('kegiatan', $act->kode_act)
                            ->where('id_kd_satker',1) 
                            ->where('ro','<>',null)
                            ->where('sumber_dana', $kode_sd) 
                            ->whereBetween('tanggal', [$first_day, $curr_month])
                            ->sum('nilai');

                $sum_realisasi_anggaran[] = 'sum_realisasi_anggaran'.$i_sd.$act->kode_act;

                ${'list_kro'.$i_sd.$act->kode_act}[$i_sd] = DB::table('view_lkka_raw')
                        ->select('kode_kro','kro','kode_ro','ro')
                        ->where('kode_act', $act->kode_act)
                        ->where('sumber_dana',$loop_sumber_dana[$i_sd]->sumber_dana)
                        ->groupBy('kode_kro')
                        ->get();
                $list_kro[] = 'list_kro'.$i_sd.$act->kode_act;

                foreach (${'list_kro'.$i_sd.$act->kode_act}[$i_sd] as $kro) {


                    ##
                    ${'list_ro'.$i_sd.$act->kode_act.$kro->kode_kro}[$i_sd] = DB::table('view_lkka_raw')
                            ->where('kode_act', $act->kode_act)
                            ->where('kode_kro', $kro->kode_kro)
                            ->where('sumber_dana',$loop_sumber_dana[$i_sd]->sumber_dana)
                            ->groupBy('kode_ro')
                            ->get();

                    $list_ro[] = 'list_ro'.$i_sd.$act->kode_act.$kro->kode_kro;

                    foreach (${'list_ro'.$i_sd.$act->kode_act.$kro->kode_kro}[$i_sd] as $ros) {
                        
                        ${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd] = DB::table('view_realisasi_fisik')
                                    ->where('kode_keg', $act->kode_act)
                                    ->where('kode_kro', $kro->kode_kro)
                                    ->where('kode_ro', $ros->kode_ro)
                                    ->get();

                        $volume[] = 'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro;

                        if (${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->satuan == 'Layanan' || ${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->satuan == 'layanan' ) {
                            ${'realisasi_fisik'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro} =  
                             (${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->jan+
                             ${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->feb+
                             ${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->mar+
                             ${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->apr+
                             ${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->mei+
                             ${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->jun+
                             ${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->jul+
                             ${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->ags+
                             ${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->sep+
                             ${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->okt+
                             ${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->nov+
                             ${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->des)/12;
                             $realisasi_fisik[] = 'realisasi_fisik'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro;
                        }else{
                            ${'realisasi_fisik'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro} =  
                             ${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->jan+
                             ${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->feb+
                             ${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->mar+
                             ${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->apr+
                             ${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->mei+
                             ${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->jun+
                             ${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->jul+
                             ${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->ags+
                             ${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->sep+
                             ${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->okt+
                             ${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->nov+
                             ${'volume_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd][0]->des;
                             $realisasi_fisik[] = 'realisasi_fisik'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro;
                        }

                        ${'realisasi_ro_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd] = DB::table('view_trans_sp2d_akun')
                                            ->where('kegiatan', $act->kode_act)
                                            ->where('kro', $kro->kode_kro)
                                            ->where('ro', $ros->kode_ro)
                                            ->where('ro','<>',null)
                                            ->where('sumber_dana',$kode_sd) 
                                            ->whereBetween('tanggal', [$first_day, $curr_month])
                                            ->sum('nilai');
                        $realisasi_ro[] = 'realisasi_ro_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro;

                        ${'anggaran_ro'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd] = DB::table('view_lkka_raw')
                                        ->where('kode_kro', $kro->kode_kro)
                                        ->where('kode_ro', $ros->kode_ro)
                                        ->where('sumber_dana', $loop_sumber_dana[$i_sd]->sumber_dana)
                                        ->groupBy('kode_ro')
                                        ->sum('anggaran');
                        $anggaran_ro[] = 'anggaran_ro'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro;

                         
                        ${'list_komponen'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd] = DB::table('view_lkka_raw')
                            ->select('kode_komponen','komponen')
                            ->where('kode_kro', $kro->kode_kro)
                            ->where('kode_ro', $ros->kode_ro)
                            ->where('sumber_dana',$loop_sumber_dana[$i_sd]->sumber_dana)
                            ->groupBy('kode_komponen')
                            ->get();

                        $list_komponen[] = 'list_komponen'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro;


                        foreach (${'list_komponen'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro}[$i_sd] as $komponen) {

                            ${'anggaran_komponen_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro.$komponen->kode_komponen}[$i_sd] = DB::table('view_lkka_raw')
                                            ->where('kode_komponen', $komponen->kode_komponen)
                                            ->where('kode_kro', $kro->kode_kro)
                                            ->where('kode_ro', $ros->kode_ro)
                                            ->where('sumber_dana',$loop_sumber_dana[$i_sd]->sumber_dana)
                                            ->groupBy('kode_komponen')
                                            ->sum('anggaran');
                                            
                            $anggaran_komponen[] = 'anggaran_komponen_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro.$komponen->kode_komponen;

                            ${'realisasi_ang_komponen_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro.$komponen->kode_komponen}[$i_sd] = DB::table('view_trans_sp2d_akun')
                                            ->where('kegiatan', $act->kode_act)
                                            ->where('kro', $kro->kode_kro)
                                            ->where('ro', $ros->kode_ro)
                                            ->where('komponen', $komponen->kode_komponen)
                                            ->where('ro','<>',null)
                                            ->where('sumber_dana', $kode_sd) 
                                            ->whereBetween('tanggal', [$first_day, $curr_month])
                                            ->sum('nilai');

                            $realisasi_ang_komponen[] = 'realisasi_ang_komponen_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro.$komponen->kode_komponen;

                            ${'list_subkomponen'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro.$komponen->kode_komponen}[$i_sd] = DB::table('view_lkka_raw')
                                            ->select('kode_subkomponen','subkomponen','id_sub')
                                            ->where('kode_komponen', $komponen->kode_komponen)
                                            ->where('kode_kro', $kro->kode_kro)
                                            ->where('kode_ro', $ros->kode_ro)
                                            ->where('sumber_dana',$loop_sumber_dana[$i_sd]->sumber_dana)
                                            ->groupBy('kode_subkomponen')
                                            ->get();

                            $list_subkomponen[] = 'list_subkomponen'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro.$komponen->kode_komponen;

                            foreach (${'list_subkomponen'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro.$komponen->kode_komponen}[$i_sd] as $subkomponen) {
                               
                                    ${'anggaran_subkomponen_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro.$komponen->kode_komponen.$subkomponen->kode_subkomponen}[$i_sd] = DB::table('view_lkka_raw')
                                            ->where('id_sub', $subkomponen->id_sub)
                                            ->where('kode_komponen', $komponen->kode_komponen)
                                            ->where('kode_kro', $kro->kode_kro)
                                            ->where('kode_ro', $ros->kode_ro)
                                            ->where('sumber_dana',$loop_sumber_dana[$i_sd]->sumber_dana)
                                            ->orderBy('kode_subkomponen')
                                            ->sum('anggaran');

                                    $anggaran_subkomponen[] = 'anggaran_subkomponen_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro.$komponen->kode_komponen.$subkomponen->kode_subkomponen;

                                    ${'real_subkomponen_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro.$komponen->kode_komponen.$subkomponen->kode_subkomponen}[$i_sd] = DB::table('view_trans_sp2d_akun')
                                            ->where('kegiatan', $act->kode_act)
                                            ->where('kro', $kro->kode_kro)
                                            ->where('ro', $kro->kode_ro)
                                            ->where('komponen', $komponen->kode_komponen)
                                            ->where('subkomponen', $subkomponen->kode_subkomponen)
                                            ->where('ro','<>',null)
                                            ->where('sumber_dana', $kode_sd) 
                                            ->whereBetween('tanggal', [$first_day, $curr_month])
                                            ->sum('nilai');

                                    $real_subkomponen[] = 'real_subkomponen_'.$i_sd.$act->kode_act.$kro->kode_kro.$ros->kode_ro.$komponen->kode_komponen.$subkomponen->kode_subkomponen;
                            }
                            /** endfor Sub Komponen **/

                        } 
                        /** endfor Komponen **/

                    }
                    /** endfor ro **/
                    ##

                    
                $i2++;
                }
                /** endfor KRO **/
            }
            /** endfor Sumber Dana **/

                                   
            
            $i++;
        }
        //endfor Aktivitas

        // dd($list_subkomponen15527EAB002051);
        // dd($realisasi_fisik05527EAA001);
           // dd($list_subkomponen);

            
        //die();
         // dd($real_subkomponen);

        return view('pages.laporan.monev', 
            compact('list_aktivitas','loop_sumber_dana'
                 ,$sum_anggaran, $sum_realisasi_anggaran
                 ,$list_kro
                 ,$list_ro, $volume, $realisasi_fisik
                 ,$realisasi_ro, $anggaran_ro
                 ,$list_komponen, $anggaran_komponen, $realisasi_ang_komponen
                 ,$list_subkomponen, $anggaran_subkomponen, $real_subkomponen
                 
                )
        );
    }
}
