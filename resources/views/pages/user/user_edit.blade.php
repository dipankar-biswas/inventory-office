@extends('layouts.master')

@section('content')
    <div class="main-content-inner">
        <div class="row mt-5">

            <!-- Form inputs start -->
            <div class="col-lg-8 m-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title d-flex justify-content-between">
                            <span>User Edit</span>
                            <a href="{{ route('user.list') }}" class="btn btn-sm btn-primary">Back</a>
                        </h4>
                        @if(Auth::user()->name == $users->name || Auth::user()->name == 'Admin')
                        <form action="{{ route('user.update',$users->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @endif
                            <div class="form-group">
                                <label for="rentProduct">Name</label>
                                <input type="text" name="name" value="{{ $users->name }}" class="form-control" placeholder="Enter Brand Name">
                                @error('name')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="rentProduct">Email</label>
                                <input type="email" name="email" value="{{ $users->email }}" class="form-control" placeholder="Enter Email">
                                @error('email')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            @if(Auth::user()->name == $users->name || Auth::user()->name == 'Admin')
                            <div class="form-group">
                                <label for="rentProduct">Password</label>
                                <input type="password" name="password" class="form-control">
                                @error('password')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="rentProduct">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                                @error('password_confirmation')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            @endif
                            <div class="form-group imageChange">
                                <label for="rentsImage">Image</label>
                                <input type="file" name="image" class="form-control imageSelect">
                                <img class="imagePreview mt-3 border rounded" src="{{ !empty($users->image)?asset($users->image):asset('backend/assets/images/no-image.png') }}" alt="Image" style="width:100px;height: 100px;object-fit:contain;">
                            </div>
                            <div class="form-group">
                                <label for="rentProduct">Account is : 
                                    @if(Auth::user()->name == $users->name && $users->status == 1 || Auth::user()->name == 'Admin' && $users->status == 1)
                                    <span class="badge badge-info">Active</span>
                                    @else
                                    <span class="badge badge-secondary">Inactive</span>
                                    @endif
                                </label>
                            </div>
                            @if(Auth::user()->name == $users->name || Auth::user()->name == 'Admin')
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Form inputs end -->

        </div>
    </div>
@endsection
