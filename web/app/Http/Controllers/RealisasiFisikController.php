<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RealisasiFisikController extends Controller
{
    public function index(){
    	$program = DB::table('view_lkka_raw')
    			->select('id_prog','kode_prog','nama_program')
    			->where('id_kodesatker',1)
    			->groupBy('id_prog')
    			->orderBy('kode_act')
    			->get();
    	// dd($program);
    	$i=0;
        $i2=0;
    	foreach ($program as $prog) {
    		${'komponen'.$i} = DB::table('view_lkka_raw')
    				->distinct()
    				->select('kode_prog','kode_act','kode_kro','kode_ro','ro')
    				->where('id_prog', $prog->id_prog)
    				->groupBy('kode_act','kode_kro','kode_ro')
    				->orderBy('kode_act')
    				->get();
            $komponen[] = ${'komponen'.$i};

            foreach (${'komponen'.$i} as $komp) {
                
                ${'realisasi_fisik'.$i} = DB::table('rjw_realisasi_fisik')
                                ->where('id_kdsatker', 1)
                                ->where('kode_ro','like', $komp->kode_prog.'%')
                                ->get();            
            $i2++;
            }


    	$i++;
    	}

    	for ($i0=0; $i0 < $i ; $i0++) { 
            $realisasi_fisik[] = 'realisasi_fisik'.$i0;
        }

       
    	return view('pages.realisasi.fisik', compact('program','komponen'
            ,$realisasi_fisik));

    }

    public function store(Request $request){
        $program = DB::table('view_lkka_raw')
                ->select('id_prog','kode_prog','nama_program')
                ->where('id_kodesatker',1)
                ->groupBy('id_prog')
                ->orderBy('kode_act')
                ->get();
 
        $i=0;
        $i2=0;
        foreach ($program as $prog) {
            ${'komponen'.$i} = DB::table('view_lkka_raw')
                    ->distinct()
                    ->select('kode_prog','kode_act','kode_kro','kode_ro','ro')
                    ->where('id_prog', $prog->id_prog)
                    ->groupBy('kode_act','kode_kro','kode_ro')
                    ->orderBy('kode_act')
                    ->get();
            foreach (${'komponen'.$i} as $komp) {
                $ro[] = $komp->kode_prog.'.'.$komp->kode_act.'.'.$komp->kode_kro.'.'.$komp->kode_ro;
                
                $query = DB::table('rjw_realisasi_fisik')->updateorInsert([
                            'kode_ro' => $ro[$i2],
                        ],
                        [
                            'id_kdsatker' => 1,
                            'target' => $request->target[$i2],
                            'satuan' => $request->satuan[$i2],
                            'jan' => $request->jan[$i2],
                            'feb' => $request->feb[$i2],
                            'mar' => $request->mar[$i2],
                            'apr' => $request->apr[$i2],
                            'mei' => $request->mei[$i2],
                            'jun' => $request->jun[$i2],
                            'jul' => $request->jul[$i2],
                            'ags' => $request->ags[$i2],
                            'sep' => $request->sep[$i2],
                            'okt' => $request->okt[$i2],
                            'nov' => $request->nov[$i2],
                            'des' => $request->des[$i2]
                            
                        ]);

            $i2++;    
            }
        $i++;
        }

        return redirect()->route('realisasi.fisik');
    }
}
