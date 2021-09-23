@component('layouts.dashboard')
@slot('title')
Home
@endslot

<div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Customer Row -->
    @if (\Illuminate\Support\Facades\Auth::user()->role == 'customer')
    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Cards
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ count($cards) }}
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Prescriptions
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
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Profile Completion</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ round($profileCount*100, 0) }}%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                            aria-valuenow="{{ round($profileCount*100, 0) }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endif

    @if (\Illuminate\Support\Facades\Auth::user()->role == 'admin')
    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Customers
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ count($customers) }}
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Doctors
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ count($doctors) }}
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Insurers
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ count($insurers) }}
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Insurance Companies
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ count($companies) }}
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Prescriptions
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Complaints
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
  

    </div>
    @endif


    @if (\Illuminate\Support\Facades\Auth::user()->role == 'insurer')
    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Prescriptions
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Cards
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ count($cards) }}
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
    @endif

</div>

@endcomponent
