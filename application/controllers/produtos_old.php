<?php
class Produtos extends CI_Controller{
	
	public function index()
	{
		$produtos = array();
		$bola = array("nome"=>"Bola","preco"=>300);
		$hd = array("nome"=>"HD Externo","preco"=>250);
		array_push($produtos, $bola, $hd);
		
		$dados = array("produtos" => $produtos);
		
		$this->load->view("produtos/index.php", $dados);
	}
	
}