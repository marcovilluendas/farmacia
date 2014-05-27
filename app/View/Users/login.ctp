<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>

<div class="container">
	<div class="row">
	<div class="col-lg-12 col-md-12">


<?php echo $this->Html->link("Registrarse", array('action' => 'add')); ?>

		<div class="formularioedit">
			<div class="users form">

				<?php echo $this->Session->flash('auth'); ?>
				<?php echo $this->Form->create('User'); ?>
					<fieldset>
						<legend>
							<?php echo __('Por favor, introduzca su usuario y contraseña'); ?>
						</legend>
						<?php 	echo $this->Form->input('username');
								echo $this->Form->input('password');
						?>
					</fieldset>
				<?php echo $this->Form->end(__('Login')); ?>

			</div>
		</div>
	</div>
	</div>
</div>