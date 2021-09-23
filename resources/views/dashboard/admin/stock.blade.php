@component('layouts.dashboard')
@slot('title')
Stock
@endslot

<div>
    @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('message') }}
    </div>
    @endif

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Stock</h1>
    </div>


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="/dashboard/admin/create/stock" class="btn btn-info">
                Add new Drug
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Drug</th>
                            <th>Availabity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S/N</th>
                            <th>Drug</th>
                            <th>Availabity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($stock as $item)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $item->generic_name }}
                            </td>
                            <td>
                                @if ($item->quantity > 0)
                                <span class="badge badge-pill badge-success p-2">
                                    In Stock
                                </span>
                                @else
                                <span class="badge badge-pill badge-danger px-3 py-2">
                                    No Stock
                                </span>
                                @endif
                            </td>
                            <td>
                                {{ $item->purchase_price }}
                            </td>
                            <td>
                                <div class="dropright">
                                    <a type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Details</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endcomponent
