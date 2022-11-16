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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Products Data</h3>
                                <div class="card-tools">
                                    <a href="{{route('product.register')}}" class="btn btn-tool has-tooltip" id="add-agent-link" data-original-title="null">
                                        <i aria-hidden="true" class="fas fa-plus"></i>
                                        <p> Add Product</p>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example" class="display nowrap " style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Name of Product</th>
                                        <th>Cost of Product</th>
                                        <th>Tax rate %</th>
                                        <th>Total cost</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $productkey=>$productvalue)
                                        <tr class="odd">
                                            <td class="sorting_1 dtr-control">{{$productvalue['name']}}</td>
                                            <td>$-{{ $productvalue['cost'] }}</td>
                                            <td>{{$productvalue->taxes['tax_rate']}}%</td>
                                            @php
                                            $totaltax=(((int)$productvalue->taxes['tax_rate'])/100)*(int)$productvalue['cost'];
                                            $totalcost=$totaltax+((int)$productvalue['cost']);
                                            @endphp
                                            <td>$-{{$totalcost }}</td>
                                            <td>
                                                <a href="{{route('product.edit',['id'=>$productvalue['id']])}}">
                                                    <button class="btn btn-outline-info" data-toggle="tooltip" data-placement="top"  title="Edit">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </a>
                                                <form action="{{route('product.delete')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$productvalue['id']}}">
                                                    <button class="btn btn-outline-danger" type="submit" onclick="return confirm('Are you sure yor want to delete {{$productvalue['name']}}?')" data-toggle="tooltip" data-placement="top" title="Delete">
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


