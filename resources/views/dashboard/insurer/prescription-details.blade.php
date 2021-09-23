@component('layouts.dashboard')
@slot('title')
Prescription details
@endslot

<div>

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
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5" class="text-center">No prescriptions</td>
                </tr>
                @endif

            </tbody>
        </table>
        <br>
        <div class="my-3">
            <form action="">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Drug</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="">Selling Price</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-success" style="margin-top: 32px; padding: 5px 30px">
                            Add
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <img src="{{ env('APP_URL') }}{{ $prescription->image }}" alt="..." style="height: 500px">

    </div>

</div>

@endcomponent
