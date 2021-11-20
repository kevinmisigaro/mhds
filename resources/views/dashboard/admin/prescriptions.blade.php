@component('layouts.dashboard')
@slot('title')
Prescriptions
@endslot

<h1 class="h3 mb-2 text-gray-800">Prescriptions</h1>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Prescription ID</th>
                        <th>Patient</th>
                        <th>Approved by SP</th>
                        <th>Approved by Insurer</th>
                        <th>Upload date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Prescription ID</th>
                        <th>Patient</th>
                        <th>Approved by SP</th>
                        <th>Approved by Insurer</th>
                        <th>Upload date</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($prescriptions as $prescription)
                    <tr>
                        <td>
                            {{ $prescription->id }}
                        </td>
                        <td>
                            {{ $prescription->patient->name }}
                        </td>
                        <td>
                            @if ($prescription->approved_by_admin)
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
                            <a type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item"
                                    href="/dashboard/insurer/prescription/{{ $prescription->id }}">Details</a>
                                    @if ($prescription->approved_by_insurer)
                                    <a href="/dashboard/admin/prescription/tracking/{{ $prescription->id }}" class="dropdown-item">Delivery tracking</a>
                                    @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endcomponent
