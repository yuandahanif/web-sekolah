<?php
     class landing extends Controller
     {
        public function index()
        {
            $data['title'] = 'SMK N TEMBARAK';
            $this->view('templates/header',$data);
            $this->view('landing');
            $this->view('templates/footer');
        }
     }
     