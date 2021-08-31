@component('layouts.app')

@slot('pagecss')
    <style>
        .hero{
            height: 460px; 
            background-color:blue;
            background-image: url('{{ asset('images/fliphandcard.png') }}');
            background-repeat: no-repeat;
            background-position: right;
        }
        .btn-register{
            background: white; 
            color: blue;
            padding: 10px 60px;
            font-weight: bold;
        }
        footer{
            background: black;
            padding: 10px 0;
            text-align: center;
        }
        .footer > small{
            color: aliceblue;
        }
    </style>
@endslot

<section class="hero">
    <div class="container-fluid">
        <div class="container">

            <div class="row">
                <div class="col-md-6">
                    <br><br><br><br><br>
                    <h2 style="color: white">
                        Get medicine delivered to you with your insurance card.
                    </h2>
                    <br><br>
                    <a href="/register" type="button" class="btn btn-light btn-register">
                        Register
                    </a>
                </div>
                
            </div>

        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <h2 class="text-center">
            Access to quality healthcare should be simple.
        </h2>
        <br><br>
        <div class="row">
            <div class="col-md-6 d-flex align-items-center">
                <div>
                    <h3>
                        Talk to a doctor anytime, anywhere—for free!
                    </h3>
                    <p class="text-muted">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('images/consultation.png') }}" alt="consultation" style="max-width: 400px">
            </div>
            <div class="col-md-6">
                <img src="{{ asset('images/reports.png') }}" alt="consultation" style="max-width: 400px">
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <div>
                    <h3>
                        Get reports.
                    </h3>
                    <p class="text-muted">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                    </p>
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <div>
                    <h3>
                        Get medicine delivered and paid for with your insurance card.
                    </h3>
                    <p class="text-muted">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('images/otw.png') }}" alt="otw" style="max-width: 400px">
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="footer">
        <small class="text-center">
            2021. MDHS.
        </small>
    </div>
</footer>

@endcomponent