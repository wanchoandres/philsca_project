<?= $this->extend('/AdminPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="page-heading mb-3">
        <div class="page-title">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Capstone List</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Research</li>
                        <li class="breadcrumb-item active" aria-current="page">Capstone List</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Capstone List</h5>
            </div>

            <hr class="mt-1">

            <div class="card-body">
                <div class="table-responsive table-hover table-bordered">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>S.Y</th>
                                <th>Institute</th>
                                <th>Program</th>
                                <th>Research Title</th>
                                <th>Members</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($thesis_approved as $approved): ?>
                                <tr>
                                    <td class="col-1"><?= $approved['date_submitted'] ?></td>
                                    <td class="col-1">
                                        <?php
                                        foreach ($departments as $department):
                                            if ($approved['department_id'] == $department['department_id']) {
                                                echo $department['department_code'];
                                            }
                                        endforeach;
                                        ?>
                                    </td>

                                    <td class="col-3">
                                        <?php
                                        foreach ($programs as $program):
                                            if ($approved['program_id'] == $program['program_id']) {
                                                echo $program['program_name'];
                                            }
                                        endforeach;
                                        ?>
                                    </td>
                                    <td class="col-3"><?= $approved['thesis_title'] ?></td>
                                    <td class="col-3"><?= str_replace('|', ', ', $approved['members']); ?></td>
                                    <td class="col-1">
                                        <div class="">
                                            <button class="btn btn-primary btn-sm dropdown-toggle me-1" type="button" id="dropdownMenuButtonIcon" data-bs-toggle="dropdown">
                                                <i class="bi bi-error-circle"></i> Actions
                                            </button>
                                            <div class="dropdown-menu shadow-lg">
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#view_research_modal" 
                                                data-title="<?=$approved['thesis_title']?>" data-members="<?= str_replace('|', ', ', $approved['members']); ?>" data-file="<?=$approved['file_path']?>">
                                                    <i class="bi bi-eye me-3"></i> View
                                                </a>

                                                <a class="dropdown-item" href="/AdminController/ResearchThesisArchive/<?= $approved['thesis_id'] ?>" onclick="return confirm('Are you sure you want to archive this research?');">
                                                    <i class="bi bi-archive me-3"></i> Archive
                                                </a>

                                                <a class="dropdown-item" href="<?= base_url($approved['file_path']); ?>" download>
                                                    <i class="bi bi-download me-3"></i> Download
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

        <div class="card shadow-sm mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Pending Capstone List</h5>
            </div>

            <hr class="mt-1">

            <div class="card-body">
                <div class="table-responsive table-hover table-bordered">
                    <table class="table" id="table2">
                        <thead>
                            <tr>
                                <th>S.Y</th>
                                <th>Institute</th>
                                <th>Program</th>
                                <th>Research Title</th>
                                <th>Members</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($thesis_pending as $pending): ?>
                                <tr>
                                    <td class="col-1"><?= $pending['date_submitted'] ?></td>
                                    <td class="col-1">
                                        <?php
                                        foreach ($departments as $department):
                                            if ($pending['department_id'] == $department['department_id']) {
                                                echo $department['department_code'];
                                            }
                                        endforeach;
                                        ?>
                                    </td>

                                    <td class="col-3">
                                        <?php
                                        foreach ($programs as $program):
                                            if ($pending['program_id'] == $program['program_id']) {
                                                echo $program['program_name'];
                                            }
                                        endforeach;
                                        ?>
                                    </td>
                                    <td class="col-3"><?= $pending['thesis_title'] ?></td>
                                    <td class="col-3"><?= str_replace('|', ', ', $pending['members']); ?></td>
                                    <td class="col-1">
                                        <div class="">
                                            <button class="btn btn-primary btn-sm dropdown-toggle me-1" type="button" id="dropdownMenuButtonIcon" data-bs-toggle="dropdown">
                                                <i class="bi bi-error-circle"></i> Actions
                                            </button>
                                            <div class="dropdown-menu shadow-lg">
                                                <a class="dropdown-item" href="/AdminController/ResearchThesisApprove/<?= $pending['thesis_id']; ?>" onclick="return confirm('Are you sure you want to approve this thesis?');">
                                                    <i class="bi bi-check-square me-3"></i> Approve
                                                </a>

                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#reject_remark_modal" data-research-id="<?= $pending['thesis_id'] ?>">
                                                    <i class="bi bi-x-square me-3"></i> Reject
                                                </a>

                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#view_research_modal" 
                                                data-title="<?=$pending['thesis_title']?>" data-members="<?= str_replace('|', ', ', $pending['members']); ?>" data-file="<?=$pending['file_path']?>">
                                                    <i class="bi bi-eye me-3"></i> View
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

        <div class="card shadow-sm mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Rejected</h5>
            </div>

            <hr class="mt-1">

            <div class="card-body">
                <div class="table-responsive table-hover table-bordered">
                    <table class="table" id="table3">
                        <thead>
                            <tr>
                                <th>S.Y</th>
                                <th>Institute</th>
                                <th>Program</th>
                                <th>Research Title</th>
                                <th>Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($thesis_rejected as $reject): ?>
                                <tr>
                                    <td class="col-1"><?= $reject['date_submitted'] ?></td>
                                    <td class="col-1">
                                        <?php
                                        foreach ($departments as $department):
                                            if ($reject['department_id'] == $department['department_id']) {
                                                echo $department['department_code'];
                                            }
                                        endforeach;
                                        ?>
                                    </td>

                                    <td class="col-1">
                                        <?php
                                        foreach ($programs as $program):
                                            if ($reject['program_id'] == $program['program_id']) {
                                                echo $program['program_code'];
                                            }
                                        endforeach;
                                        ?>
                                    </td>
                                    <td class="col-5"><?= $reject['thesis_title'] ?></td>
                                    <td class="col-4"><?= $reject['reject_remark'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="reject_remark_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="mx-3 mt-3">
                            <h2>Reject Research</h2>
                            <small class="text-muted mb-0">Please indicate remarks for rejection.</small>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="/AdminController/ResearchThesisReject" method="post">
                        <input type="hidden" name="thesis_id" id="modal-thesis-id">
                        <div class="modal-body m-3">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="" class="mb-2">Remarks</label>
                                        <textarea name="remark" id="" class="form-control" required></textarea>
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

        <div class="modal fade" id="view_research_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="mx-3 mt-3">
                            <h2 id="modal-research-title"></h2>
                            <small class="text-muted mb-0" id="modal-research-member"></small>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <iframe id="modal-research-file" src="" width="100%" height="600px"></iframe>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var remarkModal = document.getElementById('reject_remark_modal');
        remarkModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;

            var researchId = button.getAttribute('data-research-id');
            var modalResearchId = remarkModal.querySelector('#modal-thesis-id');

            modalResearchId.value = researchId;
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        var updateModal = document.getElementById('view_research_modal');
        updateModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;

            var researchTitle = button.getAttribute('data-title');
            var researchMember = button.getAttribute('data-members');
            var researchFile = button.getAttribute('data-file');

            var modalResearchTitle = updateModal.querySelector('#modal-research-title');
            var modalResearchMember = updateModal.querySelector('#modal-research-member');
            var modalResearchFile = updateModal.querySelector('#modal-research-file');

            modalResearchTitle.textContent = researchTitle;
            modalResearchMember.textContent = "Members: " + researchMember;
            modalResearchFile.src = researchFile;
        });
    });
</script>

<?= $this->endSection(); ?>