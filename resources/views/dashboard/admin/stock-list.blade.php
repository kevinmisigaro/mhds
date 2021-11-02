@component('layouts.dashboard')
    @slot('title')
        Stock
    @endslot

    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                Stock list
            </h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                    Add new Stock
                </a>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="/dashboard/admin/stock/list/create" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">Batch number</label>
                                <input type="text" name="batch" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Quantity</label>
                                <input type="number" name="quantity" class="form-control">
                            </div>
                            <input type="hidden" name="id" value="{{ $stock_id }}">
                            <div class="form-group mb-3">
                                <label for="">Purchase price</label>
                                <input type="number" name="price" class="form-control">
                            </div>
                            <div class="form-group mb-4">
                                <label for="">Expiry date</label>
                                <input type="date" name="expiryDate" class="form-control">
                            </div>
                            <div class="form-group mb-1 text-center">
                                <button type="submit" class="btn btn-success">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
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
                                <th>Quantity</th>
                                <th>Purchase price</th>
                                <th>Expiry date</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>S/N</th>
                                <th>Quantity</th>
                                <th>Purchase price</th>
                                <th>Expiry date</th> 
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($stock as $item)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $item->quantity }}
                                </td>
                                <td>
                                    {{ $item->purchase_price }}
                                </td>
                                <td>
                                    {{ $item->expiry_date }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endcomponent