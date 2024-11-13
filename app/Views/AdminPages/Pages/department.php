<?= $this->extend('/AdminPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="page-heading mb-3">
        <div class="page-title">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Institutes</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Institutes</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Institute List</h5>
                <button type="button" class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#new_department_modal">New Institute</button>
            </div>

            <hr class="mt-1">

            <div class="card-body">
                <div class="table-responsive table-hover table-bordered">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>Institute Code</th>
                                <th>Institute Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($departments as $department): ?>
                                <tr>
                                    <td><?= $department['department_code'] ?></td>
                                    <td><?= $department['department_name'] ?></td>
                                    <td>
                                        <div class="">
                                            <button class="btn btn-primary btn-sm dropdown-toggle me-1" type="button" id="dropdownMenuButtonIcon" data-bs-toggle="dropdown">
                                                <i class="bi bi-error-circle"></i> Actions
                                            </button>
                                            <div class="dropdown-menu shadow-lg">
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#update_department_modal" data-department-id="<?= $department['department_id'] ?>" data-department-code="<?= $department['department_code'] ?>" data-department-name="<?= $department['department_name'] ?>">
                                                    <i class="bi bi-pencil-square me-3"></i> Update</a>

                                                <a class="dropdown-item" href="/AdminController/DepartmentDelete/<?= $department['department_id'] ?>" onclick="return confirm('Are you sure you want to delete this program? This action cannot be undone.');">
                                                    <i class="bi bi-trash3 me-3"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="new_department_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="mx-3 mt-3">
                            <h2>New Institute</h2>
                            <small class="text-muted mb-0">Please fill this form to add a new institute.</small>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="/AdminController/DepartmentCreate" method="post">
                        <div class="modal-body m-3">
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="">Institute Code</label>
                                        <input type="text" class="form-control" name="department_code" id="" placeholder="Institute Code" required>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-8">
                                    <div class="form-group mb-3">
                                        <label for="">Institute Name</label>
                                        <input type="text" class="form-control" name="department_name" id="" placeholder="Institute Name" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Cancel</span>
                            </button>
                            <button type="submit" class="btn btn-primary ms-1">
                                <span class="px-3">Submit</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="update_department_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="mx-3 mt-3">
                            <h2>Update Institute</h2>
                            <small class="text-muted mb-0">Make sure to click "Save Changes" to ensure your updates are applied.</small>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="/AdminController/DepartmentUpdate" method="post">
                        <div class="modal-body m-3">
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="">Institute Code</label>
                                        <input type="text" class="form-control" name="department_code" id="modal-department-code" placeholder="Institute Code" required>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-8">
                                    <div class="form-group mb-3">
                                        <label for="">Institute Name</label>
                                        <input type="text" class="form-control" name="department_name" id="modal-department-name" placeholder="Institute Name" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="department_id" id="modal-department-id" value="">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Cancel</span>
                            </button>
                            <button type="submit" class="btn btn-primary ms-1">
                                <span class="px-3">Save Changes</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var updateModal = document.getElementById('update_department_modal');
        updateModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;

            var departmentId = button.getAttribute('data-department-id');
            var departmentCode = button.getAttribute('data-department-code');
            var departmentName = button.getAttribute('data-department-name');

            var modalDepartmentId = updateModal.querySelector('#modal-department-id');
            var modalDepartmentCode = updateModal.querySelector('#modal-department-code');
            var modalDepartmentName = updateModal.querySelector('#modal-department-name');

            modalDepartmentId.value = departmentId;
            modalDepartmentCode.value = departmentCode;
            modalDepartmentName.value = departmentName;
        });
    });
</script>


<?= $this->endSection(); ?>