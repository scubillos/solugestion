<style>
.ui-jqgrid {
    margin-left: auto;
    margin-right: auto;
}
</style>
<div class="wrapper">
	<div class="navbar">
		<?php $this->navbar(); ?>
	</div>
	<div class="sidebar">
		<?php $this->sidebar(); ?>
	</div>
	<div class="content">
		<?php
		$this->breadcrumb($breadcrumb);
		?>
		<div class="row">
		<?php
		$this->RenderView("Formulario",["tipos" => $tipos]);
		?>
		</div>
		<div class="row">
		<?php
		$this->LoadTemplate("jqgrid","TablaAdmCatalogos");
		?>
		</div>
	</div>
</div>
<?php
	$this->LoadTemplate("modal","ModalOpciones","sm");
?>