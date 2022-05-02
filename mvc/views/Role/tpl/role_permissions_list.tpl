<table class="table">
<header>
    <th>
        <td>Nazwa uprawnienia</td>
        <td>Akcje</td>
    </th>
</header>
<tbody>
{foreach from=$permissions item=permission}
    <tr>
        <td>{$permission['id']}</td>
        <td>{$permission['name']}</td>
        <td><a href="/?model=Role&action=role_permissions_delete&role={$role_id}&permission={$permission['id']}">❌</a></td>
    </tr>
{/foreach}
</tbody>
</table>

<form action="/index.php?model=Role&action=role_permissions_add&role={$role_id}" style="width: 400px;" method="post">
  <div class="form-group">
    <label for="permission">Add permission</label>
    <select class="form-control" id="permission" name="permission">
    {foreach from=$available_list item=permission}
    <option value="{$permission['id']}">{$permission['name']}</option>
    {/foreach}
    </select>
  </div>
  <input class ="btn btn-primary" type="submit" value="Add" />
</form>