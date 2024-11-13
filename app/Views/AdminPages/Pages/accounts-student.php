<?= $this->extend('/AdminPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<style>
    #modal-user-email:hover {
        text-decoration: underline;
    }
</style>

<div id="main-content">
    <div class="page-heading mb-3">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Student Accounts</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Accounts</li>
                            <li class="breadcrumb-item active">Student</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-header mb-0 pb-0 text-center">
                <h5>Students</h5>
            </div>

            <hr class="mt-1">

            <div class="card-body">
                <div class="table-responsive table-hover table-bordered ">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Email Adrress</th>
                                <th>Username</th>
                                <th>Institute</th>
                                <th>Program</th>
                                <th>Date Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($students as $user): ?>
                                <tr>
                                    <td><?= $user['full_name'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= $user['username'] ?></td>
                                    <td>
                                        <?php
                                        foreach ($departments as $department):
                                            if ($user['department_id'] == $department['department_id']) {
                                                echo $department['department_code'];
                                                $department = $department['department_code'];
                                                break;
                                            }
                                        endforeach;
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        foreach ($programs as $program):
                                            if ($user['program_id'] == $program['program_id']) {
                                                echo $program['program_name'];
                                                $program = $program['program_name'];
                                                break;
                                            }
                                        endforeach;
                                        ?>
                                    </td>
                                    <td><?= $user['date_created'] ?></td>
                                    <td>
                                        <div class="">
                                            <button class="btn btn-primary btn-sm dropdown-toggle me-1" type="button" id="dropdownMenuButtonIcon" data-bs-toggle="dropdown">
                                                <i class="bi bi-error-circle"></i> Actions
                                            </button>
                                            <div class="dropdown-menu shadow-lg">
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#view_profile_modal" data-user-picture="<?= $user['profile_path'] ?>" data-user-id="<?= $user['user_code'] ?>" data-user-name="<?= $user['full_name'] ?>" data-user-email="<?= $user['email'] ?>" data-user-program="<?= $program ?>" data-user-department="<?= $department ?>" data-user-date="<?= $user['date_created'] ?>">
                                                    <i class="bi bi-eye me-3"></i> View</a>

                                                <a class="dropdown-item" href="/AdminController/AccountDelete/<?= $user['user_id'] ?>/2" onclick="return confirm('Are you sure you want to delete this program? This action cannot be undone.');">
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

        <div class="modal fade" id="view_profile_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="mx-3 mt-3">
                            <h2 id="modal-user-id"></h2>
                            <small class="text-muted mb-0">Showing the profile information of a user.</small>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>


                    <div class="modal-body m-3">
                        <div class="text-center mb-3">
                            <img id="modal-user-picture" src="" class="rounded-circle mx-auto mb-3" style="width: 30%; object-fit: cover; aspect-ratio: 1/1;">
                            <h1 id="modal-user-name"></h1>
                            <a href="#" class="h5" id="modal-user-email"></a><br>
                            <div class="message"></div>
                            <p id="modal-user-department-program" class="mt-2 mb-0"></p><br>
                            <small id="modal-user-date"></small>
                        </div>
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
        var updateModal = document.getElementById('view_profile_modal');
        updateModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;

            var userId = button.getAttribute('data-user-id');
            var userName = button.getAttribute('data-user-name');
            var userEmail = button.getAttribute('data-user-email');
            var userDate = button.getAttribute('data-user-date');
            var userPicture = button.getAttribute('data-user-picture');
            var userDepartment = button.getAttribute('data-user-department');
            var userProgram = button.getAttribute('data-user-program');

            var modaluserId = updateModal.querySelector('#modal-user-id');
            var modaluserName = updateModal.querySelector('#modal-user-name');
            var modaluserEmail = updateModal.querySelector('#modal-user-email');
            var modaluserDate = updateModal.querySelector('#modal-user-date');
            var modaluserPicture = updateModal.querySelector('#modal-user-picture');
            var modaluserDepartmentProgram = updateModal.querySelector('#modal-user-department-program');

            modaluserId.textContent = "Student #" + userId;
            modaluserName.textContent = userName;
            modaluserEmail.textContent = userEmail;
            modaluserDate.textContent = "Date Created: " + userDate;
            modaluserPicture.src = userPicture;
            modaluserDepartmentProgram.textContent = userDepartment + " | " + userProgram;
        });
    });

    const modalEmail = document.getElementById('modal-user-email');
    const messageDiv = document.querySelector('.message');

    modalEmail.addEventListener('click', () => {
        // Copy the email to the clipboard
        navigator.clipboard.writeText(modalEmail.textContent)
            .then(() => {
                // Check if the copied message already exists
                let copiedMessage = document.getElementById('copied-message');

                // If it doesn't exist, create it
                if (!copiedMessage) {
                    copiedMessage = document.createElement('small');
                    copiedMessage.id = 'copied-message';
                    copiedMessage.className = 'd-none text-success m-0';
                    copiedMessage.textContent = 'Copied!';

                    // Append the new element inside the message div
                    messageDiv.appendChild(copiedMessage);
                }

                // Show the "Copied!" message
                copiedMessage.classList.remove('d-none');

                // Hide the message after 2 seconds
                setTimeout(() => {
                    copiedMessage.classList.add('d-none');
                }, 2000);
            })
            .catch(err => console.error('Failed to copy: ', err));
    });
</script>

<?= $this->endSection(); ?>