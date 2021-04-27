@extends('master')
@section('pages')
<div class="page-wrapper mdc-toolbar-fixed-adjust">
  <main class="content-wrapper">
    <div class="mdc-layout-grid">
      <div class="mdc-layout-grid__inner">              
       


<div class="mdc-layout-grid__cell--span-4 mdc-layout-grid__cell--span-12-desktop stretch-card">
  <div class="mdc-card">
    <h6 class="card-title"></h6>
    <div class="template-demo">
      

<div class = "tabinator">

  <h2>Laporan Monev</h2>

  {{-- Loop untuk menampilkan data tabs --}}
  @foreach($list_aktivitas as $data_tabs)
  <?php 
    if($loop->iteration == '1'){
       $checked = 'checked';
    }else{
       $checked = '';
    }


  ?>
    <input type = "radio" id = "tab{{ $loop->iteration }}" name = "tabs[]" {{ $checked }}>
        <label for = "tab{{ $loop->iteration }}">{{ $data_tabs->kode_act }}</label>

  @endforeach
  {{-- endloop --}}

  <?php $i=0; ?>                  
  <?php $i2=0; ?>
  <?php $i3=0; ?>
  <?php $i4=0; ?>
  <?php $i5=0; ?>
  <?php $i6=0; ?>
  <?php $i7=0; ?>


  {{-- open aktivitas --}}

  @foreach($list_aktivitas as $data)

  <div id = "content{{ $loop->iteration }}">

      <br>
  <b>
  {{ $data->nama_aktivitas }}
  </b>
    <table class="table table-hoverable">
        <thead>
          <tr>
          <th rowspan="2" class="text-center"><b>No</b></th>
          <th class="text-center"><b>Sumber Dana</b></th>
          <th rowspan="2" class="text-center"><b>Volume</b></th>
          <th rowspan="2" class="text-center"><b>Anggaran (Rp)</b></th>
          <th colspan="4" class="text-center"><b>Realisasi s.d Bulan Ini</b></th>
          </tr>
          <tr>
            <th class="text-center"><b>KRO / RO</b></th>
            <th class="text-center"><b>Fisik</b></th>
            <th class="text-center"><b>%</b></th>
            <th class="text-center"><b>Keuangan</b></th>
            <th class="text-center"><b>%</b></th>            
          </tr>
        </thead>

        <tbody>

          {{-- open sd --}}

          @foreach($loop_sumber_dana as $sd)
          
          <?php
            if($sd->sumber_dana == 'RM'){
              $warna_button = 'secondary';

            }elseif($sd->sumber_dana == 'PNBP'){
              $warna_button = 'primary';
            }            
          ?>

          <tr>
            <td class="text-center"><button class="mdc-button mdc-button--outlined outlined-button--{{ $warna_button }} mdc-ripple-upgraded" >{{ $sd->sumber_dana }}</button></td>

            <td class="text-center"></td>
            
            <td class="text-center">
              {{-- <button class="mdc-button mdc-button--outlined outlined-button--secondary  mdc-ripple-upgraded" >volume</button> --}}
            </td>
            
            <td class="text-right"><button class="mdc-button mdc-button--outlined outlined-button--{{ $warna_button }}  mdc-ripple-upgraded" >
              {{ number_format(${'sum_anggaran'.$loop->index.$data->kode_act}[$loop->index]) }}
            </button>
            </td>
            
            <td class="text-center">
                {{-- <button class="mdc-button mdc-button--outlined outlined-button--secondary  mdc-ripple-upgraded" >sum fi</button> --}}
            
            </td>
            
            <td class="text-center">
              {{-- <button class="mdc-button mdc-button--outlined outlined-button--secondary mdc-ripple-upgraded" >persen</button> --}}
            </td>
            
            <td class="text-center"><button class="mdc-button mdc-button--outlined outlined-button--{{ $warna_button }}  mdc-ripple-upgraded" >
              {{ number_format(${'sum_realisasi_anggaran'.$loop->index.$data->kode_act}[$loop->index]) }}
            </button></td>
            
            <td class="text-center"><button class="mdc-button mdc-button--outlined outlined-button--{{ $warna_button }}  mdc-ripple-upgraded" >

              <?php
                if (${'sum_realisasi_anggaran'.$loop->index.$data->kode_act}[$loop->index] <> null) {
                  $sum_persen_real = ${'sum_realisasi_anggaran'.$loop->index.$data->kode_act}[$loop->index]/${'sum_anggaran'.$loop->index.$data->kode_act}[$loop->index]*100;
                }else{
                  $sum_persen_real = 0;
                }
              ?>

              {{
                number_format($sum_persen_real,2)
              }}%
 
            </button></td> 

          </tr>

            {{-- open ro --}}

            <?php $get_sd = $loop->index ?>
            @foreach(${'list_kro'.$loop->index.$data->kode_act}[$loop->index] as $data_kro)

              @foreach(${'list_ro'.$get_sd.$data->kode_act.$data_kro->kode_kro}[$get_sd] as $data_ro)
                <?php
              $len = strlen($data_ro->ro);
              if ($len > 30) {
                $ro = substr($data_ro->ro, 0,30).'-<br>'.substr($data_ro->ro, 30,30);
              }else{
                $ro = $data_ro->ro;
              }
              ?>          

              <tr>
                <td class="text-center"></td>
                <td class="text-left">
                  <font color="red"><b>
                  {!! $data_ro->kode_kro.' </font> / '.$data_ro->kode_ro.' ['.$ro.']' !!}
                  </b>
                </td>
                <td class="text-center"><font color=""><b>

                      {{ number_format(${'volume_'.$get_sd.$data->kode_act.$data_kro->kode_kro.$data_ro->kode_ro}[$get_sd][0]->target).' '.${'volume_'.$get_sd.$data->kode_act.$data_kro->kode_kro.$data_ro->kode_ro}[$get_sd][0]->satuan }}
                 
                  
                </b></font></td>

                <td class="text-right"><font color=""><b>            
                    {{ number_format(${'anggaran_ro'.$get_sd.$data->kode_act.$data_kro->kode_kro.$data_ro->kode_ro}[$get_sd]) }}   
                </b></font></td>

                <td class="text-center"><font color=""><b>
                {{ number_format(${'realisasi_fisik'.$get_sd.$data->kode_act.$data_kro->kode_kro.$data_ro->kode_ro},2) }}
                </b></font></td>
                
                <td class="text-center"><font color=""><b>
                  {{ number_format(${'realisasi_fisik'.$get_sd.$data->kode_act.$data_kro->kode_kro.$data_ro->kode_ro}/${'volume_'.$get_sd.$data->kode_act.$data_kro->kode_kro.$data_ro->kode_ro}[$get_sd][0]->target*100,2) }}%
                </b></font></td>
                
                <td class="text-right">
                  <font color=""><b>
                    {{ number_format(${'realisasi_ro_'.$get_sd.$data->kode_act.$data_kro->kode_kro.$data_ro->kode_ro}[$get_sd]) }}
                  </b></font></td>

                <td class="text-center"><font color=""><b>
                  {{ number_format((${'realisasi_ro_'.$get_sd.$data->kode_act.$data_kro->kode_kro.$data_ro->kode_ro}[$get_sd]/${'anggaran_ro'.$get_sd.$data->kode_act.$data_kro->kode_kro.$data_ro->kode_ro}[$get_sd])*100,2) }}%
                </b></font></td> 
              </tr>


                {{-- komponen open --}}
                <?php
                $list_komponen = ${'list_komponen'.$get_sd.$data->kode_act.$data_kro->kode_kro.$data_ro->kode_ro};
                ?>
                {{-- {{dd($list_komponen)}} --}}
                @foreach($list_komponen[$get_sd] as $data_komponen)
                  <?php                
                    $len_komp = strlen($data_komponen->komponen);
                    if ($len_komp > 30) {
                      $komponen = substr($data_komponen->komponen, 0,30).'-<br>'.substr($data_komponen->komponen, 30,30);
                    }else{
                      $komponen = $data_komponen->komponen;
                    }
                  ?>
                  <tr>
                    <td></td>
                    <td class="text-left"><b>{!! $data_komponen->kode_komponen.' '.$komponen !!}</b></td>                    
                    <td></td>
                    
                    <td class="text-right"><b>
                      {{ number_format(${'anggaran_komponen_'.$get_sd.$data->kode_act.$data_kro->kode_kro.$data_ro->kode_ro.$data_komponen->kode_komponen}[$get_sd]) }}
                    </b></td>
                    
                    <td></td>
                    <td></td>
                    
                    <td class="text-right"><b>
                      
                      <?php 
                        if(isset(${'realisasi_ang_komponen_'.$get_sd.$data->kode_act.$data_kro->kode_kro.$data_ro->kode_ro.$data_komponen->kode_komponen}[$get_sd])) :
                      ?> 

                      {{ number_format(${'realisasi_ang_komponen_'.$get_sd.$data->kode_act.$data_kro->kode_kro.$data_ro->kode_ro.$data_komponen->kode_komponen}[$get_sd]) }}

                      <?php endif ?>
                    </b></td>
                    
                    <td class="text-center"><b>
                      
                      
                      {{ number_format(${'realisasi_ang_komponen_'.$get_sd.$data->kode_act.$data_kro->kode_kro.$data_ro->kode_ro.$data_komponen->kode_komponen}[$get_sd]/${'anggaran_komponen_'.$get_sd.$data->kode_act.$data_kro->kode_kro.$data_ro->kode_ro.$data_komponen->kode_komponen}[$get_sd]*100,2) }}

                   

                    %</b></td>
                                   
                  </tr>

                    {{-- open subkomponen --}}
                    <?php
                    $list_subkomponen = ${'list_subkomponen'.$get_sd.$data->kode_act.$data_kro->kode_kro.$data_ro->kode_ro.$data_komponen->kode_komponen};
                    ?>

                    @foreach($list_subkomponen[$get_sd] as $data_subkomp)
                    <?php                
                      $len_subkomp = strlen($data_subkomp->subkomponen);
                      if ($len_subkomp > 30) {
                        $subkomponen = '<u><i>'.substr($data_subkomp->subkomponen, 0,30).'-</u></i><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u><i>'.substr($data_subkomp->subkomponen, 30,30).'</u></i>';
                      }else{
                        $subkomponen = '<u><i>'.$data_subkomp->subkomponen.'</u></i>';
                      }
                    ?>

                    <tr>
                      <td></td>
                      <td class="text-left">
                        &nbsp;&nbsp;{!! '('.$data_subkomp->kode_subkomponen.') '.$subkomponen!!}
                      </td>
                      <td></td>
                      <td>
            
                        {{ number_format(${'anggaran_subkomponen_'.$get_sd.$data->kode_act.$data_kro->kode_kro.$data_ro->kode_ro.$data_komponen->kode_komponen.$data_subkomp->kode_subkomponen}[$get_sd]) }}
                        
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        {{ number_format(${'real_subkomponen_'.$get_sd.$data->kode_act.$data_kro->kode_kro.$data_ro->kode_ro.$data_komponen->kode_komponen.$data_subkomp->kode_subkomponen}[$get_sd]) }}
                      </td>
                      <td class="text-center">

                        <?php


                          if (${'real_subkomponen_'.$get_sd.$data->kode_act.$data_kro->kode_kro.$data_ro->kode_ro.$data_komponen->kode_komponen.$data_subkomp->kode_subkomponen}[$get_sd] <> 0) {

                            $persen_subkomp = ${'real_subkomponen_'.$get_sd.$data->kode_act.$data_kro->kode_kro.$data_ro->kode_ro.$data_komponen->kode_komponen.$data_subkomp->kode_subkomponen}[$get_sd] / max(${'anggaran_subkomponen_'.$get_sd.$data->kode_act.$data_kro->kode_kro.$data_ro->kode_ro.$data_komponen->kode_komponen.$data_subkomp->kode_subkomponen}[$get_sd], 1) * 100;
                          
                          }else{
                            $persen_subkomp = 1;
                          }
                        ?>

                        {{
                          number_format($persen_subkomp,2)
                        }}
                        %
                      
                      </td>                  
                    </tr>
           
                    @endforeach
                    {{-- end subkomponen --}}

                @endforeach
                {{-- endfor komponen --}}

              @endforeach
              {{-- endofor ro --}}



            <?php $i2++; ?>
            @endforeach
            {{-- end for kro --}}

            <?php $i++; ?>
          @endforeach
          {{-- endfor sumber dana --}}
        </tbody>
      </table>
  </div>
  @endforeach
  {{-- end for aktivitas --}}
