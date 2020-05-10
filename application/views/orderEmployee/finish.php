<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php foreach ($orders as $order) : ?>

        <div class="card border-primary col-sm-10 mt-5">
            <div class="card-body">
                <div class="form-group row">
                    <label for="date_finish" class="col-sm-4 col-form-label">Date finish</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="date_finish" name="date_finish" value="<?= date('d F Y, H:i', $order['date_finish']);  ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="date_upload" class="col-sm-4 col-form-label">Date upload</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="date_upload" name="date_upload" value="<?= date('d F Y, H:i', $order['date_upload']);  ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label">Name member</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" name="name" value="<?= $order['name'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-sm-4 col-form-label">Title</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="title" name="title" value="<?= $order['title'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="num_print" class="col-sm-4 col-form-label">Number of print</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="num_print" name="num_print" value="<?= $order['num_print'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-4 col-form-label">keterangan</label>
                    <div class="col-sm-8">
                        <!-- <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $order['keterangan'] ?>" readonly> -->
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="2" readonly> <?= $order['keterangan'] ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="price" class="col-sm-4 col-form-label">Price</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="price" name="price" value="Rp. <?= $order['price'] ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="form-group row justify-content-end">
                    <!-- <div class="col-sm-9"></div> -->
                    <div class="">
                        <a href="#" class="btn btn-primary" role="button" data-toggle="modal" data-target="#taken-<?= $order['id_po']; ?>"> taken</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php foreach ($orders as $order) : ?>
        <!-- MODAL TAKEN-->
        <div class="modal fade" id="taken-<?= $order['id_po']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Taken</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure want to move this order to taken?
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <a href="<?= base_url('orderEmployee/toTaken/') . $order['id_po']; ?>" class="btn btn-primary">Taken</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    <?php endforeach; ?>

    <!-- End page Content -->
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->