<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view("admin/navigation_admin.php", array('page' => 'master_group_perangkat')) ?>     
</head>
<body>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Master Group Perangkat</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <?php if($this->session->userdata('role') == 1){ ?>
              <li class="breadcrumb-item"><a class="btn btn-primary btn-lg" href="<?php echo base_url(); ?>Panel/tambah_master_group_perangkat">Tambah</a></li>
              <?php } ?>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <table id="datatables" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Group Perangkat</th>
                    <th>Keterangan</th>
                    <?php if($this->session->userdata('role') == 1){ ?>
                    <th>Aksi</th>
                    <?php  } ?>
                  </tr>
                </thead>
                <!--tbody>
                  <?php 
                  //$no=1;
                  //foreach ($master_jenis as $mstrjns):?>
                  <tr>
                    <td><?php //echo $no++; ?></td>
                    <td><?php //echo $mstrjns->jns_prgkt; ?></td>
                    <td><?php //echo $mstrjns->ket; ?></td>
                    <td>
                        <?php //echo anchor('admin/ubah_aksi_mstrjns/'.$mstrjns->id_master_jns,'<button type="submit" class="btn btn-warning">Ubah</button>') ?>
                      <form action="hapus_mstrjns" method="post">
                        <input type="hidden" name="id_master_jns" value="<?php //echo $mstrjns->id_master_jns; ?>">
                        <button type="submit"class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data?');">Hapus</button>
                      </form>
                    </td>
                  </tr>
                <?php //endforeach; ?>
                </tbody-->
                <tbody>
                    <?php
                      $i=1;
                      foreach($master_group_perangkat as $a){
                        echo '<tr>';
                        echo '<td>'.$i.'</td>';
                        echo '<td>'.$a->group_perangkat.'</td>';
                        echo '<td>'.$a->keterangan.'</td>';
                        if($this->session->userdata('role') == 1){
                        echo "
                          <td>
                            <a class='btn btn-warning' href='".base_url('Panel/ubah_master_group_perangkat/').$a->id_group."'><i class='fa fa-edit'></i></a>
                            <a class='btn btn-danger' onclick='return confirm_delete()' href='".base_url('Panel/hapus_mstrgroup_perangkat/').$a->id_group."'><i class='fa fa-trash'></i></a>
                          </td>";
                        echo '</tr>';
                        }
                        $i++;
                  }
                  ?>
                 </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</body>
<footer>
<?php $this->load->view("admin/footer_admin.php") ?>

<script type="text/javascript">
  function confirm_delete() {
        var x=confirm("Apakah Anda yakin ingin menghapus data?")
        if (x) {
            return true;
        } else {
            return false;
        }
    }
</script>
</footer>
</html>