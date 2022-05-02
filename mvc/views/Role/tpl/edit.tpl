<form style="width: 400px;" action='index.php?model=Role&action=save' method='post'>
    <input type="hidden" name="id" value="{$record['id']}" />
    Name:<br>
    <input class="form-control" type="text" id="name" name="name" value="{$record['name']}" /><br>
    <input class ="btn btn-primary" type="submit" value="Save" />
</form>