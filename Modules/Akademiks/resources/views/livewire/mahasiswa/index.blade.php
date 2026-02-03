<div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Data Mahasiswa</h5>
                <div class="d-flex align-items-center gap-2">
                    <div class="input-group input-group-merge" style="min-width: 250px;">
                        <span class="input-group-text" id="basic-addon-search31"><i class="ri-search-line"></i></span>
                        <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                            placeholder="Cari Mahasiswa..." aria-label="Search..."
                            aria-describedby="basic-addon-search31" />
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasFilter">
                        <i class="ri-filter-3-line me-1"></i> Filter
                    </button>
                    <a class="btn btn-primary" href="#">
                        <i class="ri-add-line me-1"></i> Tambah 
                    </a>
                </div>
            </div>

            <div class="card-datatable table-responsive pt-0">
                <table class="datatables-basic table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>NIM</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Prodi</th>
                            <th>Angkatan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswas as $index => $mahasiswa)
                            @php
                                $rp = $mahasiswa->riwayatPendidikan->first();
                            @endphp
                            <tr>
                                <td>{{ $mahasiswas->firstItem() + $index }}</td>
                                <td>{{ $mahasiswa->nama_lengkap }}</td>
                                <td>{{ $rp?->nim ?? '-' }}</td>
                                <td>{{ $mahasiswa->jenis_kelamin }}</td>
                                <td>{{ $mahasiswa->email }}</td>
                                <td>{{ $rp?->id_prodi ?? '-' }}</td>
                                <td>{{ $rp?->id_periode_masuk ? substr($rp->id_periode_masuk, 0, 4) : '-' }}</td>
                                <td>
                                    @if ($rp?->id_status_mahasiswa == 'A')
                                        <span class="badge bg-label-success">Aktif</span>
                                    @elseif($rp?->id_status_mahasiswa == 'C')
                                        <span class="badge bg-label-warning">Cuti</span>
                                    @elseif($rp?->id_status_mahasiswa == 'N')
                                        <span class="badge bg-label-danger">Non-Aktif</span>
                                    @else
                                        <span class="badge bg-label-secondary">Unknown</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="ri-more-2-line"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-eye-line me-1"></i>
                                                Detail</a>
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-pencil-line me-1"></i>
                                                Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-delete-bin-6-line me-1"></i>
                                                Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end p-4">
                    {{ $mahasiswas->links() }}
                </div>
            </div>
        </div>
        <!-- Modal to add new record -->
        <div class="offcanvas offcanvas-end" id="add-new-record">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title" id="exampleModalLabel">New Record</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body flex-grow-1">
                <form class="add-new-record pt-0 row g-3" id="form-add-new-record" onsubmit="return false">
                    <div class="col-sm-12">
                        <div class="input-group input-group-merge">
                            <span id="basicFullname2" class="input-group-text"><i
                                    class="ri-user-line ri-18px"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="basicFullname" class="form-control dt-full-name"
                                    name="basicFullname" placeholder="John Doe" aria-label="John Doe"
                                    aria-describedby="basicFullname2" />
                                <label for="basicFullname">Full Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="input-group input-group-merge">
                            <span id="basicPost2" class="input-group-text"><i
                                    class="ri-briefcase-line ri-18px"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="basicPost" name="basicPost" class="form-control dt-post"
                                    placeholder="Web Developer" aria-label="Web Developer"
                                    aria-describedby="basicPost2" />
                                <label for="basicPost">Post</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="ri-mail-line ri-18px"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="basicEmail" name="basicEmail" class="form-control dt-email"
                                    placeholder="john.doe@example.com" aria-label="john.doe@example.com" />
                                <label for="basicEmail">Email</label>
                            </div>
                        </div>
                        <div class="form-text">You can use letters, numbers & periods</div>
                    </div>
                    <div class="col-sm-12">
                        <div class="input-group input-group-merge">
                            <span id="basicDate2" class="input-group-text"><i
                                    class="ri-calendar-2-line ri-18px"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control dt-date" id="basicDate" name="basicDate"
                                    aria-describedby="basicDate2" placeholder="MM/DD/YYYY" aria-label="MM/DD/YYYY" />
                                <label for="basicDate">Joining Date</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="input-group input-group-merge">
                            <span id="basicSalary2" class="input-group-text"><i
                                    class="ri-money-dollar-circle-line ri-18px"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="number" id="basicSalary" name="basicSalary" class="form-control dt-salary"
                                    placeholder="12000" aria-label="12000" aria-describedby="basicSalary2" />
                                <label for="basicSalary">Salary</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary data-submit me-sm-4 me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary"
                            data-bs-dismiss="offcanvas">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <!--/ DataTable with Buttons -->
    </div>

    <!-- Filter Offcanvas -->
    <div class="offcanvas offcanvas-end" id="offcanvasFilter" tabindex="-1" aria-labelledby="offcanvasFilterLabel"
        wire:ignore.self>
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="offcanvasFilterLabel">Filter Data</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <div class="row g-4">
                <div class="col-12">
                    <label class="form-label">Tampilkan</label>
                    <select wire:model.live="perPage" class="form-select">
                        <option value="10">10 Baris</option>
                        <option value="25">25 Baris</option>
                        <option value="50">50 Baris</option>
                        <option value="100">100 Baris</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Program Studi</label>
                    <select wire:model.live="filterProdi" class="form-select">
                        <option value="">Semua Prodi</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Manajemen Informatika">Manajemen Informatika</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Status Mahasiswa</label>
                    <select wire:model.live="filterStatus" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="A">Aktif</option>
                        <option value="C">Cuti</option>
                        <option value="N">Non-Aktif</option>
                    </select>
                </div>
                <div class="col-12">
                    <button type="button" class="btn btn-primary w-100" data-bs-dismiss="offcanvas">Terapkan
                        Filter</button>
                    <button type="button" class="btn btn-outline-secondary w-100 mt-2"
                        data-bs-dismiss="offcanvas">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@push('scripts')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script>
        $(function () {
            var dt_basic_table = $('.datatables-basic');

            if (dt_basic_table.length) {
                var dt_basic = dt_basic_table.DataTable({
                    dom: 't',
                    paging: false,
                    searching: false,
                    info: false,
                    lengthChange: false,
                    responsive: true
                });
            }
        });
    </script>
@endpush