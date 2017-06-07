<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" content="text/html" http-equiv="CONTENT-TYPE">
    <title>Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script type="text/javascript" src="/js/jquery-3.1.1.min.js"></script>
    {block name="header"}{/block}
</head>
{block name="header"}{/block}
<body>
<div class="container">
    <div class="container-fluid">
        <nav class="navbar navbar-inverse">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">Show all tasks</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="/?page=create">Create new task</a></li>
                {if not $isAdmin}
                    <li><a href="/?page=login">Login</a></li>
                {else}
                    <li><a href="/?page=logout">Logout</a></li>
                {/if}
            </ul>
        </nav>
        <div>
            {if $message}
                <div class="alert alert-danger">
                    {$message}
                </div>
            {/if}
            {block name="content"}{/block}
        </div>
    </div>
</div>
</body>
</html>
