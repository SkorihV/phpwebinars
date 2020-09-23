<?php /* Smarty version 2.6.31, created on 2020-09-23 15:39:52
         compiled from user/register.form.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array('h1' => "Регистрация пользователя")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<p>
<?php if ($this->_tpl_vars['error']['message']): ?>
<div class="alert alert-danger" role="alert"><?php echo $this->_tpl_vars['error']['message']; ?>
</div>
<?php endif; ?>
    <form action="" method="post">
        <div class="form-group">
            <label for="user-name">Имя</label>
            <input  name="name" <?php if ($_POST['name']): ?>value="<?php echo $_POST['name']; ?>
"<?php endif; ?> type="text" class="form-control <?php if ($this->_tpl_vars['error']['requiredFields']['name']): ?>is-invalid<?php endif; ?>" id="user-name" placeholder="ФИО">
            <?php if ($this->_tpl_vars['error']['requiredFields']['name']): ?> <div class="invalid-feedback">Заполните обязательное поле</div><?php endif; ?>
        </div>
        <div class="form-group">
            <label for="user-email">Email</label>
            <input  name="email" <?php if ($_POST['email']): ?>value="<?php echo $_POST['email']; ?>
"<?php endif; ?> type="email" class="form-control <?php if ($this->_tpl_vars['error']['requiredFields']['email']): ?>is-invalid<?php endif; ?>" id="user-email" placeholder="name@example.com">
            <?php if ($this->_tpl_vars['error']['requiredFields']['email']): ?> <div class="invalid-feedback">Заполните обязательное поле</div><?php endif; ?>
        </div>
        <div class="form-group">
            <label for="user-password">Пароль</label>
            <input  name="password"  type="password" class="form-control <?php if ($this->_tpl_vars['error']['requiredFields']['password']): ?>is-invalid<?php endif; ?>" id="user-password" placeholder="Введите пароль">
            <?php if ($this->_tpl_vars['error']['requiredFields']['password']): ?> <div class="invalid-feedback">Заполните обязательное поле</div><?php endif; ?>
        </div>
        <div class="form-group">
            <label for="user-password-repeat">Повторить пароль</label>
            <input  name="passwordRepeat" type="password" class="form-control <?php if ($this->_tpl_vars['error']['requiredFields']['passwordRepeat']): ?>is-invalid<?php endif; ?>" id="user-password-repeat" placeholder="Введите пароль повторно">
            <?php if ($this->_tpl_vars['error']['requiredFields']['passwordRepeat']): ?> <div class="invalid-feedback">Заполните обязательное поле</div><?php endif; ?>
        </div>

    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
    </form>
</p>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>