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
                        <a href="/admin_dashboard">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ __('Dashboard') }}
                            </h2>
                        </a>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="row">
                <div class="col-12 col-sm-8 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0">
                          Role:  {{$user->role}}
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h1 class="lead"><b>{{$user->name}}</b></h1>
                                    <p class="text-muted text-sm my-2"><b>Mail: </b> {{ $user->email }}</p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small my-2"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: {{$user->address}}
                                        <li class="small my-2">Pin Code: {{$user->pin_code}}</li>
                                        <li class="small my-2">Counrty: {{$user->country}}<li>
                                        <li class="small my-2">State:{{ $user->state }}</li>
                                        <li class="small my-2">City: {{$user->city}}</li>
                                        <li class="small my-2"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone : {{$user->phone}}</li>
                                        <li class="small my-2">Branch: {{$user->branch['name']}}</li>
                                        <li class="small my-2">Branch Address: {{$user->branch['address']}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a href="/users" class="btn btn-sm btn-outline-info">
                                    Go Back
                                    <i class="fa-solid fa-backward"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</x-app-layout>
