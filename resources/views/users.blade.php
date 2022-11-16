<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Header') }}
        </h2>
    </x-slot>
    <div class="content-wrapper" style="min-height: 1302.26px;">
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
        <section class="content">
            <div class="container-fluid">
                @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if(session()->get('danger'))
                    <div class="alert alert-danger">
                        {{session()->get('danger') }}
                    </div>
                @endif
                <div class="row ">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Users Data</h3>
                                <div class="card-tools">
                                    <a href="{{route('admin-user-register')}}" class="btn btn-tool has-tooltip" id="add-user" data-original-title="Add User">
                                        <button class="btn btn-outline-secondary" data-toggle="tooltip" data-placement="top" title="Add User">
                                            <i aria-hidden="true" class="fas fa-plus"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example" class="display nowrap " style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Country</th>
                                        <th>Pin code</th>
                                        <th>Branch</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $userkey=>$uservalue)
                                        @if(Auth::user()->id!==$uservalue['id'])
                                        <tr class="odd">
                                            <td class="sorting_1 dtr-control">{{$uservalue['name']}}</td>
                                            <td>{{$uservalue['email']}}</td>
                                            <td>{{$uservalue['phone']}}</td>
                                            <td>{{$uservalue['address']}}</td>
                                            <td>{{$uservalue['country']}}</td>
                                            <td>{{$uservalue['pin_code']}}</td>
                                            <td>{{$uservalue->branch['name']}}</td>
                                            <td>{{$uservalue['role']}}</td>
                                            <td>
                                                <a href="{{route('user.profile',['id'=>$uservalue['id']])}}">
                                                    <button class="btn btn-outline-secondary " data-toggle="tooltip" data-placement="top" title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                </a>
                                                <a href="{{route('edit.user',['id'=>$uservalue['id']])}}">
                                                    <button class="btn btn-outline-info" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </a>
                                                <form action="{{route('delete.user')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$uservalue['id']}}" >
                                                    <button class="btn btn-outline-danger" type="submit" onclick="return confirm('Are you sure yor want to delete {{$uservalue['name']}}?')" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            scrollX: true,
        });
    });
</script>


