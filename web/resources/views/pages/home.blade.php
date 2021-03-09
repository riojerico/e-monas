@extends('master')
@section('pages')
<div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper">

          <div class="mdc-layout-grid__inner"> 

            {{-- row 1 --}}
            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
              <div class="mdc-card info-card info-card--success">
                <div class="card-inner">
                  <h5 class="card-title">Pagu Dipa</h5>
                  <h5 class="font-weight-light pb-2 mb-1 border-bottom">

                  Rp. {{ number_format($pagu_dipa) }},-</h5>
                  <p class="tx-12 text-muted"></p>
                  <div class="card-icon-wrapper">
                    <i class="material-icons">dvr</i>
                  </div>
                </div>
              </div>
            </div>
            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
              <div class="mdc-card info-card info-card--danger">
                <div class="card-inner">
                  <h5 class="card-title">Dipa Rupiah Murni</h5>
                  <h5 class="font-weight-light pb-2 mb-1 border-bottom">
                  Rp. {{ number_format($pagu_rm) }},-</h5>
                  <p class="tx-12 text-muted"></p>
                  <div class="card-icon-wrapper">
                    <i class="material-icons">credit_card</i>
                  </div>
                </div>
              </div>
            </div>
            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
              <div class="mdc-card info-card info-card--primary">
                <div class="card-inner">
                  <h5 class="card-title">Dipa PNBP</h5>
                  <h5 class="font-weight-light pb-2 mb-1 border-bottom">
                    Rp. {{ number_format($pagu_pnbp) }},-
                  </h5>
                  <p class="tx-12 text-muted"></p>
                  <div class="card-icon-wrapper">
                    <i class="material-icons">credit_card</i>
                  </div>
                </div>
              </div>
            </div> 
            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
              <div class="mdc-card info-card info-card--info">
                <div class="card-inner">
                  <h5 class="card-title">Penyerapan Dipa </h5>
                  <h5 class="font-weight-light pb-2 mb-1 border-bottom">
                  Rp. {{ number_format($penyerapan) }},-</h5>
                  <p class="tx-12 text-muted"><b>{{ number_format($persen_penyerapan, 2) }}%</b>
                  target reach!</p>
                  <div class="card-icon-wrapper">
                    <i class="material-icons">trending_up</i>
                  </div>
                </div>
              </div>
            </div>
            {{-- end row 1 --}}

            {{-- row 2 --}}
            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12 mdc-layout-grid__cell--span-8-tablet">
              <div class="mdc-card">
                <div class="d-flex d-lg-block d-xl-flex justify-content-between">
                  <div>
                    <h4 class="card-title">Penyerapan Anggaran</h4>
                    <h6 class="card-sub-title">Kantor Pertanahan Kab. Boalemo</h6>
                  </div>
                  <div id="penyerapan-legend" class="d-flex flex-wrap"></div>
                </div>
                <div class="chart-container mt-4">
                  <canvas id="chart-penyerapan" height="70"></canvas>
                </div>
              </div>
            </div>
            {{-- end row 2 --}}

          </div>

        </main>
        <!-- partial:partials/_footer.html -->
        @include('layouts.footer')
        <!-- partial -->
      </div>
@endsection

@push('js-pages')

<script type="text/javascript">
//Sales Chart
    if ($("#chart-penyerapan").length) {
        var penyerapanChartCanvas = $("#chart-penyerapan").get(0).getContext("2d");
        var gradient1 = penyerapanChartCanvas.createLinearGradient(0, 0, 0, 230);
        gradient1.addColorStop(0, '#55d1e8');
        gradient1.addColorStop(1, 'rgba(255, 255, 255, 0)');

        var gradient2 = penyerapanChartCanvas.createLinearGradient(0, 0, 0, 160);
        gradient2.addColorStop(0, '#1bbd88');
        gradient2.addColorStop(1, 'rgba(255, 255, 255, 0)');

        var penyerapanChart = new Chart(penyerapanChartCanvas, {
          type: 'line', 
          data: {
            labels: 
              {!! json_encode($bulan) !!}
            ,
            datasets: [{
                data:  
                   {!! json_encode($penyerapan_chart_rm) !!}                  
                ,
                backgroundColor: gradient1,
                borderColor: [
                  '#ff420f'
                ],
                borderWidth: 2,
                pointBorderColor: "#ff420f",
                pointBorderWidth: 4,
                pointRadius: 1,
                fill: 'origin',
              },
              {
                data: 
                  {!! json_encode($penyerapan_chart_pnbp) !!}
                ,
                backgroundColor: gradient2,
                borderColor: [
                  '#7a00ff'
                ],
                borderWidth: 2,
                pointBorderColor: "#7a00ff",
                pointBorderWidth: 4,
                pointRadius: 1,
                fill: 'origin',
              }
            ]
          },
          options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
              filler: {
                propagate: false
              }
            },
            scales: {
              xAxes: [{
                ticks: {
                  fontColor: "#bababa"
                },
                gridLines: {
                  display: false,
                  drawBorder: false
                }
              }],
              yAxes: [{
                ticks: {
                  fontColor: "#bababa",
                  stepSize: {{ $max/20 }},
                  min: 0,
                  max: {{ $max }}
                },
                gridLines: {
                  drawBorder: false,
                  color: "rgba(101, 103, 119, 0.21)",
                  zeroLineColor: "rgba(101, 103, 119, 0.21)"
                }
              }]
            },
            legend: {
              display: false
            },
            tooltips: {
              enabled: true
            },
            elements: {
                line: {
                    tension: 0
                }
            },
            legendCallback : function(chart) {
              var text = [];
              text.push('<div>');
              text.push('<div class="d-flex align-items-center">');
              text.push('<span class="bullet-rounded" style="border-color: ' + chart.data.datasets[1].borderColor[0] +' "></span>');
              text.push('<p class="tx-12 text-muted mb-0 ml-2">PNBP</p>');
              text.push('</div>');
              text.push('<div class="d-flex align-items-center">');
              text.push('<span class="bullet-rounded" style="border-color: ' + chart.data.datasets[0].borderColor[0] +' "></span>');
              text.push('<p class="tx-12 text-muted mb-0 ml-2">Rupiah Murni</p>');
              text.push('</div>');
              text.push('</div>');
              return text.join('');
            },
          }
        });
      document.getElementById('penyerapan-legend').innerHTML = penyerapanChart.generateLegend();
    }
</script>
@endpush