<div>
    @if (session()->has('message'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('message') }}
    </div>
    @endif
    <h1 class="h3 mb-2 text-gray-800">Prescriptions details</h1>

    <div class="my-4">
        <h4>
            <b>{{ $prescription->patient->name }}</b> with card number
            <b>{{ $prescription->card->insurance_number }}</b>
        </h4>
    </div>

    <div class="my-5">

        <table class="table table-bordered mb-3 mt-4">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Brand Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Selling price</th>
                    <th scope="col">Strength</th>
                </tr>
            </thead>
            <tbody>

                @if ( \App\Models\PrescriptionDetails::where('prescription_id', $prescription->id)->exists() )
                @foreach ( \App\Models\PrescriptionDetails::where('prescription_id',
                $prescription->id)->with('drug')->get() as $item)
                <tr>
                    <th scope="row">
                        {{ $loop->iteration }}
                    </th>
                    <td>
                        {{ $item->drug->brand_name }}
                    </td>
                    <td>
                        {{ $item->quantity }}
                    </td>
                    <td>
                        {{ $item->selling_price }}
                    </td>
                    <td>
                        {{ $item->drug->strength }}
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5" class="text-center">No prescriptions</td>
                </tr>
                @endif

            </tbody>
        </table>

        @if (\Illuminate\Support\Facades\Auth::user()->role == 'insurer')
        <div class="my-3">
            <button class="btn btn-info ml-2" data-toggle="modal" data-target="#approve" style="margin-top: 32px">
                Approve
            </button>
            <button class="btn btn-danger ml-2" data-toggle="modal" data-target="#reject" style="margin-top: 32px;">
                Reject
            </button>
        </div>

        <!-- Insurer Reject Modal -->
        <div wire:ignore.self class="modal fade" id="reject" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Reject with comment
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group mb-2">
                                <textarea class="form-control" wire:model="comment" cols="100%" rows="5"></textarea>
                                <button class="btn btn-danger" wire:click.prevent="insurerReject()" style="margin-top: 32px">
                                    Reject
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Insurer Approve Modal -->
        <div wire:ignore.self class="modal fade" id="approve" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Approve with comment
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group mb-2">
                                <textarea class="form-control" wire:model="comment" cols="100%" rows="5"></textarea>
                                <button class="btn btn-success" wire:click.prevent="insurerApprove()" style="margin-top: 32px">
                                    Approve
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if (\Illuminate\Support\Facades\Auth::user()->role == 'admin')
        <div class="my-3">
            <form wire:submit.prevent="submit">
                <div class="row">
                    <div class="col-md-4">
                        <label>Drug</label>
                        <select wire:model="drug" class="form-control">
                            <option value="">Select drug</option>
                            @foreach ($stock as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->generic_name }} ({{ $item->brand_name }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>Selling Price</label>
                        <input type="text" class="form-control" autocomplete="off" wire:model="price">
                    </div>
                    <div class="col-md-1">
                        <label>Quantity</label>
                        <input type="number" min="1" class="form-control" autocomplete="off" wire:model="quantity">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-success" type="submit" style="margin-top: 32px; padding: 5px 25px">
                            Add
                        </button>
                        <button class="btn btn-info ml-2" type="button" wire:click="approve" style="margin-top: 32px">
                            Approve
                        </button>
                        <button class="btn btn-danger ml-2" type="button" wire:click="disapprove"
                            style="margin-top: 32px;">
                            Reject
                        </button>

                    </div>
                </div>
            </form>
        </div>
        @endif

        @if ($prescription->insurance_comment != null)

        <div class="my-3">
            <div class="card" style="width: 100%">
                <div class="card-body">

                    @if ($prescription->approved_by_insurer)
                    <div class="alert alert-success" role="alert">
                        Approved by insurer
                      </div>
                    @else
                    <div class="alert alert-danger" role="alert">
                       Rejected by insurer
                      </div>
                    @endif

                    <p>
                        {{ $prescription->insurance_comment }}
                    </p>

                </div>
            </div>
        </div>

        @endif
        
        <img src="{{ env('APP_URL') }}{{ $prescription->image }}" alt="..." style="height: 500px">

    </div>

</div>
