@extends('master')
@section('pages')
<div class="page-wrapper mdc-toolbar-fixed-adjust">
  <main class="content-wrapper">
    <div class="mdc-layout-grid">
      <div class="mdc-layout-grid__inner">
        
        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
          <div class="mdc-card p-0">
            <h6 class="card-title card-padding pb-0">Laporan Keadaan Kas</h6>
            <div class="table-responsive">
              <table class="table table-hoverable">
                <thead>
                  <tr>
                    <th class="text-left"><b>
                      <font color="#483D8B">Program</font> / 
                      <font color="#6495ED">Kegiatan</font> / 
                      <font color="red">KRO</font> / 
                      RO / Komponen / 
                      <u><i>Subkomponen</i></u> /
                      </b>
                      Akun
                    
                    </th>
                    <th>Pagu Dalam Dipa</th>
                    <th>SP2D S.D Bulan Lalu</th>
                    <th>SP2D Bulan Ini</th>
                    <th>Jumlah SP2D S.D Bulan Ini</th>
                    <th>Sisa Dana</th>
                    <th>SD</th>
                   
                  </tr>
                </thead>
                <tbody>
                  <?php $i=0; ?>                  
                  <?php $i2=0; ?>
                  <?php $i3=0; ?>
                  <?php $i4=0; ?>
                  <?php $i5=0; ?>
                  <?php $i6=0; ?>
                  <?php $i7=0; ?>

                  @foreach($program as $programs)
                  
                  <tr>
                    <td class="text-left">
                      <b><font color="#483D8B">
                      <a href="{{ route('lkka_act', $programs->id_prog) }}">{{ $programs->kode_prog.' '.$programs->nama_program }}</a>
                      </font></b>
                    </td>
                    <td><font color="#483D8B"><b>{{ number_format($pagu_program[$loop->index]) }}</b></td>
                    <td><font color="#483D8B"><b>{{ number_format($real_prog_last[$loop->index]) }}</b></font></td>
                    <td><font color="#483D8B"><b>{{ number_format($real_prog_curr[$loop->index]) }}</b></font></td>
                    <td><font color="#483D8B"><b>{{ number_format($real_prog_tott[$loop->index]) }}</b></font></td>
                    <td><font color="#483D8B"><b>{{ number_format($pagu_program[$loop->index]-$real_prog_tott[$loop->index]) }}</b></font></td>
                    <td><font color="#483D8B"><b></b></font></td>        
                  </tr>        
                        
                    {{-- for aktivitas --}}
                    @foreach($aktivitas[$loop->index] as $acts) 
                      
                    <tr>
                      <td class="text-left">
                        <a href="{{route('lkka_kro', $acts->id_act)}}">
                        <b><font color="#6495ED">{{ $acts->kode_act.' '.$acts->nama_aktivitas }}</font></b>
                        </a>
                      </td>
                      <td><b>
                        <font color="#6495ED">{{ number_format($pagu_aktivitas[$i2]) }}</font></b>
                      </td>
                      <td><b>
                        <font color="#6495ED">{{ number_format($real_act_last[$i2]) }}</font></b>
                      </td>
                      <td><b>
                        <font color="#6495ED">{{ number_format($real_act_curr[$i2]) }}</font></b>
                      </td>
                      <td><b>
                        <font color="#6495ED">{{ number_format($real_act_tott[$i2]) }}</font></b>
                      </td>
                      <td><b>
                        <font color="#6495ED">{{ number_format($pagu_aktivitas[$i2]-$real_act_tott[$i2]) }}</font></b>
                      </td>
                      <td></td>
                    </tr>                                                                             
                      {{-- for kro --}}                                              
                         @foreach($kro[$i2] as $kros)  
                          @if(isset($kros->kode_kro))                                        
                           <tr>
                            <td class="text-left">
                              <a href="{{route('lkka_ro', $kros->id_kro)}}">
                              <b><font color="red"> 
                              {{ $kros->kode_act.'.'.$kros->kode_kro.' '.$kros->kro }}
                            </font></b>
                              </a>
                          </td>
                            <td><b><font color="red"> 
                              {{ number_format($pagu_kro[$i3]) }}
                            </font></b></td>
                            <td><b><font color="red"> 
                              {{ number_format($real_kro_last[$i3]) }}
                            </font></b></td>
                            <td><b><font color="red"> 
                              {{ number_format($real_kro_curr[$i3]) }}
                            </font></b></td>
                            <td><b><font color="red"> 
                              {{ number_format($real_kro_tott[$i3]) }}
                            </font></b></td>
                            <td><b><font color="red"> 
                              {{ number_format($pagu_kro[$i3]-$real_kro_tott[$i3]) }}
                            </font></b></td>
                            <td></td>
                          </tr>
                          {{-- for ro --}}                          
                          @foreach($ro[$i3] as $ros)
                            @if(isset($ros->kode_ro)) 
                            <tr>
                              <td class="text-left">
                                <a href="{{ route('lkka_komponen', $ros->id_ro) }}">
                                <font color="black">
                                <b>{{ $kros->kode_act.'.'.$kros->kode_kro.'.'.$ros->kode_ro.' '.$ros->ro }}</b>
                                </font>
                                </a>
                              </td>
                              <td><b>{{ number_format($pagu_ro[$i4]) }}</b></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            {{-- for komponen --}}
                            @foreach($komponen[$i4] as $komp)
                            @if(isset($komp->kode_komponen)) 
                            <tr>
                              <td class="text-left">
                                <a href="{{ route('lkka_subkomponen', $komp->id_komp) }}">
                                  <font color="black">
                                {{ $kros->kode_act.'.'.$kros->kode_kro.'.'.$ros->kode_ro.'.'.$komp->kode_komponen.' '.$komp->komponen }}
                              </font>
                              </a>
                              </td>
                              <td>{{ number_format($pagu_komp[$i5]) }}</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            {{-- for sub komponen --}}
                                @foreach($subkomponen[$i5] as $sub)
                                @if(isset($sub->kode_subkomponen)) 
                                <tr>
                                  <td class="text-left">
                                    <a href="{{ route('lkka_akun',$sub->id_sub) }}">
                                      <font color="black">
                                    <u><i>{{ $sub->kode_subkomponen.' '.$sub->subkomponen }}</i></u>
                                      </font>
                                    </a>
                                  </td>
                                  <td><u><i>{{ number_format($pagu_sub[$i6]) }}</i></u></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td>
                                    
                                  </td>
                                </tr> 
                                {{-- for akun --}}
                                @foreach($akuns[$i6] as $akun)
                                @if(isset($akun->akun)) 
                                <tr>
                                  <td class="text-left">{{ $akun->akun.' ('.$akun->uraian.')' }}</td>
                                  <td>{{ number_format($akun->anggaran) }}</td>
                                  <td>{{ number_format($real_akun_last[$i7]) }}</td>
                                  <td>{{ number_format($real_akun_curr[$i7]) }}</td>
                                  <td>{{ number_format($real_akun_tott[$i7]) }}</td>
                                  <td>{{ number_format($akun->anggaran-$real_akun_tott[$i7]) }}</td>
                                  <td>
                                    <u><i>
                                      @if($akun->sumber_dana == "PNBP")
                                      D
                                      @elseif($akun->sumber_dana == "RM")
                                      A
                                      @endif
                                    </i></u>
                                  </td>
                                </tr>
                                <?php $i7++; ?>
                                @endif
                                @endforeach
                                {{-- end akun --}}
                                <?php $i6++; ?>
                                @endif
                                @endforeach
                            {{-- end sub komponen --}}

                            <?php $i5++; ?>
                            @endif
                            @endforeach
                            {{-- end komponen --}}
                            <?php $i4++; ?>
                            @endif
                          @endforeach
                          {{-- end ro --}}
                          <?php $i3++; ?>
                             @endif
                         
                         @endforeach 
                      {{-- end kro --}}
                    

                    <?php $i2++; ?>
                    @endforeach  
                    {{-- end aktivitas --}}
                    
                    <?php $i++; ?>
                  @endforeach {{-- end programs --}} 
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