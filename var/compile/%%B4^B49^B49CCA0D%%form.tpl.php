<?php /* Smarty version 2.6.31, created on 2020-07-31 08:02:17
         compiled from products/form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'products/form.tpl', 42, false),)), $this); ?>
<form class="form" method="post">

        <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['product']['id']; ?>
">
    <div class="input-wrap">
        <label>
          Название товара: <input type="text" name="name" required value="<?php echo $this->_tpl_vars['product']['name']; ?>
">
        </label>
    </div>

    <div class="input-wrap">
        <label>
            Категории
            <select name="category_id" >
                <option></option>
                <?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
                    <option <?php if ($this->_tpl_vars['product']['category_id'] == $this->_tpl_vars['category']['id']): ?>selected<?php endif; ?> value='<?php echo $this->_tpl_vars['category']['id']; ?>
'><?php echo $this->_tpl_vars['category']['name']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
        </label>
    </div>

    <div class="input-wrap">
     <label>
        Артикул товара: <input type="text" name="article" value="<?php echo $this->_tpl_vars['product']['article']; ?>
" >
        </label>
    </div>
    <div class="input-wrap">
         <label>
        Цена: <input type="number" name="price" value="<?php echo $this->_tpl_vars['product']['price']; ?>
">
        </label>
    </div>
    <div class="input-wrap">
        <label>
        Количество на складе: <input type="number" name="amount" value="<?php echo $this->_tpl_vars['product']['amount']; ?>
">
        </label>
    </div>
    <div class="input-wrap">
        <label>
        Описание: <textarea style="resize: auto;" name="description"><?php echo $this->_tpl_vars['product']['description']; ?>
</textarea>
        </label>
    </div>
        <input type="submit" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['submit_name'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Сохранить') : smarty_modifier_default($_tmp, 'Сохранить')); ?>
">
</form>