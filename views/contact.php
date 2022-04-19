<?php

use app\core\forms\Button;
use app\core\forms\Form;
use app\core\forms\InputField;
use app\core\forms\TextAreaField;
use app\core\Model;

/**
 * @var $model Model
 */

$this->title = 'Contact Us';
?>
    <h1>Contact us page</h1>

<?php
$form = Form::begin('', 'post');
echo new InputField($model, 'subject');
echo new InputField($model, 'email', InputField::TYPE_EMAIL);
echo new TextAreaField($model, 'body');
echo new Button($model, 'submit', 'Send');
//echo $form->field($model, 'subject');
//echo $form->field($model, 'email');
//echo $form->field($model, 'body');
?>
    <!--    <button type="submit" class="btn btn-primary">Submit</button>-->
<?php Form::end(); ?>