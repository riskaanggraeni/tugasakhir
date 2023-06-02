@extends('layouts.admin')

@section('title')
    Store Settings
@endsection

@section('content')
<!-- Section Content -->
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Product</h2>
            <p class="dashboard-subtitle">
             Edit "{{ $item->name}}"Product
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
                        <form action="{{ route('product.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama Product</label>
                                        <input type="text" name="name" class="form-control" value="{{ $item->name }}" required />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Pemilik Product</label>
                                      <select name="users_id" class="form-control">
                                        <option value="{{ $item->users_id}}">{{ $item->user->name}}</option>
                                        <option value="" disabled>-------------------</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id}}">{{ $user->name}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Kategori Product</label>
                                      <select name="categories_id" class="form-control">
                                        <option value="{{ $item->categories_id}}">{{ $item->category->name}}</option>
                                        <option value="" disabled>-------------------</option>
                                        @foreach ($categories as $categories)
                                            <option value="{{ $categories->id}}">{{ $categories->name}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="number" class="form-control" name="price" value="{{ $item->price}}" required />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea name="description" id="editor">{!! $item->description !!}</textarea>
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