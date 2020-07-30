<form class="form" method="post">

        <input type="hidden" name="id" value="{$category.id}">
    <div class="input-wrap">
        <label>
          Название категории: <input type="text" name="name" required value="{$category.name}">
        </label>
    </div>
    <input type="submit" value="{$submit_name|default:'Сохранить'}">
</form>
