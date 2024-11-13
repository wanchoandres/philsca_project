<?php

namespace App\Controllers;

use App\Models\AgendaModel;
use App\Models\DepartmentModel;
use App\Models\LogsModel;
use App\Models\ProgramModel;
use App\Models\ThesisModel;
use App\Models\UserModel;

class AdminController extends BaseController
{
    public function DashboardPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'dashboard');
        return view('/AdminPages/Pages/dashboard');
    }

    public function DepartmentPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'department');

        $departmentModel = new DepartmentModel();
        $department_list = $departmentModel->findAll();

        $data = [
            'departments' => $department_list,
        ];

        return view('AdminPages/Pages/department', $data);
    }

    public function DepartmentCreate()
    {
        $rqst_department_code = $this->request->getPost('department_code');
        $rqst_department_name = $this->request->getPost('department_name');

        $departmentModel = new DepartmentModel();
        $department_data = [
            'department_name' => $rqst_department_name,
            'department_code' => $rqst_department_code,
        ];
        $departmentModel->save($department_data);

        session()->setFlashdata('success', 'New Department Added Successfully.');
        return redirect()->to('/AdminController/DepartmentPage');
    }

    public function DepartmentDelete($department_id)
    {
        $programModel = new ProgramModel();
        $relation_program = $programModel->where('department_id', $department_id)->findAll();

        $userModel = new UserModel();
        $relation_user = $userModel->where('department_id', $department_id)->findAll();

        $thesisModel = new ThesisModel();
        $relation_thesis = $thesisModel->where('department_id', $department_id)->findAll();

        if (!$relation_program && !$relation_user && !$relation_thesis) {
            $departmentModel = new DepartmentModel();
            $departmentModel->delete($department_id);

            session()->setFlashdata('success', 'Department Deleted Successfully.');
        } else {
            session()->setFlashdata('danger', 'Department Deletion Failed.');
        }

        return redirect()->to('/AdminController/DepartmentPage');
    }

    public function DepartmentUpdate()
    {
        $rqst_department_id = $this->request->getPost('department_id');
        $rqst_department_code = $this->request->getPost('department_code');
        $rqst_department_name = $this->request->getPost('department_name');

        $departmentModel = new DepartmentModel();
        $department_data = [
            'department_code' => $rqst_department_code,
            'department_name' => $rqst_department_name,
        ];

        $update = $departmentModel->update($rqst_department_id, $department_data);
        if ($update) {
            session()->setFlashdata('success', 'Department Updated Successfully.');
        } else {
            session()->setFlashdata('danger', 'Department Update Failed.');
        }

        session()->setFlashdata('success', 'Department Updated Successfully.');
        return redirect()->to('/AdminController/DepartmentPage');
    }

    public function ProgramPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'program');

        $programModel = new ProgramModel();
        $program_list = $programModel->findAll();

        $departmentModel = new DepartmentModel();
        $department_list = $departmentModel->findAll();

        $data = [
            'programs' => $program_list,
            'departments' => $department_list
        ];

        return view('AdminPages/Pages/program', $data);
    }

    public function ProgramCreate()
    {
        $rqst_department_id = $this->request->getPost('department_id');
        $rqst_program_code = $this->request->getPost('program_code');
        $rqst_program_name = $this->request->getPost('program_name');

        $departmentModel = new DepartmentModel();
        $department = $departmentModel->where('department_id', $rqst_department_id)->first();
        $department_name = $department['department_name'];

        $programModel = new ProgramModel();
        $program_data = [
            'department_id' => $rqst_department_id,
            'department_name' => $department_name,
            'program_code' => $rqst_program_code,
            'program_name' => $rqst_program_name,
        ];
        $programModel->save($program_data);

        session()->setFlashdata('success', 'New Program Added Successfully.');
        return redirect()->to('/AdminController/ProgramPage');
    }

    public function ProgramDelete($program_id)
    {
        $userModel = new UserModel();
        $relation_user = $userModel->where('program_id', $program_id)->findAll();

        $thesisModel = new ThesisModel();
        $relation_thesis = $thesisModel->where('program_id', $program_id)->findAll();


        if (!$relation_user && !$relation_thesis) {
            $programModel = new ProgramModel();
            $programModel->delete($program_id);

            session()->setFlashdata('success', 'Program Deleted Successfully.');
        } else {
            session()->setFlashdata('danger', 'Program Deletion Failed.');
        }

        return redirect()->to('/AdminController/ProgramPage');
    }

    public function ProgramUpdate()
    {
        $rqst_program_id = $this->request->getPost('program_id');
        $rqst_department_id = $this->request->getPost('department_id');
        $rqst_program_code = $this->request->getPost('program_code');
        $rqst_program_name = $this->request->getPost('program_name');

        $departmentModel = new DepartmentModel();
        $department = $departmentModel->where('department_id', $rqst_department_id)->first();
        $department_name = $department['department_name'];

        $programModel = new ProgramModel();
        $program_data = [
            'department_id' => $rqst_department_id,
            'department_name' => $department_name,
            'program_code' => $rqst_program_code,
            'program_name' => $rqst_program_name,
        ];

        $update = $programModel->update($rqst_program_id, $program_data);

        if ($update) {
            session()->setFlashdata('success', 'Program Updated Successfully.');
        } else {
            session()->setFlashdata('danger', 'Program Update Failed.');
        }

        return redirect()->to('/AdminController/ProgramPage');
    }

    public function AgendaPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'agenda');

        $agendaModel = new AgendaModel();
        $agenda_list = $agendaModel->findAll();

        $ProgramModel = new ProgramModel();
        $program_list = $ProgramModel->findAll();

        $data = [
            'agendas' => $agenda_list,
            'programs' => $program_list,
        ];

        return view('AdminPages/Pages/agenda', $data);
    }

    public function AgendaCreate()
    {
        $rqst_agenda_code = $this->request->getPost('agenda_code');
        $rqst_agenda_name = $this->request->getPost('agenda_name');
        $rqst_program_id = $this->request->getPost('program_id');

        $ProgramModel = new ProgramModel();
        $program = $ProgramModel->where('program_id', $rqst_program_id)->first();
        $program_code = $program['program_code'];

        $agendaModel = new AgendaModel();
        $agenda_data = [
            'agenda_name' => $rqst_agenda_name,
            'agenda_code' => $rqst_agenda_code,
            'program_id' => $rqst_program_id,
            'program_code' => $program_code,
        ];
        $agendaModel->save($agenda_data);

        session()->setFlashdata('success', 'New Agenda Added Successfully.');
        return redirect()->to('/AdminController/AgendaPage');
    }

    public function AgendaDelete($agenda_id)
    {
        $thesisModel = new ThesisModel();
        $relation_thesis = $thesisModel->where('agenda_id', $agenda_id)->findAll();

        if (!$relation_thesis) {
            $agendaModel = new AgendaModel();
            $agendaModel->delete($agenda_id);

            session()->setFlashdata('success', 'Agenda Deleted Successfully.');
        } else {
            session()->setFlashdata('danger', 'Agenda Deletion Failed.');
        }

        return redirect()->to('/AdminController/AgendaPage');
    }

    public function AgendaUpdate()
    {
        $rqst_agenda_id = $this->request->getPost('agenda_id');
        $rqst_agenda_code = $this->request->getPost('agenda_code');
        $rqst_agenda_name = $this->request->getPost('agenda_name');
        $rqst_program_id = $this->request->getPost('program_id');

        $ProgramModel = new ProgramModel();
        $program = $ProgramModel->where('program_id', $rqst_program_id)->first();
        $program_code = $program['program_code'];

        $agendaModel = new AgendaModel();
        $agenda_data = [
            'agenda_code' => $rqst_agenda_code,
            'agenda_name' => $rqst_agenda_name,
            'program_id' => $rqst_program_id,
            'program_code' => $program_code,
        ];

        try {
            // Attempt to update the department record
            $update = $agendaModel->update($rqst_agenda_id, $agenda_data);

            if ($update) {
                session()->setFlashdata('success', 'Department Updated Successfully.');
            } else {
                session()->setFlashdata('danger', 'Department Update Failed.');
            }
        } catch (\Exception $e) {
            // Catch any exceptions and handle them (e.g., database errors)
            session()->setFlashdata('danger', 'Department Update Failed: ' . $e->getMessage());
        }

        return redirect()->to('/AdminController/AgendaPage');
    }

    public function ResearchThesisPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'research');

        $thesisModel = new ThesisModel();
        $thesis_pending = $thesisModel->where('is_approve', 0)->findAll();
        $thesis_approved = $thesisModel->where('is_approve', 1)->findAll();
        $thesis_rejected = $thesisModel->where('is_approve', 3)->findAll();

        $departmentModel = new DepartmentModel();
        $department_list = $departmentModel->findAll();

        $programModel = new ProgramModel();
        $program_list = $programModel->findAll();

        $data = [
            'thesis_approved' => $thesis_approved,
            'thesis_pending' => $thesis_pending,
            'thesis_rejected' => $thesis_rejected,
            'departments' => $department_list,
            'programs' => $program_list
        ];

        return view('AdminPages/Pages/research-thesis', $data);
    }

    public function ResearchArchivePage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'research');

        $thesisModel = new ThesisModel();
        $thesis_archive = $thesisModel->where('is_approve', 2)->findAll();

        $departmentModel = new DepartmentModel();
        $department_list = $departmentModel->findAll();

        $programModel = new ProgramModel();
        $program_list = $programModel->findAll();

        $data = [
            'thesis_archive' => $thesis_archive,
            'departments' => $department_list,
            'programs' => $program_list
        ];

        return view('AdminPages/Pages/research-archive', $data);
    }

    public function ResearchThesisApprove($thesis_id)
    {
        $thesisModel = new ThesisModel();
        $thesisModel->update($thesis_id, ['is_approve' => 1]);
        $thesis = $thesisModel->where('thesis_id', $thesis_id)->first();
        $thesis_code = $thesis['thesis_code'];
        $thesis_title = $thesis['thesis_title'];

        $logsModel = new LogsModel();
        $logs_data = [
            'user_id' => session()->get('logged_id'),
            'user_type' => session()->get('user_type'),
            'thesis_id' => $thesis_id,
            'thesis_code' => $thesis_code,
            'full_name' => session()->get('logged_fullname'),
            'description' => "Congratulations, '$thesis_title' is Approved",
            'status' => "Approved"
        ];
        $logsModel->save($logs_data);

        session()->setFlashdata('success', 'Research Approve Successfully.');
        return redirect()->to("/AdminController/ResearchThesisPage");
    }

    public function ResearchThesisReject()
    {
        $thesis_id = $this->request->getPost('thesis_id');
        $remark_message = $this->request->getPost('remark');

        $thesisModel = new ThesisModel();
        $thesisModel->update($thesis_id, ['is_approve' => 3, 'reject_remark' => $remark_message]);
        $thesis = $thesisModel->where('thesis_id', $thesis_id)->first();
        $thesis_code = $thesis['thesis_code'];
        $thesis_title = $thesis['thesis_title'];

        $logsModel = new LogsModel();
        $logs_data = [
            'user_id' => session()->get('logged_id'),
            'user_type' => session()->get('user_type'),
            'thesis_id' => $thesis_id,
            'thesis_code' => $thesis_code,
            'full_name' => session()->get('logged_fullname'),
            'description' => "Your thesis '$thesis_title' has been Rejected. Remark: $remark_message",
            'status' => "Rejected"
        ];
        $logsModel->save($logs_data);

        session()->setFlashdata('success', 'Research Rejected Successfully.');
        return redirect()->to("/AdminController/ResearchThesisPage");
    }

    public function ResearchThesisArchive($thesis_id)
    {
        $thesisModel = new ThesisModel();
        $thesisModel->update($thesis_id, ['is_approve' => 2]);

        $thesis = $thesisModel->where('thesis_id', $thesis_id)->first();
        $thesis_title = $thesis['thesis_title'];

        $logsModel = new LogsModel();
        $logs_data = [
            'user_id' => session()->get('logged_id'),
            'user_type' => session()->get('user_type'),
            'full_name' => session()->get('logged_fullname'),
            'description' => "Thesis Archived: $thesis_title",
            'status' => "Rejected"
        ];
        $logsModel->save($logs_data);

        session()->setFlashdata('success', 'Research Archived Successfully.');
        return redirect()->to("/AdminController/ResearchThesisPage");
    }

    public function ResearchThesisRestore($thesis_id)
    {
        $thesisModel = new ThesisModel();
        $thesisModel->update($thesis_id, ['is_approve' => 1]);

        $thesis = $thesisModel->where('thesis_id', $thesis_id)->first();
        $thesis_title = $thesis['thesis_title'];

        $logsModel = new LogsModel();
        $logs_data = [
            'user_id' => session()->get('logged_id'),
            'user_type' => session()->get('user_type'),
            'full_name' => session()->get('logged_fullname'),
            'description' => "Restored: $thesis_title",
            'status' => "Rejected"
        ];
        $logsModel->save($logs_data);

        // flashdata = Restore Successfully
        session()->setFlashdata('success', 'Research Restored Successfully.');
        return redirect()->to("/AdminController/ResearchArchivePage");
    }

    public function ResearchAnalyticsPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'research');

        $departmentModel = new DepartmentModel();
        $department_count = $departmentModel->countAll();
        $department_list = $departmentModel->findAll();
        $department_analytics = [];

        $agendaModel = new AgendaModel();
        $agenda_count = $agendaModel->countAll();
        $agenda_list = $agendaModel->findAll();
        $agenda_analytics = [];

        $programModel = new ProgramModel();
        $program_count = $programModel->countAll();
        $program_list = $programModel->findAll();
        $program_analytics = [];

        $thesisModel = new ThesisModel();
        $thesis_count = $thesisModel->where('is_approve', 1)->countAllResults();


        foreach ($department_list as $department) {
            $department_id = $department['department_id'];
            $department_name = $department['department_name'];
            $department_code = $department['department_code'];

            $department_thesis_count = $thesisModel->where('department_id', $department_id)->where('is_approve', 1)->countAllResults();

            $department_analytics[] = [
                'department_id' => $department_id,
                'department_name' => $department_name,
                'department_code' => $department_code,
                'department_thesis_count' => $department_thesis_count
            ];
        }

        foreach ($agenda_list as $agenda) {
            $agenda_id = $agenda['agenda_id'];
            $agenda_name = $agenda['agenda_name'];
            $agenda_code = $agenda['agenda_code'];
            $program_code = $agenda['program_code'];

            $agenda_thesis_count = $thesisModel->where('agenda_id', $agenda_id)->where('is_approve', 1)->countAllResults();

            $agenda_analytics[] = [
                'agenda_id' => $agenda_id,
                'agenda_name' => $agenda_name,
                'agenda_code' => $agenda_code,
                'program_code' => $program_code,
                'agenda_thesis_count' => $agenda_thesis_count
            ];
        }

        foreach ($program_list as $program) {
            $program_id = $program['program_id'];
            $program_name = $program['program_name'];
            $program_code = $program['program_code'];

            $program_thesis_count = $thesisModel->where('program_id', $program_id)->where('is_approve', 1)->countAllResults();

            $program_analytics[] = [
                'program_id' => $program_id,
                'program_name' => $program_name,
                'program_code' => $program_code,
                'program_thesis_count' => $program_thesis_count
            ];
        }

        $data = [
            'thesis_count' => $thesis_count,
            'department_count' => $department_count,
            'department_analytics' => $department_analytics,
            'agenda_count' => $agenda_count,
            'agenda_analytics' => $agenda_analytics,
            'program_count' => $program_count,
            'program_analytics' => $program_analytics,
        ];

        return view('AdminPages/Pages/research-analytics', $data);
    }

    public function AccountsAdministratorPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'accounts');

        $userModel = new UserModel();
        $user_administrator_list = $userModel->where('user_type', 1)->findAll();

        $data = [
            'administrators' => $user_administrator_list,
        ];

        return view('AdminPages/Pages/accounts-administrator', $data);
    }

    public function AccountsStudentPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'accounts');

        $userModel = new UserModel();
        $user_student_list = $userModel->where('user_type', 2)->where('is_approve', 1)->findAll();

        $departmentModel = new DepartmentModel();
        $department_list = $departmentModel->findAll();

        $programModel = new ProgramModel();
        $program_list = $programModel->findAll();

        $data = [
            'students' => $user_student_list,
            'departments' => $department_list,
            'programs' => $program_list,
        ];

        return view('AdminPages/Pages/accounts-student', $data);
    }

    public function AccountsCoordinatorPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'accounts');

        $userModel = new UserModel();
        $user_coordinator_list = $userModel->where('user_type', 3)->where('is_approve', 1)->findAll();

        $departmentModel = new DepartmentModel();
        $department_list = $departmentModel->findAll();

        $programModel = new ProgramModel();
        $program_list = $programModel->findAll();

        $data = [
            'coordinators' => $user_coordinator_list,
            'departments' => $department_list,
            'programs' => $program_list,
        ];

        return view('AdminPages/Pages/accounts-coordinator', $data);
    }

    public function AccountsPendingPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'accounts');

        $userModel = new UserModel();
        $user_pending_list = $userModel->where('is_approve', 0)->findAll();

        $departmentModel = new DepartmentModel();
        $department_list = $departmentModel->findAll();

        $programModel = new ProgramModel();
        $program_list = $programModel->findAll();

        $data = [
            'pendings' => $user_pending_list,
            'departments' => $department_list,
            'programs' => $program_list,
        ];

        return view('AdminPages/Pages/accounts-pending', $data);
    }

    public function AccountDelete($user_id, $user_type)
    {
        $userModel = new UserModel();
        $userModel->delete($user_id);

        if ($user_type = 1) {
            $accounts_page = "AccountsAdministratorPage";
        } else if ($user_type = 2) {
            $accounts_page = "AccountsStudentPage";
        } else if ($user_type = 3) {
            $accounts_page = "??";
        }

        session()->setFlashdata('success', 'Account Deleted Successfully.');
        return redirect()->to("/AdminController/$accounts_page");
    }

    public function AccountApprove($user_id)
    {
        $userModel = new UserModel();
        $userModel->update($user_id, ['is_approve' => 1]);

        session()->setFlashdata('success', 'Account Approved Successfully.');
        return redirect()->to("/AdminController/AccountsPendingPage");
    }

    public function AccountDecline($user_id)
    {
        $userModel = new UserModel();
        $userModel->update($user_id, ['is_approve' => 2]);

        session()->setFlashdata('success', 'Account Declined Successfully.');
        return redirect()->to("/AdminController/AccountsPendingPage");
    }


    public function UpdateProfilePage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'profile');
        return view('/AdminPages/Pages/change-profile');
    }

    public function ProfileUpdate()
    {
        $user_id = session()->get('logged_id');
        $rqst_name = $this->request->getPost('new_name');
        $rqst_file = $this->request->getFile('new_profile');

        $image_path = "/profilePictures";
        $directoryPath = FCPATH . $image_path;

        if (!is_dir($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        $userModel = new UserModel();
        if ($rqst_name) {
            if ($userModel->update($user_id, ['full_name' => $rqst_name])) {
                session()->set('logged_fullname', $rqst_name);
                session()->setFlashdata('success', 'Account Updated Successfully.');
            }
        }

        if ($rqst_file && $rqst_file->isValid()) {
            $file_extension = $rqst_file->getClientExtension();
            $new_filename = session()->get('logged_code') . '.' . $file_extension;
            $profile_path = $image_path . "/$new_filename";
            $target_file_path = $directoryPath . "/" . $new_filename;

            if (file_exists($target_file_path)) {
                unlink($target_file_path);
            }

            if ($userModel->update($user_id, ['profile_path' => $profile_path])) {
                session()->set('logged_profile', $profile_path);
                $rqst_file->move($directoryPath, $new_filename);
            }
        }

        return redirect()->to('/AdminController/UpdateProfilePage');
    }


    public function ChangeEmailPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'email');

        $rqst_new_email = $this->request->getPost('new_email');
        $rqst_check = $this->request->getPost('email_check');

        $is_email_error = false;

        if ($rqst_check) {
            $userModel = new UserModel();
            $user_id = session()->get('logged_id');
            $email_check = $userModel->where('user_id', $user_id)->first();

            if ($email_check) {
                session()->setFlashdata('success', 'Change Email Successfully.');
                $userModel->update($user_id, ['email' => $rqst_new_email]);
            } else {
                $is_email_error = true;
                session()->setFlashdata('danger', 'Change Email Failed.');
            }
        }

        $data = [
            'isPasswordError' => $is_email_error,
            'isPasswordCheck' => $rqst_check
        ];

        return view('/AdminPages/Pages/change-email', $data);
    }

    public function ChangePasswordPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'password');

        $rqst_new = $this->request->getPost('new_password');
        $hashedPassword = password_hash($rqst_new, PASSWORD_BCRYPT);
        $rqst_currrent = $this->request->getPost('old_password');
        $rqst_check = $this->request->getPost('password_check');

        $is_password_error = false;

        if ($rqst_check) {
            $userModel = new UserModel();
            $user_id = session()->get('logged_id');
            $user_data = $userModel->where('user_id', $user_id)->first();

            if (password_verify($rqst_currrent, $user_data['password'])) {
                session()->setFlashdata('success', 'Change Password Successfully.');
                $userModel->update($user_id, ['password' => $hashedPassword]);
            } else {
                $is_password_error = true;
                session()->setFlashdata('danger', 'Change Password Failed.');
            }
        }

        $data = [
            'isPasswordError' => $is_password_error,
            'isPasswordCheck' => $rqst_check
        ];

        return view('/AdminPages/Pages/change-password', $data);
    }

    public function DevelopersPage()
    {
        session()->set('nav_active', 'developers');
        return view('/AdminPages/Pages/developers');
    }


}
