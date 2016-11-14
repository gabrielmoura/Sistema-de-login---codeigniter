<?php

/**
 * Created by PhpStorm.
 * User: blx32@srmoura.com.br
 * Date: 23/09/16
 * Time: 00:29
 */
class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    private function data()
    {
        return array(
            /** Link e Titulo da pagina */
            'action' => base_url('User'),
            'titulo' => 'Example : User',
        );
    }

    public function index()
    {
        if ($this->input->post()) {
            /**
             * Recebe o email e a senha em SHA512
             * e confirma com o BD.
             */
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('p', 'Senha', 'required|exact_length[128]');

            if ($this->form_validation->run() == FALSE) {
                /**Formulário não validado*/
                if (isset($this->session->userdata['logged_in'])
                ) {
                    /** Caso logado */
                    if ($this->session->logged_in['class'] == 11) {
                        $data = array(
                            'html' => $this->data(),
                            'msg' => 'Você é administrador <a href=\'' . base_url('admin') . '\'>Acessar Controles</a>'
                        );
                    } else {
                        $data = array(
                            'html' => $this->data(),
                        );
                    }
                    $this->load->view('user/header', $data);
                    $this->load->view('user/login/panel', $data);

                } else {
                    /** Caso formulário invalido e não logado redirecionar */
                    header('Location: ' . base_url('User'));

                }
            } else {
                /** Formulário válido, efetuando login */

                $data = array(
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('p')
                );

                $result = $this->User_model->login($data);
                if ($result == TRUE) {
                    /** Usuário verificado e escrevendo cookies */
                    $email = $this->input->post('email');
                    $result = $this->User_model->information_email($email);
                    if ($result != false) {

                        $session_data = array(
                            'username' => $result[0]->username,
                            'email' => $result[0]->email,
                            'class' => $result[0]->class,
                        );

                        $this->session->set_userdata('logged_in', $session_data);
                        header('refresh:0; url=http://srmoura.com.br/User');
                    }
                } else {
                    /** Caso diferente do BD mostrar erros */

                    $data = array(
                        'html' => $this->data(),
                        'msg' => 'Email ou senha inválidos',
                    );

                    $this->load->view('user/login/login', $data);
                }//FIM ERROS DE LOGIN
            }//FIM FORM-VALIDATION


        } else {
            /**Caso não haja POST*/

            if (!isset($this->session->logged_in)) {
                /**Caso não esteja logado
                 * Pagina de login*/
                $data = array(
                    'html' => $this->data(),
                );

                $this->load->view('user/header', $data);
                $this->load->view('user/login/login', $data);
                $this->load->view('user/footer');

            } else {
                /**Caso esteja logado*/
                if ($this->session->logged_in['class'] == 11) {
                    $data = array(
                        'html' => $this->data(),
                        'msg' => 'Você é administrador <a href=\'' . base_url('admin') . '\'>Acessar Controles</a>'
                    );
                } else {
                    $data = array(
                        'html' => $this->data(),
                    );
                }
                $this->load->view('user/header', $data);
                $this->load->view('user/login/panel', $data);
            }
        }//FIM NÃO POST
    }//FIM INDEX

    public function logout()
    {

        /** Remove a sessão e redireciona para o login*/
        $sess_array = array(
            'email' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $data = array(
            'html' => $this->data(),
            'msg' => 'Successfully Logout',
        );
        header('refresh:2; url=http://srmoura.com.br/User/');
        $this->load->view('user/header', $data);
        $this->load->view('user/logout/logout_success', $data);
        $this->load->view('user/footer');


    }


}/**Fim do Controller*/