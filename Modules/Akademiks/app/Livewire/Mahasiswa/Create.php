<?php

namespace Modules\Akademiks\Livewire\Mahasiswa;

use App\Models\Agama;
use App\Models\AlatTransportasi;
use App\Models\JenisTinggal;
use App\Models\JenjangPendidikan;
use App\Models\Negara;
use App\Models\Pekerjaan;
use App\Models\Penghasilan;
use App\Models\Wilayah;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    #[Layout('layouts.app')]
    public $penerima_kps;

    public $no_kps;

    public $selectedProvinsi = null;
    public $selectedKabupaten = null;
    public $selectedKecamatan = null;
    public $wilayahDisplay = '';
    public $id_wilayah; // Store the final selected kecamatan ID

    public function updatedSelectedProvinsi($value)
    {
        $this->selectedKabupaten = null;
        $this->selectedKecamatan = null;

        if ($value) {
            $kabupaten = Wilayah::where('id_induk_wilayah', $value)
                ->where('id_level_wilayah', '2')
                ->get(['id_wilayah', 'nama_wilayah']);
            $this->dispatch('kabupaten-loaded', $kabupaten->toArray());
        }
    }

    public function updatedSelectedKabupaten($value)
    {
        $this->selectedKecamatan = null;

        if ($value) {
            $kecamatan = Wilayah::where('id_induk_wilayah', $value)
                ->where('id_level_wilayah', '3')
                ->get(['id_wilayah', 'nama_wilayah']);
            $this->dispatch('kecamatan-loaded', $kecamatan->toArray());
        }
    }

    public function saveWilayah()
    {
        $this->validate([
            'selectedKecamatan' => 'required',
        ]);

        $kecamatan = Wilayah::find($this->selectedKecamatan);
        $kabupaten = Wilayah::find($this->selectedKabupaten);
        $provinsi = Wilayah::find($this->selectedProvinsi);

        if ($kecamatan && $kabupaten && $provinsi) {
            $this->wilayahDisplay = "{$provinsi->nama_wilayah} - {$kabupaten->nama_wilayah} - {$kecamatan->nama_wilayah}";
            $this->id_wilayah = $this->selectedKecamatan;
        }
    }

    public function render()
    {
        $agama = Agama::all();
        $negara = Negara::all();
        $alat_transportasi = AlatTransportasi::all();
        $jenis_tinggal = JenisTinggal::all();
        $pendidikan = JenjangPendidikan::all();
        $pekerjaan = Pekerjaan::all();
        $penghasilan = Penghasilan::all();

        // Wilayah (only provinces - kabupaten/kecamatan loaded via dispatch events)
        $provinsi = Wilayah::where('id_level_wilayah', '1')->get();

        return view('akademiks::livewire.mahasiswa.create', compact(
            'agama', 'negara', 'alat_transportasi', 'jenis_tinggal',
            'pendidikan', 'pekerjaan', 'penghasilan',
            'provinsi'
        ));
    }
}
