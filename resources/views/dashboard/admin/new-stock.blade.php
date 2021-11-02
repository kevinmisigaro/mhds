@component('layouts.dashboard')
@slot('title')
New title
@endslot

<div>
    @if (session()->has('message'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('message') }}
    </div>
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create new stock</h1>
    </div>

    <form action="/dashboard/admin/stock/store" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="">Generic Name</label>
                <input type="text" name="generic" class="form-control">
            </div>

            <div class="col-md-6">
                <label for="">Brand Name</label>
                <input type="text" name="brand" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="">Dosage</label>
                <input type="text" name="dose" class="form-control">
            </div>

            <div class="col-md-6">
                <label for="">Strength</label>
                <input type="text" name="strength" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">
                Submit
            </button>
        </div>
    </form>
</div>
@endcomponent
