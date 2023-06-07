@extends('layouts.dashboard')

@section('title')
    Store Dashboard
@endsection

@section('content')
<div
class="section-content section-dashboard-home"
data-aos="fade-up"
>
<div class="container-fluid">
  <div class="dashboard-heading">
    <h2 class="dashboard-title">Dashboard</h2>
    <p class="dashboard-subtitle">
      {{-- Look what you have made today! --}}
    </p>
  </div>
  <div class="dashboard-content">
  
    <div class="row mt-3">
      <div class="col-12 mt-2">
        <h5 class="mb-3">Recent Transactions</h5>
        <a
          class="card card-list d-block"
          href="dashboard-transactions-details.html"
        >
          <div class="card-body">
            <div class="row">
              <div class="col-md-1">
                <img
                  src="images/dashboard-icon-product-1.png"
                  alt=""
                />
              </div>
              <div class="col-md-4">
                Kemeja HIMIT
              </div>
              <div class="col-md-3">
                Cahya
              </div>
              <div class="col-md-3">
                12 Januari, 2023
              </div>
              <div class="col-md-1 d-none d-md-block">
                <img
                  src="images/dashboard-arrow-right.svg"
                  alt=""
                />
              </div>
            </div>
          </div>
        </a>
        <a
          class="card card-list d-block"
          href="dashboard-transactions-details.html"
        >
          <div class="card-body">
            <div class="row">
              <div class="col-md-1">
                <img
                  src="images/dashboard-icon-product-2.png"
                  alt=""
                />
              </div>
              <div class="col-md-4">
                Lanyard
              </div>
              <div class="col-md-3">
                Farida
              </div>
              <div class="col-md-3">
                11 January, 2020
              </div>
              <div class="col-md-1 d-none d-md-block">
                <img
                  src="images/dashboard-arrow-right.svg"
                  alt=""
                />
              </div>
            </div>
          </div>
        </a>
        <a
          class="card card-list d-block"
          href="dashboard-transactions-details.html"
        >
          <div class="card-body">
            <div class="row">
              <div class="col-md-1">
                <img
                  src="images/dashboard-icon-product-3.png"
                  alt=""
                />
              </div>
              <div class="col-md-4">
                Stiker HIMIT
              </div>
              <div class="col-md-3">
                Ranid
              </div>
              <div class="col-md-3">
                11 January, 2020
              </div>
              <div class="col-md-1 d-none d-md-block">
                <img
                  src="images/dashboard-arrow-right.svg"
                  alt=""
                />
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>
</div>
    
@endsection

