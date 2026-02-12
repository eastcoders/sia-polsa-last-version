<?php

namespace App\Services\Feeder;

use App\Services\FeederApiService;

class ReferencesServices
{
    protected FeederApiService $api;

    public function __construct(FeederApiService $api)
    {
        $this->api = $api;
    }

    // Wilayah & Lokasi
    public function getWilayah(array $filter = [], int $limit = 0, int $offset = 0)
    {
        $payload = [
            'act' => 'GetWilayah',
            'limit' => $limit,
            'offset' => $offset,
        ];

        if (! empty($filter)) {
            $payload['filter'] = $filter;
        }

        return $this->api->request($payload);
    }

    public function getNegara(array $filter = [], int $limit = 0, int $offset = 0)
    {
        $payload = [
            'act' => 'GetNegara',
            'limit' => $limit,
            'offset' => $offset,
        ];

        if (! empty($filter)) {
            $payload['filter'] = $filter;
        }

        return $this->api->request($payload);
    }

    public function getLevelWilayah(array $filter = [], int $limit = 0, int $offset = 0)
    {
        $payload = [
            'act' => 'GetLevelWilayah',
            'limit' => $limit,
            'offset' => $offset,
        ];

        if (! empty($filter)) {
            $payload['filter'] = $filter;
        }

        return $this->api->request($payload);
    }
    // Institusi & Akademik
    public function getAllPT(array $filter = [], int $limit = 0, int $offset = 0)
    {
        $payload = [
            'act' => 'GetAllPT',
            'limit' => $limit,
            'offset' => $offset,
        ];

        if (! empty($filter)) {
            $payload['filter'] = $filter;
        }

        return $this->api->request($payload);
    }

    public function getAllProdi(array $filter = [], int $limit = 0, int $offset = 0)
    {
        $payload = [
            'act' => 'GetAllProdi',
            'limit' => $limit,
            'offset' => $offset,
        ];

        if (! empty($filter)) {
            $payload['filter'] = $filter;
        }

        return $this->api->request($payload);
    }

    public function getFakultas(array $filter = [], int $limit = 0, int $offset = 0)
    {
        $payload = [
            'act' => 'GetFakultas',
            'limit' => $limit,
            'offset' => $offset,
        ];

        if (! empty($filter)) {
            $payload['filter'] = $filter;
        }

        return $this->api->request($payload);
    }

    public function getTahunAjaran(array $filter = [], int $limit = 0, int $offset = 0)
    {
        $payload = [
            'act' => 'GetTahunAjaran',
            'limit' => $limit,
            'offset' => $offset,
        ];

        if (! empty($filter)) {
            $payload['filter'] = $filter;
        }

        return $this->api->request($payload);
    }

    public function getSemester(array $filter = [], int $limit = 0, int $offset = 0)
    {
        $payload = [
            'act' => 'GetSemester',
            'limit' => $limit,
            'offset' => $offset,
        ];

        if (! empty($filter)) {
            $payload['filter'] = $filter;
        }

        return $this->api->request($payload);
    }

    public function getKurikulum(array $filter = [], int $limit = 0, int $offset = 0)
    {
        $payload = [
            'act' => 'GetListKurikulum', // Note: Using GetListKurikulum as per dictionary
            'limit' => $limit,
            'offset' => $offset,
        ];

        if (! empty($filter)) {
            $payload['filter'] = $filter;
        }

        return $this->api->request($payload);
    }

    // Biodata Personal & Demografi
    public function getAgama(array $filter = [], int $limit = 0, int $offset = 0)
    {
        return $this->api->request(['act' => 'GetAgama', 'filter' => $filter, 'limit' => $limit, 'offset' => $offset]);
    }

    public function getAlatTransportasi(array $filter = [], int $limit = 0, int $offset = 0)
    {
        return $this->api->request(['act' => 'GetAlatTransportasi', 'filter' => $filter, 'limit' => $limit, 'offset' => $offset]);
    }

    public function getPekerjaan(array $filter = [], int $limit = 0, int $offset = 0)
    {
        return $this->api->request(['act' => 'GetPekerjaan', 'filter' => $filter, 'limit' => $limit, 'offset' => $offset]);
    }

    public function getPenghasilan(array $filter = [], int $limit = 0, int $offset = 0)
    {
        return $this->api->request(['act' => 'GetPenghasilan', 'filter' => $filter, 'limit' => $limit, 'offset' => $offset]);
    }

    public function getKebutuhanKhusus(array $filter = [], int $limit = 0, int $offset = 0)
    {
        return $this->api->request(['act' => 'GetKebutuhanKhusus', 'filter' => $filter, 'limit' => $limit, 'offset' => $offset]);
    }

    public function getJenisTinggal(array $filter = [], int $limit = 0, int $offset = 0)
    {
        return $this->api->request(['act' => 'GetJenisTinggal', 'filter' => $filter, 'limit' => $limit, 'offset' => $offset]);
    }

    public function getStatusKepegawaian(array $filter = [], int $limit = 0, int $offset = 0)
    {
        return $this->api->request(['act' => 'GetStatusKepegawaian', 'filter' => $filter, 'limit' => $limit, 'offset' => $offset]);
    }

    public function getIkatanKerjaSdm(array $filter = [], int $limit = 0, int $offset = 0)
    {
        return $this->api->request(['act' => 'GetIkatanKerjaSdm', 'filter' => $filter, 'limit' => $limit, 'offset' => $offset]);
    }

