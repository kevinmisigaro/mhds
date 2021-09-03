@component('layouts.dashboard')
@slot('title')
Complaints
@endslot
@if (session()->has('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Your Complaints</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="new-complaint" class="btn btn-primary">
            Make new complaint
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
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
                            {{ $complaint->subject }}
                        </td>
                        <td>
                            {{ $complaint->description }}
                        </td>
                        <td>
                            @if ($complaint->status == 'open')
                            <span class="badge py-2 px-3 rounded-pill text-white bg-success">Open</span>
                            @else
                            <span class="badge py-2 px-3 rounded-pill text-white bg-danger">Closed</span>
                            @endif
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
