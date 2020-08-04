<?php /* Smarty version 2.6.31, created on 2020-08-04 13:19:38
         compiled from header.tpl */ ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" >
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>	<!--link rel="stylesheet" href="/assets/styles.css"-->
	<title><?php echo $this->_tpl_vars['h1']; ?>
</title>
</head>
<body>


<div class="contains site-wrapper" style="max-width: 1400px; margin: 0 auto;">
	<div class="header">
		<div class="row">
			<ul class="nav nav-pills">
				<li class="nav-item"><a class="nav-link" href="/products/list">Товары</a></li>
				<li class="nav-item"><a class="nav-link" href="/categories/list">Категории</a></li>
				<li class="nav-item"><a class="nav-link" href="/import/index">Импорт товаров</a></li>
			</ul>
		</div>
	</div>
	
	<div class="row">
		<div class="col-3">
			<nav class="nav flex-column nav-pills">
				<?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
				<a href="/categories/view?id=<?php echo $this->_tpl_vars['category']['id']; ?>
" class="nav-link  w-100 <?php if ($this->_tpl_vars['category']['id'] == $this->_tpl_vars['current_category']['id']): ?>active<?php endif; ?>"><?php echo $this->_tpl_vars['category']['name']; ?>
</a>
				<?php endforeach; endif; unset($_from); ?>
			</nav>
		</div>

		<div class="col-9">
			<div class="content">
				<?php if ($this->_tpl_vars['h1']): ?><h1><?php echo $this->_tpl_vars['h1']; ?>
</h1><?php endif; ?>