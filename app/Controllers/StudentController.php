<?php

namespace App\Controllers;
use App\Models\AgendaModel;
use App\Models\DepartmentModel;
use App\Models\LogsModel;
use App\Models\ProgramModel;
use App\Models\ThesisModel;
use App\Models\UserModel;

class StudentController extends BaseController
{
    public function DashboardPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'dashboard');
        return view('/StudentPages/Pages/dashboard');
    }

    public function ResearchThesisPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'research');
        $thesisModel = new ThesisModel();
        $thesis_approved = $thesisModel->where('is_approve', 1)->findAll();

        $departmentModel = new DepartmentModel();
        $department_list = $departmentModel->findAll();

        $programModel = new ProgramModel();
        $program_list = $programModel->findAll();

        $data = [
            'thesis_approved' => $thesis_approved,
            'departments' => $department_list,
            'programs' => $program_list
        ];

        return view('/StudentPages/Pages/research-thesis', $data);
    }

    public function ResearchImportPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'research');
        $thesisModel = new ThesisModel();
        $thesis_approved = $thesisModel->where('is_approve', 1)->findAll();

        $departmentModel = new DepartmentModel();
        $department_list = $departmentModel->findAll();

        $programModel = new ProgramModel();
        $program_list = $programModel->findAll();

        $agendaModel = new AgendaModel();
        $agenda_list = $agendaModel->findAll();

        $data = [
            'thesis_approved' => $thesis_approved,
            'departments' => $department_list,
            'programs' => $program_list,
            'agendas' => $agenda_list
        ];

        return view('/StudentPages/Pages/research-upload', $data);
    }

    public function ResearchLogsPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'research');
        $logsModel = new LogsModel();
        $logs_list = $logsModel->findAll();
        $user_logs = [];

        $thesisModel = new ThesisModel();
        $thesis_list = $thesisModel->where('uploaded_by', session()->get('logged_code'))->findAll();
        $user_thesis = [];

        foreach ($thesis_list as $thesis) {
            $thesis_id = $thesis['thesis_id'];
            $thesis_code = $thesis['thesis_code'];

            $user_thesis[] = [
                'thesis_id' => $thesis_id,
                'thesis_code' => $thesis_code,
            ];
        }
        

        foreach($logs_list as $logs){
            $log_user_id = $logs['user_id'];
            $log_user_type = $logs['user_type'];
            $log_full_name = $logs['full_name'];
            $log_thesis_id = $logs['thesis_id'];
            $log_thesis_code = $logs['thesis_code'];
            $log_description = $logs['description'];
            $log_status = $logs['status'];
            $log_date_created = $logs['date_created'];

            foreach($user_thesis as $thesis){
                if($thesis['thesis_code'] == $log_thesis_code){
                    $user_logs[] = [
                        'user_id' => $log_user_id,
                        'user_type' => $log_user_type,
                        'full_name' => $log_full_name,
                        'thesis_id' => $log_thesis_id,
                        'thesis_code' => $log_thesis_code,
                        'description' => $log_description,
                        'status' => $log_status,
                        'date_created' => $log_date_created,
                    ];
                }
            }
        }

        $data = [
            'logs' => $user_logs
        ];

        return view('/StudentPages/Pages/research-logs', $data);
    }

    public function ResearchCreate()
    {
        $generated_code = mt_rand(1, 9) . str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
        $rqst_department = $this->request->getPost('department');
        $rqst_program = $this->request->getPost('program');
        $rqst_agenda = $this->request->getPost('agenda');
        $rqst_year = $this->request->getPost('school_year');
        $rqst_title = $this->request->getPost('title');
        $rqst_member_count = $this->request->getPost('member_count');
        $rqst_file = $this->request->getFile('file');

        $members = [$this->request->getPost('member_1')];
        for ($i = 2; $i <= $rqst_member_count; $i++) {
            $member_name = $this->request->getPost("member_$i");
            if (!empty($member_name)) {
                $members[] = $member_name;
            }
        }
        $members_string = implode('|', $members);

        $folder = "/researchFiles";
        $directoryPath = FCPATH . $folder;

        if (!is_dir($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        if ($rqst_file && $rqst_file->isValid()) {
            $file_extension = $rqst_file->getClientExtension();
            $file_path = $folder . "/" . $generated_code . "." . $file_extension;
            $target_file_path = $directoryPath . "/" . $generated_code . "." . $file_extension;

            if (file_exists($target_file_path)) {
                unlink($target_file_path);
            }

            $rqst_file->move($directoryPath, $generated_code . "." . $file_extension);
        }

        $thesisModel = new ThesisModel();
        $thesis_data = [
            'thesis_code' => $generated_code,
            'department_id' => $rqst_department,
            'program_id' => $rqst_program,
            'agenda_id' => $rqst_agenda,
            'thesis_title' => $rqst_title,
            'members' => $members_string,
            'date_submitted' => $rqst_year,
            'file_path' => $file_path,
            'uploaded_by' => session()->get('logged_code'),
        ];
        $thesisModel->save($thesis_data);
        $thesis_id = $thesisModel->insertID();

        $logsModel = new LogsModel();
        $logs_data = [
            'user_id' => session()->get('logged_id'),
            'user_type' => session()->get('user_type'),
            'full_name' => session()->get('logged_fullname'),
            'thesis_id' => $thesis_id,
            'thesis_code' => $generated_code,
            'description' => "Thesis Uploaded: $rqst_title",
            'status' => "Pending"
        ];
        $logsModel->save($logs_data);
        session()->setFlashdata('success', 'Research Uploaded Successfully.');

        return redirect()->to('/StudentController/ResearchImportPage');
    }

    public function UpdateProfilePage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'profile');
        return view('/StudentPages/Pages/change-profile');
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

        return redirect()->to('/StudentController/UpdateProfilePage');
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

        return view('/StudentPages/Pages/change-email', $data);
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

        return view('/StudentPages/Pages/change-password', $data);
    }

    public function test()
    {
        $generated_code = mt_rand(1, 9) . str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
        echo $generated_code;
    }
}
