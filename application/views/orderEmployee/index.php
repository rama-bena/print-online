<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card col-sm-10">
        <div class="card-body col-sm-8">
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" readonly>
                </div>
            </div>
        </div>
    </div>

    <!-- End page Content -->
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->