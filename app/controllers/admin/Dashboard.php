<?php
class Dashboard extends Controller
{
    public function index()
    {
        $data['title'] = "Dashboard";
        $this->view('templates/header', $data);
        $this->view('templates/navbar-admin');
        $this->view('admin/dashboard/index');
        $this->view('templates/footer');
    }
}
