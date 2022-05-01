<table class="table">
<header>
    <th>
        <td>Nazwa użytkownika</td>
        <td>Akcje</td>
    </th>
</header>
<tbody>
{foreach from=$users item=user}
    <tr>
        <td>{$user['id']}</td>
        <td>{$user['name']}</td>
        <td><a href="/?model=Admin&action=user_permissions_list&user={$user['id']}">📜</a></td>
    </tr>
{/foreach}
</tbody>
</table>