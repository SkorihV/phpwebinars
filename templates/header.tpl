<!DOCTYPE html>
<html lang="ru">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" >
	<!--link rel="stylesheet" href="/assets/styles.css"-->
	<title>{$h1}</title>
</head>
<body>


<div class="contains site-wrapper">
	<div class="header">
		<div class="row">
			<ul class="nav nav-pills">
				<li class="nav-item"><a class="nav-link" href="/products/list">Товары</a></li>
				<li class="nav-item"><a class="nav-link" href="/categories/list">Категории</a></li>
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
