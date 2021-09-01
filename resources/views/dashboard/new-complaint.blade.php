@component('layouts.dashboard')
    @slot('title')
        New Complaint
    @endslot

    <div class="row">
        <livewire:new-complaint-form />
    </div>

@endcomponent