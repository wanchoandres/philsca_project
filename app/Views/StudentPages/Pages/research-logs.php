<?= $this->extend('/StudentPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="page-heading mb-3">
        <div class="page-title">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Thesis Logs</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Research</li>
                        <li class="breadcrumb-item active" aria-current="page">Logs</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <div class="table-responsive table-hover table-bordered w-100">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>Date & Time</th>
                                <th>User Type</th>
                                <th>Full Name</th>
                                <th>Description</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($logs as $log): ?>
                                <tr>
                                    <td><?= $log['date_created'] ?></td>
                                    <td>
                                        <?php 
                                        if($log['user_type'] == 1){
                                            echo "Administrator";
                                        }elseif($log['user_type'] == 2){
                                            echo "Student";
                                        }elseif($log['user_type'] == 3){
                                            echo "ICS Research Coordinator";
                                        }
                                        ?>
                                    </td>
                                    <td><?= $log['full_name'] ?></td>
                                    <td><?= $log['description'] ?></td>
                                    <td><?= $log['status'] ?></td>
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