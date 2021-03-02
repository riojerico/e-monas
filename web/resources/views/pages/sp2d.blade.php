@extends('master')
@section('pages')
<div class="page-wrapper mdc-toolbar-fixed-adjust">
  <main class="content-wrapper">
    <div class="mdc-layout-grid">
      <div class="mdc-layout-grid__inner">
    
<!-- Trigger/Open The Modal -->
<button id="myBtn"><i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">add_box</i><br>Rekam SP2D</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="mdc-layout-grid__cell--span-6-desktop">

    Rekam SP2D
    <span class="close">&times;</span>
    <form method="post" action="{{ route('sp2d.store') }}">
      @csrf
    <div class="mdc-text-field mdc-text-field--outlined md-col-6">                       
      <input class="mdc-text-field__input" id="text-field-hero-input" name="nomor" required>
      <div class="mdc-notched-outline">
        <div class="mdc-notched-outline__leading"></div>
        <div class="mdc-notched-outline__notch">
          <label class="mdc-floating-label">Nomor</label>
        </div>
        <div class="mdc-notched-outline__trailing"></div>
      </div>
    </div>
  <br><br>
   <div class="mdc-text-field mdc-text-field--outlined">                       
      <input class="mdc-text-field__input" id="text-field-hero-input" name="tanggal" required maxlength="10" minlength="10">
      <div class="mdc-notched-outline">
        <div class="mdc-notched-outline__leading"></div>
        <div class="mdc-notched-outline__notch">
          <label class="mdc-floating-label">Tanggal (dd-mm-yyyy)</label>
        </div>
        <div class="mdc-notched-outline__trailing"></div>
      </div>
    </div>
    <br><br>
    <div class="mdc-text-field mdc-text-field--outlined">                       
      <input class="mdc-text-field__input" id="text-field-hero-input" name="invoice" required>
      <div class="mdc-notched-outline">
        <div class="mdc-notched-outline__leading"></div>
        <div class="mdc-notched-outline__notch">
          <label class="mdc-floating-label">Invoice</label>
        </div>
        <div class="mdc-notched-outline__trailing"></div>
      </div>
    </div>
    <br><br>
    <div class="mdc-text-field mdc-text-field--outlined">                       
      <input class="mdc-text-field__input" id="text-field-hero-input" name="jenis" required>
      <div class="mdc-notched-outline">
        <div class="mdc-notched-outline__leading"></div>
        <div class="mdc-notched-outline__notch">
          <label class="mdc-floating-label">Jenis SPM</label>
        </div>
        <div class="mdc-notched-outline__trailing"></div>
      </div>
    </div>
    <br><br>
    <div class="mdc-text-field mdc-text-field--outlined">                       
      <input class="mdc-text-field__input" id="text-field-hero-input" name="uraian" required>
      <div class="mdc-notched-outline">
        <div class="mdc-notched-outline__leading"></div>
        <div class="mdc-notched-outline__notch">
          <label class="mdc-floating-label">Uraian</label>
        </div>
        <div class="mdc-notched-outline__trailing"></div>
      </div>
    </div>
    <br><br>
    <div class="mdc-text-field mdc-text-field--outlined">  
    <button class="mdc-button mdc-button--outlined">
      Simpan
    </button>
    </div>
  </form>
  </div>

</div>
</div>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");
</script>


          

         <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                <div class="mdc-card p-0">

                  <h6 class="card-title card-padding pb-0">
                  <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">description</i>
                  List SP2D Satker</h6>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor SP2D</th>
                    <th>Tanggal SP2D</th>
                    <th>Nilai SP2D</th>
                    <th>Nomor Invoice</th>
                    <th>Jenis SPM</th>
                    <th width="30%">Uraian</th>
                    <th></th>
                    <th width="20%"></th>                  
                  </tr>
                </thead>
                <tbody>

                 @foreach ($table_sp2d as $list_sp2d)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $list_sp2d->nomor_sp2d }}</td>
                    <td>{{ $list_sp2d->tgl_sp2d }}</td>
                    <td class="text-right">
                      @if($nilai[$loop->index] == 0)
                        <a href="{{ route('sp2d.detail',$list_sp2d->id) }}" 
                          data-toggle="tooltip" title="detail akun perlu diisi, sesuaikan dengan data dari aplikasi SPAN!">
                        <font color="red">
                          ({{ number_format($nilai[$loop->index]) }}) belum di entry
                        </font>
                        </a>
                        @else
                        {{ number_format($nilai[$loop->index]) }}
                      @endif
                      

                    </td>
                    <td>{{ $list_sp2d->nomor_invoice }}</td>
                    <td>{{ $list_sp2d->jenis_spm }}</td>
                    <td><textarea disabled cols="30%" rows="4">{{ $list_sp2d->uraian }}</textarea></td>
                    <td>
                      @if(isset($valid[$loop->index][0]))
        
                        @foreach($valid[$loop->index] as $data)
                          <?php
                          if ($data->ro == '') {
                             $not_valid = 1;
                           }else{
                             $not_valid = 0;
                           }                           
                          ?>
                        @endforeach

                        @if($not_valid == 1)
                          <a href="{{ route('sp2d.detail',$list_sp2d->id) }}" 
                            data-toogle="tooltip" title="Validasi RO, Komponen, Subkomponen">
                            <font color="orange"><span class="material-icons">info</span></font>
                          </a>
                        @else
                          <a href="{{ route('sp2d.detail',$list_sp2d->id) }}" data-toogle="tooltip" title="Validasi RO, Komponen, Subkomponen">
                            <font color="green"><span class="material-icons">check_circle</span></font>
                          </a>
                        @endif

                      
                      @else
                      <a href="{{ route('sp2d.detail',$list_sp2d->id) }}" 
                        data-toogle="tooltip" title="Validasi RO, Komponen, Subkomponen">
                        <font color="orange"><span class="material-icons">info</span></font>
                      </a>
                      @endif
                      

                      
                    </td> 
                    <td>

                      <a href="{{ route('sp2d.detail',$list_sp2d->id) }}" data-toggle="tooltip" title="detail akun nomor SP2D {{ $list_sp2d->nomor_sp2d }}!"> <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">open_in_new</i></a>

                      {{-- <a href=""> <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">update</i></a> --}}

                      <a href="" data-toggle="tooltip" title="hapus data SP2D nomor {{ $list_sp2d->nomor_sp2d }}!"> <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">delete</i></a>

                    </td>
               
                  </tr>                
                  @endforeach
                        
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