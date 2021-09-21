@component('layouts.dashboard')
    @slot('title')
        Complaints
    @endslot

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Complaints</h1>
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
                        <th>Complainer name</th>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>S/N</th>
                        <th>Complainer name</th>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($complaints as $complaint)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $complaint->complainerDetails->name }}
                        </td>
                        <td>
                            {{ $complaint->subject }}
                        </td>
                        <td>
                            {{ $complaint->description }}
                        </td>
                        <td>
                            @if ($complaint->status == 'open')
                            <span class="badge rounded-pill text-white px-3 py-2 bg-success">Open</span>
                            @else
                            <span class="badge rounded-pill text-white px-3 py-2 bg-danger">Closed</span>  
                            @endif
                        </td>
                        <td>
                            <a href="/dashboard/admin/complaint-chat/{{ $complaint->id }}" class="btn btn-info text-white">
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