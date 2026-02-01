<?php

namespace Modules\Akademiks\Livewire\Widgets;

use Livewire\Component;

class AkademikSummaryWidget extends Component
{
    public int $totalMahasiswa = 0;
    public int $totalDosen = 0;
    public int $totalMataKuliah = 0;

    public function mount(): void
    {
        // Data placeholder - akan diambil dari service/repository
        $this->totalMahasiswa = 1250;
        $this->totalDosen = 85;
        $this->totalMataKuliah = 156;
    }

    public function render()
    {
        return view('akademiks::livewire.widgets.akademik-summary-widget');
    }
}
