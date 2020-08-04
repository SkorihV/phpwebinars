<?php /* Smarty version 2.6.31, created on 2020-08-04 13:20:10
         compiled from queue/list.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array('h1' => "Список Категорий")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<a href='/categories/add'>Добавить</a>
<p>
<table class="table">
    <thead class="thead-light">
    <tr>
        <th>#</th>
        <th>Название задачи</th>
        <th>Статус задачи</th>
        <th width="1"></th>
    </tr>
    </thead>
    <tbody>
    <?php $_from = $this->_tpl_vars['tasks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['task']):
?>
        <tr>
            <td><?php echo $this->_tpl_vars['task']['id']; ?>
</td>
            <td><?php echo $this->_tpl_vars['task']['name']; ?>
</td>
            <td><?php echo $this->_tpl_vars['task']['status']; ?>
</td>
            <td class="nobr">
                <form action="/queue/delete" method="post" style="display: inline"><input type="hidden" name="id" value="<?php echo $this->_tpl_vars['task']['id']; ?>
">
                    <input type="submit" value="Удал" class="btn btn-danger btn-sm">
                </form>
                &nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;
                <a href='/queue/run=<?php echo $this->_tpl_vars['task']['id']; ?>
' class="btn btn-primary btn-sm">Зап</a>
            </td>
        </tr>
    <?php endforeach; endif; unset($_from); ?>
    </tbody>
</table>
</p>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>