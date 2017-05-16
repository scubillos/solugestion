<ul class="sidebar-nav">
	<?php	
	foreach($sidebar["permissions"] as $menu){
	?>
	<li>
		<span class="<?php echo $menu["icono"]; ?>">
		<a href="<?php echo $sidebar["url_app"].$menu["url"] ?>"><?php echo $menu["nombre"]; ?></a></span>
		<?php 
		if(isset($sidebar["submenus"]) AND is_array($sidebar["submenus"]) AND count($sidebar["submenus"])!=0 ){
			foreach($sidebar["submenus"] as $submenu){
				?>
				<ul>
					<li>
						<span class="<?php echo $submenu["icono"]; ?>">
						<a href="<?php echo $sidebar["url_app"].$submenu["url"] ?>"><?php echo $submenu["nombre"]; ?></a></span>
					</li>
				</ul>
				<?php
			}
		}
		?>
	</li>
	<?php
	}
	?>
</ul>