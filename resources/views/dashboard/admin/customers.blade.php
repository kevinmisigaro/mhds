@component('layouts.dashboard')
@slot('title')
Customers
@endslot

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
</div>
@endif

@if (session()->has('fail'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('fail') }}
</div>
@endif

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Customers</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#newCustomerModal">
            New customer
        </button>
    </div>

    <!-- New Customer Modal -->
    <div class="modal fade" id="newCustomerModal" tabindex="-1" aria-labelledby="newCustomerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newCustomerModalLabel">Register user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/dashboard/admin/customer/store" method="POST">
                        @csrf
                        <small>Personal details</small>
                        <div class="row mb-2">

                            <div class="col-md-6 mb-2">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label>Sex</label>
                                <select name="sex" class="form-control">
                                    <option value="">Select gender</option>
                                    <option value="MALE">Male</option>
                                    <option value="FEMALE">Female</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="">Date of birth</label>
                                <input type="date" name="dob" class="form-control">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="">User Image</label>
                                <input type="file" name="avatar" class="form-control">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="">Phone number</label>
                                <input type="text" name="phone" class="form-control">
                            </div>

                        </div>

                        <div class="mt-3">
                            <small>Insurance card details</small>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-6 mb-2">
                                <label for="">Company</label>
                                <select name="company" class="form-control">
                                    <option value="">Select company</option>
                                    @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">
                                        {{ $company->company_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="">Card number</label>
                                <input type="text" name="card" class="form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="">Card image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="">Issue date</label>
                                <input type="date" name="issuedate" class="form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="">Expiry date </label>
                                <input type="date" name="expirydate" class="form-control">
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-success">
                                Register
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Sex</th>
                        <th>DOB</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Sex</th>
                        <th>DOB</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($customers as $customer)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $customer->name }}
                        </td>
                        <td>
                            {{ $customer->email }}
                        </td>
                        <td>
                            @if ($customer->phone == null)
                            <span class="badge rounded-pill text-white px-3 py-2 bg-danger">Unavailable</span>
                            @else
                            {{ $customer->phone }}
                            @endif
                        </td>
                        <td>
                            @if ($customer->customer->sex == null)
                            <span class="badge rounded-pill text-white px-3 py-2 bg-danger">Unavailable</span>
                            @else
                            {{ $customer->customer->sex }}
                            @endif
                        </td>
                        <td>
                            @if ($customer->customer->dob == null)
                            <span class="badge rounded-pill text-white px-3 py-2 bg-danger">Unavailable</span>
                            @else
                            {{ $customer->customer->dob }}
                            @endif
                        </td>
                        <td>
                            <a type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="/dashboard/admin/customer/{{ $customer->id }}">View
                                    cards</a>
                                <a href="#" data-toggle="modal" data-target="#customerDetailsModal{{ $customer->id }}"
                                    class="dropdown-item">Customer details</a>
                            </div>
                        </td>
                    </tr>


                    <!-- Modal -->
                    <div class="modal fade" id="customerDetailsModal{{ $customer->id }}" tabindex="-1"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        {{ $customer->name }} details
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="">Name</label>
                                            <input type="text" disabled value="{{ $customer->name }}"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Email</label>
                                            <input type="text" disabled value="{{ $customer->email }}"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Phone</label>
                                            <input type="text" disabled value="{{ $customer->phone }}"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Gender</label>
                                            <input type="text" disabled value="{{ $customer->customer->sex }}"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Date of birth</label>
                                            <input type="text" disabled value="{{ $customer->customer->dob }}"
                                                class="form-control">
                                        </div>
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
@endcomponent
