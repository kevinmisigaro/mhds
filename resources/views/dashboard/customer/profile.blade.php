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
                <form>
                    <div class="form-group mb-2">
                        <label for="">
                            Name
                        </label>
                        <input type="text" value="{{ $user->name }}" class="form-control" disabled>
                    </div>
                    <div class="form-group mb-2">
                        <label for="">
                            Email
                        </label>
                        <input type="email" value="{{ $user->email }}" class="form-control" disabled>
                    </div>
                    <div class="form-group mb-2">
                        <label for="">
                            Phone
                        </label>
                        <input type="text" value="{{ $user->phone }}" class="form-control" disabled>
                    </div>
                    <div class="form-group mb-2">
                        <label for="">
                            Amount of cards associated with account
                        </label>
                        <input type="text" value="{{ count($user->cards) }}" class="form-control" disabled>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endcomponent