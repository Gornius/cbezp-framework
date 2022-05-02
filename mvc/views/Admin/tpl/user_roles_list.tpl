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
        <td><a href="/?model=Admin&action=user_roles_delete&user={$user_id}&role={$role['id']}">❌</a></td>
    </tr>
{/foreach}
</tbody>
</table>

<form action="/index.php?model=Admin&action=user_roles_add&user={$user_id}" style="width: 400px;" method="post">
  <div class="form-group">
    <label for="role">Add role</label>
    <select class="form-control" id="role" name="role">
    {foreach from=$available_list item=role}
    <option value="{$role['id']}">{$role['name']}</option>
    {/foreach}
    </select>
  </div>
  <input class ="btn btn-primary" type="submit" value="Add" />
</form>