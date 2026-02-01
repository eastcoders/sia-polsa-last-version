<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\WidgetRegistry;

class Dashboard extends Component
{
    public array $widgets = [];

    public function mount(WidgetRegistry $registry): void
    {
        $this->widgets = $registry->getWidgets();
    }

    public function render()
    {
        return view('livewire.dashboard')
            ->layout('layouts.app');
    }
}