    public function getJenisKeluar(array $filter = [], int $limit = 0, int $offset = 0)
    {
        return $this->api->request(['act' => 'GetJenisKeluar', 'filter' => $filter, 'limit' => $limit, 'offset' => $offset]);
    }

    public function getJenjangPendidikan(array $filter = [], int $limit = 0, int $offset = 0)
    {
        $payload = [
            'act' => 'GetJenjangPendidikan',
            'filter' => !empty($filter) ? http_build_query($filter) : '',
            'limit' => $limit,
            'offset' => $offset
        ];

        return $this->api->request($payload);
    }

    public function getBentukPendidikan(array $filter = [], int $limit = 0, int $offset = 0)
    {
        $payload = [
            'act' => 'GetBentukPendidikan',
            'filter' => !empty($filter) ? http_build_query($filter) : '',
            'limit' => $limit,
            'offset' => $offset
        ];

        return $this->api->request($payload);
    }

    public function getJalurMasuk(array $filter = [], int $limit = 0, int $offset = 0)
    {
        $payload = [
            'act' => 'GetJalurMasuk',
            'filter' => !empty($filter) ? http_build_query($filter) : '',
            'limit' => $limit,
            'offset' => $offset
        ];

        return $this->api->request($payload);
    }

    public function getJenisPendaftaran(array $filter = [], int $limit = 0, int $offset = 0)
    {
        $payload = [
            'act' => 'GetJenisPendaftaran',
            'filter' => !empty($filter) ? http_build_query($filter) : '',
            'limit' => $limit,
            'offset' => $offset
        ];

        return $this->api->request($payload);
    }

    public function getPembiayaan(array $filter = [], int $limit = 0, int $offset = 0)
    {
        $payload = [
            'act' => 'GetPembiayaan',
            'filter' => !empty($filter) ? http_build_query($filter) : '',
            'limit' => $limit,
            'offset' => $offset
        ];

        return $this->api->request($payload);
    }

    public function getJenisEvaluasi(array $filter = [], int $limit = 0, int $offset = 0)
    {
        $payload = [
            'act' => 'GetJenisEvaluasi',
            'filter' => !empty($filter) ? http_build_query($filter) : '',
            'limit' => $limit,
            'offset' => $offset
        ];

        return $this->api->request($payload);
    }

    public function getJenisSubstansi(array $filter = [], int $limit = 0, int $offset = 0)
    {
        $payload = [
            'act' => 'GetJenisSubstansi',
            'filter' => !empty($filter) ? http_build_query($filter) : '',
            'limit' => $limit,
            'offset' => $offset
        ];

        return $this->api->request($payload);
    }
    // Kepegawaian & Lainnya
    public function getJabfung(array $filter = [], int $limit = 0, int $offset = 0)
    {
        $payload = [
            'act' => 'GetJabatanFungsional',
            'filter' => !empty($filter) ? http_build_query($filter) : '',
            'limit' => $limit,
            'offset' => $offset
        ];

        return $this->api->request($payload);
    }

    public function getPangkatGolongan(array $filter = [], int $limit = 0, int $offset = 0)
    {
        $payload = [
            'act' => 'GetPangkatGolongan',
            'filter' => !empty($filter) ? http_build_query($filter) : '',
            'limit' => $limit,
            'offset' => $offset
        ];

        return $this->api->request($payload);
    }

    public function getLembagaPengangkat(array $filter = [], int $limit = 0, int $offset = 0)
    {
        $payload = [
            'act' => 'GetLembagaPengangkat',
            'filter' => !empty($filter) ? http_build_query($filter) : '',
            'limit' => $limit,
            'offset' => $offset
        ];

        return $this->api->request($payload);
    }

    public function getJenisSertifikasi(array $filter = [], int $limit = 0, int $offset = 0)
    {
        $payload = [
            'act' => 'GetJenisSertifikasi',
            'filter' => !empty($filter) ? http_build_query($filter) : '',
            'limit' => $limit,
            'offset' => $offset
        ];

        return $this->api->request($payload);
    }

    public function getJenisPrestasi(array $filter = [], int $limit = 0, int $offset = 0)
    {
        $payload = [
            'act' => 'GetJenisPrestasi',
            'filter' => !empty($filter) ? http_build_query($filter) : '',
            'limit' => $limit,
            'offset' => $offset
        ];

        return $this->api->request($payload);
    }

    public function getTingkatPrestasi(array $filter = [], int $limit = 0, int $offset = 0)
    {
        $payload = [
            'act' => 'GetTingkatPrestasi',
            'filter' => !empty($filter) ? http_build_query($filter) : '',
            'limit' => $limit,
            'offset' => $offset
        ];

        return $this->api->request($payload);
    }

    public function getKategoriKegiatan(array $filter = [], int $limit = 0, int $offset = 0)
    {
        $payload = [
            'act' => 'GetKategoriKegiatan',
            'filter' => !empty($filter) ? http_build_query($filter) : '',
            'limit' => $limit,
            'offset' => $offset
        ];

        return $this->api->request($payload);
    }

    public function getJenisAktivitasMahasiswa(array $filter = [], int $limit = 0, int $offset = 0)
    {
        $payload = [
            'act' => 'GetJenisAktivitasMahasiswa',
            'filter' => !empty($filter) ? http_build_query($filter) : '',
            'limit' => $limit,
            'offset' => $offset
        ];

        return $this->api->request($payload);
    }
}
