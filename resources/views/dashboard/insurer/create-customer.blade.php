@component('layouts.dashboard')
@slot('title')
New customer
@endslot

<div>

    @if (session()->has('fail'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('fail') }}
    </div>
    @endif

    <h1>Create new customer</h1>
    <br>
    <small>Customer details</small>
    <form action="/dashboard/insurer/store-customer" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row my-1">

            <div class="col-md-6 mb-2">
                <label>
                    Full name
                </label>
                <input type="text" name="name" class="form-control">
            </div>

            <div class="col-md-6 mb-2">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="col-md-6 mb-2">
                <label>
                    Sex
                </label>
                <select name="sex" class="form-control">
                    <option value="" selected disabled>Select gender</option>
                    <option value="MALE">Male</option>
                    <option value="FEMALE">Female</option>
                </select>
            </div>

            <div class="col-md-6 mb-2">
                <label for="">Date of birth</label>
                <input type="date" name="dob" class="form-control">
            </div>

            <div class="col-md-6 mb-2">
                <label for="">User Image</label>
                <input type="file" name="avatar" class="form-control">
            </div>

            <div class="col-md-6 mb-2">
                <label for="">Phone number</label>
                <input type="text" name="phone" class="form-control">
            </div>

        </div>

        <hr>

        <small>Card details</small>
        <div class="row my-2">
            <div class="col-md-6 mb-2">
                <label for="">Insurance number</label>
                <input type="text" class="form-control" name="card">
            </div>
            <div class="col-md-6 mb-2">
                <label for="">Card image</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="col-md-6 mb-2">
                <label>Issue date</label>
                <input type="date" name="idate" class="form-control">
            </div>
            <div class="col-md-6 mb-2">
                <label>Expiry date</label>
                <input type="date" name="edate" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-success" type="submit">
                Submit
            </button>
        </div>

    </form>

</div>

@endcomponent
