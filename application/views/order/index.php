<!-- PRINT NOW -->
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
            <form action="<?= base_url('order'); ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="title" class="col-sm-3 col-form-label">Title <sup class="text-danger">*</sup></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="title" name="title">
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
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="2" placeholder="(Optional)"></textarea>
                    </div>
                </div>
                <div class="form-group row justify-content-end mt-5">
                    <div>
                        <input type="submit" name="uploadFile" class="btn btn-primary" value="Print">
                    </div>
                </div>
            </form>
        </div>

    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->