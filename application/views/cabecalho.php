<html>
<head>
	<link rel="stylesheet" href="<?= base_url("css/bootstrap.css") ?>">
</head>
<body>
	<div class="container">
	
	<?php if($this->session->flashdata("success")) : ?>
	<p class="alert alert-success"><?= $this->session->flashdata("success")?></p>
	<?php endif ?>
	
	<?php if($this->session->flashdata("danger")) : ?>
	<p class="alert alert-danger"><?= $this->session->flashdata("danger")?></p>
	<?php endif ?>