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
      
      <h4>Realisasi Fisik</h4>
      
      <table class="table table-hoverable">
        <thead>
          <tr>
            <td class="text-center">
              <font color="#483D8B"><b>Program</b></font> <br>
              <font color="#6495ED"><b>Kegiatan .</b></font>
              <font color="red"><b>KRO .</b></font>
              <b>RO
            </td>
            <td><b>Target Fisik</b></td>
            <td><b>Satuan</b></td>            
            <td><b>Jan</b></td>
            <td><b>Feb</b></td>
            <td><b>Mar</b></td>
            <td><b>Apr</b></td>
            <td><b>Mei</b></td>
            <td><b>Jun</b></td>
            <td><b>Jul</b></td>
            <td><b>Ags</b></td>
            <td><b>Sep</b></td>
            <td><b>Okt</b></td>
            <td><b>Nov</b></td>
            <td><b>Des</b></td>
            <td><b>Total %</b></td>

          </tr>
        </thead>

        <?php 
        $i2=0;

       // $disable = 'disabled';
        $disable = '';
        ?>


        <tbody>
          <form method="post" action="{{ route('realisasi.fisik.store') }}"> 

          @foreach($program as $prog)
          <tr>
            <td class="text-center"><font color="#483D8B" size="1"><b>{{ $prog->nama_program }}</b></font></td>
          </tr>
           @foreach($komponen[$loop->index] as $komp)
          <tr>   
            <?php
            $data_realisasi = ${'realisasi_fisik'.$i2};
            ?>

           
           @csrf    

            <td class="text-center">
              <div class="tooltip">{!! '<font color="#6495ED"><b>'.$komp->kode_act.'</b></font>.<font color="red"><b>'.$komp->kode_kro.'</b></font>.<b>'.$komp->kode_ro.'<b>' !!}
                <span class="tooltiptext">{!! $komp->ro !!}</span>
              </div> 
            </td>  
            <td>
              <input type="" name="target[]" size="1" value="{{ $data_realisasi[$loop->index]->target }}" {{ $disable }}>
            </td>
            <td>
              <input type="" name="satuan[]" size="1" value="{{ $data_realisasi[$loop->index]->satuan }}" {{ $disable }}>
            </td>
            <td>
              <input type="" name="jan[]" size="1" value="{{ $data_realisasi[$loop->index]->jan }}" {{ $disable }}>
            </td>
            <td>
              <input type="" name="feb[]" size="1" value="{{ $data_realisasi[$loop->index]->feb }}" {{ $disable }}>
            </td>
            <td>
              <input type="" name="mar[]" size="1" value="{{ $data_realisasi[$loop->index]->mar }}" {{ $disable }}>
            </td>
            <td>
              <input type="" name="apr[]" size="1" value="{{ $data_realisasi[$loop->index]->apr }}" {{ $disable }}>
            </td>
            <td>
              <input type="" name="mei[]" size="1" value="{{ $data_realisasi[$loop->index]->mei }}" {{ $disable }}>
            </td>
            <td>
              <input type="" name="jun[]" size="1" value="{{ $data_realisasi[$loop->index]->jun }}" {{ $disable }}>
            </td>
            <td>
              <input type="" name="jul[]" size="1" value="{{ $data_realisasi[$loop->index]->jul }}" {{ $disable }}>
            </td>
            <td>
              <input type="" name="ags[]" size="1" value="{{ $data_realisasi[$loop->index]->ags }}" {{ $disable }}>
            </td>
            <td>
              <input type="" name="sep[]" size="1" value="{{ $data_realisasi[$loop->index]->sep }}" {{ $disable }}>
            </td>
            <td>
              <input type="" name="okt[]" size="1" value="{{ $data_realisasi[$loop->index]->okt }}" {{ $disable }}>
            </td>
            <td>
              <input type="" name="nov[]" size="1" value="{{ $data_realisasi[$loop->index]->nov }}" {{ $disable }}>
            </td>
            <td>
              <input type="" name="des[]" size="1" value="{{ $data_realisasi[$loop->index]->des }}" {{ $disable }}>
            </td>
            <td>
              <?php
              if ($data_realisasi[$loop->index]->satuan == "Layanan" || $data_realisasi[$loop->index]->satuan == "layanan") {
              ?>              
                <input type="" name="tot[]" size="1" value="{{ 

                number_format(($data_realisasi[$loop->index]->jan+$data_realisasi[$loop->index]->feb+$data_realisasi[$loop->index]->mar+$data_realisasi[$loop->index]->apr+$data_realisasi[$loop->index]->mei+$data_realisasi[$loop->index]->jun+$data_realisasi[$loop->index]->jul+$data_realisasi[$loop->index]->ags+$data_realisasi[$loop->index]->sep+$data_realisasi[$loop->index]->okt+$data_realisasi[$loop->index]->nov+$data_realisasi[$loop->index]->des)/$data_realisasi[$loop->index]->target/12*100,2) }}

                " disabled> 
              <?php
              }else{
              ?>
                <input type="" name="tot[]" size="1" value="{{ 

                number_format(($data_realisasi[$loop->index]->jan+$data_realisasi[$loop->index]->feb+$data_realisasi[$loop->index]->mar+$data_realisasi[$loop->index]->apr+$data_realisasi[$loop->index]->mei+$data_realisasi[$loop->index]->jun+$data_realisasi[$loop->index]->jul+$data_realisasi[$loop->index]->ags+$data_realisasi[$loop->index]->sep+$data_realisasi[$loop->index]->okt+$data_realisasi[$loop->index]->nov+$data_realisasi[$loop->index]->des)/$data_realisasi[$loop->index]->target*100,2) }}

                " disabled> 
              <?php
              }
              ?>
              
            </td>                               
          </tr>
          
           @endforeach
            
          <?php $i2++; ?>
          @endforeach
          <button class="mdc-button mdc-button--outlined">
              Simpan
            </button>
            </form>
        </tbody>
      </table>
    
    
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
<style>
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 600px;
  background-color: #483D8B;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}
</style>
@endpush