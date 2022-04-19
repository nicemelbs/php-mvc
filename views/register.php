<h1>Create an account</h1>

<?php

use app\core\forms\Form;
use app\core\forms\InputField;

?>

<?php $form = Form::begin('', 'post'); ?>
<div class="row">
    <div class="col">
        <?php echo $form->field($model, 'firstname'); ?>
    </div>
    <div class="col">
        <?php echo $form->field($model, 'lastname'); ?>
    </div>
</div>
<?php echo $form->field($model, 'email')->setType(InputField::TYPE_EMAIL); ?>
<?php echo $form->field($model, 'password')->setType(InputField::TYPE_PASSWORD); ?>
<?php echo $form->field($model, 'passwordConfirm')->setType(InputField::TYPE_PASSWORD); ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php echo Form::end(); ?>
