@extends('layouts.master')

@section('content')
    <div class="main-content-inner">
        <div class="row mt-5">

            <!-- Form inputs start -->
            <div class="col-lg-8 m-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title d-flex justify-content-between">
                            <span>Product Edit</span>
                            <a href="{{ route('stock.list') }}" class="btn btn-sm btn-primary">Back</a>
                        </h4>
                        <form action="{{ route('stock.update',$stocks->id) }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="">Name *</label>
                                <input type="text" name="name" value="{{ $stocks->name }}" class="form-control" placeholder="Enter Product Name">
                                @error('name')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Model</label>
                                        <select class="select-form form-control" name="model_id">
                                            <option value="" selected>Select Name</option>
                                            @foreach ($models as $item)
                                            <option value="{{ $item->id }}" {{ $stocks->model_id == $item->id ? 'selected':'' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('model_id')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Capacity</label>
                                        <select class="select-form form-control" name="capacity_id">
                                            <option value="" selected>Select Name</option>
                                            @foreach ($capacities as $item)
                                            <option value="{{ $item->id }}" {{ $stocks->capacity_id == $item->id ? 'selected':'' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('capacity_id')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Brand *</label>
                                        <select class="select-form form-control" name="brand_id">
                                            <option value="" selected>Select Name</option>
                                            @foreach ($brands as $item)
                                            <option value="{{ $item->id }}" {{ $stocks->brand_id == $item->id ? 'selected':'' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Category *</label>
                                        <select class="select-form form-control" name="category_id">
                                            <option value="" selected>Select Name</option>
                                            @foreach ($categories as $item)
                                            <option value="{{ $item->id }}" {{ $stocks->category_id == $item->id ? 'selected':'' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Color *</label>
                                        <select class="select-form form-control" name="color_id">
                                            <option value="" selected>Select Name</option>
                                            @foreach ($colors as $item)
                                            <option value="{{ $item->id }}" {{ $stocks->color_id == $item->id ? 'selected':'' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('color_id')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Size</label>
                                        <select class="select-form form-control" name="size_id">
                                            <option value="" selected>Select Name</option>
                                            @foreach ($sizes as $item)
                                            <option value="{{ $item->id }}" {{ $stocks->size_id == $item->id ? 'selected':'' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('size_id')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- 
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Qty *</label>
                                            <input type="text" class="form-control" name="qty" value="{{ $stocks->qty }}">
                                            @error('qty')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                --}}

                            </div>
                            <div class="form-group imageChange">
                                <label for="rentsImage">Image</label>
                                <input type="file" name="image" class="form-control imageSelect">
                                <img class="imagePreview mt-3 border rounded" src="{{ !empty($stocks->image) ? asset($stocks->image) : asset('backend/assets/images/no-image.png') }}" alt="Image" style="width:100px;height: 100px;object-fit:contain;">
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
