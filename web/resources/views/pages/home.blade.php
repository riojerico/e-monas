@extends('master')
@section('pages')
<div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper">
          <div class="mdc-layout-grid">
            <div class="mdc-layout-grid__inner">
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                <div class="mdc-card info-card info-card--success">
                  <div class="card-inner">
                    <h5 class="card-title">Pagu Dipa</h5>
                    <h5 class="font-weight-light pb-2 mb-1 border-bottom">$62,0076.00</h5>
                    <p class="tx-12 text-muted">48% target reached</p>
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
                    <h5 class="font-weight-light pb-2 mb-1 border-bottom">$1,958,104.00</h5>
                    <p class="tx-12 text-muted">55% target reached</p>
                    <div class="card-icon-wrapper">
                      <i class="material-icons">attach_money</i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                <div class="mdc-card info-card info-card--primary">
                  <div class="card-inner">
                    <h5 class="card-title">Dipa PNBP</h5>
                    <h5 class="font-weight-light pb-2 mb-1 border-bottom">$234,769.00</h5>
                    <p class="tx-12 text-muted">87% target reached</p>
                    <div class="card-icon-wrapper">
                      <i class="material-icons">trending_up</i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                <div class="mdc-card info-card info-card--info">
                  <div class="card-inner">
                    <h5 class="card-title">Penyerapan Dipa </h5>
                    <h5 class="font-weight-light pb-2 mb-1 border-bottom">$1,200.00</h5>
                    <p class="tx-12 text-muted">87% target reached</p>
                    <div class="card-icon-wrapper">
                      <i class="material-icons">credit_card</i>
                    </div>
                  </div>
                </div>
              </div>
              
    
            </div>
          </div>
        </main>
        <!-- partial:partials/_footer.html -->
        @include('layouts.footer')
        <!-- partial -->
      </div>
@endsection