{include file="header.tpl" h1="Список товаров"}

<form method="post">
    <input type="hidden" name="id" value="{$product.id}">
    <label>
       Название товара: <input type="text" name="name" required value="{$product.name}">
    </label>
    <label>
       Артикул товара: <input type="text" name="article" value="{$product.article}" >
    </label>
    <label>
       Цена: <input type="number" name="price" value="{$product.price}">
    </label>
    <label>
       Количество на складе: <input type="number" name="amount" value="{$product.amount}">
    </label>
    <label>
       Описание: <textarea name="description">{$product.description}</textarea>
    </label>
    <input type="submit" value="{$submit_name|default:'Сохранить'}">
</form>
{include file="bottom.tpl"}