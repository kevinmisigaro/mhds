@component('layouts.app')

    @slot('pagecss')
        <style>
            .btn-register{
            background: blue; 
            color: white;
            padding: 10px 60px;
            font-weight: bold;
            border: 1px solid blue;
        }
        h3{
            font-weight: bold
        }
        .error{
            color: red
        }
        </style>
    @endslot
    <livewire:login-form />
@endcomponent