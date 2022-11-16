<x-app-layout>
    <x-slot name="header">

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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tax Data</h3>
                                <div class="card-tools">
                                    <a href="{{route('tax.register') }}" class="btn btn-tool has-tooltip" id="add-agent-link" data-original-title="null">
                                        <i aria-hidden="true" class="fas fa-plus"></i>
                                        <p> Add Tax</p>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example" class="display nowrap " style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>% of Tax</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($taxes as $tax)
                                        <tr class="odd">
                                            <td class="sorting_1 dtr-control">{{$tax['name']}}</td>
                                            <td class="sorting_1 dtr-control">{{ $tax['tax_rate'] }}</td>
                                            <td>
                                                <a href="{{route('edit.tax',['id'=>$tax['id']])}}">
                                                    <button class="btn btn-outline-info" data-toggle="tooltip" data-placement="top"  title="Edit">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </a>
                                                <form action="{{route('tax.delete')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$tax['id']}}">
                                                    <button class="btn btn-outline-danger" type="submit" onclick="return confirm('Are you sure yor want to delete {{$tax['name']}}?')" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
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


