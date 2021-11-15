@component('layouts.dashboard')
    @slot('title')
        Insurers
    @endslot

    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
    @endif

    @if (session()->has('fail'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('fail') }}
    </div>
    @endif

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Insurers</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#insuranceModal">
            New Insurer
        </button>
    </div>

    <!-- Modal -->
<div class="modal fade" id="insuranceModal" tabindex="-1" aria-labelledby="insuranceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="insuranceModalLabel">Create insurer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="dashboard/admin/insurer/store" method="post">
            @csrf
              <small>Insurance manager details</small>

              <div class="row mb-2">
                  <div class="col-md-6">
                    <label for="">Full name</label>
                    <input type="text" name="name" class="form-control">
                  </div>
                  <div class="col-md-6">
                      <label for="">Email</label>
                      <input type="email" name="email" class="form-control">
                  </div>
              </div>

              <div class="row mb-2">
                <div class="col-md-6">
                  <label for="">Password</label>
                  <input type="password" name="password" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="">email</label>
                    <input type="password" name="confirmpassword" class="form-control">
                </div>
            </div>

            <small>Company details</small>

            <div class="row mb-2">
                <div class="col-md-6">
                    <label for="">Company name</label>
                    <input type="text" name="company" class="form-control">
                </div>
            </div>

            <button type="submit" class="btn btn-success mb-2">
                Register
            </button>

          </form>
        </div>
      </div>
    </div>
  </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($insurers as $insurer)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $insurer->name }}
                            </td>
                            <td>
                                {{ $insurer->email }}
                            </td>
                            <td>
                                <button class="btn btn-info text-white">
                                    View
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endcomponent