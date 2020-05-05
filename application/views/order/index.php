<!-- PRINT NOW -->
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">

            <?= form_open_multipart('order/printNow'); ?>

            <div class="form-group row">
                <label for="file" class="col-sm-3 col-form-label">File</label>
                <div class="col-sm-9">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file" name="file">
                        <label class="custom-file-label" for="file">Choose file</label>
                    </div>
                    <!-- <?= form_error('file', '<small class="text-danger pl-3">', '</small>'); ?> -->
                </div>
            </div>
            <div class="form-group row">
                <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="keterangan" rows="2" placeholder="(Optional)"></textarea>
                </div>
            </div>
            <div class="form-group row justify-content-end mt-5">
                <div>
                    <button type="submit" class="btn btn-primary">Print</button>
                </div>
            </div>
            </form>
        </div>

    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->