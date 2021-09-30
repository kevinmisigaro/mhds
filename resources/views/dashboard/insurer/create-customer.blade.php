@component('layouts.dashboard')
    @slot('title')
        New customer
    @endslot

    <div>

        <h1>Create new customer</h1>
        <br>
        <small>Customer details</small>
        <form action="/dashboard/insurer/store-customer" method="post">
            @csrf
            <div class="row my-1">
                <div class="col-md-6 mb-3">
                    <label>
                        Full name
                    </label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Email</label>
                    <input type="email" name="email" id="" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>
                       Sex
                    </label>
                    <select name="sex" class="form-control">
                        <option value="" selected disabled>Select gender</option>
                        <option value="MALE">Male</option>
                        <option value="FEMALE">Female</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Date of birth</label>
                    <input type="date" name="dob" id="" class="form-control">
                </div>
            </div>

            <hr>

            <small>Card details</small>
            <div class="row my-2">
                <div class="col-md-6 mb-3">
                    <label for="">Insurance number</label>
                    <input type="text" class="form-control" name="card">
                </div> 
                <div class="col-md-6 mb-3">
                    <label for="">Type</label>
                    <input type="text" class="form-control" name="type">
                </div>
            </div>

            <hr>

            <small>Card image</small>
            <div class="row my-2">
                <div class="col-md-6 mb-3">
                    <label for="">Card image</label>
                    <input type="file" name="image" id="" class="form-control">
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