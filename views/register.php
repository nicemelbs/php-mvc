<h1>Create an account</h1>

<?php

use app\core\forms\Field;
use app\core\forms\Form;

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
<?php echo $form->field($model, 'email')->setType(Field::TYPE_EMAIL); ?>
<?php echo $form->field($model, 'password')->setType(Field::TYPE_PASSWORD); ?>
<?php echo $form->field($model, 'passwordConfirm')->setType(Field::TYPE_PASSWORD); ?>
<button type="submit" class="btn btn-primary">Submit</button>
<!--<div class="row mb-3">-->
<!--    <div class="col">-->
<!--        <label for="firstname" class="form-label">First Name</label>-->
<!--        <input type="text" class="form-control" id="firstname" name="firstname">-->
<!--    </div>-->
<!--    <div class="col">-->
<!--        <label for="lastname" class="form-label">Last Name</label>-->
<!--        <input type="text" class="form-control" id="lastname" name="lastname">-->
<!--    </div>-->
<!--</div>-->
<!--<div class="mb-3">-->
<!--    <label for="email" class="form-label">Email</label>-->
<!--    <input type="email" class="form-control" id="email" name="email">-->
<!--</div>-->
<!--<div class="mb-3">-->
<!--    <label for="password" class="form-label">Password</label>-->
<!--    <input type="password" class="form-control" name="password" id="password">-->
<!--    <label for="passwordConfirm" class="form-label">Confirm Password</label>-->
<!--    <input type="password" class="form-control" name="passwordConfirm" id="passwordConfirm">-->
<!--</div>-->
<!--<button type="submit" class="btn btn-primary">Submit</button>-->
<?php echo Form::end(); ?>
<!--</form>-->
