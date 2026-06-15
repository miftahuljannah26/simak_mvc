<div class="d-flex flex-column h-100 p-3 bg-white" style="border-right: 1px solid #eee;">
    <div class="sidebar-brand mb-4">SIMAK</div>
    <nav class="nav flex-column flex-grow-1">
        <a href="<?= base_url('dashboard'); ?>" class="nav-link <?= $this->uri->segment(1)=='dashboard'?'active':''; ?>">Dashboard</a>
        <a href="<?= base_url('aktivitas'); ?>" class="nav-link">Aktivitas</a>
        <a href="<?= base_url('keuangan'); ?>" class="nav-link">Keuangan</a>
        <a href="<?= base_url('ibadah'); ?>" class="nav-link">Ibadah</a>
    </nav>
    <div class="sidebar-footer">
        <a href="<?= base_url('auth/logout'); ?>" class="text-danger">Keluar</a>
    </div>
</div>