<?php
class signup extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->database();
        $this->load->model('user_model');
    }

    function index()
    {
        // set form validation rules
        // $this->form_validation->set_rules('fname', 'First Name', 'trim|required|alpha|min_length[3]|max_length[30]|xss_clean');
        // $this->form_validation->set_rules('lname', 'Last Name', 'trim|required|alpha|min_length[3]|max_length[30]|xss_clean');
        // $this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email|is_unique[user.email]');
        // $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[cpassword]|md5');
        // $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required');

        $valid = false;
        if($this->input->post()){
            $fio = $this->input->post('fio');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $password = $this->input->post('password');
            $cpassword = $this->input->post('cpassword');

            $valid = $this->validate($fio, $email, $phone, $password, $cpassword);
            
        }
        // submit
        if (! $valid) //$this->form_validation->run() == FALSE
        {
            // fails
            $this->load->view('signup_view');
        }
        else
        {
            //insert user details into db
            $data = array(
                'fio' => $this->input->post('fio'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'password' => $this->input->post('password')
            );

            if ($this->user_model->insert_user($data))
            {
                $this->session->set_flashdata('msg','<div class="alert alert-success text-center">You are Successfully Registered! Please login to access your Profile!</div>');
                redirect('signup/index');
            }
            else
            {
                // error
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
                redirect('signup/index');
            }
        }
    }

    function validate($fio, $email, $phone, $password, $cpassword){
        $error = false;
        
        if(strlen($password) < 6 || $password != $cpassword) {
            $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error in password(От шести символов и должен совпадать с повтором пароля).  Please try again.</div>');
            $error = true; 
        }
        if(! preg_match('~^[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}$~', $email)) {
            $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error in email(Введите правильно).  Please try again.</div>');
            $error = true; 
        }
        if(! preg_match('~^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}+$~', $phone)) {
            $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error in phone(+380ХХ...).  Please try again.</div>');
            $error = true; 
        }
        if(! preg_match('~^[а-яА-ЯёЁ]+$~u', $fio)){
            $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error in FIO(Русские буквы и пробел).  Please try again.</div>');
            $error = true; 
        } 

        if($error){
            return false;
        } else {
            return true;
        }

    }
}
?>