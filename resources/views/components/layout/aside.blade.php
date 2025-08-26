<aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-heading">Home</li>

            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link @activeclass('admin/dashboard')" href="{{ route('admin.dashboard')}}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-heading">Main Menu</li>

            <!-- KATEGORI -->
            <li class="nav-item">
                <a class="nav-link @activeclass('admin/kategori')" href="/admin/kategori">
                    <i class="bi bi-tags"></i>
                    <span>Kategori</span>
                </a>
            </li>

            <!-- Data supplier -->
            <li class="nav-item">
                <a class="nav-link @activeclass('admin/data_supplier')" href="/admin/data_supplier">
                    <i class="bi bi-truck"></i>
                    <span>Data supplier</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @activeclass('admin/data_barang')" href="/admin/data_barang">
                    <i class="bi bi-box-seam"></i>
                    <span>Data barang</span>
                </a>
            </li>

            <!-- Pembelian -->
            <li class="nav-item">
                <a class="nav-link @activeclass('admin/barang_masuk')" href="/admin/barang_masuk">
                    <i class="bi bi-box-arrow-in-down"></i>
                    <span>Pembelian</span>
                </a>
            </li>

            <!-- Penjualan -->
            <li class="nav-item">
                <a class="nav-link @activeclass('admin/penjualan')" href="{{ route('penjualan.index') }}">
                    <i class="bi bi-box-arrow-in-up"></i>
                    <span>Penjualan</span>
                </a>
            </li>
            
            
            <li class="nav-heading">Laporan</li>
                
            <li class="nav-item">
                <a class="nav-link @activeclass('admin/rekap_data')" href="{{ route('rekap.index') }}">
                    <i class="bi bi-journals"></i>
                    <span>Rekap data</span>
                </a>
            </li>
            
    </aside>