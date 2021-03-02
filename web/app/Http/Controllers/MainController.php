<?php

namespace App\Http\Controllers;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

use Illuminate\Http\Request;
use DB;
use Auth;
	  
class MainController extends Controller
{


    public function __construct(){
     
    }

    public function dashboard(){
        $users = Auth::user();
        
        
        return view('pages.home');
    }   

    public function lkka_view(){
        $program = DB::table('view_lkka_raw')
                ->select('id_prog','kode_prog','nama_program')
                ->distinct()
                ->orderBy('kode_prog')
                ->get();
        $i=0;
        $i2=0;
        $i3=0;
        $i4=0;
        $i5=0;
        $i6=0;
        $i7=0;


        $curr_year = date("Y");
        $first_day = date("Y-m-d", strtotime("first day of January"));
        $first_day_month = date("Y-m-d", strtotime("first day of this month"));
        $curr_month = date('Y-m-d');
        $prev_month = date('Y-m',strtotime("-1 month"));
        $lastdate_prevmonth = DB::table('view_trans_sp2d_akun')
                            ->select('tanggal')
                            ->where('tanggal','like', $prev_month.'%')
                            ->orderBy('tanggal','desc')
                            ->limit(1)
                            ->get();
        $res_lastdate_prevmonth = $lastdate_prevmonth[0]->tanggal;
                

        foreach ($program as $prog) {
            ##pagu program
            $pagu_program[] = DB::table('view_lkka_raw')
                                ->where('id_prog', $prog->id_prog)
                                ->orderBy('id_prog')
                                ->sum('anggaran');
            ##pagu program

            ## Realisasi sampai dengan bulan lalu
            $real_prog_last[] = DB::table('view_trans_sp2d_akun')
                                ->where('program', $prog->kode_prog)
                                ->whereBetween('tanggal', [$first_day, $res_lastdate_prevmonth])
                                ->sum('nilai');
            ## Realisasi sampai dengan bulan lalu

            ## Realisasi sampai dengan bulan ini
            $real_prog_curr[] = DB::table('view_trans_sp2d_akun')
                                ->where('program', $prog->kode_prog)
                                ->whereBetween('tanggal', [$first_day_month, $curr_month])
                                ->sum('nilai');
            ## Realisasi sampai dengan bulan ini

            ## Realisasi total
            $real_prog_tott[] = DB::table('view_trans_sp2d_akun')
                                ->where('program', $prog->kode_prog)
                                ->whereBetween('tanggal', [$first_day, $curr_month])
                                ->sum('nilai');
            ## Realisasi total


            ##Aktivitas
            ${'aktivitas'.$i} = DB::table('view_lkka_raw')->select('id_prog_act','id_act','kode_act','nama_aktivitas')->distinct()->where('id_prog_act', $prog->id_prog)->orderBy('kode_act')->get();
            $aktivitas[] = ${'aktivitas'.$i};
            ##Aktivitas
           
            foreach (${'aktivitas'.$i} as $act) {
             $pagu_aktivitas[] = DB::table('view_lkka_raw')->where('id_act', $act->id_act)->orderBy('kode_act')->sum('anggaran'); 

            ## Realisasi sampai dengan bulan lalu
            $real_act_last[] = DB::table('view_trans_sp2d_akun')->where('kegiatan', $act->kode_act)->whereBetween('tanggal', [$first_day, $res_lastdate_prevmonth])->sum('nilai');
            ## Realisasi sampai dengan bulan lalu

            ## Realisasi sampai dengan bulan ini
            $real_act_curr[] = DB::table('view_trans_sp2d_akun')->where('kegiatan', $act->kode_act)->whereBetween('tanggal', [$first_day_month, $curr_month])->sum('nilai');
            ## Realisasi sampai dengan bulan ini

            ## Realisasi total
            $real_act_tott[] = DB::table('view_trans_sp2d_akun')->where('kegiatan', $act->kode_act)->whereBetween('tanggal', [$first_day, $curr_month])->sum('nilai');
            ## Realisasi total  

                if (isset($act->id_act)) {
                    ##KRO
                    ${'kro'.$i2} = DB::table('view_lkka_raw')->select('kode_act','id_act','id_kro','kode_kro','kro')->distinct()->where('id_act', $act->id_act)->orderBy('kode_kro')->get();
                    $kro[] = ${'kro'.$i2};
                    ##KRO                   

                    foreach (${'kro'.$i2} as $kros) {
                        $pagu_kro[] = DB::table('view_lkka_raw')->where('id_kro', $kros->id_kro)->orderBy('id_kro')->sum('anggaran');

                        ## Realisasi sampai dengan bulan lalu
                        $real_kro_last[] = DB::table('view_trans_sp2d_akun')->where('kro', $kros->kode_kro)->whereBetween('tanggal', [$first_day, $res_lastdate_prevmonth])->sum('nilai');
                        ## Realisasi sampai dengan bulan lalu

                        ## Realisasi sampai dengan bulan ini
                        $real_kro_curr[] = DB::table('view_trans_sp2d_akun')->where('kro', $kros->kode_kro)->whereBetween('tanggal', [$first_day_month, $curr_month])->sum('nilai');
                        ## Realisasi sampai dengan bulan ini

                        ## Realisasi total
                        $real_kro_tott[] = DB::table('view_trans_sp2d_akun')->where('kro', $kros->kode_kro)->whereBetween('tanggal', [$first_day, $curr_month])->sum('nilai');
                        ## Realisasi total

                        if (isset($kros->id_kro)) {
                            # RO
                            ${'ro'.$i3} = DB::table('view_lkka_raw')->select('kode_kro','id_kro','id_ro','kode_ro','ro')->distinct()->where('id_kro', $kros->id_kro)->orderBy('kode_ro')->get();
                            $ro[] = ${'ro'.$i3};
                            # RO 

                            foreach (${'ro'.$i3} as $ros) {
                                $pagu_ro[] = DB::table('view_lkka_raw')->where('id_ro', $ros->id_ro)->orderBy('kode_ro')->sum('anggaran');

                                if (isset($ros->kode_ro)) {
                                ## Komponen
                                ${'komponen'.$i4} = DB::table('view_lkka_raw')->select('kode_ro','id_ro','id_komp','kode_komponen','komponen')->distinct()->where('id_ro', $ros->id_ro)->orderBy('kode_komponen')->get();
                                $komponen[] = ${'komponen'.$i4};
                                ## Komponen

                                foreach (${'komponen'.$i4} as $sub) {
                                    $pagu_komp[] = DB::table('view_lkka_raw')->where('id_komp', $sub->id_komp)->orderBy('kode_komponen')->sum('anggaran');

                                    if (isset($sub->kode_komponen)) {
                                        ## Subkomponen
                                        ${'subkomponen'.$i5} = DB::table('view_lkka_raw')->select('kode_komponen','id_komp','id_sub','kode_subkomponen','subkomponen')->distinct()->where('id_komp', $sub->id_komp)->orderBy('kode_subkomponen')->get();
                                        $subkomponen[] = ${'subkomponen'.$i5};
                                        ## Subkomponen

                                        foreach (${'subkomponen'.$i5} as $akun) {
                                            $pagu_sub[] = DB::table('view_lkka_raw')->where('id_sub', $akun->id_sub)->orderBy('kode_subkomponen')->sum('anggaran');
                                            //if (isset($akun->kode_subkomponen)) {
                                            ## Akun

                                           // $realisasi

                                            ${'akun'.$i6} = DB::table('view_lkka_raw')->select('view_lkka_raw.kode_subkomponen','view_lkka_raw.id_sub','view_lkka_raw.akun','view_lkka_raw.anggaran','view_lkka_raw.sumber_dana','rjw_akun.uraian')->distinct()->leftjoin('rjw_akun','rjw_akun.akun','=','view_lkka_raw.akun')->where('id_sub', $akun->id_sub)->orderBy('akun')->get();
                                            $akuns[] = ${'akun'.$i6};

                                            foreach (${'akun'.$i6} as $akun) {
                                            ## Realisasi sampai dengan bulan lalu
                                            $real_akun_last[] = DB::table('view_trans_sp2d_akun')->where('akun', $akun->akun)->whereBetween('tanggal', [$first_day, $res_lastdate_prevmonth])->sum('nilai');
                                            ## Realisasi sampai dengan bulan lalu

                                            ## Realisasi sampai dengan bulan ini
                                            $real_akun_curr[] = DB::table('view_trans_sp2d_akun')->where('akun', $akun->akun)->whereBetween('tanggal', [$first_day_month, $curr_month])->sum('nilai');
                                            ## Realisasi sampai dengan bulan ini

                                            ## Realisasi total
                                            $real_akun_tott[] = DB::table('view_trans_sp2d_akun')->where('akun', $akun->akun)->whereBetween('tanggal', [$first_day, $curr_month])->sum('nilai');
                                            ## Realisasi total

                                            $i7++;
                                            }
                                            ## Akun
                                            //}
                                        $i6++;
                                        }
                                    }
                                $i5++;
                                }
                                }
                            $i4++;                         
                            }                           
                        }
                    $i3++;
                    }
                }
            $i2++;
            }

        $i++;
        }
        
        return view('pages.lkka', compact(
            'program',
                'pagu_program','real_prog_last','real_prog_curr','real_prog_tott',
            'aktivitas',
                'pagu_aktivitas','real_act_last','real_act_curr','real_act_tott',
            'kro',
                'pagu_kro','real_kro_last','real_kro_curr','real_kro_tott',
            'ro',
                'pagu_ro',
            'komponen',
                'pagu_komp',
            'subkomponen',
                'pagu_sub',
            'akuns',
                'real_akun_last','real_akun_curr','real_akun_tott'
        ));
    }

