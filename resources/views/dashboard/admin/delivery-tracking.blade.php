@component('layouts.dashboard')
    @slot('title')
        Tracking
    @endslot

    <h1 class="h3 mb-2 text-gray-800">Delivery tracking</h1>

    <div class="container mt-5">

        @if ( isset($tracking) )
        <div class="card shadow mb-4">
            <div class="card-body">
              Insurer approved.
            </div>
          </div>
        @endif

        @if( isset($tracking) && $tracking->dispatched_by_sp )
        <div class="card shadow mb-4">
            <div class="card-body">
              Dispatched by Service provider
            </div>
          </div>
        @endif

        @if (isset($tracking) && $tracking->invoice_generated)
        <div class="card shadow mb-4">
            <div class="card-body">
              Invoice generated to Insurer
            </div>
          </div>
        @endif

        @if (isset($tracking) && $tracking->customer_delivery_accept)
        <div class="card shadow mb-4">
            <div class="card-body">
              Customer recieved prescription
            </div>
          </div>
        @endif

        @if (isset($tracking) && $tracking->insurer_process_payment)
        <div class="card shadow mb-4">
            <div class="card-body">
              Insurer processing payment.
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