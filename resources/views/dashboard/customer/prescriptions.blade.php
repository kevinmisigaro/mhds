@component('layouts.dashboard')
@slot('title')
Prescriptions
@endslot
@if (session()->has('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Your Prescriptions</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="new-prescription" class="btn btn-primary">
            Add new Prescription
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Approved by Manager</th>
                        <th>Approved by Insurer</th>
                        <th>Upload date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>S/N</th>
                        <th>Approved by Manager</th>
                        <th>Approved by Insurer</th>
                        <th>Upload date</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($prescriptions as $prescription)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            @if ($prescription->approved_by_manager)
                            <span class="badge rounded-pill text-white px-3 py-2 bg-success">Approved</span>
                            @else
                            <span class="badge rounded-pill text-white px-3 py-2 bg-danger">Unapproved</span>
                            @endif
                        </td>
                        <td>
                            @if ($prescription->approved_by_insurer)
                            <span class="badge rounded-pill text-white px-3 py-2 bg-success">Approved</span>
                            @else
                            <span class="badge rounded-pill text-white px-3 py-2 bg-danger">Unapproved</span>
                            @endif
                        </td>
                        <td>
                            {{ $prescription->created_at }}
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
