<?php

  class Comments extends CI_Controller
  {

    public function create($post_id)
    {
      $slug = $this->input->post('slug');
      $data['post'] = $this->post_model->get_posts($slug);
      $data['title'] = $data['post']['title'];

      $this->form_validation->set_rules('name', 'Name', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
      $this->form_validation->set_rules('body', 'Body', 'required');

      if ($this->form_validation->run() === false) {
        $this->load->view('templates/header');
        $this->load->view('posts/view', $data);
        $this->load->view('templates/footer');
      } else {
        $this->comment_model->create_comment($post_id);
        redirect('posts/'.$slug);
      }
    }
  }
