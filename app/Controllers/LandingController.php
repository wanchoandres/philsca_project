<?php

namespace App\Controllers;
use App\Models\DepartmentModel;
use App\Models\ProgramModel;
use App\Models\ThesisModel;

class LandingController extends BaseController
{
    public function LandingPage()
    {
        return view('/LandingPage/Pages/landing_page');
    }

    public function LibraryPage()
    {
        $thesisModel = new ThesisModel();
        $thesis_pending = $thesisModel->where('is_approve', 0)->findAll();
        $thesis_approved = $thesisModel->where('is_approve', 1)->findAll();

        $departmentModel = new DepartmentModel();
        $department_list = $departmentModel->findAll();

        $programModel = new ProgramModel();
        $program_list = $programModel->findAll();

        $data = [
            'thesis_approved' => $thesis_approved,
            'thesis_pending' => $thesis_pending,
            'departments' => $department_list,
            'programs' => $program_list
        ];

        return view('/ResearchLibraryPage/Pages/library', $data);
    }
}