    public function lkka_detail_aktivitas(Request $request){
        // $subkomp = DB::table('rjw_subkomponen')->where('id', $request->id)->get();
        // $akun = DB::table('rjw_detil')->select('rjw_detil.*','rjw_akun.uraian')->where('id_subkomponen', $request->id)->join('rjw_akun','rjw_akun.akun','=','rjw_detil.akun')->get();
        // //dd($subkomp);
        // return view('pages.lkka-detail-akun', compact('subkomp','akun'));
    }

    public function lkka_detail_kro(Request $request){
        // $subkomp = DB::table('rjw_subkomponen')->where('id', $request->id)->get();
        // $akun = DB::table('rjw_detil')->select('rjw_detil.*','rjw_akun.uraian')->where('id_subkomponen', $request->id)->join('rjw_akun','rjw_akun.akun','=','rjw_detil.akun')->get();
        // //dd($subkomp);
        // return view('pages.lkka-detail-akun', compact('subkomp','akun'));
    }

    public function lkka_detail_ro(Request $request){
        // $subkomp = DB::table('rjw_subkomponen')->where('id', $request->id)->get();
        // $akun = DB::table('rjw_detil')->select('rjw_detil.*','rjw_akun.uraian')->where('id_subkomponen', $request->id)->join('rjw_akun','rjw_akun.akun','=','rjw_detil.akun')->get();
        // //dd($subkomp);
        // return view('pages.lkka-detail-akun', compact('subkomp','akun'));
    }

