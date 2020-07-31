<form class="form" method="post">

        <input type="hidden" name="id" value="{$product.id}">
    <div class="input-wrap">
        <label>
          Название товара: <input type="text" name="name" required value="{$product.name}">
        </label>
    </div>

    <div class="input-wrap">
        <label>
            Категории
            <select name="category_id" >
                <option></option>
                {foreach from=$categories item=category}
                    <option {if $product.category_id == $category.id}selected{/if} value='{$category.id}'>{$category.name}</option>
                {/foreach}
            </select>
        </label>
    </div>

    <div class="input-wrap">
     <label>
        Артикул товара: <input type="text" name="article" value="{$product.article}" >
        </label>
    </div>
    <div class="input-wrap">
         <label>
        Цена: <input type="number" name="price" value="{$product.price}">
        </label>
    </div>
    <div class="input-wrap">
        <label>
        Количество на складе: <input type="number" name="amount" value="{$product.amount}">
        </label>
    </div>
    <div class="input-wrap">
        <label>
        Описание: <textarea style="resize: auto;" name="description">{$product.description}</textarea>
        </label>
    </div>
        <input type="submit" value="{$submit_name|default:'Сохранить'}">
</form>
