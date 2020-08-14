<form class="form" method="post" enctype="multipart/form-data">


        <input type="hidden" name="id" value="{$product->getId()}">
    <div class="input-wrap">
        <label>
          Название товара: <input type="text" name="name" required value="{$product->getName()}">
        </label>
    </div>

    <div class="input-wrap">
        <label>
            Категории
            <select name="category_id" >
                <option value="0">Не выборано</option>
                {assign var=productCategory value=$product->getCategory()}
                {foreach from=$categories item=category}
                    <option {if $productCategory->getId() == $category.id}selected{/if} value='{$category.id}'>{$category.name}</option>
                {/foreach}
            </select>
        </label>
    </div>
    <div class="input-wrap">
        <label>
            Ссылка на изображение: <input type="text"  name="image_url" class="form-control">
        </label>
    </div>
    <div class="input-wrap">
        <label>
            ФОто товара: <input type="file" multiple name="images[]" class="form-control">
        </label>
    </div>
    {if $product->getImages()}
        <div class="form-group d-flex">
            {foreach from=$product->getImages() item=image}
                <div class="card" style="width: 90px;">
                    <div class="card-body">
                        <button type="submit" class="btn btn-danger btn-sm" data-image-id="{$image->getId()}" onclick="return deleteImage(this)">Удалить</button>
                    </div>
                    <img src="{$image->getPath()}" class="card-img-top" alt="{$image->getName()}" style="max-height: 120px; object-fit: contain;">
                </div>
            {/foreach}
        </div>
    {literal}
        <script>
            function deleteImage(button) {
                let imageId = $(button).attr("data-image-id");
                imageId = parseInt(imageId);

                if(!imageId) {
                    alert("Проблема с image_id");
                }

                let url = '/products/delete_image';

                const formData = new FormData();
                formData.append('product_image_id', imageId);

                fetch(url, {
                    method: 'POST',
                    body: formData
                })
                .then((response) => {
                    response.text()
                    .then((text) => {
                        if(text.indexOf('error') > -1) {
                            alert("ошибка при удалении");
                        } else {
                            document.location.reload();
                        }
                    })
                })
                return false;
            }
        </script>
    {/literal}
    {/if}
    <div class="input-wrap">
     <label>
        Артикул товара: <input type="text" name="article" value="{$product->getArticle()}" >
        </label>
    </div>
    <div class="input-wrap">
         <label>
        Цена: <input type="number" name="price" value="{$product->getPrice()}">
        </label>
    </div>
    <div class="input-wrap">
        <label>
        Количество на складе: <input type="number" name="amount" value="{$product->getAmount()}">
        </label>
    </div>
    <div class="input-wrap">
        <label>
        Описание: <textarea style="resize: auto;" name="description">{$product->getDescription()}</textarea>
        </label>
    </div>
        <input type="submit" value="{$submit_name|default:'Сохранить'}">
</form>