    public function lkka_detail_komponen(Request $request){
        // $subkomp = DB::table('rjw_subkomponen')->where('id', $request->id)->get();
        // $akun = DB::table('rjw_detil')->select('rjw_detil.*','rjw_akun.uraian')->where('id_subkomponen', $request->id)->join('rjw_akun','rjw_akun.akun','=','rjw_detil.akun')->get();
        // //dd($subkomp);
        // return view('pages.lkka-detail-akun', compact('subkomp','akun'));
    }

    public function lkka_detail_subkomponen(Request $request){
        // $subkomp = DB::table('rjw_subkomponen')->where('id', $request->id)->get();
        // $akun = DB::table('rjw_detil')->select('rjw_detil.*','rjw_akun.uraian')->where('id_subkomponen', $request->id)->join('rjw_akun','rjw_akun.akun','=','rjw_detil.akun')->get();
        // //dd($subkomp);
        // return view('pages.lkka-detail-akun', compact('subkomp','akun'));
    }



    public function lkka_detail_akun(Request $request){
        $subkomp = DB::table('rjw_subkomponen')->where('id', $request->id)->get();
        $akun = DB::table('rjw_detil')->select('rjw_detil.*','rjw_akun.uraian')->where('id_subkomponen', $request->id)->leftjoin('rjw_akun','rjw_akun.akun','=','rjw_detil.akun')->get();
        //dd($subkomp);
        return view('pages.lkka-detail-akun', compact('subkomp','akun'));
    }

    public function lkka_akun_store(Request $request){
       
        $query = DB::table('rjw_detil')->insert([
            'akun' => $request->akun,
            'anggaran' => $request->anggaran,
            'sumber_dana' => $request->sumber_dana,
            'id_subkomponen' => $request->id
        ]);
        return redirect()->route('lkka_akun', $request->id);
    }

    public function lkka_akun_edit(Request $request){
       
        $query = DB::table('rjw_detil')->where('id', $request->id_detil)->update([
            'akun' => $request->akun,
            'anggaran' => $request->anggaran,
            'sumber_dana' => $request->sumber_dana,
            'id_subkomponen' => $request->id
        ]);
        return redirect()->route('lkka_akun', $request->id);
    }

    public function lkka_akun_destroy(Request $request){
        
        $sub = DB::table('rjw_detil')->where('id', $request->id)->get();
        DB::table('rjw_detil')->where('id', $request->id)->delete();
        
            $id_sub = $sub[0]->id_subkomponen;            

        return redirect()->route('lkka_akun', $id_sub);
    }

    public function sp2d_view(){
        
        $table_sp2d = DB::table('rjw_trans_sp2d')
        ->orderBy('tgl_sp2d')
        ->get();
        
        $i=0;
        foreach ($table_sp2d as $table) {
            $nilai[] = DB::table('rjw_trans_sp2d_akun')
            ->where('id_sp2d', $table_sp2d[$i]->id)
            ->SUM('nilai');

            $valid[] = DB::table('view_trans_sp2d_akun')
            ->where('id_sp2d', $table_sp2d[$i]->id)
            ->get();

           $i++;
        }

        return view('pages.sp2d', compact('table_sp2d','nilai','valid'));
    }

