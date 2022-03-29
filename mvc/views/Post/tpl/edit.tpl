{include file='page/header.tpl'}
<form style="width: 400px;" action='index.php?model=Post&action=save' method='post'>
    <input type="hidden" name="deleted" value="0" />
    <input type="hidden" name="id" value="{$record['id']}" />
    Name:<br>
    <input class="form-control" type="text" id="name" name="name" value="{$record['name']}" /><br>
    Type:<br>
    <select class="form-control" id="type" name="type">
        <option value="private">private</option>
        <option value="public" {if $record['type'] == 'public'}selected{/if}>public</option>
    </select><br>
    Message:<br>
    <textarea class="form-control" id="message" name="message" rows="4" cols="50">{$record['message']}</textarea><br>
    <input class ="btn btn-primary" type="submit" value="Save" />
</form>
{include file='page/footer.tpl'}