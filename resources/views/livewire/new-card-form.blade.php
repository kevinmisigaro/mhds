<div class="col-md-8">
    <style>
        .error {
            color: red;
            font-size: 13pt;
            padding-top: 5px;
        }

    </style>
    <h3>New Card form</h3>
    <br>
    <form wire:submit.prevent="submit">
        <div class="form-group">
            <label for="">Insurance number</label>
            <input type="text" wire:model="cardNumber" class="text form-control">
            @error('cardNumber') <small class="error">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label for="">Insurance Company</label>
            <select class="form-control" wire:model="company">
                @foreach ($companies as $company)
                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                @endforeach
            </select>
            @error('company') <small class="error">{{ $message }}</small> @enderror
        </div>
        <div class="form-group mb-2">
            <label for="">Image</label>
            <input type="file" class="form-control" wire:model="image">
            @error('image') <small class="error">{{ $message }}</small> @enderror
        </div>
        <div class="form-group mb-2">
            <button class="btn btn-primary" type="submit">
                Submit
            </button>
        </div>
    </form>
</div>
