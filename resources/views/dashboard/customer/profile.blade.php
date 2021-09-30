@component('layouts.dashboard')
    @slot('title')
        Profile
    @endslot

    <div class="container mt-3">

        <h3>
            Customer profile
        </h3>
        <br>

        <div class="row">
            <div class="col-md-7">
                <form method="POST" action="/dashboard/customer/update-details">
                    @csrf
                    <div class="form-group mb-2">
                        <label>
                            Name
                        </label>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <label>
                            Email
                        </label>
                        <input type="email" name="email" value="{{ $user->email }}" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <label>
                            Phone
                        </label>
                        <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <label>Gender</label>
                        <select name="sex" id="" class="form-control">
                            <option value="" {{ $user->customer->sex ? '': 'selected' }} disabled class="text-muted">Select gender</option>
                            <option value="MALE">Male</option>
                            <option value="FEMALE">Female</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label>
                            Amount of cards associated with account
                        </label>
                        <input type="text" value="{{ count($user->cards) }}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-info" type="submit">
                            Update
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-5 text-center mt-3">
                @if ($user->customer->profile_image)
                    <img src="{{ env('APP_URL') }}{{ $user->customer->profile_image }}" class="rounded-circle" style="width: 150px; height: 150px" alt="..">
                @else
                    <p class="text-muted">
                        No image uploaded
                    </p>
                @endif
                <br> <br><br>
                <form action="/dashboard/customer/update-avatar" method="post" enctype="multipart/form-data">
                    @csrf
                    <small>To change image, update below</small>
                    <input type="file" name="avatar" class="form-control"> <br>
                    <button class="btn btn-warning" type="submit">
                        Upload image
                    </button>
                </form>
            </div>
        </div>

    </div>

@endcomponent