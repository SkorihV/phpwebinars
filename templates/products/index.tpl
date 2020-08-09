{include file="header.tpl" h1="Список товаров"}

<a href='/products/add'>Добавить</a>
<p>

	<nav>
		<ul class="pagination">
			{section loop=$page_count name=pagination}
			<li class="page-item {if $smarty.get.p == $smarty.section.pagination.iteration}active{/if}"><a class="page-link" href="{$smarty.server.PATH_INFO}?p={$smarty.section.pagination.iteration}">{$smarty.section.pagination.iteration}</a></li>
			{/section}
		</ul>
	</nav>


<table class="table">
	<thead>
		<tr>
			<th>#</th>
			<th>Название товара</th>
			<th>Категория</th>
			<th>Артикул</th>
			<th>Цена</th>
			<th>Количество на складе</th>
			<th>Описание</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$products item=product}
		<tr>
			<td>{$product->getId()}</td>
			<td width="200">
				{$product->getName()}
				{*if $product.images}
					<br>
					{foreach from=$product.images item=image}
						<img width="30" src="{$image.path}" alt="{$image.name}">
					{/foreach}
				{/if*}
			</td>
			{assign var=productCategory value=$product->getCategory() }
			<td>{$productCategory->getName()}</td>
			<td>{$product->getArticle()}</td>
			<td>{$product->getPrice()}</td>
			<td>{$product->getAmount()}</td>
			<td>{$product->getDescription()}</td>
			<td>
				<form action="/products/delete" method="post" style="display: inline"><input type="hidden" name="id" value="{$product->getId()}"><input type="submit" value="Удал"></form>
				&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;
				<a href="/products/edit?id={$product->getId()}">Ред</a>
			</td>
		</tr>
		{/foreach}
	</tbody>
</table>
</p>

{include file="bottom.tpl"}
