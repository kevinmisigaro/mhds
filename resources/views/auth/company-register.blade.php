@component('layouts.app')
@slot('pagecss')

@endslot

<div class="container  mt-5">
    <h2>
        Insurance company registraton.
    </h2>
    <br><br>
    <p class="text-muted">Insurance manager details</p>

    <form action="/company/register" method="post">
        @csrf
        <div class="row my-3">
            <div class="col-md-6 mb-2">
                <label for="">Full Name</label>
                <input type="text" name="name" class="form-control" autocomplete="off">
            </div>
            <div class="col-md-6 mb-2">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" autocomplete="off">
            </div>
            <div class="col-md-6 mb-2">
                <label for="">Password</label>
                <input type="password" name="pass" class="form-control" autocomplete="off">
            </div>
            <div class="col-md-6 mb-2">
                <label for="">Confirm Password</label>
                <input type="password" name="confirmpass" class="form-control" autocomplete="off">
            </div>
        </div>

        <p class="text-muted">Company details</p>

        <div class="row mb-5">
            <div class="form-group col-md-6">
                <label for="">Company Name</label>
                <input type="text" name="company" class="form-control" autocomplete="off">
            </div>
        </div>

        <div>
            <button class="btn btn-success" type="submit">
                Register
            </button>
        </div>
    </form>
</div>

@endcomponent
