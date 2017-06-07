{extends file="layout.tpl"}
{block name="header"}
    <script type='text/javascript'>
        $(document).ready(function () {
            $("#preview").click(function () {
                var name = $('#name').val();
                var email = $('#email').val();
                var content = $('#content').val();

                if (name && email && content) {
                    $('#showName').html(name);
                    $('#showEmail').html(email);
                    $('#showContent').html(content);
                    $("#show").fadeIn();
                }
            });
        });
    </script>
{/block}
{block name="content"}
    <form method="POST" action="/?page=create-post" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="content"><b>Task:</b></label>
            <textarea class="form-control" id="content" name="content" required></textarea><br>
            <label for="name"><b>Name:</b></label>
            <input class="form-control" id="name" name="username" required>
            <label for="email"><b>Email:</b></label>
            <input class="form-control" id="email" name="email" type="email" required>
            <label for="image"><b>Images:</b></label>
            <input id="image" name="images[]" class="form-control" type="file" multiple required><br>
            <button type="submit" class="btn btn-success create">Create</button>
            <button id="preview" type="button" class="btn btn-danger pre">Preview</button>
        </div>
    </form>
    <div id="show" style="display: none">
        <h2>Your task looks like this:</h2>
        <div class="panel panel-primary">
            <div class="panel-heading"><span id="showName"></span>
                (<span id="showEmail"></span>
            </div>
            <div class="panel-body">
                <span id="showContent"></span>
            </div>
        </div>
    </div>
{/block}
