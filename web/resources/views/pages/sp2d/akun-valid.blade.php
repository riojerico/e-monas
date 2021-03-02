@extends('master')
@section('pages')
<div class="page-wrapper mdc-toolbar-fixed-adjust">
  <main class="content-wrapper">
    <div class="mdc-layout-grid">
      <div class="mdc-layout-grid__inner">              
       


<div class="mdc-layout-grid__cell--span-4 mdc-layout-grid__cell--span-12-desktop stretch-card">
  <div class="mdc-card">
    <h6 class="card-title">Validasi RO / Komponen / Subkomponen</h6>
    <div class="template-demo">

      <form method="post" action="{{ route('sp2d.valid.store', $id_sp2d) }}">
        @csrf
    <div class="mdc-text-field mdc-text-field--outlined">  
      <select required name="ro" class="mdc-list-item mdc-list-item--selected" >
        <option>- Select RO -</option>
        @foreach($data_ro as $ros)
        <option value="{{ $ros->kode_ro }}">{{ 
          $ros->kode_prog.'.'.
          $ros->kode_act.'.'.
          $ros->kode_kro.'.'.
          $ros->kode_ro.' - '.
          $ros->ro 
          }}
        </option>   
        @endforeach
        <option value="000">Akun Potongan</option> 
      </select>           
          <div class="mdc-notched-outline">
          <div class="mdc-notched-outline__leading"></div>
          <div class="mdc-notched-outline__notch">            
            <label class="mdc-floating-label"> </label>            
          </div>
          <div class="mdc-notched-outline__trailing"></div>
        </div>
    </div>

    <div class="mdc-text-field mdc-text-field--outlined">  
      <select required name="komponen" class="mdc-list-item mdc-list-item--selected" >
        <option>- Select Komponen -</option>
        @foreach($data_komp as $komp)
        <option value="{{ $komp->kode_komponen }}">{{ 
          $komp->kode_prog.'.'.
          $komp->kode_act.'.'.
          $komp->kode_kro.'.'.
          $komp->kode_ro.'.'.
          $komp->kode_komponen.' - '.
          $komp->komponen 
          }}
        </option>   
        @endforeach 
        <option value="000">Akun Potongan</option>         
      </select>           
          <div class="mdc-notched-outline">
          <div class="mdc-notched-outline__leading"></div>
          <div class="mdc-notched-outline__notch">            
            <label class="mdc-floating-label"> </label>            
          </div>
          <div class="mdc-notched-outline__trailing"></div>
        </div>
    </div>

    <div class="mdc-text-field mdc-text-field--outlined">  
      <select required name="subkomponen" class="mdc-list-item mdc-list-item--selected" >
        <option>- Select Subkomponen -</option>
        @foreach($data_sub as $subs)
        <option value="{{ $subs->kode_subkomponen }}">{{ 
          $subs->kode_prog.'.'.
          $subs->kode_act.'.'.
          $subs->kode_kro.'.'.
          $subs->kode_ro.'.'.
          $subs->kode_komponen.'.'.
          $subs->kode_subkomponen.' - '.
          $subs->subkomponen 
          }}
        </option>   
        @endforeach 
        <option value="000">Akun Potongan</option>         
      </select>           
          <div class="mdc-notched-outline">
          <div class="mdc-notched-outline__leading"></div>
          <div class="mdc-notched-outline__notch">            
            <label class="mdc-floating-label"> </label>            
          </div>
          <div class="mdc-notched-outline__trailing"></div>
        </div>
    </div>

      @foreach($checkbox as $id_akun)
      <input type="hidden" name="id_akun[]" value="{{ $id_akun }}">
      @endforeach
        <div class="mdc-text-field mdc-text-field--outlined">  
          <button class="mdc-button mdc-button--outlined">
            Simpan
          </button>
        </div>

      </form>
    
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