<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MainSp2dController extends Controller
{
    public function akun_validasi(Request $request){
    	$checkbox = $request->checkbox;
    	$id_sp2d = $request->id;

    	if (isset($checkbox)) {
    		//dd($checkbox);
    	

    	// $i=0;
    	// foreach ($checkbox as $id_sp2d_akun) {
    		$view = DB::table('view_trans_sp2d_akun')->where('id', $checkbox)->get();

    		$program = $view[0]->program;
    		$kegiatan = $view[0]->kegiatan;
    		$kro = $view[0]->kro;
    	// $i++;
    	// }
    	
    	//dd($kegiatan);

    	$data_ro = DB::table('view_lkka_raw')
    		->select('kode_prog','kode_act','kode_kro','kode_ro','ro')
    		->distinct()
    		->where('kode_prog', $program)
    		->where('kode_act', $kegiatan)
    		->where('kode_kro', $kro)    		
    		->get();

    	$data_komp = DB::table('view_lkka_raw')
    		->select('kode_prog','kode_act','kode_kro','kode_ro','kode_komponen','komponen')
    		->distinct()
    		->where('kode_prog', $program)
    		->where('kode_act', $kegiatan)
    		->where('kode_kro', $kro)    		
    		->get();

    	$data_sub = DB::table('view_lkka_raw')
    		->select('kode_prog','kode_act','kode_kro','kode_ro','kode_komponen','kode_subkomponen','subkomponen')
    		->distinct()
    		->where('kode_prog', $program)
    		->where('kode_act', $kegiatan)
    		->where('kode_kro', $kro)    		
    		->get();

    	return view('pages.sp2d.akun-valid', compact('id_sp2d','checkbox','data_ro','data_komp','data_sub'));

    	}else{
    		return redirect()->route('sp2d.detail', $id_sp2d);
    	}
    	
    }

    public function akun_validasi_store(Request $request){
    	$id_sp2d = $request->id;
    	$id_akun = $request->id_akun;


    	foreach ($id_akun as $id_akuns) {
    		$query = DB::table('rjw_trans_sp2d_akun_add')->updateorInsert([
    		'id_sp2d_akun' => $id_akuns,
    	],
    	[
    		'ro' => $request->ro,
    		'komponen' => $request->komponen,
    		'subkomponen' => $request->subkomponen
    	]);

    	}
    	
    	return redirect()->route('sp2d.detail', $id_sp2d);
    	
    }
}
