<?= $this->extend('/StudentPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="page-heading mb-3">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Upload Research</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/StudentController/DashboardPage">Dashboard</a></li>
                            <li class="breadcrumb-item active">Upload Research</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-body mb-3">
                <form action="/StudentController/ResearchCreate" method="post" enctype="multipart/form-data">
                    <div class="row d-flex justify-content-center align-items-center mt-3">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="form-group mb-3">
                                                    <label class="text-sm" for="">Institute</label>
                                                    <select class="form-control form-select" name="department" id="department" required>
                                                        <option value="" required>Select Institute</option>
                                                        <?php foreach ($departments as $department): ?>
                                                            <option value="<?= $department['department_id'] ?>"><?= $department['department_name'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="form-group mb-3">
                                                    <label class="text-sm" for="">Program</label>
                                                    <select class="form-control form-select" name="program" id="program" required>
                                                        <option value="">Select Program</option>
                                                        <?php foreach ($programs as $program): ?>
                                                            <option value="<?= $program['program_id'] ?>" data-department-id="<?= $program['department_id'] ?>"><?= $program['program_name'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="form-group mb-3">
                                                    <label class="text-sm" for="">Agenda</label>
                                                    <select class="form-control form-select" name="agenda" id="agenda" required>
                                                        <option value="">Select Agenda</option>
                                                        <?php foreach ($agendas as $agenda): ?>
                                                            <option value="<?= $agenda['agenda_id'] ?>"><?= $agenda['agenda_name'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="form-group mb-3">
                                                    <label class="text-sm" for="">Year Submitted</label>
                                                    <input class="form-control" type="text" name="school_year" id="school_year" value="" placeholder="2024-2025" required>
                                                    <div class="invalid-feedback">
                                                        <i class="bx bx-radio-circle"></i>
                                                        Invalid School Year
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group mb-3">
                                            <label class="text-sm" for="">Research Title</label>
                                            <input type="text" id="" class="form-control" name="title" placeholder="Research Title" autofocus required>
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                Contains special characters or numbers
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group mb-3">
                                            <label class="text-sm" for="">1. Members</label>
                                            <div class="input-group">
                                                <input type="text" id="" class="form-control" name="member_1" placeholder="Member 1" required>
                                                <button type="button" class="btn btn-secondary px-3" id="add-member"><i class="bi bi-plus-lg "></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="member-form"></div>
                                    <input type="hidden" id="member-count" name="member_count" value="1">
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="confirmEmail">Research File</label>
                                        <small class="text-muted">(Formats: PDF | Max size: 20MB)</small>
                                        <input type="file" class="image-crop-filepond" image-crop-aspect-ratio="1:1" accept="application/pdf" data-max-file-size="20MB" data-max-files="1" name="file" required>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary form-control mt-3" id="submit_button">Import</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<script>
    const department = document.getElementById("department");
    const program = document.getElementById("program");
    const school_year = document.getElementById("school_year");
    const submit_button = document.getElementById("submit_button");

    department.addEventListener('change', function () {
        const department_id = this.value;

        for (let i = 0; i < program.options.length; i++) {
            const option = program.options[i];
            const program_dept_id = option.getAttribute("data-department-id");

            if (program_dept_id == department_id || !program_dept_id) {
                option.style.display = '';
                console.log(option);
            } else {
                option.style.display = 'none';
            }
        }
        program.value = '';
    });

    school_year.addEventListener('input', function () {
        const syPattern = /^\d{4}-\d{4}$/;
        if (syPattern.test(school_year.value)) {
            school_year.classList.remove("is-invalid");
            submit_button.disabled = false;
        } else {
            school_year.classList.add("is-invalid");
            submit_button.disabled = true;
        }
    });
</script>

<?= $this->endSection(); ?>