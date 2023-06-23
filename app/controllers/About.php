<?php

class About extends Controller
{
    public function index()
    {
        $this->view('templates/header');
        $this->view('templates/navbar');
        $this->view('about/index');
        $this->view('templates/footer');
    }
}
