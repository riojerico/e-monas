@extends('master')
@section('pages')
<div class="page-wrapper mdc-toolbar-fixed-adjust">
  <main class="content-wrapper">
    <div class="mdc-layout-grid">
      <div class="mdc-layout-grid__inner">              
       

<!-- Trigger/Open The Modal -->
{{-- <button id="myBtn"><i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">add_box</i><br>Rekam Akun</button> --}}

<button onclick="document.getElementById('rekam').style.display='block'"><i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">add_box</i><br>Rekam Akun</button>


<div id="rekam" class="modal">
  
  <!-- Modal content -->
  <div class="modal-content">
    <div class="mdc-layout-grid__cell--span-2-desktop">

    Rekam Akun
    <span onclick="document.getElementById('rekam').style.display='none'" class="close" title="Close Modal">×</span>
    <form method="post" action="{{ route('lkka_akun_store', $subkomp[0]->id) }}">
      @csrf
    <div class="mdc-text-field mdc-text-field--outlined md-col-6">                       
      <input class="mdc-text-field__input" id="text-field-hero-input" name="akun" required>
      <div class="mdc-notched-outline" type="number" minlength="6" maxlength="6">
        <div class="mdc-notched-outline__leading"></div>
        <div class="mdc-notched-outline__notch">
          <label class="mdc-floating-label">Akun</label>
        </div>
        <div class="mdc-notched-outline__trailing"></div>
      </div>
    </div>
    <br><br>   
    <div class="mdc-text-field mdc-text-field--outlined">                       
      <input class="mdc-text-field__input" id="text-field-hero-input" name="anggaran" required  type="number">
      <div class="mdc-notched-outline">
        <div class="mdc-notched-outline__leading"></div>
        <div class="mdc-notched-outline__notch">
          <label class="mdc-floating-label">Anggaran</label>
        </div>
        <div class="mdc-notched-outline__trailing"></div>
      </div>
    </div>
    <br><br>
    <div class="mdc-text-field mdc-text-field--outlined">  
    <select name="sumber_dana" required name="sumber_dana">
      <option>- Select -</option>
      <option value="RM">A (RM)</option>
      <option value="PNBP">D (PNBP)</option>     
    </select>           
        <div class="mdc-notched-outline">
        <div class="mdc-notched-outline__leading"></div>
        <div class="mdc-notched-outline__notch">
          <label class="mdc-floating-label"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Sumber Dana</label>
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



        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                <div class="mdc-card p-0">

                  <h6 class="card-title card-padding pb-0">

                  <a href="{{ route('lkka') }}"><button class="mdc-button mdc-button--raised icon-button filled-button--light">
                    <i class="material-icons mdc-button__icon">undo</i>
                  </button></a>
                  
                    Detail akun Subkomponen [{{ $subkomp[0]->kode.' '.$subkomp[0]->subkomponen }}] </h6>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th class="text-left" >Akun</th>
                          <th>Anggaran</th>
                          <th class="text-center">Sumber Dana</th>
                          <th></th>                                    
                        </tr>
                      </thead>
                      <tbody>

                       @foreach ($akun as $list_akun)                        
                        <tr>
                          <td width="2%">{{ $loop->iteration }}</td>
                          <td  class="text-left" width="23%">

                            @if($list_akun->uraian == null)
                              <a href="#" onclick="document.getElementById('edit{{$list_akun->id}}').style.display='block'">{{ $list_akun->akun.' (akun belum terdaftar)' }}</a>
                              @else
                              <a href="#" onclick="document.getElementById('edit{{$list_akun->id}}').style.display='block'">{{ $list_akun->akun.' ('.$list_akun->uraian.')' }}</a>
                            @endif  
                            
                            

                          </td>
                          <td width="30%">{{ number_format($list_akun->anggaran) }}</td>         
                          <td class="text-center" width="30%">{{ $list_akun->sumber_dana }}</td> 
                          <td width="15">
                            {!! Form::open(['method' => 'POST', 'route' => ['lkka_akun_destroy', $list_akun->id] ]) !!}
                            <button type="submit" onclick="return confirm('Are you sure?')"><i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true" >delete</i></button>
                            {!! Form::close() !!}
                          </td>        
                        </tr> 

                                         
                        
                       
                        @endforeach                        
                      </tbody>
                    </table>


                 </div>
                </div>
              </div>


@foreach($akun as $akun_modal)
  <div id="edit{{$akun_modal->id}}" class="modal">
  
  <!-- Modal content -->
  <div class="modal-content">
    <div class="mdc-layout-grid__cell--span-2-desktop">

    Edit Akun
    <span onclick="document.getElementById('edit{{$akun_modal->id}}').style.display='none'" class="close" title="Close Modal">×</span>
    <form method="post" action="{{ route('lkka_akun_edit', $subkomp[0]->id) }}">
      @csrf
    <div class="mdc-text-field mdc-text-field--outlined md-col-6">                       
      <input class="mdc-text-field__input" id="text-field-hero-input" name="akun" required value="{{ $akun_modal->akun }}">
      <div class="mdc-notched-outline" type="number" minlength="6" maxlength="6">
        <div class="mdc-notched-outline__leading"></div>
        <div class="mdc-notched-outline__notch">
          <label class="mdc-floating-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Akun</label>
        </div>
        <div class="mdc-notched-outline__trailing"></div>
      </div>
    </div>
    <br><br>   
    <input type="hidden" name="id_detil" value="{{ $akun_modal->id }}">
    <div class="mdc-text-field mdc-text-field--outlined">                       
      <input class="mdc-text-field__input" id="text-field-hero-input" name="anggaran" required  type="number" value="{{ $akun_modal->anggaran }}">
      <div class="mdc-notched-outline">
        <div class="mdc-notched-outline__leading"></div>
        <div class="mdc-notched-outline__notch">
          <label class="mdc-floating-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Anggaran</label>
        </div>
        <div class="mdc-notched-outline__trailing"></div>
      </div>
    </div>
    <br><br>
    <div class="mdc-text-field mdc-text-field--outlined">  
    <select name="sumber_dana" required name="sumber_dana">
      <option>{{ $akun_modal->sumber_dana }}</option>
      <option value="RM">A (RM)</option>
      <option value="PNBP">D (PNBP)</option>     
    </select>           
        <div class="mdc-notched-outline">
        <div class="mdc-notched-outline__leading"></div>
        <div class="mdc-notched-outline__notch">
          <label class="mdc-floating-label"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Sumber Dana</label>
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
@endforeach

<script>
// Get the modal
var modal = document.getElementById('rekam');

@foreach($akun as $akun_script)
  var modal = document.getElementById('edit{{$akun_script->id}}');
@endforeach

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

      </div>
    </div>
  </main>
  <!-- partial:../../partials/_footer.html -->
  @include('layouts.footer')
  <!-- partial -->
</div>
@endsection

@push('ajax_crud')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script src="{{asset('assets-admin/js/ajax.js') }}"></script>
@endpush