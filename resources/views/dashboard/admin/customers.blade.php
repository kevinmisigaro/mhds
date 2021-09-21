@component('layouts.dashboard')
    @slot('title')
        Customers
    @endslot

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Customers</h1>
<!-- DataTales Example -->
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
                                <a href="/dashboard/admin/customer/{{ $customer->id }}" class="btn btn-info text-white">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endcomponent