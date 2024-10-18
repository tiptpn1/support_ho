<a class="nav-link" data-toggle="dropdown" href="#">
    <i class="far fa-bell"></i>
    <span class="badge badge-danger navbar-badge"><?= sizeof(list_notifikasi()) ?></span>
</a>
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

    <?php
    if (sizeof(list_notifikasi()) == 0) {
    ?>
        <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
                <div class="media-body">

                    <h3 class="dropdown-item-title">
                        Tidak ada Notifikasi
                    </h3>
                </div>
            </div>
            <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
    <?php
    } else { ?>
        <?php foreach (list_notifikasi() as $ln) : ?>
            <a href="#" class="dropdown-item notifikasi" data-id="<?= $ln['id'] ?>">
                <!--notifikasi  class hapus aja-->
                <!-- Message Start -->
                <div class="media">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                            <?= $ln['nama'] ?>
                        </h3>
                        <p class="text-sm"><?= $ln['jns_kerusakan'] ?></p>
                        <p class="float-right text-sm text-muted"><i class="far fa-clock mr-1"></i> <?= date("d-m-Y H:i:s", strtotime($ln->tanggal)); ?></p>
                    </div>
                </div>
                <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
        <?php endforeach ?>
    <?php } ?>
</div>