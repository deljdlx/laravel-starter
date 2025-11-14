<div style="text-align: center">
    <x-card title="Livewire Counter Example">
        <button wire:click="increment" style="font-size:2rem; padding:1rem 2rem;">+1</button>
        <h2 style="margin-top:1rem; color: {{ $count % 2 === 0 ? 'blue' : 'red' }};">Valeur : {{ $count }}</h2>
    </x-card>
</div>
