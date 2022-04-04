<html>
    <head>
    <title>{$title}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body class="m-5">
    {if !$user}
        <a class="btn btn-primary my-2" href="?model=User&action=view_login">Log in</a>
        <a class="btn btn-info my-2" href="?model=User&action=view_register">Register</a>
    {else}
        <a class="btn btn-info my-2" href="?model=User&action=logout">Logout ({$user['name']})</a>
    {/if}
    <br>