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
            <button class="btn btn-primary" type="submit">
                Upload Photo
            </button>
        </div>
    </form>
</div>
