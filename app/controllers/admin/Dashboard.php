<?php
class Dashboard extends Controller
{
    public function index()
    {
        $this->view('templates/header');
        $this->view('templates/navbar-admin');
        $this->view('admin/dashboard/index');
        $this->view('templates/footer');
    }
}
