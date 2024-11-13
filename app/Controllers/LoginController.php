<?php

namespace App\Controllers;

use App\Models\DepartmentModel;
use App\Models\ProgramModel;
use App\Models\UserModel;

class LoginController extends BaseController
{
    public function UserTypePage()
    {
        return view('/UserTypePage/Pages/user-type');
    }

    public function LoginPage($user_type)
    {
        $rqst_username = $this->request->getPost('username');
        $rqst_password = $this->request->getPost('password');
        $rqst_check_login = $this->request->getPost('check_login');
        

        $_usernameError = false;
        $_passwordError = false;

        $userModel = new UserModel();
        $check_user = $userModel->where('username', $rqst_username)->where('user_type', $user_type)->where('is_approve', 1)->first();

        if ($check_user) {
            if (password_verify($rqst_password, $check_user['password'])) {
                if ($user_type == 3) {
                    $user_data = [
                        'is_logged' => true,
                        'logged_id' => $check_user['user_id'],
                        'logged_code' => $check_user['user_code'],
                        'logged_fullname' => $check_user['full_name'],
                        'logged_email' => $check_user['email'],
                        'logged_username' => $check_user['username'],
                        'logged_department' => $check_user['department_id'],
                        'logged_profile' => $check_user['profile_path'],
                        'user_type' => $check_user['user_type'],
                    ];
                    session()->set($user_data);
                    session()->setFlashdata('success', 'Successfully Logged In.');
                    return redirect()->to('/CoordinatorController/DashboardPage');
                } else if ($user_type == 2) {
                    $user_data = [
                        'is_logged' => true,
                        'logged_id' => $check_user['user_id'],
                        'logged_code' => $check_user['user_code'],
                        'logged_fullname' => $check_user['full_name'],
                        'logged_email' => $check_user['email'],
                        'logged_username' => $check_user['username'],
                        'logged_department' => $check_user['department_id'],
                        'logged_program' => $check_user['program_id'],
                        'logged_profile' => $check_user['profile_path'],
                        'user_type' => $check_user['user_type'],
                    ];
                    session()->set($user_data);
                    session()->setFlashdata('success', 'Successfully Logged In.');
                    return redirect()->to('/StudentController/DashboardPage');
                } else if ($user_type == 1) {
                    $user_data = [
                        'is_logged' => true,
                        'logged_id' => $check_user['user_id'],
                        'logged_code' => $check_user['user_code'],
                        'logged_fullname' => $check_user['full_name'],
                        'logged_email' => $check_user['email'],
                        'logged_username' => $check_user['username'],
                        'logged_profile' => $check_user['profile_path'],
                        'user_type' => $check_user['user_type'],
                    ];
                    session()->set($user_data);
                    session()->setFlashdata('success', 'Successfully Logged In.');
                    return redirect()->to('/AdminController/DashboardPage');
                }
            } else {
                $_passwordError = true;
                session()->setFlashdata('danger', 'Incorrect Password.');
            }
        } else {
            $_usernameError = true;
            $_passwordError = true;

            if ($rqst_check_login) {
                session()->setFlashdata('danger', 'Incorrect Username and Password.');
            }
        }

        $data = [
            'user_type_id' => $user_type,
            'username' => $rqst_username,
            'usernameError' => $_usernameError,
            'passwordError' => $_passwordError,
            'checkLogin' => $rqst_check_login,
        ];

        return view('/LoginPages/Pages/login', $data);
    }

    public function RegisterPage($user_type)
    {
        $rqst_full_name = $this->request->getPost('full_name');
        $rqst_department = $this->request->getPost('department');
        $rqst_program = $this->request->getPost('program');
        $rqst_email = $this->request->getPost('email');
        $rqst_username = $this->request->getPost('username');
        $rqst_password = $this->request->getPost('password');
        $hashed_password = password_hash($rqst_password, PASSWORD_BCRYPT);
        $rqst_check_register = $this->request->getPost('check_register');

        $_usernameError = false;

        $userModel = new UserModel();
        $check_username = $userModel->where('username', $rqst_username)->first();

        $departmentModel = new DepartmentModel();
        $department_list = $departmentModel->findAll();

        $programModel = new ProgramModel();
        $program_list = $programModel->findAll();

        $department_admin = $departmentModel->first();
        $department_id = $department_admin['department_id'];

        $program_admin = $programModel->first();
        $program_id = $program_admin['program_id'];

        $generated_code = mt_rand(1, 9) . str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);

