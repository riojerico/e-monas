@extends('master')
@section('pages')
<div class="page-wrapper mdc-toolbar-fixed-adjust">
  <main class="content-wrapper">
    <div class="mdc-layout-grid">
      <div class="mdc-layout-grid__inner">              
       
<!-- Trigger/Open The Modal -->
<button onclick="document.getElementById('rekam').style.display='block'"><i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">add_box</i><br>Rekam Akun</button>

@if(request()->button == null)
<a href="{{ route('sp2d.detail.delete-btn', $table_sp2d[0]->id) }}"><button><i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">add_box</i><br>Hapus Akun</button></a>
@elseif(request()->button == 'delete')
<a href="{{ route('sp2d.detail', $table_sp2d[0]->id) }}"><button><i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">verified_user</i><br>Validasi Akun</button></a>
@endif

<!-- The Modal -->
<div id="rekam" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="mdc-layout-grid__cell--span-2-desktop">

    Rekam Akun
    <span onclick="document.getElementById('rekam').style.display='none'" class="close" title="Close Modal">×</span>

    <form method="post" action="{{ route('sp2d.detail.store',$table_sp2d[0]->id) }}">
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
      <input class="mdc-text-field__input" id="text-field-hero-input" name="program" required  >
      <div class="mdc-notched-outline">
        <div class="mdc-notched-outline__leading"></div>
        <div class="mdc-notched-outline__notch">
          <label class="mdc-floating-label">Program</label>
        </div>
        <div class="mdc-notched-outline__trailing"></div>
      </div>
    </div>
    <br><br>
    <div class="mdc-text-field mdc-text-field--outlined">                       
      <input class="mdc-text-field__input" id="text-field-hero-input" name="output" required >
      <div class="mdc-notched-outline">
        <div class="mdc-notched-outline__leading"></div>
        <div class="mdc-notched-outline__notch">
          <label class="mdc-floating-label">Output</label>
        </div>
        <div class="mdc-notched-outline__trailing"></div>
      </div>
    </div>
    <br><br>
    
    <div class="mdc-text-field mdc-text-field--outlined">                       
      <input class="mdc-text-field__input" id="text-field-hero-input" name="nilai" required  type="number">
      <div class="mdc-notched-outline">
        <div class="mdc-notched-outline__leading"></div>
        <div class="mdc-notched-outline__notch">
          <label class="mdc-floating-label">Nilai</label>
        </div>
        <div class="mdc-notched-outline__trailing"></div>
      </div>
    </div>
    <br><br>
    <div class="mdc-text-field mdc-text-field--outlined">  
    <select name="sumber_dana" required name="sumber_dana">
      <option>- Select -</option>
      <option value="A">A (RM)</option>
      <option value="D">D (PNBP)</option>
      <option value="0">0 (Potongan)</option>      
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

                  <a href="{{ route('sp2d') }}"><button class="mdc-button mdc-button--raised icon-button filled-button--light">
                    <i class="material-icons mdc-button__icon">undo</i>
                  </button></a>

                  @if(request()->button == null)
                  <form method="post" action="{{ route('sp2d.valid',$table_sp2d[0]->id) }}">
                    @csrf
                  @endif
                    Detail akun SP2D Nomor Invoice {{ $table_sp2d[0]->nomor_invoice }}</h6>
                  <div class="table-responsive">

                    @if(request()->button == null)
                    {{-- button validasi akun --}}
                    <div align="right" style="padding-right: 30px">
                    <button onclick="document.getElementById('edit').style.display='block'" name="btn_valid"><i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">verified_user</i><br>Validasi Akun</button>
                    </div>
                    {{-- button validasi akun --}}
                    @endif

                    <table class="table table-striped">
                      <thead>
                  <tr>
                    <th>No</th>
                    <th class="text-center"></th>
                    <th class="text-left">Akun</th>                    
                    <th class="text-center">Program</th>
                    <th class="text-center">Output</th>
                    <th class="text-center">Sumber Dana</th> 
                    <th></th>                   
                    <th>Nilai</th>                  
                  </tr>
                </thead>
                <tbody>

                 @foreach ($table_sp2d_akun as $list_akun)
                  <tr>
                    <td width="2%">{{ $loop->iteration }}</td>
                    <td>
                      @if(request()->button == null)
                      {{-- checkbox --}}
                      <div class="mdc-form-field">
                      <div class="mdc-checkbox">
                        <input type="checkbox"
                                class="mdc-checkbox__native-control"
                                name="checkbox[]" value="{{ $list_akun->id }}" />
                        <div class="mdc-checkbox__background">
                          <svg class="mdc-checkbox__checkmark"
                                viewBox="0 0 24 24">
                            <path class="mdc-checkbox__checkmark-path"
                                  fill="none"
                                  d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
                          </svg>
                          <div class="mdc-checkbox__mixedmark"></div>
                        </div>
                      </div>
                      <label for="checkbox-1"></label>
                    </div>
                      {{-- checkbox --}}
                      @endif
                    </td>
                    <td width="45%" class="text-left">
                      <a href="#" onclick="document.getElementById('edit{{$list_akun->id}}').style.display='block'">
                      {{ $list_akun->akun.' ('.$list_akun->uraian.')' }}
                      </a>
                    </td>
                    <td width="15%" class="text-center">{{ $list_akun->program }}</td>        
                    <td width="15%" class="text-center">{{ $list_akun->output }}</td>   
                    <td width="5%" class="text-center">{{ $list_akun->sumber_dana }}</td>
                    <td>

                      @if($list_akun->ro == null && $list_akun->komponen == null && $list_akun->subkomponen == null)
                      <a href="{{ route('sp2d.valid', $list_akun->id) }}" data-toogle="tooltip" title="akun blom valid, harus divalidasi hingga subkomponen">
                      <font color="orange"><span class="material-icons">info</span></font>
                      </a>
                      @else
                      <a href="" data-toogle="tooltip" title="sss">
                      <font color="green"><span class="material-icons">check_circle</span></font>
                      </a>
                      @endif
                    </td>         
                    <td class="text-right">{{ number_format($list_akun->nilai) }}</td>
                    <td width="15">

                      @if(request()->button == 'delete')
                      {!! Form::open(['method' => 'POST', 'route' => ['sp2d.detail.delete', $list_akun->id] ]) !!}
                      <button type="submit" onclick="return confirm('Are you sure?')"><i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true" >delete</i></button>
                      {!! Form::close() !!}
                      @endif

                    </td> 
                  </tr>                
                  @endforeach
                  <tr>
                    <td class="text-center" colspan="7"><b>Total</b></td>
                    <td class="text-right">
                      <b>
                        {{ number_format($total_akun[0]->total_akun) }}
                      </b>
                    </td>
                  </tr>
                        
                      </tbody>

                    </table>
                  @if(request()->button == null)
                  </form>
                  @endif
                  </div>
                </div>
              </div>


