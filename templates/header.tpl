<!DOCTYPE html>
<html lang="ru">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" >
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>	<!--link rel="stylesheet" href="/assets/styles.css"-->
	<title>{$h1}</title>
</head>
<body>


<div class="contains site-wrapper" style="max-width: 1400px; margin: 0 auto;">
	<div class="header">
		<div class="row">
			<ul class="nav nav-pills">
				<li class="nav-item"><a class="nav-link" href="/products/list">Товары</a></li>
				<li class="nav-item"><a class="nav-link" href="/categories/list">Категории</a></li>
				<li class="nav-item"><a class="nav-link" href="/imports/index">Импорт товаров</a></li>
				<li class="nav-item"><a class="nav-link" href="/user/register">Регистрация</a></li>
			</ul>
		</div>
	</div>
	
	<div class="row">
		<div class="col-3">
			<nav class="nav flex-column nav-pills">
				{foreach from=$categories item=category}
				<a href="/categories/view?id={$category.id}" class="nav-link  w-100 {if $category.id == $current_category.id}active{/if}">{$category.name}</a>
				{/foreach}
			</nav>
		</div>

		<div class="col-9">
			<div class="content">
				{if $h1}<h1>{$h1}</h1>{/if}
