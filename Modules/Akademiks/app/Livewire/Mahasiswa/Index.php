<?php

namespace Modules\Akademiks\Livewire\Mahasiswa;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Index extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        return view('akademiks::livewire.mahasiswa.index');
    }
}
