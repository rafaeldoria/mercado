<?php 
	class Produtos_model extends CI_Model {
		
	public function buscaTodos(){
            //where que só busca produtos vendidos = false
		$this->db->where("vendido", false);
		return $this->db->get("produtos")->result_array();	
	}
		
	public function salva($produto){
		$this->db->insert("produtos", $produto);
	}
	
	public function busca($id){
		return $this->db->get_where("produtos", array(
			"id" => $id
		))->row_array();
	}
	
	public function buscaVendidos($usuario){
		$id = $usuario["id"];
		$this->db->select("produtos.*, vendas.data_de_entrega"); //só a data de entrega de vendas
		$this->db->from("produtos"); // da tabela produto
		$this->db->join("vendas","vendas.produto_id = produtos.id"); //join com vendas
		/*vendido = true */$this->db->where("vendido", true);
		/*usuario, vendendo = id do usuario*/$this->db->where("id_usuario", $id);
		return $this->db->get()->result_array();
	}
	
	}
?>