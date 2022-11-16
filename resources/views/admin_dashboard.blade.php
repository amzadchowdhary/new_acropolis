<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Header') }}
        </h2>
    </x-slot>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
        <div class="row mx-5">
            <div class="col-lg-3 col-6">

                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>Users</h3>
{{--                        <p>Users</p>--}}
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <a href="{{route('users')}}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-info">
                    <div class="inner">
{{--                        <h3>150</h3>--}}
                        <h3>Products</h3>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="{{route('products')}}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
{{--                        <h3>53<sup style="font-size: 20px">%</sup></h3>--}}
                        <h3>Tax Rate</h3>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-percent"></i>
                    </div>
                    <a href="{{route('tax.rate')}}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>


            <div class="col-lg-3 col-6">

                <div class="small-box bg-danger">
                    <div class="inner">
{{--                        <h3>65</h3>--}}
                        <h3>Branches</h3>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-code-branch"></i>
                    </div>
                    <a href="{{'branches'}}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

{{--            <div class="col-lg-3 col-6">--}}

{{--                <div class="small-box bg-secondary">--}}
{{--                    <div class="inner">--}}
{{--                        --}}{{--                        <h3>65</h3>--}}
{{--                        <h3>Batch</h3>--}}
{{--                    </div>--}}
{{--                    <div class="icon">--}}
{{--                        <i class="fa-solid fa-timeline"></i>--}}
{{--                    </div>--}}
{{--                    <a href="{{'branches'}}" class="small-box-footer">--}}
{{--                        More info <i class="fas fa-arrow-circle-right"></i>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}

        </div>



        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

</x-app-layout>
