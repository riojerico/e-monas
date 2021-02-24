@extends('master')
@section('pages')
<div class="page-wrapper mdc-toolbar-fixed-adjust">
  <main class="content-wrapper">
    <div class="mdc-layout-grid">
      <div class="mdc-layout-grid__inner">              
       

<!-- Trigger/Open The Modal -->

<button onclick="document.getElementById('rekam').style.display='block'"><i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">add_box</i><br>Rekam RO</button>


<div id="rekam" class="modal">
  
  <!-- Modal content -->
  <div class="modal-content">
    <div class="mdc-layout-grid__cell--span-2-desktop">

    Rekam RO
    <span onclick="document.getElementById('rekam').style.display='none'" class="close" title="Close Modal">×</span>
    <form method="post" action="{{ route('ro_store', $get_id[0]->id) }}">
      @csrf
    <div class="mdc-text-field mdc-text-field--outlined md-col-6">                       
      <input class="mdc-text-field__input" id="text-field-hero-input" name="kode" required>
      <div class="mdc-notched-outline" type="number" minlength="6" maxlength="6">
        <div class="mdc-notched-outline__leading"></div>
        <div class="mdc-notched-outline__notch">
          <label class="mdc-floating-label">Kode</label>
        </div>
        <div class="mdc-notched-outline__trailing"></div>
      </div>
    </div>
    <br><br>   
    <div class="mdc-text-field mdc-text-field--outlined">                       
      <input class="mdc-text-field__input" id="text-field-hero-input" name="ro" required>
      <div class="mdc-notched-outline">
        <div class="mdc-notched-outline__leading"></div>
        <div class="mdc-notched-outline__notch">
          <label class="mdc-floating-label">RO</label>
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
                  
                    Detail 
                    <font color="red"><b>
                    RO [{{ $get_id[0]->kode.' '.$get_id[0]->kro }}]
                    </b></font> 
                  </h6>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th class="text-left" >Kode</th>
                          <th class="text-left">RO/Kegiatan</th>
                          <th></th>                                    
                        </tr>
                      </thead>
                      <tbody>

                       @foreach ($ro as $data)                        
                        <tr>
                          <td width="2%">{{ $loop->iteration }}</td>
                          <td class="text-left">{{ $data->kode }}</td>         
                          <td class="text-left" ><a href="#" onclick="document.getElementById('edit{{$data->id}}').style.display='block'">{{ $data->ro }}</a></td>
                          
                          <td width="15">
                            {!! Form::open(['method' => 'POST', 'route' => ['ro_destroy', $data->id] ]) !!}
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


@foreach($ro as $data_edit)
  <div id="edit{{ $data_edit->id }}" class="modal">
  
  <!-- Modal content -->
  <div class="modal-content">
    <div class="mdc-layout-grid__cell--span-2-desktop">

    Edit Data
    <span onclick="document.getElementById('edit{{ $data_edit->id }}').style.display='none'" class="close" title="Close Modal">×</span>
    <form method="post" action="{{ route('ro_edit', $get_id[0]->id) }}">
      @csrf
      <input type="hidden" name="id_detail" value="{{ $data_edit->id }}">
    <div class="mdc-text-field mdc-text-field--outlined md-col-6">                       
      <input class="mdc-text-field__input" id="text-field-hero-input" name="kode" required value="{{ $data_edit->kode }}">
      <div class="mdc-notched-outline" type="number" minlength="6" maxlength="6">
        <div class="mdc-notched-outline__leading"></div>
        <div class="mdc-notched-outline__notch">
          <label class="mdc-floating-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kode</label>
        </div>
        <div class="mdc-notched-outline__trailing"></div>
      </div>
    </div>
    <br><br>   
    <div class="mdc-text-field mdc-text-field--outlined">                       
      <input class="mdc-text-field__input" id="text-field-hero-input" name="ro" required value="{{ $data_edit->ro }}">
      <div class="mdc-notched-outline">
        <div class="mdc-notched-outline__leading"></div>
        <div class="mdc-notched-outline__notch">
          <label class="mdc-floating-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RO</label>
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

@foreach($ro as $data_script)
  var modal = document.getElementById('edit{{$data_script->id}}');
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

