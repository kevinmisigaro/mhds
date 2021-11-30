@component('layouts.dashboard')
   @slot('title')
       Card
   @endslot 

   <h1 class="h3 mb-2 text-gray-800">Card</h1>

   <div class="row">
       <div class="col-md-6">

        <div class="form-group">
            <label for="">Insuarance number</label>
            <input type="text" value="{{ $card->insurance_number }}" class="form-control" disabled>
        </div>
        <div class="form-group">
            <label for="">Company name</label>
            <input type="text" class="form-control" value="{{ $card->company->company_name }}" disabled>
        </div>
        <div class="form-group">
            <label for="">Type</label>
            <input type="text" class="form-control" value="{{ $card->type }}" disabled>
        </div>
        <div class="form-group">
            Approved: &nbsp; @if ($card->valid)
            <span class="badge rounded-pill text-white px-3 py-2 bg-success">True</span>
            @else
            <span class="badge rounded-pill text-white px-3 py-2 bg-danger">False</span>
            @endif
        </div>
        <div class="form-group">
            Image uploaded: &nbsp; @if ($card->image != null)
            <span class="badge rounded-pill text-white px-3 py-2 bg-success">True</span>
            @else
            <span class="badge rounded-pill text-white px-3 py-2 bg-danger">False</span>
            @endif
        </div>

        <div class="mt-5">
            @if ($card->valid)
            <a href="/dashboard/admin/customer/disapprovecard/{{ $card->id }}" class="btn btn-danger">
                Revoke card
            </a>
            @else
            <a href="/dashboard/admin/customer/approvecard/{{ $card->id }}" class="btn btn-primary">
                Approve card
            </a>
            @endif

            <a href="/dashboard/admin/customer/{{ $card->owner->id }}" class="btn btn-warning ml-4">
                Ignore
            </a>
        </div>
        
       </div>
       <div class="col-md-6">
        <img src="{{ env('APP_URL') }}/storage/{{ $card->image }}" style="max-width: 100%">
    </div>
   </div>

@endcomponent