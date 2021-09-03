@component('layouts.dashboard')
@slot('title')
Insurance Companies
@endslot

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Insurance Companies</h1>
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
                            <button class="btn btn-info text-white">
                                View
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endcomponent
