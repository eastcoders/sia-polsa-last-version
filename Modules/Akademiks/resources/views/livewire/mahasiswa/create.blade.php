@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endpush

<div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-4">
            <h5 class="card-header">
                Bioddata Mahasiswa
            </h5>
            <div class="card-body">
                <form action="">
                    <div class="row">
                        <div class="col-md-6">
                            <x-input-floating id="nama_lengkap" label="Nama Lengkap" type="text" required />

                            <x-select-floating id="jenis_kelamin" label="Jenis Kelamin" required>
                                <option selected>--- Pilih Salah Satu ---</option>
                                <option value="L">Laki Laki</option>
                                <option value="P">Perempuan</option>
                            </x-select-floating>

                            <x-input-floating id="tanggal_lahir" label="Tanggal Lahir" type="date" required />
                        </div>
                        <div class="col-md-6">
                            <x-input-floating id="tempat_lahir" label="Tempat Lahir" type="text" required />

                            <x-input-floating id="nama_ibu_kandung" label="Nama Ibu Kandung" type="text" required />

                            <x-select-floating id="id_agama" label="Agama" required>
                                <option selected>--- Pilih Salah Satu ---</option>
                                @foreach ($agama as $item)
                                    <option value="{{ $item->id_agama }}">{{ $item->nama_agama }}</option>
                                @endforeach
                            </x-select-floating>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <h5 class="card-header">Informasi Detail Mahasiswa</h5>
            <div class="card-body">
                <div class="card">
                    <div class="card-header p-0">
                        <div class="nav-align-top">
                            <ul class="nav nav-tabs nav-fill" role="tablist">
                                <li class="nav-item">
                                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#tabs-alamat" aria-controls="tabs-alamat" aria-selected="true">
                                        <span class="d-none d-sm-block"><i class="tf-icons ri-home-smile-line me-2"></i>
                                            Alamat</span><i class="ri-home-smile-line ri-20px d-sm-none"></i>
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#tabs-orang-tua" aria-controls="tabs-orang-tua"
                                        aria-selected="false">
                                        <span class="d-none d-sm-block"><i class="tf-icons ri-user-3-line me-2"></i>
                                            Orang Tua</span><i class="ri-user-3-line ri-20px d-sm-none"></i>
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#tabs-wali" aria-controls="tabs-wali" aria-selected="false">
                                        <span class="d-none d-sm-block"><i class="tf-icons ri-message-2-line me-2"></i>
                                            Wali</span><i class="ri-message-2-line ri-20px d-sm-none"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body pt-5">
                        <div class="tab-content p-0">
                            <div class="tab-pane fade active show" id="tabs-alamat" role="tabpanel">
                                <div class="row pt-6">
                                    <div class="col-md-6">
                                        <x-select-floating id="kewarganegaraan" label="Kewarganegaraan" required>
                                            <option selected>--- Pilih Salah Satu ---</option>
                                            @foreach ($negara as $item)
                                                <option value="{{ $item->id_negara }}">{{ $item->nama_negara }}</option>
                                            @endforeach
                                        </x-select-floating>

                                        <x-input-floating id="nisn" label="NISN" type="text" required />
                                        <x-input-floating id="jalan" label="Jalan" type="text" />

                                        <div class="row">
                                            <div class="col-md-6">
                                                <x-input-floating id="dusun" label="Dusun" type="text" />
                                            </div>
                                            <div class="col-md-3">
                                                <x-input-floating id="rt" label="RT" type="text" />
                                            </div>
                                            <div class="col-md-3">
                                                <x-input-floating id="rw" label="RW" type="text" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-8">
                                                <x-input-floating id="kelurahan" label="Kelurahan" type="text"
                                                    required />
                                            </div>
                                            <div class="col-md-4">
                                                <x-input-floating id="kode_pos" label="Kode Pos" type="text" />
                                            </div>
                                        </div>

                                        <x-select-floating id="penerima_kps" label="Penerima KPS" required
                                            wire:model.live="penerima_kps">
                                            <option selected value="">--- Pilih Salah Satu ---</option>
                                            <option value="1">Iya</option>
                                            <option value="0">Tidak</option>
                                        </x-select-floating>

                                        <div class="mb-4">
                                            <div wire:ignore>
                                                <x-select-floating id="id_provinsi" label="Provinsi"
                                                    class="select2-wilayah">
                                                    <option value="">-- Pilih Provinsi --</option>
                                                    @foreach ($provinsi as $item)
                                                        <option value="{{ $item->id_wilayah }}">
                                                            {{ $item->nama_wilayah }}
                                                        </option>
                                                    @endforeach
                                                </x-select-floating>
                                            </div>

                                            <div wire:ignore>
                                                <x-select-floating id="id_kabupaten" label="Kabupaten"
                                                    class="select2-wilayah">
                                                    <option value="">-- Pilih Kabupaten --</option>
                                                </x-select-floating>
                                            </div>

                                            <div wire:ignore>
                                                <x-select-floating id="id_kecamatan" label="Kecamatan"
                                                    containerClass="mb-0" class="select2-wilayah">
                                                    <option value="">-- Pilih Kecamatan --</option>
                                                </x-select-floating>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <x-input-floating id="nik" label="NIK" type="text" required />
                                        <x-input-floating id="npwp" label="NPWP" type="text" />
                                        <x-input-floating id="telephone" label="Telephone" type="text" />
                                        <x-input-floating id="no_hp" label="No. HP" type="text" required />
                                        <x-input-floating id="email" label="Email" type="text" required />
                                        <x-input-floating id="no_kps" label="No. KPS" type="text" wire:model="no_kps"
                                            :disabled="$penerima_kps != 1" :required="$penerima_kps != 0" />
                                        <x-select-floating id="id_alat_transportasi" label="Alat Transportasi">
                                            <option selected>--- Pilih Salah Satu ---</option>
                                            @foreach ($alat_transportasi as $item)
                                                <option value="{{ $item->id_alat_transportasi }}">
                                                    {{ $item->nama_alat_transportasi }}
                                                </option>
                                            @endforeach
                                        </x-select-floating>
                                        <x-select-floating id="id_jenis_tinggal" label="Jenis Tinggal">
                                            <option selected>--- Pilih Salah Satu ---</option>
                                            @foreach ($jenis_tinggal as $item)
                                                <option value="{{ $item->id_jenis_tinggal }}">
                                                    {{ $item->nama_jenis_tinggal }}
                                                </option>
                                            @endforeach
                                        </x-select-floating>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-orang-tua" role="tabpanel">
                                <div class="row pt-6">
                                    <div class="col-md-6">
                                        <h5 class="card-title text-center">Ayah</h5>
                                        <x-input-floating id="nik_ayah" label="NIK" type="text" />
                                        <x-input-floating id="nama_ayah" label="Nama" type="text" />
                                        <x-input-floating id="tanggal_lahir_ayah" label="Tanggal Lahir" type="date" />

                                        <x-select-floating id="id_pendidikan_ayah" label="Pendidikan">
                                            <option selected>--- Pilih Salah Satu ---</option>
                                            @foreach ($pendidikan as $item)
                                                <option value="{{ $item->id_jenjang_didik }}">
                                                    {{ $item->nama_jenjang_didik }}
                                                </option>
                                            @endforeach
                                        </x-select-floating>

                                        <x-select-floating id="id_pekerjaan_ayah" label="Pekerjaan">
                                            <option selected>--- Pilih Salah Satu ---</option>
                                            @foreach ($pekerjaan as $item)
                                                <option value="{{ $item->id_pekerjaan }}">
                                                    {{ $item->nama_pekerjaan }}
                                                </option>
                                            @endforeach
                                        </x-select-floating>

                                        <x-select-floating id="id_penghasilan_ayah" label="Penghasilan">
                                            <option selected>--- Pilih Salah Satu ---</option>
                                            @foreach ($penghasilan as $item)
                                                <option value="{{ $item->id_penghasilan }}">
                                                    {{ $item->nama_penghasilan }}
                                                </option>
                                            @endforeach
                                        </x-select-floating>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title text-center">Ibu</h5>

                                        <x-input-floating id="nik_ibu" label="NIK" type="text" />
                                        <x-input-floating id="nama_ibu_kandung" label="Nama" type="text" required
                                            disabled />
                                        <x-input-floating id="tanggal_lahir_ibu" label="Tanggal Lahir" type="date" />

                                        <x-select-floating id="id_pendidikan_ibu" label="Pendidikan">
                                            <option selected>--- Pilih Salah Satu ---</option>
                                            @foreach ($pendidikan as $item)
                                                <option value="{{ $item->id_jenjang_didik }}">
                                                    {{ $item->nama_jenjang_didik }}
                                                </option>
                                            @endforeach
                                        </x-select-floating>

                                        <x-select-floating id="id_pekerjaan_ibu" label="Pekerjaan">
                                            <option selected>--- Pilih Salah Satu ---</option>
                                            @foreach ($pekerjaan as $item)
                                                <option value="{{ $item->id_pekerjaan }}">
                                                    {{ $item->nama_pekerjaan }}
                                                </option>
                                            @endforeach
                                        </x-select-floating>

                                        <x-select-floating id="id_penghasilan_ibu" label="Penghasilan">
                                            <option selected>--- Pilih Salah Satu ---</option>
                                            @foreach ($penghasilan as $item)
                                                <option value="{{ $item->id_penghasilan }}">
                                                    {{ $item->nama_penghasilan }}
                                                </option>
                                            @endforeach
                                        </x-select-floating>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-wali" role="tabpanel">
                                <div class="row">
                                    <h5 class="card-title text-center">Wali</h5>
                                    <div class="col-md-6">

                                        <x-input-floating id="nama_wali" label="Nama" type="text" />
                                        <x-input-floating id="tanggal_lahir_wali" label="Tanggal Lahir" type="date" />

                                        <x-select-floating id="id_pendidikan_wali" label="Pendidikan">
                                            <option selected>-- Pilih Salah Satu ---</option>
                                            @foreach ($pendidikan as $item)
                                                <option value="{{ $item->id_jenjang_didik }}">
                                                    {{ $item->nama_jenjang_didik }}
                                                </option>
                                            @endforeach
                                        </x-select-floating>


                                    </div>
                                    <div class="col-md-6">
                                        <x-select-floating id="id_pekerjaan_wali" label="Pekerjaan">
                                            <option selected>-- Pilih Salah Satu --</option>
                                            @foreach ($pekerjaan as $item)
                                                <option value="{{ $item->id_pekerjaan }}">
                                                    {{ $item->nama_pekerjaan }}
                                                </option>
                                            @endforeach
                                        </x-select-floating>

                                        <x-select-floating id="id_penghasilan_wali" label="Penghasilan">
                                            <option selected>-- Pilih Salah Satu --</option>
                                            @foreach ($penghasilan as $item)
                                                <option value="{{ $item->id_penghasilan }}">
                                                    {{ $item->nama_penghasilan }}
                                                </option>
                                            @endforeach
                                        </x-select-floating>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script>
        document.addEventListener('livewire:navigated', function () {

            function initWilayahSelect2() {
                console.log('[Wilayah] Init start');

                // Destroy existing instances
                $('.select2-wilayah').each(function () {
                    if ($(this).hasClass('select2-hidden-accessible')) {
                        $(this).select2('destroy');
                    }
                });

                // Add floating label class
                $('.select2-wilayah').each(function () {
                    $(this).closest('.form-floating').addClass('form-floating-select2');
                });

                // Simple init — NO wrapping, NO dropdownParent
                $('#id_provinsi').select2({ placeholder: '-- Pilih Provinsi --', allowClear: true });
                $('#id_kabupaten').select2({ placeholder: '-- Pilih Kabupaten --', allowClear: true });
                $('#id_kecamatan').select2({ placeholder: '-- Pilih Kecamatan --', allowClear: true });

                console.log('[Wilayah] Init done');

                // === Use select2:select (fires AFTER Select2 renders the text) ===

                $('#id_provinsi').off('select2:select').on('select2:select', function (e) {
                    console.log('[Wilayah] Provinsi selected:', e.params.data.id, e.params.data.text);
                    @this.set('selectedProvinsi', e.params.data.id);

                    // Reset dependents
                    $('#id_kabupaten').val(null).trigger('change.select2');
                    $('#id_kecamatan').val(null).trigger('change.select2');
                });

                $('#id_kabupaten').off('select2:select').on('select2:select', function (e) {
                    console.log('[Wilayah] Kabupaten selected:', e.params.data.id, e.params.data.text);
                    @this.set('selectedKabupaten', e.params.data.id);

                    // Reset dependent
                    $('#id_kecamatan').val(null).trigger('change.select2');
                });

                $('#id_kecamatan').off('select2:select').on('select2:select', function (e) {
                    console.log('[Wilayah] Kecamatan selected:', e.params.data.id, e.params.data.text);
                    @this.set('selectedKecamatan', e.params.data.id);
                });

                // Handle clear events
                $('#id_provinsi').off('select2:clear').on('select2:clear', function () {
                    @this.set('selectedProvinsi', null);
                    $('#id_kabupaten').val(null).trigger('change.select2');
                    $('#id_kecamatan').val(null).trigger('change.select2');
                });

                $('#id_kabupaten').off('select2:clear').on('select2:clear', function () {
                    @this.set('selectedKabupaten', null);
                    $('#id_kecamatan').val(null).trigger('change.select2');
                });

                $('#id_kecamatan').off('select2:clear').on('select2:clear', function () {
                    @this.set('selectedKecamatan', null);
                });
            }

            // Initialize immediately
            initWilayahSelect2();

            // Re-apply values after Livewire DOM morphing
            Livewire.hook('morph.updated', ({ el, component }) => {
                setTimeout(function () {
                    ['#id_provinsi', '#id_kabupaten', '#id_kecamatan'].forEach(function (sel) {
                        var $el = $(sel);
                        if ($el.hasClass('select2-hidden-accessible') && $el.val()) {
                            $el.trigger('change.select2');
                        }
                    });
                }, 100);
            });

            // Kabupaten loaded from Livewire
            Livewire.on('kabupaten-loaded', (data) => {
                console.log('[Wilayah] Kabupaten loaded:', data[0].length, 'items');
                var $kab = $('#id_kabupaten');
                $kab.empty().append('<option value="">-- Pilih Kabupaten --</option>');
                data[0].forEach(function (item) {
                    $kab.append(new Option(item.nama_wilayah, item.id_wilayah, false, false));
                });
                $kab.trigger('change.select2');
            });

            // Kecamatan loaded from Livewire
            Livewire.on('kecamatan-loaded', (data) => {
                console.log('[Wilayah] Kecamatan loaded:', data[0].length, 'items');
                var $kec = $('#id_kecamatan');
                $kec.empty().append('<option value="">-- Pilih Kecamatan --</option>');
                data[0].forEach(function (item) {
                    $kec.append(new Option(item.nama_wilayah, item.id_wilayah, false, false));
                });
                $kec.trigger('change.select2');
            });
        });
    </script>
@endpush