        if ($rqst_check_register) {
            if (!$check_username) {
                if ($user_type == 3) {
                    $registration_data = [
                        'registration_user_code' => $generated_code,
                        'registration_full_name' => $rqst_full_name,
                        'registration_email' => $rqst_email,
                        'registration_username' => $rqst_username,
                        'registration_password' => $hashed_password,
                        'registration_department_id' => $rqst_department,
                        'registration_user_type' => $user_type,
                    ];
                    session()->set($registration_data);
                    return redirect()->to("/LoginController/SendOTP");
                } else if ($user_type == 2) {
                    $registration_data = [
                        'registration_user_code' => $generated_code,
                        'registration_full_name' => $rqst_full_name,
                        'registration_email' => $rqst_email,
                        'registration_username' => $rqst_username,
                        'registration_password' => $hashed_password,
                        'registration_department_id' => $rqst_department,
                        'registration_program_id' => $rqst_program,
                        'registration_user_type' => $user_type,
                    ];
                    session()->set($registration_data);
                    return redirect()->to("/LoginController/SendOTP");
                } else if ($user_type == 1) {
                    $registration_data = [
                        'registration_user_code' => $generated_code,
                        'registration_full_name' => $rqst_full_name,
                        'registration_email' => $rqst_email,
                        'registration_username' => $rqst_username,
                        'registration_password' => $hashed_password,
                        'registration_department_id' => $department_id,
                        'registration_program_id' => $program_id,
                        'registration_user_type' => $user_type,
                    ];
                    session()->set($registration_data);
                    return redirect()->to("/LoginController/SendOTP");
                }
            } else {
                $_usernameError = true;
            }
        }

        $data = [
            'departments' => $department_list,
            'programs' => $program_list,
            'userTypeId' => $user_type,
            'departmentId' => $rqst_department,
            'programId' => $rqst_program,
            'fullName' => $rqst_full_name,
            'email' => $rqst_email,
            'username' => $rqst_username,
            'usernameError' => $_usernameError,
            'checkRegister' => $rqst_check_register,
        ];

