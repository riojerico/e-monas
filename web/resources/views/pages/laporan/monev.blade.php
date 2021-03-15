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


  <?php $i=0; ?>                  
  <?php $i2=0; ?>
  <?php $i3=0; ?>
  <?php $i4=0; ?>
  <?php $i5=0; ?>
  <?php $i6=0; ?>
  <?php $i7=0; ?>

  @foreach($list_aktivitas as $data)

  <div id = "content{{ $loop->iteration }}">

      <br>
  <b>
  {{ $data->nama_aktivitas }}
  </b>
    <table class="table table-hoverable">
        <thead>
          <tr>
          <th rowspan="2" class="text-center">No</th>
          <th class="text-center">Sumber Dana</th>
          <th rowspan="2" class="text-center">Volume</th>
          <th rowspan="2" class="text-center">Anggaran (Rp)</th>
          <th colspan="4" class="text-center">Realisasi s.d Bulan Ini</th>
          </tr>
          <tr>
            <th class="text-center">KRO / RO</th>
            <th class="text-center">Fisik</th>
            <th class="text-center">%</th>
            <th class="text-center">Keuangan</th>
            <th class="text-center">%</th>            
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center"><font color="red"><b>Rupiah Murni</b></font></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td> 
          </tr> 

          {{-- @foreach($sumber_dana as $sd)
            {{ $sumber_dana[$loop->index]->sumber_dana }}
          @endforeach --}}

            @foreach($list_kro_rm[$loop->index] as $data_kro)
            <?php
            $len = strlen($data_kro->ro);
            if ($len > 45) {
              $ro = substr($data_kro->ro, 0,45).'...';
            }else{
              $ro = $data_kro->ro;
            }
            ?>          

            <tr>
              <td class="text-center"></td>
              <td class="text-left">
                <font color="red"><b>
                {{ $data_kro->kode_kro.' / '.$data_kro->kode_ro.' ['.$ro.']' }}
                </b></font>
              </td>
              <td class="text-center"></td>
              <td class="text-right"><font color="red"><b>{{ number_format($anggaran_ro_rm[$i2]) }}</b></font></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-right">
                <font color="red"><b>{{ number_format($real_ro_last_rm[$i2]) }}
                </b></font></td>
              <td class="text-center"><font color="red"><b>
                {{ number_format(($real_ro_last_rm[$i2]/$anggaran_ro_rm[$i2])*100,2) }}%
              </b></font></td> 
            </tr>
              @foreach($list_komponen_rm[$i2] as $data_komp)
              <?php
              $len_kom = strlen($data_komp->komponen);
              if ($len_kom > 45) {
                $komponen = substr($data_komp->komponen, 0,45).'...';
              }else{
                $komponen = $data_komp->komponen;
              }
              ?>

              <tr>
                <td class="text-center"></td>
                <td class="text-left">
                  <b>
                  {{ $data_komp->kode_komponen.'. '.$komponen }}
                  </b>
                </td>
                <td class="text-center"></td>
                <td class="text-right"><b>{{ number_format($anggaran_komponen_rm[$i3]) }}</b></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-right"><b>{{ number_format($real_komponen_last_rm[$i3]) }}</b></td>
                <td class="text-center"><b>{{ number_format(($real_komponen_last_rm[$i3]/$anggaran_komponen_rm[$i3])*100,2) }}%</b></td> 
              </tr> 
                @foreach($list_subkomponen_rm[$i3] as $data_sub)

                <?php
                $len = strlen($data_sub->subkomponen);
                if ($len > 45) {
                  $subkomponen = substr($data_sub->subkomponen, 0,45).'...';
                }else{
                  $subkomponen = $data_sub->subkomponen;
                }
                ?>
                <tr>
                  <td class="text-center"></td>
                  <td class="text-left">{{ $data_sub->kode_subkomponen.'. '.$subkomponen }}</td>
                  <td class="text-center"></td>
                  <td class="text-right">{{ number_format($anggaran_subkomponen_rm[$i4]) }}</td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td class="text-right">{{ number_format($real_subkomponen_last_rm[$i4]) }}</td>
                  <td class="text-center">{{ number_format(($real_subkomponen_last_rm[$i4]/$anggaran_subkomponen_rm[$i4])*100,2) }}%</td> 
                </tr> 
                <?php $i4++; ?>
                @endforeach
                <?php $i3++; ?>
              @endforeach
              <?php $i2++; ?>
            @endforeach

        </tbody>
      </table>
  </div>
  @endforeach
 
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
  padding: 15px 25px;
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