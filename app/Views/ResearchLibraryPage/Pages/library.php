<?= $this->extend('/ResearchLibraryPage/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div class="container my-5 d-flex flex-column justify-content-center align-items-center">
    <div class="page-heading">
        <div class="text-center">
            <img src="/landingPageAssets/images/philsca-logo.png" style="max-height: 100px; width: auto;" alt="Philsca Logo">

            <h1 class="mb-0 mt-2">Research Library</h1>
            <p>Web-Based Research Management System</p>
        </div>
    </div>

    <div class="page-content">
        <div class="card shadow-lg mb-3">
            <div class="card-body">
                <div class="table-responsive table-hover table-bordered w-100">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>S.Y</th>
                                <th>Department</th>
                                <th>Program</th>
                                <th>Research Title</th>
                                <th>Members</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($thesis_approved as $approve): ?>
                                <tr>
                                    <td><?= $approve['date_submitted'] ?></td>
                                    <td>
                                        <?php
                                        foreach ($departments as $department):
                                            if ($approve['department_id'] == $department['department_id']) {
                                                echo $department['department_code'];
                                            }
                                        endforeach;
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        foreach ($programs as $program):
                                            if ($approve['program_id'] == $program['program_id']) {
                                                echo $program['program_name'];
                                            }
                                        endforeach;
                                        ?>
                                    </td>
                                    <td><?= $approve['thesis_title'] ?></td>
                                    <td><?= str_replace('|', ', ', $approve['members']); ?></td>
                                    <td>
                                        <a class="btn btn-outline-secondary btn-sm px-3" href="#" data-bs-toggle="modal" data-bs-target="#view_research_modal" 
                                        data-title="<?=$approve['thesis_title']?>" data-members="<?= str_replace('|', ', ', $approve['members']); ?>" data-file="<?=$approve['file_path']?>">View
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="text-center py-3">
            <a href="/" class="text-decoration-none">
                <span class="text-sm text-muted">
                    <i class="bi bi-chevron-left"></i> Return
                </span>
            </a>
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
</div>

<style>
    .type-select {
        text-decoration: none;
    }

    .type-select #user-type {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .type-select:hover #user-type {
        transform: scale(1.05);
        box-shadow: 3px 3px 12px rgba(0, 0, 0, 0.2);
    }
</style>


<script>
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
            modalResearchMember.textContent = "Members:" + researchMember;
            modalResearchFile.src = researchFile + "#toolbar=0";
        });
    });
</script>

<?= $this->endSection(); ?>
