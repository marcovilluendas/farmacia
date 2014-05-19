		
		
			<h1> FARMALINK </h1>
			
		<?php   
				$uid = $this->Session->read('Auth.User.id');
				
				if (empty($uid)){
						?> 
						
						<div class="right">
								<li>
									<?php echo $this->Html->link("Login Farmacias", array('controller' => 'users', 'action' => 'logout', 'admin'=>false)); ?>
								</li>
						</div> <?php
				}
				
				else {
						?> 
						
						
						<div class="right">
								<li>
									<?php echo $this->Html->link("Cerrar Sesión", array('controller' => 'users', 'action' => 'logout', 'admin'=>false)); ?>
								</li>
						</div> <?php
				}
				
				$uid = $this->Session->read('Auth.User.id');

				
				if (empty($uid)){
				
				}
				
				else {
						?>
						<div class="right">
								<li>
									<?php echo $this->Html->link("Panel de Control", 
									array(
									'controller' => 'ofertas', 
									'action' => 'ofertas_farmacias', 
									'admin'=>false,
									$uid
									)); ?>
								</li>
	
						</div> <?php
				}
		
		?>
			
			
			<nav>				
				<ul class="nav">
					<?php echo $this->Html->link('Ver Listado Farmacias', array('controller' => 'farmacias', 'action' => 'index', 'admin' => false)); ?>
					<?php echo $this->Html->link('Ver Ofertas', array('controller' => 'ofertas', 'action' => 'index', 'admin' => false)); ?>
				</ul>
			</nav>
			
			<div class="clearfix"></div>



	

 