@foreach($table_sp2d_akun as $edit)

  <div id="edit{{ $edit->id }}" class="modal">
  
  <!-- Modal content -->
  <div class="modal-content">
    <div class="mdc-layout-grid__cell--span-2-desktop">

    Edit Data
    <span onclick="document.getElementById('edit{{ $edit->id }}').style.display='none'" class="close" title="Close Modal">×</span>
    <form method="post" action="{{ route('sp2d.detail.edit',$edit->id) }}">
      @csrf
    <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--focused md-col-6">   

      <input type="hidden" name="id_sp2d" value="{{ $edit->id_sp2d }}">

      <input class="mdc-text-field__input" id="text-field-hero-input" name="akun" required value="{{ $edit->akun }}">
      <div class="mdc-notched-outline mdc-notched-outline--notched" type="number" minlength="6" maxlength="6">
        <div class="mdc-notched-outline__leading"></div>
        <div class="mdc-notched-outline__notch">
          <label class="mdc-floating-label mdc-floating-label--float-above">Akun</label>
        </div>
        <div class="mdc-notched-outline__trailing"></div>
      </div>
    </div>
    <br><br>
   <div class="mdc-text-field mdc-text-field--focused mdc-text-field--outlined">                       
      <input class="mdc-text-field__input" id="text-field-hero-input" name="program" required value="{{ $edit->program }}">
      <div class="mdc-notched-outline mdc-notched-outline--notched">
        <div class="mdc-notched-outline__leading"></div>
        <div class="mdc-notched-outline__notch">
          <label class="mdc-floating-label mdc-floating-label--float-above">Program</label>
        </div>
        <div class="mdc-notched-outline__trailing"></div>
      </div>
    </div>
    <br><br>
    <div class="mdc-text-field mdc-text-field--focused mdc-text-field--outlined">                       
      <input class="mdc-text-field__input" id="text-field-hero-input" name="output" required class="" value="{{ $edit->output }}">
      <div class="mdc-notched-outline mdc-notched-outline--notched">
        <div class="mdc-notched-outline__leading"></div>
        <div class="mdc-notched-outline__notch">
          <label class="mdc-floating-label mdc-floating-label--float-above">Output</label>
        </div>
        <div class="mdc-notched-outline__trailing"></div>
      </div>
    </div>
    <br><br>
    
    <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--focused ">                       
      <input class="mdc-text-field__input" id="text-field-hero-input" name="nilai" required  type="number" value="{{ $edit->nilai }}">
      <div class="mdc-notched-outline mdc-notched-outline--notched">
        <div class="mdc-notched-outline__leading"></div>
        <div class="mdc-notched-outline__notch">
          <label class="mdc-floating-label mdc-floating-label--float-above">Nilai</label>
        </div>
        <div class="mdc-notched-outline__trailing"></div>
      </div>
    </div>
    <br><br>
    <div class="mdc-text-field mdc-text-field--outlined">  
          <select name="sumber_dana" required name="sumber_dana">
      <option>{{ $edit->sumber_dana }}</option>
      <option value="A">A (RM)</option>
      <option value="D">D (PNBP)</option>
      <option value="0">0 (Potongan)</option>      
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

@foreach($table_sp2d_akun as $script)
 var modal = document.getElementById('edit{{$script->id}}');
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