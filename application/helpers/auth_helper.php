<?php
function autoriza(){
	$ci = get_instance(); // instancia CI - não tem classe para usar o this, criar um objeto
		$usuarioLogado = $ci->session->userdata("usuario_logado");
		if(!$usuarioLogado){
			$ci->session->set_flashdata("danger", "Fazer Login");
			redirect("/");
		}
		return $usuarioLogado;
}