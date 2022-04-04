<form style="width: 400px;" action='index.php?model=User&action=login' method='post'>
    Name:<br>
    <input class="form-control" type="text" id="name" name="name" value="{$record['name']}" /><br>
    Password:<br>
    <input class="form-control" type="password" id="password" name="password" value="{$record['name']}" /><br>
    <input class ="btn btn-primary" type="submit" value="Login" />
</form>