<?= $this->extend('/AdminPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="page-heading mb-3">
        <div class="page-title">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Agendas</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Agendas</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Agenda List</h5>
            <button type="button" class="btn btn-primary px-5 mb-3" data-bs-toggle="modal" data-bs-target="#new_agenda_modal">New Agenda</button>
        </div>
        <?php $counter = 1; ?>
        <?php foreach($programs AS $program): ?>
            <div class="card shadow-sm mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><?=$program['program_name']?> (<?=$program['program_code']?>)</h5>
                </div>

                <hr class="mt-1">

                <div class="card-body">
                    <div class="table-responsive table-hover table-bordered">
                        <table class="table" id="<?= "table$counter" ?>">
                            <thead>
                                <tr>
                                    <th>Program</th>
                                    <th>Agenda Code</th>
                                    <th>Agenda Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($agendas as $agenda): ?>
                                    <?php if($agenda['program_id'] == $program['program_id']): ?>
                                        <tr>
                                            <td class="col-3"><?= $agenda['program_code'] ?></td>
                                            <td class="col-3"><?= $agenda['agenda_code'] ?></td>
                                            <td class="col-5"><?= $agenda['agenda_name'] ?></td>
                                            <td class="col-1">
                                                <div class="">
                                                    <button class="btn btn-primary btn-sm dropdown-toggle me-1" type="button" id="dropdownMenuButtonIcon"data-bs-toggle="dropdown">
                                                        <i class="bi bi-error-circle"></i> Actions
                                                    </button>
                                                    <div class="dropdown-menu shadow-lg">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#update_agenda_modal" data-agenda-id="<?= $agenda['agenda_id'] ?>" data-agenda-code="<?= $agenda['agenda_code'] ?>" data-agenda-name="<?= $agenda['agenda_name'] ?>">
                                                            <i class="bi bi-pencil-square me-3"></i> Update</a>

                                                        <a class="dropdown-item" href="/AdminController/AgendaDelete/<?= $agenda['agenda_id'] ?>" onclick="return confirm('Are you sure you want to delete this program? This action cannot be undone.');">
                                                            <i class="bi bi-trash3 me-3"></i> Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php $counter++ ?>
        <?php endforeach; ?>

        <div class="modal fade" id="new_agenda_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="mx-3 mt-3">
                            <h2>New Agenda</h2>
                            <small class="text-muted mb-0">Please fill this form to add a new agenda.</small>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="/AdminController/AgendaCreate" method="post">
                        <div class="modal-body m-3">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Program</label>
                                        <select class="form-control form-select" name="program_id" id="program" required>
                                            <option value="">Select Program</option>
                                            <?php foreach ($programs as $program): ?>
                                                <option value="<?= $program['program_id'] ?>"><?= $program['program_code'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Agenda Code</label>
                                        <input type="text" class="form-control" name="agenda_code" id="" placeholder="Agenda Code" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="">Agenda Name</label>
                                        <input type="text" class="form-control" name="agenda_name" id="" placeholder="Agenda Name" required>
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

        <div class="modal fade" id="update_agenda_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="mx-3 mt-3">
                            <h2>Update Agenda</h2>
                            <small class="text-muted mb-0">Make sure to click "Save Changes" to ensure your updates are applied.</small>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="/AdminController/AgendaUpdate" method="post">
                        <div class="modal-body m-3">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Program</label>
                                        <select class="form-control form-select" name="program_id" id="program" required>
                                            <option value="">Select Program</option>
                                            <?php foreach ($programs as $program): ?>
                                                <option value="<?= $program['program_id'] ?>"><?= $program['program_code'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Agenda Code</label>
                                        <input type="text" class="form-control" name="agenda_code" id="modal-agenda-code" placeholder="Agenda Code" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="">Agenda Name</label>
                                        <input type="text" class="form-control" name="agenda_name" id="modal-agenda-name" placeholder="Agenda Name" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="agenda_id" id="modal-agenda-id" value="">

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
        var updateModal = document.getElementById('update_agenda_modal');
        updateModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;

            var agendaId = button.getAttribute('data-agenda-id');
            var agendaCode = button.getAttribute('data-agenda-code');
            var agendaName = button.getAttribute('data-agenda-name');

            var modalAgendaId = updateModal.querySelector('#modal-agenda-id');
            var modalAgendaCode = updateModal.querySelector('#modal-agenda-code');
            var modalAgendaName = updateModal.querySelector('#modal-agenda-name');

            modalAgendaId.value = agendaId;
            modalAgendaCode.value = agendaCode;
            modalAgendaName.value = agendaName;
        });
    });
</script>


<?= $this->endSection(); ?>