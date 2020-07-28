<?php /* Smarty version 2.6.31, created on 2020-07-28 13:49:00
         compiled from products/form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'products/form.tpl', 20, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array('h1' => "Список товаров")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form method="post">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['product']['id']; ?>
">
    <label>
       Название товара: <input type="text" name="name" required value="<?php echo $this->_tpl_vars['product']['name']; ?>
">
    </label>
    <label>
       Артикул товара: <input type="text" name="article" value="<?php echo $this->_tpl_vars['product']['article']; ?>
" >
    </label>
    <label>
       Цена: <input type="number" name="price" value="<?php echo $this->_tpl_vars['product']['price']; ?>
">
    </label>
    <label>
       Количество на складе: <input type="number" name="amount" value="<?php echo $this->_tpl_vars['product']['amount']; ?>
">
    </label>
    <label>
       Описание: <textarea name="description"><?php echo $this->_tpl_vars['product']['description']; ?>
</textarea>
    </label>
    <input type="submit" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['submit_name'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Сохранить') : smarty_modifier_default($_tmp, 'Сохранить')); ?>
">
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>