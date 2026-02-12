<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Wilayah;
use App\Services\Feeder\ReferencesServices;
use App\Models\Agama;
use App\Models\Negara;
use App\Models\Fakultas;
use App\Models\Semester;
use App\Models\Kurikulum;
use App\Models\Pekerjaan;
use App\Models\JalurMasuk;
use App\Models\Pembiayaan;
use App\Models\JenisKeluar;
use App\Models\Penghasilan;
use App\Models\TahunAjaran;
use App\Models\JenisTinggal;
use App\Models\LevelWilayah;
use App\Models\ProgramStudi;
use App\Models\JenisEvaluasi;
use App\Models\JenisPrestasi;
use App\Models\IkatanKerjaSdm;
use App\Models\JenisSubstansi;
use App\Models\KebutuhanKhusus;
use App\Models\PangkatGolongan;
use App\Models\PerguruanTinggi;
use App\Models\TingkatPrestasi;
use App\Models\AlatTransportasi;
use App\Models\BentukPendidikan;
use App\Models\JenisPendaftaran;
use App\Models\JenisSertifikasi;
use App\Models\KategoriKegiatan;
use App\Models\JabatanFungsional;
use App\Models\JenjangPendidikan;
use App\Models\LembagaPengangkat;
use App\Models\StatusKepegawaian;
use App\Models\JenisAktivitasMahasiswa;

class SyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feeder:sync {--chunk=500 : Number of records per chunk} {--type=wilayah : Type of data to sync (wilayah, level, negara, pt, prodi, fakultas, ta, semester, kurikulum, agama, alat_transportasi, pekerjaan, penghasilan, kebutuhan_khusus, jenis_tinggal, status_pegawai, ikatan_kerja, jenis_keluar, jenjang_pendidikan, bentuk_pendidikan, jalur_masuk, jenis_pendaftaran, pembiayaan, jenis_evaluasi, jenis_substansi, jabatan_fungsional, pangkat_golongan, lembaga_pengangkat, jenis_sertifikasi, jenis_prestasi, tingkat_prestasi, kategori_kegiatan, jenis_aktivitas_mahasiswa)}';

    protected $description = 'Sync Reference Data (Wilayah, Level, Negara, PT, Prodi, Fakultas, TA, Semester, Kurikulum, Biodata)';

    protected ReferencesServices $feeder;

    public function __construct(ReferencesServices $feeder)
    {
        parent::__construct();
        $this->feeder = $feeder;
    }

    public function handle()
    {
        $type = $this->option('type');

        switch ($type) {
            case 'level':
                return $this->syncLevelWilayah();
            case 'negara':
                return $this->syncNegara();
            case 'pt':
                return $this->syncPT();
            case 'prodi':
                return $this->syncProdi();
            case 'fakultas':
                return $this->syncFakultas();
            case 'ta':
                return $this->syncTahunAjaran();
            case 'semester':
                return $this->syncSemester();
            case 'kurikulum':
                return $this->syncKurikulum();
            case 'agama':
                return $this->syncAgama();
            case 'alat_transportasi':
                return $this->syncAlatTransportasi();
            case 'pekerjaan':
                return $this->syncPekerjaan();
            case 'penghasilan':
                return $this->syncPenghasilan();
            case 'kebutuhan_khusus':
                return $this->syncKebutuhanKhusus();
            case 'jenis_tinggal':
                return $this->syncJenisTinggal();
            case 'status_pegawai':
                return $this->syncStatusKepegawaian();
            case 'ikatan_kerja':
                return $this->syncIkatanKerjaSdm();
            case 'jenis_keluar':
                return $this->syncJenisKeluar();
            case 'jenjang_pendidikan':
                return $this->syncJenjangPendidikan();
            case 'bentuk_pendidikan':
                return $this->syncBentukPendidikan();
            case 'jalur_masuk':
                return $this->syncJalurMasuk();
            case 'jenis_pendaftaran':
                return $this->syncJenisPendaftaran();
            case 'pembiayaan':
                return $this->syncPembiayaan();
            case 'jenis_evaluasi':
                return $this->syncJenisEvaluasi();
            case 'jenis_substansi':
                return $this->syncJenisSubstansi();
            case 'jabatan_fungsional':
                return $this->syncJabatanFungsional();
            case 'pangkat_golongan':
                return $this->syncPangkatGolongan();
            case 'lembaga_pengangkat':
                return $this->syncLembagaPengangkat();
            case 'jenis_sertifikasi':
                return $this->syncJenisSertifikasi();
            case 'jenis_prestasi':
                return $this->syncJenisPrestasi();
            case 'tingkat_prestasi':
                return $this->syncTingkatPrestasi();
            case 'kategori_kegiatan':
                return $this->syncKategoriKegiatan();
            case 'jenis_aktivitas_mahasiswa':
                return $this->syncJenisAktivitasMahasiswa();
            case 'wilayah':
            default:
                return $this->syncWilayah();
        }
    }

    protected function syncKurikulum()
    {
        $this->info("Starting Kurikulum sync...");
        $chunkSize = (int) $this->option('chunk');
        $offset = 0;
        $totalSynced = 0;
        
        $bar = $this->output->createProgressBar();
        $bar->start();

        do {
            try {
                $response = $this->feeder->getKurikulum([], $chunkSize, $offset);
                 if (isset($response['error_code']) && $response['error_code'] != 0) {
                    $this->error("API Error: " . $response['error_desc']);
                    return Command::FAILURE;
                }

                $data = $response['data'] ?? [];
                $count = count($data);

                if ($count === 0) break;

                $records = array_map(function ($item) {
                     return [
                        'id_kurikulum' => trim($item['id_kurikulum'] ?? ''),
                        'nama_kurikulum' => trim($item['nama_kurikulum'] ?? ''),
                        'id_prodi' => trim($item['id_prodi'] ?? ''),
                        'id_semester' => isset($item['id_semester']) ? (string)$item['id_semester'] : null,
                        'jumlah_sks_lulus' => isset($item['jumlah_sks_lulus']) ? (int)$item['jumlah_sks_lulus'] : null,
                        'jumlah_sks_wajib' => isset($item['jumlah_sks_wajib']) ? (int)$item['jumlah_sks_wajib'] : null,
                        'jumlah_sks_pilihan' => isset($item['jumlah_sks_pilihan']) ? (int)$item['jumlah_sks_pilihan'] : null,
                        'status' => trim($item['status'] ?? ''),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }, $data);

                Kurikulum::upsert(
                    $records,
                    ['id_kurikulum'],
                    ['nama_kurikulum', 'id_prodi', 'id_semester', 'jumlah_sks_lulus', 'jumlah_sks_wajib', 'jumlah_sks_pilihan', 'status']
                );

                 $totalSynced += $count;
                 $offset += $chunkSize;
                 $bar->advance($count);

            } catch (\Exception $e) {
                 $this->error("Exception: " . $e->getMessage());
                return Command::FAILURE;
            }
        } while ($count >= $chunkSize);

        $bar->finish();
        $this->newLine();
        $this->info("Synced {$totalSynced} Kurikulum records.");
        return Command::SUCCESS;
    }

    protected function syncFakultas()
    {
        $chunkSize = (int) $this->option('chunk');
        $offset = 0;
        $totalSynced = 0;
        
        $this->info("Starting Fakultas sync...");

        $bar = $this->output->createProgressBar();
        $bar->start();

        do {
            try {
                $response = $this->feeder->getFakultas([], $chunkSize, $offset);

                if (isset($response['error_code']) && $response['error_code'] != 0) {
                    $this->error("API Error: " . $response['error_desc']);
                    return Command::FAILURE;
                }

                $data = $response['data'] ?? [];
                $count = count($data);

                if ($count === 0) break;

                $records = array_map(function ($item) {
                    return [
                        'id_fakultas' => trim($item['id_fakultas'] ?? ''),
                        'id_perguruan_tinggi' => trim($item['id_perguruan_tinggi'] ?? ''),
                        'nama_fakultas' => trim($item['nama_fakultas'] ?? ''),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }, $data);

                Fakultas::upsert(
                    $records,
                    ['id_fakultas'],
                    ['id_perguruan_tinggi', 'nama_fakultas']
                );

                $totalSynced += $count;
                $offset += $chunkSize;
                $bar->advance($count);

            } catch (\Exception $e) {
                $this->error("Exception: " . $e->getMessage());
                return Command::FAILURE;
            }
        } while ($count >= $chunkSize);

        $bar->finish();
        $this->newLine();
        $this->info("Synced {$totalSynced} Fakultas records.");
        return Command::SUCCESS;
    }

    protected function syncTahunAjaran()
    {
        $this->info("Starting Tahun Ajaran sync...");
        
        // TA might not be paginated or small enough to fetch all? Assuming pagination exists.
        $chunkSize = (int) $this->option('chunk');
        $offset = 0;
        $totalSynced = 0;

        $bar = $this->output->createProgressBar();
        $bar->start();

        do {
            try {
                $response = $this->feeder->getTahunAjaran([], $chunkSize, $offset);
                 if (isset($response['error_code']) && $response['error_code'] != 0) {
                    $this->error("API Error: " . $response['error_desc']);
                    return Command::FAILURE;
                }

                $data = $response['data'] ?? [];
                $count = count($data);

                if ($count === 0) break;

                $records = array_map(function ($item) {
                    return [
                        'id_tahun_ajaran' => (int)$item['id_tahun_ajaran'],
                        'nama_tahun_ajaran' => trim($item['nama_tahun_ajaran'] ?? ''),
                        'a_periode_aktif' => (bool)($item['a_periode_aktif'] ?? 0),
                        'tanggal_mulai' => isset($item['tanggal_mulai']) ? \Carbon\Carbon::parse($item['tanggal_mulai'])->format('Y-m-d') : null,
                        'tanggal_selesai' => isset($item['tanggal_selesai']) ? \Carbon\Carbon::parse($item['tanggal_selesai'])->format('Y-m-d') : null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }, $data);

                TahunAjaran::upsert(
                    $records,
                    ['id_tahun_ajaran'],
                    ['nama_tahun_ajaran', 'a_periode_aktif', 'tanggal_mulai', 'tanggal_selesai']
                );

                $totalSynced += $count;
                $offset += $chunkSize;
                $bar->advance($count);

            } catch (\Exception $e) {
                 $this->error("Exception: " . $e->getMessage());
                return Command::FAILURE;
            }
        } while ($count >= $chunkSize);

        $bar->finish();
        $this->newLine();
        $this->info("Synced {$totalSynced} Tahun Ajaran records.");
        return Command::SUCCESS;
    }

    protected function syncSemester()
    {
        $this->info("Starting Semester sync...");
        $chunkSize = (int) $this->option('chunk');
        $offset = 0;
        $totalSynced = 0;
        
        $bar = $this->output->createProgressBar();
        $bar->start();

        do {
            try {
                $response = $this->feeder->getSemester([], $chunkSize, $offset);
                 if (isset($response['error_code']) && $response['error_code'] != 0) {
                    $this->error("API Error: " . $response['error_desc']);
                    return Command::FAILURE;
                }

                $data = $response['data'] ?? [];
                $count = count($data);

                if ($count === 0) break;

                $records = array_map(function ($item) {
                     return [
                        'id_semester' => (string)$item['id_semester'],
                        'id_tahun_ajaran' => (int)$item['id_tahun_ajaran'],
                        'nama_semester' => trim($item['nama_semester'] ?? ''),
                        'semester' => (int)($item['semester'] ?? 0),
                        'a_periode_aktif' => (bool)($item['a_periode_aktif'] ?? 0),
                        'tanggal_mulai' => isset($item['tanggal_mulai']) ? \Carbon\Carbon::parse($item['tanggal_mulai'])->format('Y-m-d') : null,
                        'tanggal_selesai' => isset($item['tanggal_selesai']) ? \Carbon\Carbon::parse($item['tanggal_selesai'])->format('Y-m-d') : null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }, $data);

                Semester::upsert(
                    $records,
                    ['id_semester'],
                    ['id_tahun_ajaran', 'nama_semester', 'semester', 'a_periode_aktif', 'tanggal_mulai', 'tanggal_selesai']
                );

                 $totalSynced += $count;
                 $offset += $chunkSize;
                 $bar->advance($count);

            } catch (\Exception $e) {
                 $this->error("Exception: " . $e->getMessage());
                return Command::FAILURE;
            }
        } while ($count >= $chunkSize);

        $bar->finish();
        $this->newLine();
        $this->info("Synced {$totalSynced} Semester records.");
        return Command::SUCCESS;
    }

    protected function syncProdi()
    {
        $chunkSize = (int) $this->option('chunk');
        $offset = 0;
        $totalSynced = 0;
        
        $this->info("Starting Program Studi sync...");

        $bar = $this->output->createProgressBar();
        $bar->start();

        do {
            try {
                $response = $this->feeder->getAllProdi([], $chunkSize, $offset);

                if (isset($response['error_code']) && $response['error_code'] != 0) {
                    $this->error("API Error: " . $response['error_desc']);
                    return Command::FAILURE;
                }

                $data = $response['data'] ?? [];
                $count = count($data);

                if ($count === 0) break;

                $records = array_map(function ($item) {
                    return [
                        'id_prodi' => trim($item['id_prodi'] ?? ''),
                        'id_perguruan_tinggi' => trim($item['id_perguruan_tinggi'] ?? ''),
                        'kode_program_studi' => trim($item['kode_program_studi'] ?? ''),
                        'nama_program_studi' => trim($item['nama_program_studi'] ?? ''),
                        'status' => trim($item['status'] ?? ''),
                        'id_jenjang_pendidikan' => isset($item['id_jenjang_pendidikan']) ? (int)$item['id_jenjang_pendidikan'] : null,
                        'nama_jenjang_pendidikan' => trim($item['nama_jenjang_pendidikan'] ?? ''),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }, $data);

                ProgramStudi::upsert(
                    $records,
                    ['id_prodi'],
                    ['id_perguruan_tinggi', 'kode_program_studi', 'nama_program_studi', 'status', 'id_jenjang_pendidikan', 'nama_jenjang_pendidikan']
                );

                $totalSynced += $count;
                $offset += $chunkSize;
                $bar->advance($count);

            } catch (\Exception $e) {
                $this->error("Exception: " . $e->getMessage());
                return Command::FAILURE;
            }
        } while ($count >= $chunkSize);

        $bar->finish();
        $this->newLine();
        $this->info("Synced {$totalSynced} Program Studi records.");
        return Command::SUCCESS;
    }

    protected function syncPT()
    {
        $chunkSize = (int) $this->option('chunk');
        $offset = 0;
        $totalSynced = 0;
        
        $this->info("Starting Perguruan Tinggi sync...");

        $bar = $this->output->createProgressBar();
        $bar->start();

        do {
            try {
                $response = $this->feeder->getAllPT([], $chunkSize, $offset);

                if (isset($response['error_code']) && $response['error_code'] != 0) {
                    $this->error("API Error: " . $response['error_desc']);
                    return Command::FAILURE;
                }

                $data = $response['data'] ?? [];
                $count = count($data);

                if ($count === 0) break;

                $records = array_map(function ($item) {
                    return [
                        'id_perguruan_tinggi' => trim($item['id_perguruan_tinggi'] ?? ''),
                        'kode_perguruan_tinggi' => trim($item['kode_perguruan_tinggi'] ?? ''),
                        'nama_perguruan_tinggi' => trim($item['nama_perguruan_tinggi'] ?? ''),
                        'nama_singkat' => trim($item['nama_singkat'] ?? ''),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }, $data);

                PerguruanTinggi::upsert(
                    $records,
                    ['id_perguruan_tinggi'],
                    ['kode_perguruan_tinggi', 'nama_perguruan_tinggi', 'nama_singkat']
                );

                $totalSynced += $count;
                $offset += $chunkSize;
                $bar->advance($count);

            } catch (\Exception $e) {
                $this->error("Exception: " . $e->getMessage());
                return Command::FAILURE;
            }
        } while ($count >= $chunkSize);

        $bar->finish();
        $this->newLine();
        $this->info("Synced {$totalSynced} Perguruan Tinggi records.");
        return Command::SUCCESS;
    }

    protected function syncNegara()
    {
        $chunkSize = (int) $this->option('chunk');
        $offset = 0;
        $totalSynced = 0;
        
        $this->info("Starting Negara sync...");

        $bar = $this->output->createProgressBar();
        $bar->start();

        do {
            try {
                $response = $this->feeder->getNegara([], $chunkSize, $offset);

                if (isset($response['error_code']) && $response['error_code'] != 0) {
                    $this->error("API Error: " . $response['error_desc']);
                    return Command::FAILURE;
                }

                $data = $response['data'] ?? [];
                $count = count($data);

                if ($count === 0) break;

                $records = array_map(function ($item) {
                    return [
                        'id_negara' => trim($item['id_negara'] ?? ''),
                        'nama_negara' => trim($item['nama_negara'] ?? ''),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }, $data);

                Negara::upsert(
                    $records,
                    ['id_negara'],
                    ['nama_negara']
                );

                $totalSynced += $count;
                $offset += $chunkSize;
                $bar->advance($count);

            } catch (\Exception $e) {
                $this->error("Exception: " . $e->getMessage());
                return Command::FAILURE;
            }
        } while ($count >= $chunkSize);

        $bar->finish();
        $this->newLine();
        $this->info("Synced {$totalSynced} Negara records.");
        return Command::SUCCESS;
    }

    protected function syncLevelWilayah()
    {
        $chunkSize = (int) $this->option('chunk');
        $offset = 0;
        $totalSynced = 0;
        
        $this->info("Starting Level Wilayah sync...");

        $bar = $this->output->createProgressBar();
        $bar->start();

        do {
            try {
                $response = $this->feeder->getLevelWilayah([], $chunkSize, $offset);

                if (isset($response['error_code']) && $response['error_code'] != 0) {
                    $this->error("API Error: " . $response['error_desc']);
                    return Command::FAILURE;
                }

                $data = $response['data'] ?? [];
                $count = count($data);

                if ($count === 0) break;

                $records = array_map(function ($item) {
                    return [
                        'id_level_wilayah' => (int) $item['id_level_wilayah'],
                        'nama_level_wilayah' => trim($item['nama_level_wilayah'] ?? ''),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }, $data);

                LevelWilayah::upsert(
                    $records,
                    ['id_level_wilayah'],
                    ['nama_level_wilayah']
                );

                $totalSynced += $count;
                $offset += $chunkSize;
                $bar->advance($count);

            } catch (\Exception $e) {
                $this->error("Exception: " . $e->getMessage());
                return Command::FAILURE;
            }
        } while ($count >= $chunkSize);

        $bar->finish();
        $this->newLine();
        $this->info("Synced {$totalSynced} Level Wilayah records.");
        return Command::SUCCESS;
    }

    protected function syncWilayah()
    {
        $chunkSize = (int) $this->option('chunk');
        $offset = 0;
        $totalSynced = 0;
        
        $this->info("Starting Wilayah sync...");

        $bar = $this->output->createProgressBar();
        $bar->start();

        do {
            try {
                $response = $this->feeder->getWilayah([], $chunkSize, $offset);

                if (isset($response['error_code']) && $response['error_code'] != 0) {
                    $this->error("API Error: " . $response['error_desc']);
                    return Command::FAILURE;
                }

                $data = $response['data'] ?? [];
                $count = count($data);

                if ($count === 0) break;

                $records = array_map(function ($item) {
                    return [
                        'id_wilayah' => trim($item['id_wilayah'] ?? ''),
                        'id_negara' => trim($item['id_negara'] ?? ''),
                        'nama_wilayah' => trim($item['nama_wilayah'] ?? ''),
                        'id_induk_wilayah' => isset($item['id_induk_wilayah']) && $item['id_induk_wilayah'] !== '' ? trim($item['id_induk_wilayah']) : null,
                        'id_level_wilayah' => isset($item['id_level_wilayah']) && $item['id_level_wilayah'] !== '' ? (int)$item['id_level_wilayah'] : null,
                    ];
                }, $data);

                Wilayah::upsert(
                    $records, 
                    ['id_wilayah'], 
                    ['nama_wilayah', 'id_induk_wilayah', 'id_level_wilayah', 'id_negara']
                );

                $totalSynced += $count;
                $offset += $chunkSize;
                $bar->advance($count);

                unset($data, $records, $response);
                gc_collect_cycles();

            } catch (\Exception $e) {
                $this->error("Exception: " . $e->getMessage());
                return Command::FAILURE;
            }

        } while ($count >= $chunkSize);

        $bar->finish();
        $this->newLine();
        $this->info("Synced {$totalSynced} Wilayah records.");
        return Command::SUCCESS;
    }

    protected function syncAgama() {
        $this->info("Starting Agama sync...");
        return $this->genericSync('getAgama', Agama::class, 'id_agama', ['nama_agama']);
    }

    protected function syncAlatTransportasi() {
        $this->info("Starting Alat Transportasi sync...");
        return $this->genericSync('getAlatTransportasi', AlatTransportasi::class, 'id_alat_transportasi', ['nama_alat_transportasi']);
    }

    protected function syncPekerjaan() {
        $this->info("Starting Pekerjaan sync...");
        return $this->genericSync('getPekerjaan', Pekerjaan::class, 'id_pekerjaan', ['nama_pekerjaan']);
    }

    protected function syncPenghasilan() {
        $this->info("Starting Penghasilan sync...");
        return $this->genericSync('getPenghasilan', Penghasilan::class, 'id_penghasilan', ['nama_penghasilan']);
    }

    protected function syncKebutuhanKhusus() {
        $this->info("Starting Kebutuhan Khusus sync...");
        return $this->genericSync('getKebutuhanKhusus', KebutuhanKhusus::class, 'id_kebutuhan_khusus', ['nama_kebutuhan_khusus']);
    }

    protected function syncJenisTinggal() {
        $this->info("Starting Jenis Tinggal sync...");
        return $this->genericSync('getJenisTinggal', JenisTinggal::class, 'id_jenis_tinggal', ['nama_jenis_tinggal']);
    }

    protected function syncStatusKepegawaian() {
        $this->info("Starting Status Kepegawaian sync...");
        return $this->genericSync('getStatusKepegawaian', StatusKepegawaian::class, 'id_status_pegawai', ['nama_status_pegawai']);
    }

    protected function syncIkatanKerjaSdm() {
        $this->info("Starting Ikatan Kerja SDM sync...");
        return $this->genericSync('getIkatanKerjaSdm', IkatanKerjaSdm::class, 'id_ikatan_kerja', ['nama_ikatan_kerja']);
    }

    protected function syncJenisKeluar() {
        $this->info("Starting Jenis Keluar sync...");
        // Note: JenisKeluar has 'apa_mahasiswa' extra column
        return $this->genericSync('getJenisKeluar', JenisKeluar::class, 'id_jenis_keluar', ['jenis_keluar', 'apa_mahasiswa']);
    }


    protected function syncJenjangPendidikan()
    {
        $this->info("Starting Jenjang Pendidikan sync...");
        return $this->genericSync('getJenjangPendidikan', JenjangPendidikan::class, 'id_jenjang_didik', ['nama_jenjang_didik']);
    }

    protected function syncBentukPendidikan()
    {
        $this->info("Starting Bentuk Pendidikan sync...");
        return $this->genericSync('getBentukPendidikan', BentukPendidikan::class, 'id_bentuk_pendidikan', ['nama_bentuk_pendidikan']);
    }

    protected function syncJalurMasuk()
    {
        $this->info("Starting Jalur Masuk sync...");
        return $this->genericSync('getJalurMasuk', JalurMasuk::class, 'id_jalur_masuk', ['nama_jalur_masuk']);
    }

    protected function syncJenisPendaftaran()
    {
        $this->info("Starting Jenis Pendaftaran sync...");
        // API response has 'untuk_daftar_sekolah'
        return $this->genericSync('getJenisPendaftaran', JenisPendaftaran::class, 'id_jenis_daftar', ['nama_jenis_daftar', 'untuk_daftar_sekolah']);
    }

    protected function syncPembiayaan()
    {
        $this->info("Starting Pembiayaan sync...");
        return $this->genericSync('getPembiayaan', Pembiayaan::class, 'id_pembiayaan', ['nama_pembiayaan']);
    }

    protected function syncJenisEvaluasi()
    {
        $this->info("Starting Jenis Evaluasi sync...");
        return $this->genericSync('getJenisEvaluasi', JenisEvaluasi::class, 'id_jenis_evaluasi', ['nama_jenis_evaluasi']);
    }

    protected function syncJenisSubstansi()
    {
        $this->info("Starting Jenis Substansi sync...");
        return $this->genericSync('getJenisSubstansi', JenisSubstansi::class, 'id_jenis_substansi', ['nama_jenis_substansi']);
    }

    protected function syncJabatanFungsional()
    {
        $this->info("Starting Jabatan Fungsional sync...");
        return $this->genericSync('getJabfung', JabatanFungsional::class, 'id_jabatan_fungsional', ['nama_jabatan_fungsional']);
    }

    protected function syncPangkatGolongan()
    {
        $this->info("Starting Pangkat Golongan sync...");
        return $this->genericSync('getPangkatGolongan', PangkatGolongan::class, 'id_pangkat_golongan', ['nama_pangkat', 'kode_golongan']);
    }

    protected function syncLembagaPengangkat()
    {
        $this->info("Starting Lembaga Pengangkat sync...");
        return $this->genericSync('getLembagaPengangkat', LembagaPengangkat::class, 'id_lembaga_angkat', ['nama_lembaga_angkat']);
    }

    protected function syncJenisSertifikasi()
    {
        $this->info("Starting Jenis Sertifikasi sync...");
        return $this->genericSync('getJenisSertifikasi', JenisSertifikasi::class, 'id_jenis_sertifikasi', ['nama_jenis_sertifikasi']);
    }

    protected function syncJenisPrestasi()
    {
        $this->info("Starting Jenis Prestasi sync...");
        return $this->genericSync('getJenisPrestasi', JenisPrestasi::class, 'id_jenis_prestasi', ['nama_jenis_prestasi']);
    }

    protected function syncTingkatPrestasi()
    {
        $this->info("Starting Tingkat Prestasi sync...");
        return $this->genericSync('getTingkatPrestasi', TingkatPrestasi::class, 'id_tingkat_prestasi', ['nama_tingkat_prestasi']);
    }

    protected function syncKategoriKegiatan()
    {
        $this->info("Starting Kategori Kegiatan sync...");
        return $this->genericSync('getKategoriKegiatan', KategoriKegiatan::class, 'id_kategori_kegiatan', ['nama_kategori_kegiatan']);
    }

    protected function syncJenisAktivitasMahasiswa()
    {
        $this->info("Starting Jenis Aktivitas Mahasiswa sync...");
        return $this->genericSync('getJenisAktivitasMahasiswa', JenisAktivitasMahasiswa::class, 'id_jenis_aktivitas_mahasiswa', ['nama_jenis_aktivitas_mahasiswa', 'untuk_kampus_merdeka']);
    }

    protected function genericSync($apiMethod, $modelClass, $primaryKey, $updateColumns)
    {
        $chunkSize = (int) $this->option('chunk');
        $offset = 0;
        $totalSynced = 0;
        
        $bar = $this->output->createProgressBar();
        $bar->start();

        do {
            try {
                $response = $this->feeder->$apiMethod([], $chunkSize, $offset);

                if (isset($response['error_code']) && $response['error_code'] != 0) {
                    $this->error("API Error: " . $response['error_desc']);
                    return Command::FAILURE;
                }

                $data = $response['data'] ?? [];
                $count = count($data);

                if ($count === 0) break;

                $records = array_map(function ($item) use ($primaryKey, $updateColumns) {
                    $record = [];
                    // Add PK (trim if string, or cast if int - simple trim is usually safe for both in array keys unless strictly typed DB)
                    $record[$primaryKey] = trim($item[$primaryKey] ?? '');
                    
                    // Add Update Cols
                    foreach ($updateColumns as $col) {
                         $record[$col] = trim($item[$col] ?? '');
                    }
                    $record['created_at'] = now();
                    $record['updated_at'] = now();
                    return $record;
                }, $data);

                $modelClass::upsert(
                    $records,
                    [$primaryKey],
                    $updateColumns
                );

                $totalSynced += $count;
                $offset += $chunkSize;
                $bar->advance($count);

            } catch (\Exception $e) {
                $this->error("Exception: " . $e->getMessage());
                return Command::FAILURE;
            }
        } while ($count >= $chunkSize);

        $bar->finish();
        $this->newLine();
        $this->info("Synced {$totalSynced} records.");
        return Command::SUCCESS;
    }
}
