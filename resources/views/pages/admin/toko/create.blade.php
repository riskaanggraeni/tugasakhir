@extends('layouts.admin')

@section('title')
    Toko
@endsection

@section('content')
<!-- Section Content -->
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Toko</h2>
            <p class="dashboard-subtitle">
             Create New Store
            </p>
        </div>
        <div class="dashboard-content">
           <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($error->all() as $error)
                            <li>{{ $error}}</li>
                        @endforeach
                    </ul>
                </div>
                    
                @endif
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('toko.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama Toko</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Logo</label>
                                        <input type="file" name="logo" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-rigt">
                                    <button type="submit" class="btn btn-primary px-5">
                                        Save Now
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
           </div>
        </div>
    </div>
</div>  
@endsection