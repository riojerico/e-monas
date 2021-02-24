@extends('master')
@section('pages')
<div class="page-wrapper mdc-toolbar-fixed-adjust">
  <main class="content-wrapper">
    <div class="mdc-layout-grid">
      <div class="mdc-layout-grid__inner">              
       
        <!-- Trigger/Open The Modal -->
<button id="myBtn"><i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">add_box</i><br>Rekam Akun</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="mdc-layout-grid__cell--span-2-desktop">

    Rekam Akun
    <span class="close">&times;</span>
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

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");
</script>


        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                <div class="mdc-card p-0">

                  <h6 class="card-title card-padding pb-0">

                  <a href="{{ route('sp2d') }}"><button class="mdc-button mdc-button--raised icon-button filled-button--light">
                    <i class="material-icons mdc-button__icon">undo</i>
                  </button></a>
                  
                    Detail akun SP2D Nomor Invoice {{ $table_sp2d[0]->nomor_invoice }}</h6>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                  <tr>
                    <th>No</th>
                    <th>Akun</th>
                    <th>Program</th>
                    <th>Output</th>
                    <th>Sumber Dana</th>                    
                    <th>Nilai</th>                   
                  </tr>
                </thead>
                <tbody>

                 @foreach ($table_sp2d_akun as $list_akun)
                  <tr>
                    <td width="2%">{{ $loop->iteration }}</td>
                    <td width="15%">{{ $list_akun->akun }}</td>
                    <td width="25%">{{ $list_akun->program }}</td>        
                    <td width="25%">{{ $list_akun->output }}</td>   
                    <td width="5%">{{ $list_akun->sumber_dana }}</td>         
                    <td class="text-right">{{ number_format($list_akun->nilai) }}</td>
                  </tr>                
                  @endforeach
                  <tr>
                    <td class="text-center" colspan="5"><b>Total</b></td>
                    <td ><b>{{ number_format($total_akun[0]->total_akun) }}</b></td>
                  </tr>
                        
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