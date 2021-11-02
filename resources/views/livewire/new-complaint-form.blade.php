<div class="col-md-8">
    <style>
        .error {
            color: red;
            font-size: 13pt;
            padding-top: 5px;
        }

    </style>
    <h3>New Complaint form</h3>
    <br>
    <form wire:submit.prevent="submit">
        <div class="form-group mb-2">
            <label for="">Title</label>
            <input type="text" wire:model="title" class="form-control">
            @error('title') <small class="error">{{ $message }}</small> @enderror
        </div>
        <div class="form-group mb-2">
            <label for="">Complaint Type</label>
            <select wire:model="type" class="form-control">
                <option value="">Select option</option>
                <option value="1">
                    To Insurer
                </option>
                <option value="2">
                    To Service Provider
                </option>
            </select>
            @error('type') <small class="error">{{ $message }}</small> @enderror
        </div>
        <div class="form-group mb-4">
            <label for="">Description</label>
            <textarea wire:model="description" class="form-control" width="100%" rows="10"></textarea>
            @error('description') <small class="error">{{ $message }}</small> @enderror
        </div>
        <div class="form-group mb-2">
            <button class="btn btn-primary" type="submit">
                Submit
            </button>
        </div>
    </form>
</div>
