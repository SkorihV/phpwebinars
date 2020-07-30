{include file="header.tpl" h1="Список категорий"}

<a href='/categories/add'>Добавить</a>
<p>
<table class="table">
	<thead>
		<tr>
			<th>#</th>
			<th>Название категории</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$categories item=category}
		<tr>
			<td>{$category.id}</td>
			<td>{$category.name}</td>
			<td>
				<form action="/categories/delete" method="post" style="display: inline"><input type="hidden" name="id" value="{$category.id}"><input type="submit" value="Удал"></form>
				&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;
				<a href='/categories/edit?id={$category.id}'>Ред</a>
			</td>
		</tr>
		{/foreach}
	</tbody>
</table>
</p>

{include file="bottom.tpl"}
