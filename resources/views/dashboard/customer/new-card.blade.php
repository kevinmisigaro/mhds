@component('layouts.dashboard')
    @slot('title')
        New Card
    @endslot

    <div class="row">
        <livewire:new-card-form />
    </div>

@endcomponent