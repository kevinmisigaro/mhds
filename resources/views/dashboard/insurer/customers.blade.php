@component('layouts.dashboard')
@slot('title')
Customers
@endslot

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Customers</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="/dashboard/insurer/create-customer" class="btn btn-primary">
            Create new customer
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Card</th>
                        <th>Is Card Valid</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Card</th>
                        <th>Is Card Valid</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($cards as $card)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $card->owner->name }}
                        </td>
                        <td>
                            {{ $card->owner->email }}
                        </td>
                        <td>
                            {{ $card->insurance_number }}
                        </td>
                        <td>
                            @if ($card->valid)
                            <span class="badge rounded-pill text-white px-3 py-2 bg-success">Valid</span>
                            @else
                            <span class="badge rounded-pill text-white px-3 py-2 bg-danger">Not valid</span>
                            @endif
                        </td>
                        <td>

                            <a type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href="#" data-toggle="modal" data-target="#customerDetailsModal{{ $card->owner->id }}"
                                class="dropdown-item">Customer details</a>
                        </div>

                        </td>


                    <!-- Modal -->
                    <div class="modal fade" id="customerDetailsModal{{ $card->owner->id }}" tabindex="-1"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        {{ $card->owner->name }} details
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="">Name</label>
                                            <input type="text" disabled value="{{ $card->owner->name }}"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Email</label>
                                            <input type="text" disabled value="{{ $card->owner->email }}"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Phone</label>
                                            <input type="text" disabled value="{{ $card->owner->phone }}"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Gender</label>
                                            <input type="text" disabled value="{{ $card->owner->customer->sex }}"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Date of birth</label>
                                            <input type="text" disabled value="{{ $card->owner->customer->dob }}"
                                                class="form-control">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endcomponent
