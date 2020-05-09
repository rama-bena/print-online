<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <?php foreach ($uploads as $upload) : ?>

        <div class="card border-primary col-sm-10 mt-5">
            <div class="card-body">
                <div class="form-group row">
                    <label for="date_upload" class="col-sm-4 col-form-label">Date upload</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="date_upload" name="date_upload" value="<?= date('d F Y, H:i', $upload['date_upload']);  ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label">Name member</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" name="name" value="<?= $upload['name'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-sm-4 col-form-label">Title</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="title" name="title" value="<?= $upload['title'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="num_print" class="col-sm-4 col-form-label">Number of print</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="num_print" name="num_print" value="<?= $upload['num_print'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-4 col-form-label">keterangan</label>
                    <div class="col-sm-8">
                        <!-- <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $upload['keterangan'] ?>" readonly> -->
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="2" readonly> <?= $upload['keterangan'] ?></textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="form-group row justify-content-end">
                    <!-- <div class="col-sm-9"></div> -->
                    <div class="">
                        <a href="#" class="btn btn-danger" role="button" data-toggle="modal" data-target="#reject-<?= $upload['id_po']; ?>"> Reject</a>
                        <a href="#" class="btn btn-primary" role="button" data-toggle="modal" data-target="#process-<?= $upload['id_po']; ?>"> Process</a>
                        <a href="#" class="btn btn-success" role="button"> Download</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php foreach ($uploads as $upload) : ?>
        <!-- MODAL REJECT-->
        <div class="modal fade" id="reject-<?= $upload['id_po']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reject</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('orderEmployee/reject') ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="keterangan_reject" class="col-sm-3 col-form-label">Keterangan Reject<sup class="text-danger">*</sup></label>
                                <div class="col-sm-9">
                                    <textarea class=" form-control" id="keterangan_reject" name="keterangan_reject" rows="2" placeholder="why we rejected this file?"></textarea>
                                </div>
                                <?= form_error('keterangan_reject', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="modal-footer">
                                <div class="form-group">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger"> Reject</button>
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