    public function sp2d_store(Request $request){

        $users = Auth::user();
        $kode_satker = DB::table('rjw_kantor')
            ->join('rjw_kode_satker', 'rjw_kantor.id_user', '=', 'rjw_kode_satker.id_kantor')
            ->select('rjw_kode_satker.id')
            ->get();
        
        $date_sql =  date("Y-m-d", strtotime($request->tanggal));
 
        $table_sp2d = DB::table('rjw_trans_sp2d')->insert([
            'id_kd_satker' => $kode_satker[0]->id,
            'nomor_sp2d' => $request->nomor,
            'tgl_sp2d' => $date_sql,
            'nomor_invoice' => $request->invoice,
            'jenis_spm' => $request->jenis,
            'uraian' => $request->uraian
        ]);

        return redirect()->route('sp2d');
    }

    public function sp2d_akun_store(Request $request){
        $id = $request->id;
        $table_akun = DB::table('rjw_trans_sp2d_akun')->insert([
            'id_sp2d' => $request->id,
            'akun' => $request->akun,
            'program' => $request->program,
            'output' => $request->output,
            'sumber_dana' => $request->sumber_dana,
            'nilai' => $request->nilai
        ]);

        // $view_trans_sp2d_akun = DB::table('view_trans_sp2d_akun')
        // ->where('id_sp2d', $request->id)
        // ->where('akun', $request->akun)
        // ->get();
        // ## dd($view_trans_sp2d_akun);

        // ##jika program aktivitas kro == komponen gaji 
        // $set_gaji = DB::table('rjw_set_gaji')->get();
        // $program = $set_gaji[0]->program;
        // $aktivitas = $set_gaji[0]->aktivitas;
        // $kro = $set_gaji[0]->kro;
        // $ro = $set_gaji[0]->ro;
        // $komponen = $set_gaji[0]->komponen;
        // $subkomponen = $set_gaji[0]->subkomponen;

        // if ($view_trans_sp2d_akun[0]->program == $program &&
        //     $view_trans_sp2d_akun[0]->kegiatan == $aktivitas &&
        //     $view_trans_sp2d_akun[0]->kro == $kro) {
            
        //     $table_akun_add = DB::table('rjw_trans_sp2d_akun_add')->insert([
        //         'id_sp2d' => $request->id,
        //         'ro' => $ro,
        //         'komponen' => $komponen, 
        //         'subkomponen' => $subkomponen
        //     ]);
        // }
        
        return redirect()->route('sp2d.detail', $request->id);
    }

    public function sp2d_akun_edit(Request $request){
       
        $table_akun = DB::table('rjw_trans_sp2d_akun')
            ->where('id', $request->id)->update([
            'akun' => $request->akun,
            'program' => $request->program,
            'output' => $request->output,
            'sumber_dana' => $request->sumber_dana,
            'nilai' => $request->nilai
        ]);       
        
        return redirect()->route('sp2d.detail', $request->id_sp2d);
    }

    public function sp2d_akun_destroy(Request $request){

        $sp2d = DB::table('rjw_trans_sp2d_akun')->where('id', $request->id)->get();
        DB::table('rjw_trans_sp2d_akun')->where('id', $request->id)->delete();
        
            $id_sp2d = $sp2d[0]->id_sp2d;            

        return redirect()->route('sp2d.detail.delete-btn', $id_sp2d);
    }

    public function sp2d_view_detail(Request $request){
        $table_sp2d_akun = DB::table('rjw_trans_sp2d_akun')
                        ->select('rjw_trans_sp2d_akun.*','rjw_akun.uraian','rjw_trans_sp2d_akun_add.ro','rjw_trans_sp2d_akun_add.komponen','rjw_trans_sp2d_akun_add.subkomponen')
                        ->leftjoin('rjw_akun','rjw_akun.akun','=','rjw_trans_sp2d_akun.akun')
                        ->leftjoin('rjw_trans_sp2d_akun_add','rjw_trans_sp2d_akun_add.id_sp2d_akun','=','rjw_trans_sp2d_akun.id')
                        ->where('id_sp2d', $request->id)
                        ->get();
        $table_sp2d = DB::table('rjw_trans_sp2d')
                        ->where('id',$request->id)
                        ->get();
        $total_akun = DB::table('rjw_trans_sp2d_akun')
                        ->select(DB::raw('SUM(nilai) AS total_akun'))
                        ->where('id_sp2d', $request->id)
                        ->get();
        
        return view('pages.sp2d-detail', compact('table_sp2d','table_sp2d_akun','total_akun'));
    }

}
