<!-- app/View/Users/add.ctp -->

<div id="contenido">
<div class="users form">
<?php echo $this->Form->create('User'); ?>

    <fieldset>
        <legend><?php echo __('Añadir Usuario'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('role', array(
            'options' => array('admin' => 'Admin', 'usuario' => 'Usuario')
        ));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

</div>