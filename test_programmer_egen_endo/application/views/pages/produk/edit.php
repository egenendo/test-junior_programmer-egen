<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title"><?= $title ?> </h3>
                    </div>

                    <form action="<?= base_url('produk/update/') . $produk->id_produk ?>" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="Nama Produk">Nama Produk</label>    
                                <input type="text" name="nama_produk" class="form-control <?= form_error('nama_produk') ? 'is-invalid' : '' ?>" value="<?= $produk->nama_produk ?>" placeholder="Nama Produk">
                                <div class="invalid-feedback">
                                    <?= form_error('nama_produk') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Harga">Harga</label>    
                                <input type="text" name="harga" class="form-control number <?= form_error('harga') ? 'is-invalid' : '' ?>" value="<?= $produk->harga ?>" placeholder="Harga">
                                <div class="invalid-feedback">
                                    <?= form_error('harga') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Kategori">Kategori</label>    
                                <select name="kategori_id" class="form-control select2 <?= form_error('kategori_id') ? 'is-invalid' : '' ?>" style="width: 100%;">
                                    <option value="">-- Pilih Kategori --</option>
                                    <?php foreach ($data_kategori as $kategori): ?>
                                        <option value="<?=$kategori->id_kategori;?>" <?=($kategori->id_kategori == $produk->kategori_id) ? 'selected' : ''?>>
                                            <?=$kategori->nama_kategori;?>
                                        </option>
                                    <?php endforeach?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= form_error('kategori_id') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Status">Status</label> 
                                <select class="form-control <?= form_error('status_id') ? 'is-invalid' : '' ?>" name="status_id" style="width: 100%;">
                                    <option value="">-- Pilih Status --</option>
                                    <?php foreach ($data_status as $status) : ?>
                                        <option value="<?= $status->id_status; ?>" <?=($status->id_status == $produk->status_id) ? 'selected' : ''?>><?= $status->nama_status; ?></option>
                                    <?php endforeach ?>
                                </select>   
                                <div class="invalid-feedback">
                                    <?= form_error('status_id') ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>
                            <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>