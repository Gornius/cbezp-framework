<form style="width: 400px;" action='index.php?model=User&action=register' method='post'>
    Name:<br>
    <input class="form-control" type="text" id="name" name="name" value="{$record['name']}" /><br>
    Email:<br>
    <input class="form-control" type="email" id="email" name="email" value="{$record['email']}" /><br>
    Password:<br>
    <input class="form-control" type="password" id="password" name="password" value="{$record['name']}" /><br>
    <input class ="btn btn-primary" type="submit" value="Save" />
</form>