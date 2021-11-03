@component('layouts.dashboard')
    @slot('title')
        Tracking
    @endslot

    @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('message') }}
    </div>
    @endif

    <h1 class="h3 mb-2 text-gray-800">Delivery tracking</h1>

    <div class="container mt-5">

        @if ( isset($tracking) )
        <div class="card shadow mb-4">
            <div class="card-body">
              Insurer approved.
              <br><br>
              @if (\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                <a href="/prescription/dispatch/{{ $tracking->id }}" class="btn btn-primary">
                    Dispatch order
                </a>
              @endif
            </div>
          </div>
        @endif

        @if( isset($tracking) && $tracking->dispatched_by_sp )
        <div class="card shadow mb-4">
            <div class="card-body">
              Dispatched by Service provider
              <br><br>
              @if (\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                <a href="/prescription/invoice/{{ $tracking->id }}" class="btn btn-primary">
                    Generate invoice
                </a>
              @endif
            </div>
          </div>
        @endif

        @if (isset($tracking) && $tracking->invoice_generated)
        <div class="card shadow mb-4">
            <div class="card-body">
              Invoice generated to Insurer
              <br><br>
              @if (\Illuminate\Support\Facades\Auth::user()->role == 'customer')
                <a href="/prescription/customerAccept/{{ $tracking->id }}" class="btn btn-primary">
                    Customer recieved drugs
                </a>
              @endif
            </div>
          </div>
        @endif

        @if (isset($tracking) && $tracking->customer_delivery_accept)
        <div class="card shadow mb-4">
            <div class="card-body">
              Customer recieved prescription
              <br><br>
              @if (\Illuminate\Support\Facades\Auth::user()->role == 'insurer')
                <a href="/prescription/processPayment/{{ $tracking->id }}" class="btn btn-primary">
                    Process payment
                </a>
              @endif
            </div>
          </div>
        @endif

        @if (isset($tracking) && $tracking->insurer_process_payment)
        <div class="card shadow mb-4">
            <div class="card-body">
              Insurer processing payment.
              <br><br>
              @if (\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                <a href="/prescription/confirmPayment/{{ $tracking->id }}" class="btn btn-primary">
                    Confirm payment
                </a>
              @endif
            </div>
          </div>
        @endif

        @if (isset($tracking) && $tracking->sp_confirm_payment)
        <div class="card shadow mb-4">
            <div class="card-body">
              Service provider recieve payment.
            </div>
          </div>
        @endif

    </div>

@endcomponent