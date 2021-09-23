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
                            <a href="#" class="btn btn-info text-white">
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
