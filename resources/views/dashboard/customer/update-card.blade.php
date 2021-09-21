@component('layouts.dashboard')
    @slot('title')
        Update card
    @endslot

    <div class="row">
        <div class="container mt-3">
            <style>
                .error {
                    color: red;
                    font-size: 13pt;
                    padding-top: 5px;
                }
        
            </style>
            <h3>
                Update card
            </h3>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <form method="POST" action="/dashboard/customer/updateCard">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="">Insurance card number</label>
                            <input type="text" name="card" value="{{ $card->insurance_number }}" class="form-control">
                        </div>
                        <input type="hidden" value="{{ $card->id }}" name="id">
                        <div class="form-group mb-2">
                            <label for="">Insurance Company</label>
                            <select name="company" class="form-control">
                                <option value="{{ $card->company->id }}">
                                    {{ $card->company->company_name }}
                                </option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">
                                        {{ $company->company_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Insurance type</label>
                            <input type="text" value="{{ $card->type }}" class="form-control" name="type">
                        </div>
                        <div class="form-group mb-4">
                            <label for="">Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        <div class="form-group mb-2">
                            <button class="btn btn-warning" type="submit">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>

@endcomponent