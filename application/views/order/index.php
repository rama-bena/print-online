<!-- PRINT NOW -->
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
            <form action="<?= base_url('order/printNow'); ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="title" class="col-sm-3 col-form-label">Title <sup class="text-danger">*</sup></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="title" name="title">
                        <?= form_error('title', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="file" class="col-sm-3 col-form-label">File<sup class="text-danger">*</sup></label>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" name="file">
                            <label class="custom-file-label" for="file">Choose file</label>
                        </div>
                        <?= form_error('file', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="num_print" class="col-sm-3 col-form-label">Number of prints <sup class="text-danger">*</sup></label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="num_print" name="num_print" value="1" min="1">
                    </div>
                    <?= form_error('num_print', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="2" placeholder="(Optional)"></textarea>
                        <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row justify-content-end mt-5">
                    <a href="" class="btn btn-primary" data-target="#printModal" data-toggle="modal">Print</a>
                </div>

                <!-- PRINT MODAL -->
                <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Are you sure want to upload file to print?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Make sure your data is correct. Once you upload file you can't cancel it.
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <input type="submit" name="uploadFile" class="btn btn-primary" value="Print">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->