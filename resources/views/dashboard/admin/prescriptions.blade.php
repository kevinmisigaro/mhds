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
                            <th>Approved by Manager</th>
                            <th>Approved by Insurer</th>
                            <th>Upload date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Prescription ID</th>
                            <th>Patient</th>
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
                                {{ $prescription->id }}
                            </td>
                            <td>
                                {{ $prescription->patient->name }}
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
                                <a href="/dashboard/insurer/prescription/{{ $prescription->id }}" class="btn btn-info text-white">
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