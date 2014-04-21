



<div class="posts form">
<?php echo $this->Form->create('Upload',array('id' => 'formulario','type' => 'file')); ?>
    <fieldset>
        <legend><?php echo __('Subir Imagenes'); ?></legend>
    <?php
        echo $this->Form->input('archivo',array('type' => 'file'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>   