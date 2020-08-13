<?php /* Smarty version 2.6.31, created on 2020-08-13 17:15:05
         compiled from products/form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'products/form.tpl', 97, false),)), $this); ?>
<form class="form" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['product']->getId(); ?>
">
    <div class="input-wrap">
        <label>
          Название товара: <input type="text" name="name" required value="<?php echo $this->_tpl_vars['product']->getName(); ?>
">
        </label>
    </div>

    <div class="input-wrap">
        <label>
            Категории
            <select name="category_id" >
                <option value="0">Не выборано</option>
                <?php $this->assign('productCategory', $this->_tpl_vars['product']->getCategory()); ?>
                <?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
                    <option <?php if ($this->_tpl_vars['productCategory']->getId() == $this->_tpl_vars['category']['id']): ?>selected<?php endif; ?> value='<?php echo $this->_tpl_vars['category']['id']; ?>
'><?php echo $this->_tpl_vars['category']['name']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
        </label>
    </div>
    <div class="input-wrap">
        <label>
            Ссылка на изображение: <input type="text"  name="image_url" class="form-control">
        </label>
    </div>
    <div class="input-wrap">
        <label>
            ФОто товара: <input type="file" multiple name="images[]" class="form-control">
        </label>
    </div>
    <?php if ($this->_tpl_vars['product']->getImages()): ?>
        <div class="form-group d-flex">
            <?php $_from = $this->_tpl_vars['product']->getImages(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['image']):
?>
                <div class="card" style="width: 90px;">
                    <div class="card-body">
                        <button type="submit" class="btn btn-danger btn-sm" data-image-id="<?php echo $this->_tpl_vars['image']->getId(); ?>
" onclick="return deleteImage(this)">Удалить</button>
                    </div>
                    <img src="<?php echo $this->_tpl_vars['image']->getPath(); ?>
" class="card-img-top" alt="<?php echo $this->_tpl_vars['image']->getName(); ?>
" style="max-height: 120px; object-fit: contain;">
                </div>
            <?php endforeach; endif; unset($_from); ?>
        </div>
    <?php echo '
        <script>
            function deleteImage(button) {
                let imageId = $(button).attr("data-image-id");
                imageId = parseInt(imageId);

                if(!imageId) {
                    alert("Проблема с image_id");
                }

                let url = \'/products/delete_image\';

                const formData = new FormData();
                formData.append(\'product_image_id\', imageId);

                fetch(url, {
                    method: \'POST\',
                    body: formData
                })
                .then((response) => {
                    response.text()
                    .then((text) => {
                        if(text.indexOf(\'error\') > -1) {
                            alert("ошибка при удалении");
                        } else {
                            document.location.reload();
                        }
                    })
                })
                return false;
            }
        </script>
    '; ?>

    <?php endif; ?>
    <div class="input-wrap">
     <label>
        Артикул товара: <input type="text" name="article" value="<?php echo $this->_tpl_vars['product']->getArticle(); ?>
" >
        </label>
    </div>
    <div class="input-wrap">
         <label>
        Цена: <input type="number" name="price" value="<?php echo $this->_tpl_vars['product']->getPrice(); ?>
">
        </label>
    </div>
    <div class="input-wrap">
        <label>
        Количество на складе: <input type="number" name="amount" value="<?php echo $this->_tpl_vars['product']->getAmount(); ?>
">
        </label>
    </div>
    <div class="input-wrap">
        <label>
        Описание: <textarea style="resize: auto;" name="description"><?php echo $this->_tpl_vars['product']->getDescription(); ?>
</textarea>
        </label>
    </div>
        <input type="submit" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['submit_name'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Сохранить') : smarty_modifier_default($_tmp, 'Сохранить')); ?>
">
</form>
