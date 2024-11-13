<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;


class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $is_logged = session()->get('is_logged');
        $user_type = session()->get('user_type');

        $uri = $request->getUri();
        $firstSegment = $uri->getSegment(1);
        $controller = strtolower($firstSegment);

        if (!$controller) {
            return redirect()->to('/LandingController/LandingPage');
        } else {
            if ($is_logged) {
                if ($user_type == 1) {
                    if ($controller !== 'admincontroller') {
                        session()->setFlashdata('danger', 'Unauthorized access.');
                        return redirect()->back();
                    }
                } else if ($user_type == 2) {
                    if ($controller !== 'studentcontroller') {
                        session()->setFlashdata('danger', 'Unauthorized access.');
                        return redirect()->back();
                    }
                } else if ($user_type == 3) {
                    if ($controller !== 'coordinatorcontroller') {
                        session()->setFlashdata('danger', 'Unauthorized access.');
                        return redirect()->back();
                    }
                }
            } else {
                if ($controller != 'landingcontroller' && $controller != 'logincontroller') {
                    session()->setFlashdata('danger', 'Unauthorized access.');
                    return redirect()->to('/LandingController/LandingPage');
                }
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}
