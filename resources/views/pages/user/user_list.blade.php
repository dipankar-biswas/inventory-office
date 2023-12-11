@extends('layouts.master')

@section('content')
<div class="main-content-inner">
    <div class="row">
       
        @section('breadcrumbs')
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ url('/') }}">Dashboard</a></li>
            <li><span>User</span></li>
        </ul>
        @endsection
        <!-- Form inputs start -->
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title d-flex justify-content-between">
                        <span>User list</span>
                        @if(Auth::user()->name == 'Admin')
                        <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">Add User</a>
                        @endif
                    </h4>

                    <div class="data-tables">

                    @if($users != null)

                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach($users as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><img src="{{ !empty($item->image)?asset($item->image):'/backend/assets/images/no-image.png' }}" alt="Image" style="width: 50px;height:40px"></td>
                                    <td>{{ucfirst(substr($item->name, 0, 20))}}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        @if(Auth::user()->name == $item->name || Auth::user()->name == 'Admin')
                                        <a href="{{ route('user.show',$item->id) }}">Edit</a> 
                                        @else
                                        <a href="{{ route('user.show',$item->id) }}">Show</a> 
                                        @endif

                                        @if(Auth::user()->name == $item->name || Auth::user()->name == 'Admin')
                                        @if($item->name != 'Admin')
                                            @if($item->status == 1)
                                                | <a href="{{ route('user.delete',$item->id) }}">Deactive</i></a>
                                            @else
                                                | <a href="{{ route('user.delete',$item->id) }}">Active</i></a>
                                            @endif
                                        @endif
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    @else
                        <hr>
                        <p class="h5 text-center">Data not found!</p>
                    @endif

                    </div>
                </div>
            </div>
        </div>
        <!-- Form inputs end -->
               
    </div>
</div>
@endsection