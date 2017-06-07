{extends file="layout.tpl"}
{block name="content"}
    <form method="POST" action="/?page=login-post" role="form">
        <div class="form-group">
            <label for="name"><b>Name:</b></label>
            <input class="form-control" id="name" name="username" required>
            <label for="password"><b>Password:</b></label>
            <input class="form-control" id="password" name="password" required type="password">
            <button type="submit" class="btn btn-success create">Login</button>
        </div>
    </form>
{/block}
