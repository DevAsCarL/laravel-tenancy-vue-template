@extends('vendor.pulse.pulse')
@section('content')

    <livewire:pulse.servers cols="full" />
    <livewire:pulse.exceptions cols="6" />
    <livewire:pulse.cache cols="6" />
    <x-pulse.client-table cols="12" />
    <livewire:pulse.usage cols="3" rows="1" />
    <livewire:pulse.queues cols="4" />
    <livewire:pulse.slow-queries cols="8" />
    
    <livewire:pulse.slow-requests cols="" />
    <livewire:pulse.slow-jobs cols="6" />

    <livewire:pulse.slow-outgoing-requests cols="6" />
    
@endsection
