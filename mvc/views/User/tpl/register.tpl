{include file='page/header.tpl'}
<form style="width: 400px;" action='index.php?model=User&action=save_register' method='post'>
    Name:<br>
    <input class="form-control" type="text" id="name" name="name" value="{$record['name']}" /><br>
    Password:<br>
    <input class="form-control" type="password" id="name" name="name" value="{$record['name']}" /><br>
    <input class ="btn btn-primary" type="submit" value="Save" />
</form>
{include file='page/footer.tpl'}