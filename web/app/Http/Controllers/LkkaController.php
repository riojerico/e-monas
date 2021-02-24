<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class LkkaController extends Controller
{
	############# detail aktivitas ################
    public function detail_act(Request $request){
        $get_id = DB::table('rjw_program')->where('id', $request->id)->get();
        $act = DB::table('rjw_aktivitas')->where('id_program', $request->id)->get();
        //dd($act);
        return view('pages.lkka.detail-act', compact('act','get_id'));
    }

    public function act_store(Request $request){
       
        $query = DB::table('rjw_aktivitas')->insert([
            'kode' => $request->kode,
            'nama_aktivitas' => $request->nama_aktivitas,            
            'id_program' => $request->id
        ]);
        return redirect()->route('lkka_act', $request->id);
    }

    public function act_edit(Request $request){
        $query = DB::table('rjw_aktivitas')->where('id', $request->id_detail)->update([
            'kode' => $request->kode,
            'nama_aktivitas' => $request->nama_aktivitas,            
            'id_program' => $request->id
        ]);
        return redirect()->route('lkka_act', $request->id);
    }

    public function act_destroy(Request $request){
        $get_id = DB::table('rjw_aktivitas')->where('id', $request->id)->get();
        DB::table('rjw_aktivitas')->where('id', $request->id)->delete();
        
            $get_ids = $get_id[0]->id_program;            

        return redirect()->route('lkka_kro', $get_ids);
    }

    ############# detail kro ################
    public function detail_kro(Request $request){
        $get_id = DB::table('rjw_aktivitas')->where('id', $request->id)->get();
        $kro = DB::table('rjw_kro')->where('id_aktivitas', $request->id)->get();
        //dd($act);
        return view('pages.lkka.detail-kro', compact('kro','get_id'));
    }

    public function kro_store(Request $request){
       
        $query = DB::table('rjw_kro')->insert([
            'kode' => $request->kode,
            'kro' => $request->kro,            
            'id_aktivitas' => $request->id
        ]);
        return redirect()->route('lkka_kro', $request->id);
    }

    public function kro_edit(Request $request){
        $query = DB::table('rjw_kro')->where('id', $request->id_detail)->update([
            'kode' => $request->kode,
            'kro' => $request->kro,            
            'id_aktivitas' => $request->id
        ]);
        return redirect()->route('lkka_kro', $request->id);
    }

    public function kro_destroy(Request $request){
        $get_id = DB::table('rjw_kro')->where('id', $request->id)->get();
        DB::table('rjw_kro')->where('id', $request->id)->delete();
        
            $get_ids = $get_id[0]->id_aktivitas;            

        return redirect()->route('lkka_kro', $get_ids);
    }

    ############# detail ro ################
    public function detail_ro(Request $request){
        $get_id = DB::table('rjw_kro')->where('id', $request->id)->get();
        $ro = DB::table('rjw_ro')->where('id_kro', $request->id)->get();
        //dd($act);
        return view('pages.lkka.detail-ro', compact('ro','get_id'));
    }

    public function ro_store(Request $request){
       
        $query = DB::table('rjw_ro')->insert([
            'kode' => $request->kode,
            'ro' => $request->ro,            
            'id_kro' => $request->id
        ]);
        return redirect()->route('lkka_ro', $request->id);
    }

    public function ro_edit(Request $request){
        $query = DB::table('rjw_ro')->where('id', $request->id_detail)->update([
            'kode' => $request->kode,
            'ro' => $request->ro,            
            'id_kro' => $request->id
        ]);
        return redirect()->route('lkka_ro', $request->id);
    }

    public function ro_destroy(Request $request){
        $get_id = DB::table('rjw_ro')->where('id', $request->id)->get();
        DB::table('rjw_ro')->where('id', $request->id)->delete();
        
            $get_ids = $get_id[0]->id_kro;            

        return redirect()->route('lkka_ro', $get_ids);
    }

    ############# detail komponen ################
    public function detail_komponen(Request $request){
        $get_id = DB::table('rjw_ro')->where('id', $request->id)->get();
        $komponen = DB::table('rjw_komponen')->where('id_ro', $request->id)->get();
        //dd($act);
        return view('pages.lkka.detail-komponen', compact('komponen','get_id'));
    }

    public function komponen_store(Request $request){
       
        $query = DB::table('rjw_komponen')->insert([
            'kode' => $request->kode,
            'komponen' => $request->komponen,            
            'id_ro' => $request->id
        ]);
        return redirect()->route('lkka_komponen', $request->id);
    }

    public function komponen_edit(Request $request){
        $query = DB::table('rjw_komponen')->where('id', $request->id_detail)->update([
            'kode' => $request->kode,
            'komponen' => $request->komponen,            
            'id_ro' => $request->id
        ]);
        return redirect()->route('lkka_komponen', $request->id);
    }

    public function komponen_destroy(Request $request){
        $get_id = DB::table('rjw_komponen')->where('id', $request->id)->get();
        DB::table('rjw_komponen')->where('id', $request->id)->delete();
        
            $get_ids = $get_id[0]->id_ro;            

        return redirect()->route('lkka_komponen', $get_ids);
    }

    ############# detail subkomponen ################
    public function detail_subkomponen(Request $request){
        $get_id = DB::table('rjw_komponen')->where('id', $request->id)->get();
        $subkomponen = DB::table('rjw_subkomponen')->where('id_komponen', $request->id)->get();
        //dd($act);
        return view('pages.lkka.detail-subkomponen', compact('subkomponen','get_id'));
    }

    public function subkomponen_store(Request $request){
       
        $query = DB::table('rjw_subkomponen')->insert([
            'kode' => $request->kode,
            'subkomponen' => $request->subkomponen,            
            'id_komponen' => $request->id
        ]);
        return redirect()->route('lkka_subkomponen', $request->id);
    }

    public function subkomponen_edit(Request $request){
        $query = DB::table('rjw_subkomponen')->where('id', $request->id_detail)->update([
            'kode' => $request->kode,
            'subkomponen' => $request->subkomponen,            
            'id_komponen' => $request->id
        ]);
        return redirect()->route('lkka_subkomponen', $request->id);
    }

    public function subkomponen_destroy(Request $request){
        $get_id = DB::table('rjw_subkomponen')->where('id', $request->id)->get();
        DB::table('rjw_subkomponen')->where('id', $request->id)->delete();
        
            $get_ids = $get_id[0]->id_komponen;            

        return redirect()->route('lkka_subkomponen', $get_ids);
    }


}
