<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendas extends CI_Controller{
	public function nova(){
		$usuario = autoriza();		
		$this->load->model(array("vendas_model", "produtos_model" , "usuarios_model"));
		$venda = array(
                        //ID do produto vem via post - hidden do form
			"produto_id" => $this->input->post("produto_id"),
			"comprador_id" => $usuario["id"],
			"data_de_entrega" => dataConvert($this->input->post("data_de_entrega"))			
		);
		$this->vendas_model->salva($venda);
		
		$this->load->library("email");
		$config["protocol"] = "smtp";
		$config["smtp_host"] = "ssl://smtp.gmail.com";
		$config["smtp_user"] = "ieieldoria@gmail.com";
		$config["smtp_pass"] = "";
		$config["charset"] = "utf-8";
		$config["mailtype"] = "html";
		$config["newline"] = "\r\n";
		$config["smtp_port"] = '465';
		$this->email->initialize($config);
		
		$produto = $this->produtos_model->busca($venda["produto_id"]);
		$vendedor = $this->usuarios_model->busca($produto["id_usuario"]);
		
		$dados = array("produto" => $produto);
		$conteudo = $this->load->view("vendas/email.php", $dados, TRUE);
		
		$this->email->from("ieieldoria@gmail.com", "Mercado");
		$this->email->to($vendedor["email"]);
		$this->email->subject("Seu produto {$ptoduto['nome']} foi vendido!");
		$this->email->message($conteudo);
		$this->email->send();
				
		$this->session->set_flashdata("success","Pedido feito");
		redirect("/");
	}
	
	public function index() {
            /*metodo anterior para pega usuario logado:
            $usuario = $this->session->userdata("usuario_logado");*/
		$usuario = autoriza();
		$this->load->model("produtos_model");
		$produtosVendidos = $this->produtos_model->buscaVendidos($usuario);
		$dados = array("produtosVendidos" => $produtosVendidos);
		$this->load->template("vendas/index", $dados);
	}
	
}