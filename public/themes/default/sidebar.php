<ul class="nav nav-pills nav-stacked" style="position:fixed;">
	<?php	
	foreach($sidebar["permissions"] as $menu){
		if(in_array($menu["id"],$sidebar["permissions_auth"])){
			$hasSubmenus = ( isset($menu["submenus"]) AND is_array($menu["submenus"]) AND count($menu["submenus"])!=0 );
			if($hasSubmenus){
			?>
			<li role="presentation" class="dropdown">
				<a href="#" id="btn-<?php echo $menu["id"] ?>" data-toggle="collapse" data-target="#submenu<?php echo $menu["id"] ?>" aria-expanded="false">
					<span class="<?php echo $menu["icono"]; ?>"></span> <?php echo $menu["nombre"]; ?> <span class="caret"></span>
				</a>
				
				<ul class="nav collapse" id="submenu<?php echo $menu["id"] ?>" role="menu" aria-labelledby="btn-<?php echo $menu["id"] ?>">
				<?php 
				foreach($menu["submenus"] as $submenu){
					if(in_array($submenu["id"],$sidebar["permissions_auth"])){
					?>
					<li role="presentation">
						<a href="<?php echo $sidebar["url_app"].$submenu["url"] ?>" ><span class="<?php echo $submenu["icono"]; ?>"></span> <?php echo $submenu["nombre"]; ?></a>
					</li>
					<?php
					}
				}
				?>
				</ul>
			</li>
			<?php
			}else{
			?>
			<li role="presentation" >
				<a href="<?php echo $sidebar["url_app"].$menu["url"] ?>"><span class="<?php echo $menu["icono"]; ?>"></span> <?php echo $menu["nombre"]; ?></a>
			</li>
			<?php	
			}
		}
	}
	?>
</ul>