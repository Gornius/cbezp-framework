{include file='page/header.tpl'}
<table>
<header>
    <th>
        <td>Tytuł</td>
        <td>Wiadomość</td>
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
<a href="index.php?model=Post&action=edit">New Post</a>
{include file='page/footer.tpl'}