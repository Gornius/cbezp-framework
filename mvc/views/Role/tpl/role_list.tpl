<table class="table">
<header>
    <th>
        <td>Nazwa roli</td>
        <td>Akcje</td>
    </th>
</header>
<tbody>
{foreach from=$roles item=role}
    <tr>
        <td>{$role['id']}</td>
        <td>{$role['name']}</td>
        <td>
            <a href="/?model=Role&action=edit&id={$role['id']}">✏️</a>
            <a href="/?model=Role&action=role_permissions_list&role={$role['id']}">📜</a>
            <a href="/?model=Role&action=delete&id={$role['id']}">❌</a>
        </td>
    </tr>
{/foreach}
</tbody>
</table>
<a href="index.php?model=Role&action=edit"><button class="btn btn-primary">New Role</button></a>
