<?php

use app\core\forms\Form;
use app\core\forms\InputField;

/**
 * @var $model \app\core\forms\User
 */

$this->title = 'Login';

?>
    <h1>Log in</h1>
<?php $form = Form::begin('', 'POST'); ?>
<?php echo $form->field($model, 'email')->setType(InputField::TYPE_EMAIL); ?>
<?php echo $form->field($model, 'password')->setType(InputField::TYPE_PASSWORD); ?>
    <button type="submit" class="btn btn-primary">Login</button>
<?php Form::end(); ?>