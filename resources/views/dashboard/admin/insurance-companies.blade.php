@component('layouts.dashboard')
@slot('title')
Insurance Companies
@endslot

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('message') }}
</div>
@endif

<h1 class="h3 mb-2 text-gray-800">Insurance Companies</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Manager</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Manager</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($companies as $company)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $company->company_name }}
                        </td>
                        <td>
                            @if ($company->active)
                            <span class="badge rounded-pill text-white px-3 py-2 bg-success">Active</span>
                            @else
                            <span class="badge rounded-pill text-white px-3 py-2 bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            {{ $company->manager->name }}
                        </td>
                        <td>
                            <div class="dropright">
                                <a type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#companyDetailsModal{{ $company->id }}">Details</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#sellingPriceModal{{ $company->id }}">Update selling price</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#statusModal{{ $company->id }}">Status</a>
                                </div>
                            </div>
                        </td>
                    </tr>


                    <!-- Set active status Modal -->
                    <div class="modal fade" id="statusModal{{ $company->id }}" tabindex="-1" aria-labelledby="statusModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        Set active status for {{ $company->company_name }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    @if ($company->active)
                                    <a href="/company/status/{{ $company->id }}" class="btn btn-danger">
                                        Deactivate
                                    </a>
                                    @else
                                    <a href="/company/status/{{ $company->id }}" class="btn btn-success">
                                        Activate
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--- company details modal --->
                    <div class="modal fade" id="companyDetailsModal{{ $company->id }}" tabindex="-1"
                        aria-labelledby="companyDetailsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ $company->company_name }} details
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group mb-4">
                                        <label for="">Name</label>
                                        <input type="text" value="{{ $company->company_name }}" disabled
                                            class="form-control">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="">Status</label>
                                        @if ($company->active)
                                        <span class="badge badge-pill badge-success ml-3">Validated</span>
                                        @else
                                        <span class="badge badge-pill badge-danger ml-3">Unvalidated</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="">Manager</label>
                                        <input type="text" value="{{ $company->manager->name }}" disabled
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--- selling price modal --->
                    <div class="modal fade" id="sellingPriceModal{{ $company->id }}" tabindex="-1"
                        aria-labelledby="sellingPriceModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        {{ $company->company_name }} selling price
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="/dashboard/admin/company/sellingprice/update">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label for="">Selling Price</label>
                                            <input type="text" name="price" class="form-control"
                                                value="{{ $company->margin->margin }}">
                                        </div>
                                        <input type="hidden" name="companyId" value="{{ $company->id }}">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-warning">
                                                Update
                                            </button>
                                        </div>
                                    </form>
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
