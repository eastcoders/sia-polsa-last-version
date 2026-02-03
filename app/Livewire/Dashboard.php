<?php

namespace App\Livewire;

use App\Services\WidgetRegistry;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboard extends Component
{
    #[Layout('layouts.app')]
    public array $widgets = [];

    public function mount(WidgetRegistry $registry): void
    {
        $this->widgets = $registry->getWidgets();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
