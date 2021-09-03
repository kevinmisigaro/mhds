@component('layouts.dashboard')
    @slot('title')
        New Prescription
    @endslot

    <div class="row">
        <livewire:new-prescription-form />
    </div>

@endcomponent