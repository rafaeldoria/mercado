<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
	public function autenticar(){
		$this->load->model("usuarios_model");
		$email = $this->input->post("email");
		$senha = md5($this->input->post("senha"));
		$usuario = $this->usuarios_model->buscaEmailSenha($email, $senha);
		if($usuario){
			$this->session->set_userdata("usuario_logado", $usuario);
			//$dados = array("mensagem" => "Logado");
			$this->session->set_flashdata("success","Logado");
		}else{
			//$dados = array("mensagem" => "Não Logado");
			$this->session->set_flashdata("danger","usuario ou senha invalidos");
		}	
		//$this->load->view("login/autenticar", $dados);		
		redirect('/');
	}
	
	public function logout(){
		$this->session->unset_userdata("usuario_logado");
		$this->session->set_flashdata("success","Deslogado");
		//$this->load->view("login/logout");
		redirect('/');
	}
}