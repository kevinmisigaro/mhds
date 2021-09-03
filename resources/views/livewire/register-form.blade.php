<div class="container mt-3">
    <h3>
        Create account
    </h3>
    <br>
    <div class="row">
        <div class="col-md-12">
            <form wire:submit.prevent="submit">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Name</label>
                        <input type="text" placeholder="John Doe" wire:model="name" class="form-control" autocomplete="off">
                        @error('name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label>Email</label>
                        <input type="text" placeholder="johndoe@gmail.com" wire:model="email" class="form-control" autocomplete="off">
                        @error('email') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Choose Insurance Company</label>
                        <select wire:model="company" class="form-control">
                            <option>Select company</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">
                                    {{ $company->company_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('company') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="">Card number</label>
                        <input type="text" placeholder="123XXX.." wire:model="card" class="form-control" autocomplete="off">
                        @error('card') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-6">
                        <label for="">Password</label>
                        <input type="text" placeholder="Enter password" wire:model="password" class="form-control" autocomplete="off">
                        @error('password') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="">Repeat password</label>
                        <input type="text" placeholder="Repeat password" wire:model="confirmpassword" class="form-control" autocomplete="off">
                        @error('confirmpassword') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <hr>
                <br>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p>
                            By creating an account, you agree to our <a href="/terms">Terms of Service</a>.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <button class="btn-register" type="submit">
                            Register
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
