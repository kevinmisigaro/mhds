@component('layouts.dashboard')
@slot('title')
Card details
@endslot
<div>
    <div class="row">
        <div class="col-md-6">
            <form>
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
            </form>
        </div>
    </div>
</div>

@endcomponent
