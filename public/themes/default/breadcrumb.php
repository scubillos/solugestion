<div class="row border-bottom white-bg" style="padding-top:6px; padding-bottom:6px;">
	<div class="col-xs-0 col-sm-4 col-md-6 col-lg-6">
		<h3 class="hidden-xs hidden-sm" style="margin:0;"><i class="fa fa-archive"></i> <?php echo $breadcrumb["titulo"]; ?></h3>
		<div class="col-xs-7 col-sm-8 col-md-6 col-lg-6">
			<ol class="breadcrumb" style="background-color:white;">
			<?php 
			if(isset($breadcrumb["ruta"])){
				foreach($breadcrumb["ruta"] as $ruta){
					$url = isset($ruta["url"]) ? $ruta["url"] : "#";
					?>
					<li><a href="<?php echo $url; ?>"><?php echo $ruta["nombre"]; ?></a></li>
					<?php
				}
			}
			?>
			</ol>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-3 col-lg-4 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-2">
		<?php
		if(isset($breadcrumb["opciones"]) and count($breadcrumb["opciones"])!=0 ){
			$nombre = isset($breadcrumb["opciones"]["nombre"]) ? $breadcrumb["opciones"]["nombre"] : "";
			$class = isset($breadcrumb["opciones"]["class"]) ? $breadcrumb["opciones"]["class"] : "";
			$id = isset($breadcrumb["opciones"]["id"]) ? $breadcrumb["opciones"]["id"] : "";
			$url = isset($breadcrumb["opciones"]["url"]) ? $breadcrumb["opciones"]["url"] : "#";
			$botones = isset($breadcrumb["botones"]) ? $breadcrumb["botones"] : [];
		?>
		<div id="breadcrumbOpciones" class="btn-group btn-group-sm pull-right" style="margin:6px 12px 6px 0;">
			<a href="<?php echo $url; ?>" id="<?php echo $id; ?>" class="btn btn-primary <?php echo $class; ?>"><?php echo $breadcrumb["opciones"]["nombre"]; ?></a>
			<?php
			if(count($botones)!=0){
			?>
			<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				<span class="caret"></span>
				<span class="sr-only">Toggle Dropdown</span>
			</button>
			<ul class="dropdown-menu">
			<?php
			foreach($botones as $boton){
				$nombre2 = isset($boton["nombre"]) ? $boton["nombre"] : "";
				$class2 = isset($boton["class"]) ? $boton["class"] : "";
				$id2 = isset($boton["id"]) ? $boton["id"] : "";
				$url2 = isset($boton["url"]) ? $boton["url"] : "#";
				?>
				<li><a href="<?php echo $url2; ?>" id="<?php echo $id2; ?>" class="<?php echo $class2; ?>"><?php echo $nombre2; ?></a></li>
				<?php
			}
			?>
			</ul>
			<?php
			}
			?>
		</div>
		<?php
		}
		?>
	</div>
</div>