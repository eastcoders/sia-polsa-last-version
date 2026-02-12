<?php

namespace App\Services\Feeder;

use App\Services\FeederApiService;

class MahasiswaService
{
    protected FeederApiService $api;

    public function __construct(FeederApiService $api)
    {
        $this->api = $api;
    }

    /**
     * Get Biodata Mahasiswa
     *
     * @param  array  $filter  Key-value pair for filtering (e.g., ['nim' => '123'])
     * @return array
     */
    public function getBiodata(array $filter = [], int $limit = 0, int $offset = 0)
    {
        $payload = [
            'act' => 'GetBiodataMahasiswa',
            'limit' => $limit,
            'offset' => $offset,
        ];

        if (! empty($filter)) {
            $payload['filter'] = $filter;
        }

        return $this->api->request($payload);
    }

    /**
     * Insert Biodata Mahasiswa
     *
     * @return array
     */
    public function insertBiodata(array $data)
    {
        return $this->api->request(array_merge(
            ['act' => 'InsertBiodataMahasiswa'],
            $data
        ));
    }

    /**
     * Update Biodata Mahasiswa
     *
     * @param  array  $key  The primary key/identifier to update (e.g., ['id_mahasiswa' => '...'])
     * @param  array  $data  The data to update
     * @return array
     */
    public function updateBiodata(array $key, array $data)
    {
        // Often 'key' is keys, 'data' is record.
        // We merge them into the top level payload along with 'act'
        return $this->api->request(array_merge(
            ['act' => 'UpdateBiodataMahasiswa', 'key' => $key, 'record' => $data]
        ));
    }

    /**
     * Delete Biodata Mahasiswa
     *
     * @param  array  $key  The identifier to delete
     * @return array
     */
    public function deleteBiodata(array $key)
    {
        return $this->api->request(array_merge(
            ['act' => 'DeleteBiodataMahasiswa', 'key' => $key]
        ));
    }
}
