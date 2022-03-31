<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public int $count = 0;
    public string $name = '';

    public function render()
    {
        if($this->name === 'Test') {
            $this->name = 'Der Name ist vergeben!';
        }
        return view('livewire.counter');
    }

    public function addOne()
    {
        if($this->count >= 10) {
            $this->count--;
        } else {
            $this->count++;
        }
    }
}
