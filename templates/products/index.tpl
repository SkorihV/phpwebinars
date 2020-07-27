{include file="header.tpl" h1="Список товаров"}

<a href='/add.php'>Добавить</a>
<p>
<table class="table">
	<thead>
		<tr>
			<th>#</th>
			<th>Название товара</th>
			<th>Артикул</th>
			<th>Цена</th>
			<th>Количество на складе</th>
			<th>Описание</th>
			<th>Категория</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$products item=product}
		<tr>
			<td>{$product.id}</td>
			<td>{$product.name}</td>
			<td>{$product.article}</td>
			<td>{$product.price}</td>
			<td>{$product.amount}</td>
			<td>{$product.description}</td>
			<td>{$product.category_id}</td>
			<td>
				<form action="/delete.php" method="post" style="display: inline"><input type="hidden" name="id" value="{$product.id}"><input type="submit" value="Удал"></form>
				&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;
				<a href='/edit.php?id={$product.id}'>Ред</a>
			</td>
		</tr>
		{/foreach}
	</tbody>
</table>
</p>

{include file="bottom.tpl"}
