<?php

use app\core\forms\Field;
use app\core\forms\Form;

/**
 * @var $model \app\core\forms\User
 */

?>
    <h1>Log in to your account</h1>
<?php $form = Form::begin('', 'POST'); ?>
<?php echo $form->field($model, 'email')->setType(Field::TYPE_EMAIL); ?>
<?php echo $form->field($model, 'password')->setType(Field::TYPE_PASSWORD); ?>
    <button type="submit" class="btn btn-primary">Login</button>
<?php Form::end(); ?>