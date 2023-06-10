@extends('layouts.dashboard')

@section('title')
    Store Dashboard Product Detail
@endsection

@section('content')
<div
class="section-content section-dashboard-home"
data-aos="fade-up"
>
<div class="container-fluid">
  <div class="dashboard-heading">
    {{-- <h2 class="dashboard-title">{{ $products->name }}</h2> --}}
    <p class="dashboard-subtitle">
      Product Details
    </p>
  </div>
  <div class="dashboard-content">
    <div class="row">
      <div class="col-12">
        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($error->all() as $error)
                            <li>{{ $error}}</li>
                        @endforeach
                    </ul>
                </div> 
                @endif
        <form action="{{ route('dashboard-product-update', $product->id) }}" method="POST">
          @csrf
          <input type="hidden" name="users_id" value="{{ Auth::users()->id}}">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">Product Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="name"
                      aria-describedby="name"
                      name="storeName"
                      value="{{ $products->name }}"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="price">Price</label>
                    <input
                      type="number"
                      class="form-control"
                      id="price"
                      aria-describedby="price"
                      name="price"
                      value="{{ $products->price}}"
                    />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Kategori</label>
                    <select name="categories_id" class="form-control">
                      <option value="{{ $product->categories_id}}">Tidak diganti ({{ $product->category->name}})</option>
                      @foreach ($categories as $category)
                      <option value="{{ $category->id}}">{{ $category->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="editor">{!! $product->description !!}</textarea>
                    </textarea>
                  </div>
                </div>
              </div>
                <div class="row">
                  <div class="col text-right">
                    <button
                    type="submit"
                    class="btn btn-primary btn-block px-5"
                  >
                    Save Now
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              @foreach ($product->galleries as $gallery)
                <div class="col-md-4">
                  <div class="gallery-container">
                    <img
                      src="{{ Storage::url($gallery->photos ?? '') }}"
                      alt=""
                      class="w-100"
                    />
                    <a href="{{ route('dashboard-product-gallery-delete', $gallery->id) }}" class="delete-gallery">
                      <img src="/images/icon-delete.svg" alt="" />
                    </a>
                  </div>
                </div>
              @endforeach
              <div class="col-12">
                <form action="{{ route('dashboard-product-gallery-upload') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" value="{{ $product->id }}" name="products_id">
                  <input
                    type="file"
                    name="photos"
                    id="file"
                    style="display: none;"
                    multiple
                    onchange="form.submit()"
                  />
                  <button
                    type="button"
                    class="btn btn-secondary btn-block mt-3"
                    onclick="thisFileUpload()"
                  >
                    Add Photo
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection

@push('addon-script')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
  function thisFileUpload() {
    document.getElementById("file").click();
  }
</script>
<script>
  CKEDITOR.replace("editor");
</script>
@endpush

