@component('layouts.dashboard')
@slot('title')
Cards
@endslot
<style>
    a {
        text-decoration: none;
    }

    a:link,
    a:visited {
        color: black;
    }

    a:hover {
        text-decoration: none
    }

</style>
@if (session()->has('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif
<div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cards</h1>
        <br><br>
        <a href="new-card" class="btn btn-primary text-white">
            Add new card
        </a>
    </div>
    <div class="row">
        @foreach ($cards as $card)
        <a href="/dashboard/customer/card/{{ $card->id }}" class="col-md-4">
            <div class="card mb-4 py-3 border-left-primary">
                <div class="card-body">
                    <b>Company name:</b> {{ $card->company->company_name }} <br>
                    <b>Membership number:</b> {{ $card->insurance_number }} <br>
                    <b>Name:</b> {{ \ Illuminate\Support\Facades\Auth::user()->name }} <br>
                    <b>Sex:</b> @if ($card->sex == null)
                    TBD
                    @else
                    {{ $card->sex }}
                    @endif <br>
                    <b>DOB:</b> @if ($card->dob == null)
                    TBD
                    @else
                    {{ $card->dob }}
                    @endif
                </div>
                <div class="card-footer bg-white">
                    @if ($card->valid)
                    <span class="badge rounded-pill text-white px-3 py-2 bg-success">Validated</span>
                    @else
                    <span class="badge rounded-pill text-white px-3 py-2 bg-danger">Not yet valid</span>
                    @endif
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endcomponent
