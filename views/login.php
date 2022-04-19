<?php

use app\core\forms\Form;

?>
    <h1>Log in to your account</h1>
<?php $form = Form::begin('', 'POST'); ?>
<?php echo $form->field($model, 'email'); ?>
<?php echo $form->field($model, 'password'); ?>
    <button type="submit" class="btn btn-primary">Login</button>
<?php Form::end(); ?>