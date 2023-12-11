@extends('layouts.master')

@section('content')
    <div class="main-content-inner">
        <div class="row mt-5">

            <!-- Form inputs start -->
            <div class="col-lg-8 m-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title d-flex justify-content-between">
                            <span>Product Add</span>
                            <a href="{{ route('product.list') }}" class="btn btn-sm btn-primary">Back</a>
                        </h4>
                        <form action="{{ route('product.update',$products->id) }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="rentProduct">Name</label>
                                <input type="text" name="name" value="{{ $products->name }}" class="form-control" placeholder="Enter Product Name">
                                @error('name')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group imageChange">
                                <label for="rentsImage">Image</label>
                                <input type="file" name="image" class="form-control imageSelect">
                                <img class="imagePreview mt-3 border rounded" src="{{ !empty($products->image) ? asset($products->image) : asset('backend/assets/images/no-image.png') }}" alt="Image" style="width:100px;height: 100px;object-fit:contain;">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Form inputs end -->

        </div>
    </div>
@endsection
