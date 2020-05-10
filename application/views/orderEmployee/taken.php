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
        </div>
    <?php endforeach; ?>
    <!-- End page Content -->
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->