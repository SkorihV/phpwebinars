{include file="header.tpl" h1=$current_category.name}

{*
<a href='/products/add'>Добавить</a>
<p>
*}
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
            <td>{$product.id}</td>
            <td>{$product.name}</td>
            <td>{$product.category_name}</td>
            <td>{$product.article}</td>
            <td>{$product.price}</td>
            <td>{$product.amount}</td>
            <td>{$product.description}</td>
            <td>
                <form action="/products/delete" method="post" style="display: inline"><input type="hidden" name="id" value="{$product.id}"><input type="submit" value="Удал"></form>
                &nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;
                <a href='/products/edit?id={$product.id}'>Ред</a>
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>
</p>

{include file="bottom.tpl"}
