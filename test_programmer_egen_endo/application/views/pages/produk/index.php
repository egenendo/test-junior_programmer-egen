<?= $this->session->flashdata('success'); ?>
<?= $this->session->flashdata('error'); ?>
<div class="card">
    <div class="card-header">
         <a href="<?= base_url('produk/create') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Produk</a>  
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Nama Kategori</th>
                    <th>Nomor Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($produk as $item) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $item->nama_produk; ?></td>
                        <td>Rp <?= number_format($item->harga, 0, ',', '.'); ?></td>
                        <td><?= $item->nama_kategori; ?></td>
                        <td><?= $item->nama_status; ?></td>
                        <td>
                            <a href="<?= base_url('produk/edit/') . $item->id_produk ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-danger btn-sm btn-hapus" data-id="<?= $item->id_produk ?>" data-nama="<?= $item->nama_produk ?>">
                                <i class="fas fa-trash"></i>
                            </button>                            
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->