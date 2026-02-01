<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-4 mb-6">Dashboard</h4>

    <div class="row">
        @forelse($widgets as $widget)
            <div class="col-md-6 col-lg-4 mb-4">
                @livewire($widget['component'], $widget['props'] ?? [], key($widget['key']))
            </div>
        @empty
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="ri-dashboard-line ri-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada widget dashboard</h5>
                        <p class="text-muted mb-0">Widget akan muncul sesuai dengan module yang Anda akses.</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>