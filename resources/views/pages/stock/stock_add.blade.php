@extends('layouts.master')

@section('content')
<div class="main-content-inner">
    <div class="row mt-5">

        <!-- Form inputs start -->
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title d-flex justify-content-between">
                        <span style="font-size: 26px;">Product Add</span>
                        <a href="{{ route('stock.list') }}" class="btn btn-sm btn-primary">Back</a>
                    </h4>


                    <form method="post" enctype="multipart/form-data" id="stockForm">
                        @csrf

                        <div id="addMoreColumn">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <!-- <label for="">Name *</label> -->
                                        <input type="text" name="name" class="form-control" placeholder="Enter product name *">
                                        <small id="errname" class="form-text"></small>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <!-- <label for="">Category *</label> -->
                                        <select class="select-form form-control" name="category_id">
                                            <option value="" selected>Select Category *</option>
                                            @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <small id="errcategory_id" class="form-text"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <!-- <label for="">Brand*</label> -->
                                        <select class="select-form form-control" name="brand_id">
                                            <option value="" selected>Select Brand *</option>
                                            @foreach ($brands as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <small id="errbrand_id" class="form-text"></small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <!-- <label for="">Color*</label> -->
                                        <select class="select-form form-control" name="color_id">
                                            <option value="" selected>Select Color *</option>
                                            @foreach ($colors as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <small id="errcolor_id" class="form-text"></small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <!-- <label for="">Model</label> -->
                                        <select class="select-form form-control" name="model_id">
                                            <option selected value="">Select Model</option>
                                            @foreach ($models as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <small id="errmodel_id" class="form-text"></small>
                                    </div>
                                </div>
                            </div>
                            <div id="addMoreRowDiv">
                                <div class="row px-5">
                                    <div class="col-sm-11">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <!-- <label for="">Qty*</label> -->
                                                    <input type="text" class="form-control form-control-sm" name="qty[]" placeholder="Qty *">
                                                    <small id="errqty_0" class="form-text"></small>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <!-- <label for="">Size</label> -->
                                                    <select class="select-form form-control form-select-sm" name="size_id[]">
                                                        <option selected value="">Select Size</option>
                                                        @foreach ($sizes as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <small id="errsize_id" class="form-text"></small>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <!-- <label for="">Capacity</label> -->
                                                    <select class="select-form form-control form-select-sm" name="capacity_id[]">
                                                        <option selected value="">Select Capacity</option>
                                                        @foreach ($capacities as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <small id="errcapacity_id[]" class="form-text"></small>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group imageChange d-flex gap-2">
                                                    <div class="">
                                                        <!-- <label for="rentsImage">Image</label> -->
                                                        <input type="file" name="image[]" class="form-control form-control-sm imageSelect" style="width:0;height:0;padding:0">
                                                    </div>
                                                    <img class="imagePreview border rounded" src="{{ asset('backend/assets/images/no-image.png') }}" alt="Image" style="width:60px;height: 60px;object-fit:contain;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="">
                            <button type="button" id="addMoreRow" class="btn btn-dark float-right">Add Row +</button>
                        </div>

                        <button type="submit" class="btn btn-primary pr-4 pl-4">Save</button>
                    </form>



                </div>
            </div>
        </div>
        <!-- Form inputs end -->

    </div>
</div>
<style type="text/css">
    .select-form {
        height: 45px !important;
    }
    .form-select-sm {
        padding: 0.25rem 0.5rem !important;
        height: 34px !important;
    }
</style>
@endsection