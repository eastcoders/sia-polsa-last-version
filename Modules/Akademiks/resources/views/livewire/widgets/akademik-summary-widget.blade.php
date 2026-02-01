<div class="card h-100">
    <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
            <h5 class="mb-1">Akademik Overview</h5>
            <small class="text-muted">Ringkasan data akademik</small>
        </div>
        <div class="dropdown">
            <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ri-more-2-line ri-20px"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="{{ route('akademiks.index') }}">Lihat Detail</a>
                <a class="dropdown-item" href="javascript:void(0);" wire:click="$refresh">Refresh</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <ul class="p-0 m-0">
            <li class="d-flex align-items-center mb-4">
                <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-primary">
                        <i class="ri-user-3-line ri-22px"></i>
                    </span>
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                        <h6 class="mb-0">Mahasiswa</h6>
                        <small class="text-muted">Total mahasiswa aktif</small>
                    </div>
                    <div class="user-progress">
                        <h6 class="mb-0 text-primary">{{ number_format($totalMahasiswa) }}</h6>
                    </div>
                </div>
            </li>
            <li class="d-flex align-items-center mb-4">
                <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-success">
                        <i class="ri-user-star-line ri-22px"></i>
                    </span>
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                        <h6 class="mb-0">Dosen</h6>
                        <small class="text-muted">Total dosen aktif</small>
                    </div>
                    <div class="user-progress">
                        <h6 class="mb-0 text-success">{{ number_format($totalDosen) }}</h6>
                    </div>
                </div>
            </li>
            <li class="d-flex align-items-center">
                <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-warning">
                        <i class="ri-book-open-line ri-22px"></i>
                    </span>
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                        <h6 class="mb-0">Mata Kuliah</h6>
                        <small class="text-muted">Total mata kuliah</small>
                    </div>
                    <div class="user-progress">
                        <h6 class="mb-0 text-warning">{{ number_format($totalMataKuliah) }}</h6>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="card-footer border-top pt-3">
        <a href="{{ route('akademiks.index') }}" class="btn btn-primary w-100">
            <i class="ri-arrow-right-line me-1"></i> Kelola Akademik
        </a>
    </div>
</div>