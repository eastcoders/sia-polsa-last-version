<?php

namespace Modules\Akademiks\Livewire\Mahasiswa;

use Livewire\Attributes\Layout;
use Livewire\Component;

use Livewire\WithPagination;
use Modules\Akademiks\Models\Mahasiswa;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;
    public $filterProdi = '';
    public $filterStatus = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $query = Mahasiswa::with('riwayatPendidikan');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nama_lengkap', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhereHas('riwayatPendidikan', function ($subQ) {
                      $subQ->where('nim', 'like', '%' . $this->search . '%');
                  });
            });
        }

        if ($this->filterProdi) {
            $query->whereHas('riwayatPendidikan', function ($q) {
                $q->where('id_prodi', $this->filterProdi);
            });
        }

        if ($this->filterStatus) {
            $query->whereHas('riwayatPendidikan', function ($q) {
                $q->where('id_status_mahasiswa', $this->filterStatus);
            });
        }

        $mahasiswas = $query->latest()->paginate($this->perPage);

        return view('akademiks::livewire.mahasiswa.index', compact('mahasiswas'));
    }
}
