<?php

namespace Modules\Akademiks\tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Akademiks\Models\Wilayah;
use Modules\Akademiks\Models\ProgramStudi;
use Modules\Akademiks\Models\AlatTransportasi;
use Modules\Akademiks\Models\PerguruanTinggi;
use Tests\TestCase;

class MasterDataFactoryTest extends TestCase
{
    use DatabaseTransactions;

    public function test_can_create_hierarchical_wilayah()
    {
        // Create a Kabupaten (should create a Provinsi parent automatically)
        $kabupaten = Wilayah::factory()->kabupaten()->create();

        $this->assertNotNull($kabupaten->id_induk_wilayah);
        $this->assertEquals('2', $kabupaten->id_level_wilayah);
        
        // Fetch parent
        $provinsi = Wilayah::where('id_wilayah', $kabupaten->id_induk_wilayah)->first();
        $this->assertNotNull($provinsi);
        $this->assertEquals('1', $provinsi->id_level_wilayah);
        $this->assertNull($provinsi->id_induk_wilayah);
    }

    public function test_can_create_program_studi()
    {
        $prodi = ProgramStudi::factory()->create();
        $this->assertDatabaseHas('program_studis', [
            'id' => $prodi->id,
            'kode_program_studi' => $prodi->kode_program_studi,
        ]);
    }

    public function test_can_create_other_master_data()
    {
        $alat = AlatTransportasi::factory()->create();
        $this->assertNotNull($alat->nama_alat_transportasi);

        $pt = PerguruanTinggi::factory()->create();
        $this->assertNotNull($pt->nama_perguruan_tinggi);
    }
}
