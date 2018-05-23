<?php
defined('BASEPATH') OR exit('NO Direct Script Access Allowed');
class Validate extends CI_Controller
{
    public function __construct()
    {
      parent::__construct();
      $this->load->library('form_validation');
    }
    public function validate_fullname()
    {
        $fname_rules = array(
          array(
            'field' => 'fullname',
            'label' => 'Full Name',
            'rules' => 'required|regex_match[/^[A-Za-z\\s]+$/]|min_length[6]|max_length[45]'
          )
        );
        $this->form_validation->set_message('regex_match','The Full Name field may only contain alphabetical characters.');
        $this->form_validation->set_rules($fname_rules);
        if($this->form_validation->run())
        {
            echo "Success";
        }
        else {
          echo validation_errors();
        }
    }

    public function validate_emp_number()
    {
        $emp_number = array(
          array(
            'field' => 'empnumber',
            'label' => 'Employee Number',
            'rules' => 'required|alpha_numeric|min_length[6]|max_length[45]'
          )
        );
        $this->form_validation->set_rules($emp_number);
        if($this->form_validation->run())
        {
            echo "Success";
        }
        else {
          echo validation_errors();
        }
    }

      public function validate_email()
      {
          $email = array(
            array(
              'field' => 'email',
              'label' => 'E-mail Address',
              'rules' => 'required|valid_email'
            )
          );
          $this->form_validation->set_rules($email);
          if($this->form_validation->run())
          {
              echo "Success";
          }
          else {
            echo validation_errors();
          }
      }
      public function validate_contact_no()
      {
          $contact = array(
            array(
              'field' => 'contact',
              'label' => 'Contact Number',
              'rules' => 'required|numeric|min_length[10]|max_length[10]'
            )
          );
          $this->form_validation->set_rules($contact);
          if($this->form_validation->run())
          {
              echo "Success";
          }
          else {
            echo validation_errors();
          }
      }

      public function validate_address()
      {
          $address = array(
            array(
              'field' => 'address',
              'label' => 'Address',
              'rules' => 'required'
            )
          );
          $this->form_validation->set_rules($address);
          if($this->form_validation->run())
          {
              echo "Success";
          }
          else {
            echo validation_errors();
          }
      }


}
?>
