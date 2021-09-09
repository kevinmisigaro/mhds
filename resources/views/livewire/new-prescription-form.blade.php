<div class="col-md-8">
    <style>
        .error {
            color: red;
            font-size: 13pt;
            padding-top: 5px;
        }

    </style>
    <h3>New Prescription form</h3>
    <br>
    <form wire:submit.prevent="submit">
        <div class="form-group mb-2">
            <label>Upload prescription image</label>
            <input type="file" wire:model="photo" class="form-control">
            @error('photo') <small class="error">{{ $message }}</small> @enderror
        </div>
        <div class="form-group mb-2">
            <label for="">Choose your card</label>
            <select class="form-control" wire:model="card">
                <option>Select card</option>
                @foreach ($cards as $card)
                    <option value="{{ $card->id }}">
                        {{ $card->insurance_number }} - {{ $card->company->company_name }}
                    </option>
                @endforeach
            </select>
            @error('card') <small class="error">{{ $message }}</small> @enderror
        </div>
        <div class="form-group mb-2">
            <button class="btn btn-primary" type="submit" {{ $canSubmit == 2 ? '': 'disabled' }}>
                Upload Photo
                {{ $canSubmit == 3 ? '<span class="spinner-border spinner-border-sm"  role="status" aria-hidden="true" ></span>' : '' }}
            </button>
        </div>
    </form>
</div>
