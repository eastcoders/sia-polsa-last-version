<?php

namespace Modules\Akademiks\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Akademiks\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function getCountMahasiswa()
    {
        $count = Mahasiswa::count();

        return response()->json([
            'status' => 'success',
            'message' => 'Jumlah mahasiswa berhasil diambil',
            'data' => $count,
        ]);
    }

    public function getMahasiswa(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $mahasiswa = Mahasiswa::paginate($perPage);

        if ($mahasiswa->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data mahasiswa tidak ditemukan',
                'data' => [],
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data mahasiswa berhasil diambil',
            'data' => $mahasiswa,
        ]);
    }

    public function showMahasiswa($id)
    {
        $mahasiswa = Mahasiswa::with(['alamat', 'orangTua', 'wali', 'riwayatPendidikan'])->find($id);

        if (! $mahasiswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data mahasiswa tidak ditemukan',
                'data' => [],
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data mahasiswa berhasil diambil',
            'data' => $mahasiswa,
        ]);
    }

    public function insertMahasiswa(Request $request)
    {
        $request->validate([

            // Biodata
            'nama_lengkap' => 'required',
            'tanggal_lahir' => 'required',
            'tempat_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'id_agama' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
            'nik' => 'required',
            'nisn' => 'required',
            'npwp' => 'nullable',

            // Alamat
            'kewarganegaraan' => 'required',
            'id_wilayah' => 'required',
            'kelurahan' => 'required',
            'dusun' => 'nullable',
            'rt_rw' => 'nullable',
            'kode_pos' => 'nullable',
            'jalan' => 'nullable',
            'id_jenis_tinggal' => 'nullable',
            'id_alat_transportasi' => 'nullable',
            'penerima_kps' => 'required',
            'no_kps' => 'nullable',

            // Orang Tua
            'nama_ayah' => 'nullable',
            'nama_ibu_kandung' => 'required',
            'nik_ayah' => 'nullable',
            'nik_ibu' => 'nullable',
            'tanggal_lahir_ayah' => 'nullable',
            'tanggal_lahir_ibu' => 'nullable',
            'id_pekerjaan_ayah' => 'nullable',
            'id_pekerjaan_ibu' => 'nullable',
            'id_pendidikan_ayah' => 'nullable',
            'id_pendidikan_ibu' => 'nullable',
            'id_penghasilan_ayah' => 'nullable',
            'id_penghasilan_ibu' => 'nullable',
            'no_telp_ayah' => 'nullable',
            'no_telp_ibu' => 'nullable',

            // Wali
            'nama_wali' => 'nullable',
            'nik_wali' => 'nullable',
            'tanggal_lahir_wali' => 'nullable',
            'id_pekerjaan_wali' => 'nullable',
            'id_pendidikan_wali' => 'nullable',
            'id_penghasilan_wali' => 'nullable',

        ]);

        try {
            DB::beginTransaction();

            // 1. Create Mahasiswa (Biodata)
            $mahasiswa = Mahasiswa::create($request->only([
                'nama_lengkap',
                'tanggal_lahir',
                'tempat_lahir',
                'jenis_kelamin',
                'id_agama',
                'email',
                'no_telp',
                'nik',
                'nisn',
                'npwp',
            ]));

            // 2. Create Alamat
            $mahasiswa->alamat()->create($request->only([
                'kewarganegaraan',
                'id_wilayah',
                'kelurahan',
                'dusun',
                'rt_rw',
                'kode_pos',
                'jalan',
                'id_jenis_tinggal',
                'id_alat_transportasi',
                'penerima_kps',
                'no_kps',
            ]));

            // 3. Create Orang Tua
            $mahasiswa->orangTua()->create($request->only([
                'nama_ayah',
                'nama_ibu_kandung',
                'nik_ayah',
                'nik_ibu',
                'tanggal_lahir_ayah',
                'tanggal_lahir_ibu',
                'id_pekerjaan_ayah',
                'id_pekerjaan_ibu',
                'id_pendidikan_ayah',
                'id_pendidikan_ibu',
                'id_penghasilan_ayah',
                'id_penghasilan_ibu',
                'no_telp_ayah',
                'no_telp_ibu',
            ]));

            // 4. Create Wali (Map fields manually due to name differences)
            $mahasiswa->wali()->create([
                'nama_wali' => $request->nama_wali,
                'nik' => $request->nik_wali,
                'tanggal_lahir' => $request->tanggal_lahir_wali,
                'id_pendidikan' => $request->id_pendidikan_wali,
                'id_pekerjaan' => $request->id_pekerjaan_wali,
                'id_penghasilan' => $request->id_penghasilan_wali,
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Data mahasiswa berhasil ditambahkan beserta data terkait (Alamat, Orang Tua, Wali).',
                'data' => $mahasiswa->load(['alamat', 'orangTua', 'wali']),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data: '.$e->getMessage(),
            ], 500);
        }
    }

    public function updateMahasiswa(string $id, Request $request)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (! $mahasiswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data mahasiswa tidak ditemukan',
                'data' => [],
            ], 404);
        }

        try {
            DB::beginTransaction();

            // 1. Update Mahasiswa (Biodata)
            $mahasiswa->update($request->only([
                'nama_lengkap',
                'tanggal_lahir',
                'tempat_lahir',
                'jenis_kelamin',
                'id_agama',
                'email',
                'no_telp',
                'nik',
                'nisn',
                'npwp',
            ]));

            // 2. Update Alamat
            $mahasiswa->alamat()->updateOrCreate([], $request->only([
                'kewarganegaraan',
                'id_wilayah',
                'kelurahan',
                'dusun',
                'rt_rw',
                'kode_pos',
                'jalan',
                'id_jenis_tinggal',
                'id_alat_transportasi',
                'penerima_kps',
                'no_kps',
            ]));

            // 3. Update Orang Tua
            $mahasiswa->orangTua()->updateOrCreate([], $request->only([
                'nama_ayah',
                'nama_ibu_kandung',
                'nik_ayah',
                'nik_ibu',
                'tanggal_lahir_ayah',
                'tanggal_lahir_ibu',
                'id_pekerjaan_ayah',
                'id_pekerjaan_ibu',
                'id_pendidikan_ayah',
                'id_pendidikan_ibu',
                'id_penghasilan_ayah',
                'id_penghasilan_ibu',
                'no_telp_ayah',
                'no_telp_ibu',
            ]));

            // 4. Update Wali
            $mahasiswa->wali()->updateOrCreate([], [
                'nama_wali' => $request->nama_wali,
                'nik' => $request->nik_wali,
                'tanggal_lahir' => $request->tanggal_lahir_wali,
                'id_pendidikan' => $request->id_pendidikan_wali,
                'id_pekerjaan' => $request->id_pekerjaan_wali,
                'id_penghasilan' => $request->id_penghasilan_wali,
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Data mahasiswa berhasil diperbarui beserta data terkait.',
                'data' => $mahasiswa->load(['alamat', 'orangTua', 'wali']),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui data: '.$e->getMessage(),
            ], 500);
        }
    }

    public function deleteMahasiswa(string $id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (! $mahasiswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data mahasiswa tidak ditemukan',
                'data' => [],
            ], 404);
        }

        try {
            DB::beginTransaction();

            $mahasiswa->alamat()->delete();
            $mahasiswa->orangTua()->delete();
            $mahasiswa->wali()->delete();
            $mahasiswa->riwayatPendidikan()->delete();
            $mahasiswa->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Data mahasiswa berhasil dhapus beserta data terkait.',
                'data' => [],
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus data: '.$e->getMessage(),
            ], 500);
        }
    }
}
