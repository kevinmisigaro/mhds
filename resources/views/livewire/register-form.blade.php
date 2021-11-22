<div class="container mt-3">
    @if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
    </div>
    @endif

    <h3>
        Create account
    </h3>
    <div class="row">
        <div class="col-md-12">
            <form wire:submit.prevent="submit" enctype="multipart/form-data">

                <small class="text-muted">Personal details</small>
                <br><br>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Name</label>
                        <input type="text" placeholder="John Doe" wire:model="name" class="form-control"
                            autocomplete="off">
                        @error('name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label>Email</label>
                        <input type="text" placeholder="johndoe@gmail.com" wire:model="email" class="form-control"
                            autocomplete="off">
                        @error('email') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="">Sex</label>
                        <select wire:model="sex" class="form-control">
                            <option value="">Select gender</option>
                            <option value="MALE">Male</option>
                            <option value="FEMALE">Female</option>
                        </select>
                        @error('sex') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="">Date of birth</label>
                        <input type="date" wire:model="dob" class="form-control">
                        @error('dob') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-6">
                        <label for="">Password</label>
                        <input type="text" placeholder="Enter password" wire:model="password" class="form-control"
                            autocomplete="off">
                        @error('password') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="">Repeat password</label>
                        <input type="text" placeholder="Repeat password" wire:model="confirmpassword"
                            class="form-control" autocomplete="off">
                        @error('confirmpassword') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <hr>
                <small class="text-muted">Insurance card details</small>

                <br><br>
                <div class="row mb-3">
                    <div class="col-md-4">
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
                    <div class="col-md-4">
                        <label for="">Card number</label>
                        <input type="text" placeholder="123XXX.." wire:model="card" class="form-control"
                            autocomplete="off">
                        @error('card') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="">Card Image</label>
                        <input type="file" class="form-control" wire:model="image">
                        @error('image') <small class="error">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="">Issue date</label>
                        <input type="date" wire:model="issueDate" autocomplete="off" class="form-control">
                        @error('issueDate') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="">Expiry date</label>
                        <input type="date" wire:model="expiryDate" autocomplete="off" class="form-control">
                        @error('expiryDate') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <br>
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
                <br>
                <div class="my-3 text-center">
                    If your an insurance company, <a href="/company/login">click here</a> to register.
                </div>
            </form>
        </div>
    </div>
</div>
