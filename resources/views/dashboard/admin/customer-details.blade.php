@component('layouts.dashboard')
    @slot('title')
        Customer
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

    <h1 class="h3 mb-2 text-gray-800">{{ $customer->name }} details</h1>
    <br>
    <h4>
        Cards
    </h4>
    <div class="row">
        @foreach ($customer->cards as $card)
        <a href="/dashboard/admin/customer/card/{{ $card->id }}" class="col-md-4">
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

@endcomponent