<div>
    <p>Das ist unser Component!</p>

    @if ($count >= 10)
        <p>Klick nicht so viel</p>
    @endif
    <p>{{ $count }}</p>

    <button wire:click="addOne">+1</button>


    <br><br>

    {{ $name }}

    <input type="text" wire:model.lazy="name">
</div>
