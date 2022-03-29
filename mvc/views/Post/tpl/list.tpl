{include file='page/header.tpl'}
<table class="table">
<header>
    <th>
        <td>Tytuł</td>
        <td>Wiadomość</td>
        <td>Akcje</td>
    </th>
</header>
<tbody>
{foreach from=$posts item=post}
    <tr>
        <td>{$post['id']}</td>
        <td>{$post['name']}</td>
        <td>{$post['message']}</td>
        <td><a href="index.php?model=Post&action=edit&id={$post['id']}">✏️</td>
    </tr>
{/foreach}
</tbody>
</table>
<a href="index.php?model=Post&action=edit"><button class="btn btn-primary">New Post</button></a>
{include file='page/footer.tpl'}