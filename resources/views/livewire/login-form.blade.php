<div class="container mt-3">
    <div>
        @if (session()->has('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <h3 class="text-center">
        Login
    </h3>
    <br>
    <div class="d-flex row justify-content-center">
        <div class="card" style="width: 35rem">
            <div class="card-body p-4">
                <form wire:submit.prevent="submit">
                    <div class="form-group mb-3">
                        <label for="">Email</label>
                        <input type="text" wire:model="email" placeholder="johndoe@gmail.com" class="form-control">
                        @error('email') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Password</label>
                        <input type="password" wire:model="password" class="form-control" placeholder="****">
                        @error('password') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <button class="btn-register" type="submit">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