</div>


      
      
    
    
    </div>
  </div>
</div>




      </div>
    </div>
  </main>
  <!-- partial:../../partials/_footer.html -->
  @include('layouts.footer')
  <!-- partial -->
</div>
@endsection

@push('css-pages')
<style type="text/css">
  @import url('https://fonts.googleapis.com/css?family=Open+Sans:400,600,700');
* {
  margin: 0;
  padding: 0;
}
body {
  padding: 0px;
  background: #E5E4E2;
}
.tabinator {
  background: #fff;
  padding: 5px;
  font-family: Open Sans;
}
.tabinator h2 {
  text-align: center;
  margin-bottom: 20px;
}
.tabinator input {
  display: none;
}
.tabinator label {
  box-sizing: border-box;
  display: inline-block;
  padding: 15px 30px;
  color: #ccc;
  margin-bottom: -1px;
  margin-left: -1px;
}
.tabinator label:before {
  content:'';
  display:block;
  width:100%;
  height:15px;
  background-color:#fff;
  position:absolute;
  bottom:-11px;
  left:0;
  z-index:10;  
}
.tabinator label:hover {
  color: #888;
  cursor: pointer;
}
.tabinator input:checked + label {
  position: relative;
  color: #000;
  background: #fff;
  border: 1px solid #bbb;
  border-bottom: 1px solid #fff;
  border-radius: 5px 5px 0 0;
}
.tabinator input:checked + label:after {
  display: block;
  content: '';
  position: absolute;
  top: 0; right: 0; bottom: 0; left: 0;
  box-shadow: 0 0 15px #939393;
}
@foreach($list_aktivitas as $data_js0)
#content{{ $loop->iteration }} @if($loop->last)
  @else , @endif 
@endforeach
 {
  display: none;
  border-top: 1px solid #bbb;
  padding: 15px;
}
@foreach($list_aktivitas as $data_js)
#tab{{ $loop->iteration }}:checked ~ #content{{ $loop->iteration }} @if($loop->last)
  @else , @endif
  
@endforeach
 {
  display: block;
  box-shadow: 0 0 15px #939393;
}
</style>
@endpush