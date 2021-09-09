<div class="container mt-3">
    <style>
        .error {
            color: red;
            font-size: 13pt;
            padding-top: 5px;
        }

    </style>
    <h3>
        Create account
    </h3>
    <br>
    <div class="row">
        <div class="col-md-6">
            <form>
                <div class="form-group mb-2">
                    <label for="">Insurance card number</label>
                    <input type="text" class="form-control">
                    @error('cardNumber') <small class="error">{{ $message }}</small> @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="">Insurance Company</label>
                    <select wire:model="company" class="form-control">
                        <option>Select company</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}">
                                {{ $company->company_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('company') <small class="error">{{ $message }}</small> @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="">Image</label>
                    <input type="file" class="form-control" wire:model="image">
                    @error('image') <small class="error">{{ $message }}</small> @enderror
                </div>
            </form>
        </div>
    </div>
</div>
