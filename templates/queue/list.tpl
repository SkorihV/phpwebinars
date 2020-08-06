{include file="header.tpl" h1="Список Категорий"}

<a href='/imports/index'>Добавить</a>
<p>
<table class="table">
    <thead class="thead-light">
    <tr>
        <th>#</th>
        <th>Название</th>
        <th>Статус задачи</th>
        <th width="1"></th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$tasks item=task}
        <tr>
            <td>{$task.id}</td>
            <td>{$task.name}</td>
            <td>{$task.status}</td>
            <td class="nobr">
                <form action="/queue/delete" method="post" style="display: inline"><input type="hidden" name="id" value="{$task.id}">
                    <input type="submit" value="Удал" class="btn btn-danger btn-sm">
                </form>
                &nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;
                <a href='/queue/run?id={$task.id}' class="btn btn-primary btn-sm">Зап</a>
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>
</p>

{include file="bottom.tpl"}
