<?= $this->extend('/AdminPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="page-heading mb-3">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Research Analytics</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/AdminController/DashboardPage">Dashboard</a></li>
                            <li class="breadcrumb-item active">Research</li>
                            <li class="breadcrumb-item active">Analytics</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm mb-3">
            <div class="card-header">
                <div class="text-center my-3">
                    <h3>Institute Research Analytics</h3>
                    <small>Total Research: <?= $thesis_count ?></small>
                </div>
            </div>
            <hr class="mt-0">
            <div class="card-body my-3">
                <div class="row text-center d-flex justify-content-center align-items-center mt-3">
                    <input type="hidden" id="department_count" value="<?= $department_count ?>">
                    <?php $counter = 1; ?>
                    <?php foreach ($department_analytics as $department_analytic): ?>
                        <div class="col-sm-12 col-md-4 mb-3">
                            <h5><?= $department_analytic['department_name'] ?></h5>
                            <div id="department_chart_<?= $counter ?>" value="<?= $department_analytic['department_thesis_count'] ?>"></div>
                        </div>
                        <?php $counter++; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-3">
            <div class="card-header">
                <div class="text-center my-3">
                    <h3>Agenda Research Analytics</h3>
                    <small>Total Research: <?= $thesis_count ?></small>
                </div>
            </div>
            <hr class="mt-0">
            <div class="card-body my-3">
                <div class="row text-center d-flex justify-content-center align-items-center mt-3">
                    <input type="hidden" id="agenda_count" value="<?= $agenda_count ?>">
                    <?php $counter = 1; ?>
                    <?php foreach ($agenda_analytics as $agenda_analytic): ?>
                        <div class="col-sm-12 col-md-4 mb-3">
                            <h5><?= $agenda_analytic['agenda_name'] ?></h5>
                            <span><?= $agenda_analytic['program_code'] ?></span>
                            <div id="agenda_chart_<?= $counter ?>" value="<?= $agenda_analytic['agenda_thesis_count'] ?>"></div>
                        </div>
                        <?php $counter++; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-3">
            <div class="card-header">
                <div class="text-center my-3">
                    <h3>Program Research Analytics</h3>
                    <small>Total Research: <?= $thesis_count ?></small>
                </div>
            </div>
            <hr class="mt-0">
            <div class="card-body my-3">
                <div class="row text-center d-flex justify-content-center align-items-center mt-3">
                    <input type="hidden" id="program_count" value="<?= $program_count ?>">
                    <?php $counter = 1; ?>
                    <?php foreach ($program_analytics as $program_analytic): ?>
                        <div class="col-sm-12 col-md-4 mb-3">
                            <h5><?= $program_analytic['program_name'] ?></h5>
                            <span><?= $program_analytic['program_code'] ?></span>
                            <div id="program_chart_<?= $counter ?>" value="<?= $program_analytic['program_thesis_count'] ?>"></div>
                        </div>
                        <?php $counter++; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
</div>


<?= $this->endSection(); ?>