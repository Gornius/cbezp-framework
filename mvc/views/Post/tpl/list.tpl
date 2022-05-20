<table class="table">
<header>
    <th>
        <td>Tytuł</td>
        <td>Wiadomość</td>
        <td>Autor</td>
        <td>Akcje</td>
    </th>
</header>
<tbody>
{foreach from=$posts item=post}
    <tr>
        <td>{$post['id']}</td>
        <td>{$post['name']}</td>
        <td>{$post['message']}</td>
        <td>{$post['user_name']}</td>
        <td>
        {if ($user['id'] == $post['user_id'] || $global_editable)}
        <a href="index.php?model=Post&action=edit&id={$post['id']}">✏️</a>
        {/if}
        {if ($user['id'] == $post['user_id'] || $global_deletable)}
        <a href="index.php?model=Post&action=delete&id={$post['id']}">❌</a>
        {/if}
        </td>
    </tr>
{/foreach}
</tbody>
</table>
<a href="index.php?model=Post&action=edit"><button class="btn btn-primary">New Post</button></a>