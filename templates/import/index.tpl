{include file="header.tpl" h1="Загрузка файла импорта"}

<p>
    <form class="form" method="post" enctype="multipart/form-data" action="/import/upload">
        <div class="input-wrap">
            <label>
                Файл импорта(csv): <input type="file" multiple name="import_file" class="form-control">
            </label>
        </div>
        <input type="submit" value="{$submit_name|default:'Импортировать'}">
    </form>
</p>
{include file="bottom.tpl"}
