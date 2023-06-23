<?php

class Auth extends Controller
{

    public function index()
    {
        $this->view('auth/login');
    }

    public function login()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: POST");
        header('Content-Type: application/json');
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods");

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $out = array('error' => false);
                if (empty($_POST['username'])) {
                    $out['error'] = true;
                    $out['message'] = 'Username is required';
                } else if (empty($_POST['password'])) {
                    $out['error'] = true;
                    $out['message'] = 'Password is required';
                } else {
                    $auth = $this->model('Auth_model')->login($_POST);
                    foreach ($auth as $key => $val) {
                        $out[$key] = $val;
                    }

                    // if validate pass
                    if ($out['error'] != true) {
                        // set session 
                        $_SESSION['logged_in'] = $auth['data']['username'];
                        $_SESSION['name'] = $auth['data']['name'];
                    }
                }
                echo json_encode($out);
                break;
            default:
                http_response_code(405);
                echo json_encode(array("message" => "REQUEST METHOD NOT ALLOWED"));
                break;
        }
    }
    public function logout()
    {
        session_destroy();
        session_unset();
        header('Location: ' . BASEURL . 'auth');
    }
}
