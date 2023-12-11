@extends('layouts.master')

@section('content')
    <div class="main-content-inner">
        <div class="row mt-5">

            <!-- Form inputs start -->
            <div class="col-lg-8 m-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title d-flex justify-content-between">
                            <span>Size Add</span>
                            <a href="{{ route('size.list') }}" class="btn btn-sm btn-primary">Back</a>
                        </h4>
                        <form action="{{ route('size.update',$sizes->id) }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="rentProduct">Name</label>
                                <input type="text" name="name" value="{{ $sizes->name }}" class="form-control" placeholder="Enter Size Name" value="{{old('name')}}">
                                @error('name')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary pr-4 pl-4">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Form inputs end -->

        </div>
    </div>
@endsection
