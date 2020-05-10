<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php foreach ($orders as $process) : ?>

        <div class="card border-primary col-sm-10 mt-5">
            <div class="card-body">
                <div class="form-group row">
                    <label for="date_process" class="col-sm-4 col-form-label">Date process</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="date_process" name="date_process" value="<?= date('d F Y, H:i', $process['date_process']);  ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label">Name member</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" name="name" value="<?= $process['name'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-sm-4 col-form-label">Title</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="title" name="title" value="<?= $process['title'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="num_print" class="col-sm-4 col-form-label">Number of print</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="num_print" name="num_print" value="<?= $process['num_print'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-4 col-form-label">keterangan</label>
                    <div class="col-sm-8">
                        <!-- <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $process['keterangan'] ?>" readonly> -->
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="2" readonly> <?= $process['keterangan'] ?></textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="form-group row justify-content-end">
                    <!-- <div class="col-sm-9"></div> -->
                    <div class="">
                        <a href="#" class="btn btn-primary" role="button" data-toggle="modal" data-target="#finish-<?= $process['id_po']; ?>"> finish</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php foreach ($orders as $process) : ?>
        <!-- MODAL REJECT-->
        <div class="modal fade" id="finish-<?= $process['id_po']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Finish</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('orderEmployee/toFinish/') . $process['id_po']; ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="price" class="col-sm-3 col-form-label">Price<sup class="text-danger">*</sup></label>
                                <div class="col-sm-1 form-control">
                                    Rp.
                                </div>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="price" min="100" value="1000">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <!-- <button type="submit" class="btn btn-primary"> Finish</button> -->
                                <input type="submit" class="btn btn-primary" name="submit" value="Finish">
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