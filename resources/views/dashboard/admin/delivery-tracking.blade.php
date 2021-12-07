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

              <button class="btn btn-info" data-toggle="modal" data-target="#viewPrescriptionModal">
                View Prescription
              </button>
              <button class="btn btn-info ml-2" data-toggle="modal" data-target="#viewOirignalPrescriptionModal">
                View Original Prescription
              </button>
              <br><br>

              @if (\Illuminate\Support\Facades\Auth::user()->role == 1  && !$tracking->dispatched_by_sp)
                <a href="/prescription/dispatch/{{ $tracking->id }}" class="btn btn-primary">
                    Dispatch order
                </a>
                <br><br>
              @endif
              <small><b>Next step:</b> Customer to accept recieving drugs</small>
            </div>
          </div>
        @endif

        <!-- Original prescription Modal -->
        <div class="modal fade" id="viewOirignalPrescriptionModal" tabindex="-1" aria-labelledby="viewOirignalPrescriptionModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Original prescription</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body text-center">
                  <img src="{{ env('APP_URL') }}{{ $tracking->prescription->image }}" alt="..." style="max-height: 500px">
              </div>
            </div>
          </div>
        </div>

        <!-- View prescription Modal -->
        <div class="modal fade" id="viewPrescriptionModal" tabindex="-1" aria-labelledby="viewPrescriptionModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Prescription</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Drug</th>
                      <th scope="col">Strength</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Price</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($tracking->prescription->details as $item)

                        <tr>
                          <td>
                            {{ $loop->iteration }}
                          </td>
                          <td>
                            {{ $item->drug->generic_name }}
                          </td>
                          <td>
                            {{ $item->drug->strength }}
                          </td>
                          <td>
                            {{ $item->quantity }}
                          </td>
                          <td>
                            {{ $item->quantity * $item->selling_price }}
                          </td>
                        </tr>
                    @endforeach
                    <tr>
                      <td colspan="4">
                        <b>TOTAL:</b>
                      </td>
                      <td class="bg-success text-white">
                        <b>{{ $tracking->prescription->details->sum('total_price') }}</b>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        @if (isset($tracking) && $tracking->dispatched_by_sp )
        <div class="card shadow mb-4">
          <div class="card-body">
            Customer recieved drugs
            <br><br>
            @if (\Illuminate\Support\Facades\Auth::user()->role == 2 && !$tracking->customer_delivery_accept)
                <a href="/prescription/customerAccept/{{ $tracking->id }}" class="btn btn-primary">
                    Customer confirm drug delivery
                </a>
                <br><br>
              @endif
            <small><b>Next step:</b> Generate invoice for insurer </small>
          </div>
        </div>
        @endif

        @if( isset($tracking) && $tracking->customer_delivery_accept)
        <div class="card shadow mb-4">
            <div class="card-body">
              Customer has drugs from prescription
              <div class="my-3">
                @if (\Illuminate\Support\Facades\Auth::user()->role == 1 && !$tracking->invoice_generated)
                <a href="/prescription/invoice/{{ $tracking->id }}" class="btn btn-primary mr-3">
                    Prepare invoice for insurer
                </a>
              @endif

              <a href="/prescription/printInvoice/{{ $tracking->id }}" class="btn btn-info">
                Print invoice
              </a>

              </div>
              <small><b>Next step:</b> Insurer process payment</small>
            </div>
          </div>
        @endif


        @if (isset($tracking) && $tracking->invoice_generated)
        <div class="card shadow mb-4">
            <div class="card-body">
              Insurer get invoice and waiting to process payment
              <br><br>
              @if (\Illuminate\Support\Facades\Auth::user()->role == 3 && !$tracking->insurer_process_payment)
                <a href="/prescription/processPayment/{{ $tracking->id }}" class="btn btn-primary">
                    Process payment
                </a>
                <br><br>
              @endif
              <small><b>Next step:</b> Service provider to confirm payment</small>
            </div>
          </div>
        @endif

        @if (isset($tracking) && $tracking->insurer_process_payment)
        <div class="card shadow mb-4">
            <div class="card-body">
              Insurer processing payment.
              <br><br>
              @if (\Illuminate\Support\Facades\Auth::user()->role == 1 && !$tracking->sp_confirm_payment)
                <a href="/prescription/confirmPayment/{{ $tracking->id }}" class="btn btn-primary">
                    Confirm payment
                </a>
                <br><br>
              @endif
              <small><b>Next step:</b> Service provider to confirm payment</small>
            </div>
          </div>
        @endif

        @if (isset($tracking) && $tracking->sp_confirm_payment)
        <div class="card shadow mb-4">
            <div class="card-body">
              <b>Service provider recieve payment.</b>
              <br><br>
              <small><b>This is the final step</b></small>
            </div>
          </div>
        @endif

    </div>

@endcomponent