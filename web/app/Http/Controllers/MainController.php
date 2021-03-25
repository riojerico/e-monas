<?php

namespace App\Http\Controllers;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

use Illuminate\Http\Request;
use DB;
use Auth;
	  
class MainController extends Controller
{

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
        ->orderBy('tgl_sp2d','desc')
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
