@php
    $setting = App\Models\Setting::where('id',1)->first();
@endphp
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('dashboard') }}" target="_blank">
                @if(isset($setting->header_logo))
                 <img src="{{ asset($setting->header_logo) }}" 
                    alt="SKB Inventory" class="mw-120 h-30px h-md-60px">
                @endif
            </a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="tree">
                        <a href="{{ route('dashboard') }}" aria-expanded="true" class="link-item"><i class="ti-dashboard"></i><span>dashboard</span></a>
                    </li>
                    <li class="tree">
                        <a href="javascript:void(0)" aria-expanded="true" class="link"><i class="ti-money"></i><span>Model</span></a>
                        <ul class="">
                            <li><a href="{{ route('model.list') }}" class="link-item">Model List</a></li>
                            <li><a href="{{ route('model.create') }}" class="link-item">Add Model</a></li>
                        </ul>
                    </li>
                    <li class="tree">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-money"></i><span>Brand</span></a>
                        <ul class="collapse">
                            <li><a href="{{ route('brand.list') }}" class="link-item">Brand List</a></li>
                            <li><a href="{{ route('brand.create') }}" class="link-item">Add Brand</a></li>
                        </ul>
                    </li>
                    <li class="tree">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-money"></i><span>Categories</span></a>
                        <ul class="collapse">
                            <li><a href="{{ route('category.list') }}" class="link-item">Category List</a></li>
                            <li><a href="{{ route('category.create') }}" class="link-item">Add Category</a></li>
                        </ul>
                    </li>
                    <li class="tree">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-money"></i><span>Capacity</span></a>
                        <ul class="collapse">
                            <li><a href="{{ route('capacity.list') }}" class="link-item">Capacity List</a></li>
                            <li><a href="{{ route('capacity.create') }}" class="link-item">Add Capacity</a></li>
                        </ul>
                    </li>
                    <li class="tree">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-money"></i><span>Color</span></a>
                        <ul class="collapse">
                            <li><a href="{{ route('color.list') }}" class="link-item">Color List</a></li>
                            <li><a href="{{ route('color.create') }}" class="link-item">Add Color</a></li>
                        </ul>
                    </li>
                    <li class="tree">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-money"></i><span>Size</span></a>
                        <ul class="collapse">
                            <li><a href="{{ route('size.list') }}" class="link-item">Size List</a></li>
                            <li><a href="{{ route('size.create') }}" class="link-item">Add Size</a></li>
                        </ul>
                    </li>
                    <li class="tree">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-money"></i><span>Products</span></a>
                        <ul class="collapse">
                            <li><a href="{{ route('stock.list') }}" class="link-item">Product List</a></li>
                            <li><a href="{{ route('stock.create') }}" class="link-item">Add Product</a></li>
                        </ul>
                    </li>
                    <li class="tree">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-money"></i><span>Stockin Manage</span></a>
                        <ul class="collapse">
                            <li><a href="{{ route('stockin.list') }}" class="link-item">Stockout List</a></li>
                            <li><a href="{{ route('stockadd.extrastockadd') }}" class="link-item">Add Stock</a></li>
                        </ul>
                    </li>

                    <li class="tree">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-money"></i><span>Stockout Manage</span></a>
                        <ul class="collapse">
                            <li><a href="{{ route('stockout.list') }}" class="link-item">Stockout List</a></li>
                            <li><a href="{{ route('stockout.all') }}" class="link-item">Stockout</a></li>

                        </ul>
                    </li>
                    <li class="tree">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-money"></i><span>Refund Manage</span></a>
                        <ul class="collapse">
                            <li><a href="{{ route('refund.list') }}" class="link-item">Refund List</a></li>
                            <li><a href="{{ route('refund.add') }}" class="link-item">Add Refund</a></li>
                        </ul>
                    </li>
                    {{-- <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-money"></i><span>Products</span></a>
                        <ul class="collapse">
                            <li><a href="{{ route('product.list') }}">Product List</a></li>
                            <li><a href="{{ route('product.create') }}">Add Product</a></li>
                        </ul>
                    </li> --}}
                    
                    <li class="tree">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-money"></i><span>Report</span></a>
                        <ul class="collapse">
                            <li><a href="{{ route('today.todaygetData') }}" class="link-item">Today Report</a></li>
                            <li><a href="{{ route('daterange.getdata') }}" class="link-item">Date Rage Report</a></li>
                            <li><a href="{{ route('product.wise.report') }}" class="link-item">Product Wise Report</a></li>
                        </ul>
                    </li>

                    <li class="tree">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-money"></i><span>Users</span></a>
                        <ul class="collapse">
                            <li><a href="{{ route('user.list') }}" class="link-item">User List</a></li>
                            @if(Auth::user()->name == 'Admin')
                            <li><a href="{{ route('user.create') }}" class="link-item">Add User</a></li>
                            @endif
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('settings.page') }}" aria-expanded="true" class="link-item"><i class="ti-settings"></i><span>Settings</span></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>