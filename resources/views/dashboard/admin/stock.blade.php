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
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#viewModal{{ $item->id }}">Details</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#editModal{{ $item->id }}">Edit</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#statusModal{{ $item->id }}">Status</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Status Modal -->
                        <div class="modal fade" id="statusModal{{ $item->id }}" tabindex="-1"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            {{ $item->generic_name }} status
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        
                                        @if ($item->status)
                                            <a href="/dashboard/admin/stock/status/{{ $item->id }}" class="btn btn-danger">
                                                Deactivate
                                            </a>
                                        @else
                                            <a href="/dashboard/admin/stock/status/{{ $item->id }}" class="btn btn-success">
                                                Activate
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            {{ $item->generic_name }}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <form action="/dashboard/admin/stock/update" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="">Generic Name</label>
                                                    <input type="text" name="generic" class="form-control"
                                                        value="{{ $item->generic_name }}">
                                                </div>

                                                <input type="hidden" name="id" value="{{ $item->id }}">

                                                <div class="col-md-6 mb-3">
                                                    <label for="">Brand name</label>
                                                    <input type="text" name="brand" value="{{ $item->brand_name }}"
                                                        class="form-control">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="">Quantity</label>
                                                    <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                        class="form-control">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="">Purchase Price</label>
                                                    <input type="text" name="price" value="{{ $item->purchase_price }}"
                                                        class="form-control">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="">Dosage</label>
                                                    <input type="text" name="dosage" value="{{ $item->dosage }}"
                                                        class="form-control">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="">Strength</label>
                                                    <input type="text" name="strength" value="{{ $item->strength }}"
                                                        class="form-control">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="">Expiry Date</label>
                                                    <input type="date" name="date" value="{{ $item->expiry_date }}"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div>
                                                <button class="btn btn-warning" type="submit">
                                                    Update
                                                </button>
                                            </div>
                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <!-- View stock Modal -->
                        <div class="modal fade" id="viewModal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="viewModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            {{ $item->generic_name }} ({{ $item->brand_name }}) details
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body row">

                                        <div class="col-md-6 mb-3">
                                            <label for="">Generic Name</label>
                                            <input type="text" disabled class="form-control"
                                                value="{{ $item->generic_name }}">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="">Brand name</label>
                                            <input type="text" disabled value="{{ $item->brand_name }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="">Quantity</label>
                                            <input type="text" disabled value="{{ $item->quantity }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="">Purchase Price</label>
                                            <input type="text" disabled value="{{ $item->purchase_price }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="">Dosage</label>
                                            <input type="text" disabled value="{{ $item->dosage }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="">Strength</label>
                                            <input type="text" disabled value="{{ $item->strength }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="">Expiry Date</label>
                                            <input type="text" disabled value="{{ $item->expiry_date }}"
                                                class="form-control">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endcomponent
