<?php
class Profile extends Controller
{
    public function index()
    {
        $this->view('templates/header');
        $this->view('templates/navbar-admin');
        $this->view('admin/profile/index');
        $this->view('templates/footer');
    }

    public function info()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET");
        header('Content-Type: application/json');
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods");

        if (!isset($_SESSION['logged_in']) && !isset($_SESSION['name'])) {
            http_response_code(401);
            echo json_encode(array(
                'message' => 'Unauthorized',
                'data' => array(),
                'error' => true
            ));
        } else {
            http_response_code(200);
            echo json_encode(array(
                'message' => 'Ok',
                'data' => array(
                    'username' => $_SESSION['logged_in'],
                    'fullname' => $_SESSION['name']
                ),
                'error' => false
            ));
        }
    }

    public function update()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: PUT");
        header('Content-Type: application/json');
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods");

        $requestMethod = $_SERVER['REQUEST_METHOD'];

        switch ($requestMethod) {
            case 'PUT':
                $data = json_decode(file_get_contents('php://input'));

                $out = array('error' => false);
                if (empty($data->fullname)) {
                    $out['message'] = 'Fullname is required';
                    $out['error'] = true;
                } else {
                    $data = array(
                        'username' => $_SESSION['logged_in'],
                        'nama' => $data->fullname
                    );
                    $updateProfile = $this->model('Admin_model')->update($data);

                    foreach ($updateProfile as $key => $val) {
                        $out[$key] = $val;
                    }

                    // if validate pass
                    if ($out['error'] != true) {
                        // set session 
                        $_SESSION['logged_in'] = $out['data']['username'];
                        $_SESSION['name'] = $out['data']['name'];
                    }
                }
                echo json_encode($out);
                break;
            default:
                http_response_code(405);
                echo json_encode(array(
                    "message" => "REQUEST METHOD NOT ALLOWED",
                    "error" => true
                ));
                break;
        }
    }

    public function changePassword()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: PUT");
        header('Content-Type: application/json');
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods");

        $requestMethod = $_SERVER['REQUEST_METHOD'];

        switch ($requestMethod) {
            case 'PUT':
                $data = json_decode(file_get_contents('php://input'));

                $out = array('error' => false);
                if (empty($data->old_password)) {
                    $out['message'] = 'Old Password is required';
                    $out['error'] = true;
                } else if (empty($data->new_password)) {
                    $out['message'] = 'New Password is required';
                    $out['error'] = true;
                } else if (empty($data->confirm_password)) {
                    $out['message'] = 'Confirm Password is required';
                    $out['error'] = true;
                } else {
                    if ($data->old_password === $data->new_password) {
                        $out['message'] = "New password can't be the same as the old password";
                        $out['error'] = true;
                    } else if ($data->new_password != $data->confirm_password) {
                        $out['message'] = 'New Password and Confirm Passsword not same';
                        $out['error'] = true;
                    } else {
                        $length_password = 8;
                        if (strlen($data->new_password) < $length_password) {
                            $out['message'] = "Minimum password length is {$length_password}";
                            $out['error'] = true;
                        } else {
                            $data = array(
                                'username' => $_SESSION['logged_in'],
                                'old_password' => $data->old_password,
                                'new_password' => $data->new_password
                            );
                            $changePassword = $this->model('Admin_model')->changePassword($data);

                            foreach ($changePassword as $key => $val) {
                                $out[$key] = $val;
                            }
                        }
                    }
                }
                echo json_encode($out);
                break;
            default:
                http_response_code(405);
                echo json_encode(array(
                    "message" => "REQUEST METHOD NOT ALLOWED",
                    "error" => true
                ));
                break;
        }
    }
}
