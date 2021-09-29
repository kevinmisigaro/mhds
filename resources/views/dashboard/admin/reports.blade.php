@component('layouts.dashboard')
    @slot('title')
       Reports 
    @endslot

    <div>

        <h1 class="h3 mb-2 text-gray-800">Reports</h1>

        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    New users this month
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ count($users) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="far fa-address-card fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    New prescriptions this month
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ count($prescriptions) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="far fa-address-card fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    New complaints this month
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ count($complaints) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="far fa-address-card fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    New drugs this month
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ count($drugs) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="far fa-address-card fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Amount made this month
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    TZS {{ number_format($amount,1) }} /=
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="far fa-address-card fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>


@endcomponent