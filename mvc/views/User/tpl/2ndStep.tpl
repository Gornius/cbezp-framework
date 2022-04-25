<form style="width: 400px;" action='index.php?model=User&action=login_2nd_step' method='post'>
    <div class="alert alert-info">Two-step verification has been enabled for this account. In order to log in, please enter the code that has been sent to your email below.</div>
    Code:<br>
    <input class="form-control" type="text" id="code" name="code" value="{$record['code']}" /><br>
    <input class ="btn btn-primary" type="submit" value="Verify" />
</form>