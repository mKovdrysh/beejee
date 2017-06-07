{extends file="layout.tpl"}
{block name="content"}
    <form method="POST" action="/?page=edit-post&id={$task.id}" role="form">
        <div class="form-group">
            <label for="content"><b>Content:</b></label>
            <textarea class="form-control" id="content" name="content" rows="8" cols="50" required >{$task.content}</textarea><br>
            <button type="submit" class="btn btn-success create">Update</button>
        </div>
    </form>
{/block}