        return view('/LoginPages/Pages/register', $data);
    }

    public function SendOTP()
    {
        $generated_otp = mt_rand(100000, 999999);
        $email_address = session()->get('registration_email');
        $email_subject = 'OTP Verification Code';

        $templatePath = APPPATH . 'Views/LoginPages/Pages/otp-message.html';
        $email_message = file_get_contents($templatePath);
        $email_message = str_replace('{{otp_code}}', $generated_otp, $email_message);

        $emailService = \Config\Services::email();
        $emailService->setTo($email_address);
        $emailService->setSubject($email_subject);
        $emailService->setMessage($email_message);

        if ($emailService->send()) {
            session()->remove('email_account');
            session()->set('otp_code', $generated_otp);
            session()->setFlashdata('success', 'Verification Code Sent Successfully.');
        } else {
            session()->remove('email_account');
            session()->setFlashdata('danger', 'Verification Code Send Failed.');
        }

        return redirect()->to("/LoginController/OTPVerfication");
    }

    public function OTPVerfication()
    {
        $rqst_otp = $this->request->getPost('verification_code');
        $otp_code = session()->get('otp_code');
        $attempts = session()->get('otp_attempts') ?? 4;

        $generated_code = session()->get('registration_user_code');
        $rqst_full_name = session()->get('registration_full_name');
        $rqst_email = session()->get('registration_email');
        $rqst_username = session()->get('registration_username');
        $hashed_password = session()->get('registration_password');
        $rqst_department = session()->get('registration_department_id');
        $rqst_program = session()->get('registration_program_id');
        $user_type = session()->get('registration_user_type');

        if ($rqst_otp == $otp_code) {
            $userModel = new UserModel();
            if ($user_type == 3) {
                $registration_data = [
                    'user_code' => $generated_code,
                    'full_name' => $rqst_full_name,
                    'email' => $rqst_email,
                    'username' => $rqst_username,
                    'password' => $hashed_password,
                    'department_id' => $rqst_department,
                    'user_type' => $user_type,
                ];
                $userModel->save($registration_data);
            } else if ($user_type == 2) {
                $registration_data = [
                    'user_code' => $generated_code,
                    'full_name' => $rqst_full_name,
                    'email' => $rqst_email,
                    'username' => $rqst_username,
                    'password' => $hashed_password,
                    'department_id' => $rqst_department,
                    'program_id' => $rqst_program,
                    'user_type' => $user_type,
                ];
                $userModel->save($registration_data);
            } else if ($user_type == 1) {
                $registration_data = [
                    'user_code' => $generated_code,
                    'full_name' => $rqst_full_name,
                    'email' => $rqst_email,
                    'username' => $rqst_username,
                    'password' => $hashed_password,
                    'department_id' => $rqst_department,
                    'program_id' => $rqst_program,
                    'user_type' => $user_type,
                ];
                $userModel->save($registration_data);
            }

            $this->RemoveRegistrationSessions($user_type);
            session()->setFlashdata('success', 'Registered Successfully. Wait for Admin Approval.');
            return redirect()->to("/LoginController/LoginPage/$user_type");
        } else {
            $attempts--;
            session()->set('otp_attempts', $attempts);
            session()->setFlashdata('danger', 'Incorrect Validation Code.');
            if ($attempts < 1) {
                $this->RemoveRegistrationSessions($user_type);
                session()->setFlashdata('danger', 'Too many tries. Verification Failed.');
                return redirect()->to("/LoginController/LoginPage/$user_type");
            }
        }

        return view('/VerificationPage/Pages/otp-verification');
    }

    public function RemoveRegistrationSessions($user_type)
    {
        session()->remove([
            'registration_user_code',
            'registration_full_name',
            'registration_email',
            'registration_username',
            'registration_password',
            'registration_department_id',
            'registration_program_id',
            'registration_user_type',
            'otp_code',
            'otp_attempts'
        ]);
        return redirect()->to("/LoginController/LoginPage/$user_type");
    }

    public function ForgotPasswordPage()
    {
        return view('/LoginPages/Pages/forgot-password');
    }

    public function ResetPassword()
    {
        $rqst_username = $this->request->getPost('forgot_username');
        $rqst_email = $this->request->getPost('forgot_email');

        $userModel = new UserModel();
        $user = $userModel->where('username', $rqst_username)->first();

        if ($user) {
            if ($user['email'] === $rqst_email) {
                $user_id = $user['user_id'];
                $this->SendTemporaryPassword($user_id, $rqst_email);
                return redirect()->back();
            } else {
                session()->setFlashdata('danger', 'Email does not Match the Username.');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('danger', 'Username not Found.');
            return redirect()->back();
        }
    }

    public function SendTemporaryPassword($user_id, $email_address)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ!@_-?';
        $characters_length = strlen($characters);
        $temporary_password = '';

        for ($i = 0; $i < 8; $i++) {
            $temporary_password .= $characters[rand(0, $characters_length - 1)];
        }

        $email_subject = 'Temporary Password';
        $template_path = APPPATH . 'Views/LoginPages/Pages/forgot-message.html';
        $email_message = file_get_contents($template_path);
        $email_message = str_replace('{{temporary_password}}', $temporary_password, $email_message);

        $emailService = \Config\Services::email();
        $emailService->setTo($email_address);
        $emailService->setSubject($email_subject);
        $emailService->setMessage($email_message);

        $emailSent = $emailService->send();
        $hashed_password = password_hash($temporary_password, PASSWORD_BCRYPT);

        $userModel = new UserModel();
        $userModel->update($user_id, ['password' => $hashed_password]);

        if ($emailSent) {
            session()->setFlashdata('success', 'Temporary Password Sent Successfully.');
        } else {
            session()->setFlashdata('danger', 'Temporary Password Send Failed.');
        }

        return;
    }


    public function Logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
