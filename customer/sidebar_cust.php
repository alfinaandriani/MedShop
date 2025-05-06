<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link <?php echo ($title == 'Daftar Produk') ? 'text-primary' : 'collapsed'; ?>" href="cust_produk.php">
                <i class="bi bi-grid"></i>
                <span>Daftar Produk</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?php echo ($title == 'Keranjang Belanja') ? 'text-primary' : 'collapsed'; ?>" href="cust_lihat_keranjang.php">
                <i class="bi bi-basket-fill"></i><span>Keranjang Belanja</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?php echo ($title == 'Transaksi Belanja') ? 'text-primary' : 'collapsed'; ?>" href="cust_lihat_transaksi.php">
                <i class="bi bi-file-text"></i><span>Transaksi Belanja</span>
            </a>
        </li>

    </ul>

</aside>