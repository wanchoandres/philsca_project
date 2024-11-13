<?= $this->extend('/AdminPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="page-heading mb-3">
        <div class="page-title">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Archive Thesis</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Research</li>
                        <li class="breadcrumb-item active" aria-current="page">Archive</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Archive Thesis List</h5>
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
                            <?php foreach ($thesis_archive as $archive): ?>
                                <tr>
                                    <td><?= $archive['date_submitted'] ?></td>
                                    <td>
                                        <?php
                                        foreach ($departments as $department):
                                            if ($archive['department_id'] == $department['department_id']) {
                                                echo $department['department_code'];
                                            }
                                        endforeach;
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        foreach ($programs as $program):
                                            if ($archive['program_id'] == $program['program_id']) {
                                                echo $program['program_name'];
                                            }
                                        endforeach;
                                        ?>
                                    </td>
                                    <td><?= $archive['thesis_title'] ?></td>
                                    <td><?= str_replace('|', ', ', $archive['members']); ?></td>
                                    <td>
                                        <a href="/AdminController/ResearchThesisRestore/<?= $archive['thesis_id'] ?>"><button type="button" class="btn btn-outline-secondary btn-sm px-3">Restore</button></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection(); ?>