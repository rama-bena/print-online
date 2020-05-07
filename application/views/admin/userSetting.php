<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row col-10">
        <?= $this->session->flashdata('message'); ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Is Active</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($allUser as $au) : ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><?= $au['name']; ?></td>
                        <td><?= $au['email']; ?></td>
                        <td><?= $au['role']; ?></td>
                        <td><?= ($au['is_active'] ? 'Yes' : 'No'); ?></td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#detail-<?= $au['id']; ?>" class="badge badge-primary">Detail</a>
                            <a href="#" data-toggle="modal" data-target="#change-<?= $au['id']; ?>" class="badge badge-success">Change Role</a>
                            <a href="#" data-toggle="modal" data-target="#delete-<?= $au['id']; ?>" class="badge badge-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


    <?php foreach ($allUser as $au) : ?>
        <!-- MODAL DETAIL-->
        <div class="modal fade" id="detail-<?= $au['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="<?= base_url('assets/img/profile/') . $au['image']; ?>" class="card-img">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $au['name']; ?></h5>
                                        <p class="card-text"><?= $au['email']; ?></p>
                                        <p class="card-text"><small class="text-muted">Email is <?= ($au['is_active'] ? "" : "<strong>not </strong>");  ?>active</small></p>
                                        <p class="card-text"><?= $au['role']; ?></p>
                                        <p class="card-text"><small class="text-muted">Bergabung sejak <?= date('d F Y', $au['date_created']); ?></small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL DELETE -->
        <div class="modal fade" id="delete-<?= $au['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure want to delete <?= $au['email']; ?></p>
                        <p>Once you delete you can't get back the user</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger" href="<?= base_url('admin/deleteUser/') . $user['id'] . '/' . $au['id']; ?>">Delete</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL CHANGE -->
        <div class="modal fade" id="change-<?= $au['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('admin/changeRole/') . $user['id'] . '/' . $au['id']; ?>" method="POST">
                        <div class="modal-body">
                            <?php
                            $user_roles = $this->db->get('user_role')->result_array();
                            foreach ($user_roles as $user_role) :
                                $role = $user_role['role'];
                                $id = $user_role['id'];
                            ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio" id="<?= $role; ?>" value="<?= $id; ?>" <?= ($au['role'] == $role) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="<?= $role; ?>">
                                        <?= $role; ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <input class="btn btn-primary" type="submit" value="Change">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>




</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->