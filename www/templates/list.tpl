{extends file="layout.tpl"}

{block name="content"}
<h3>Tasks:</h3>
{foreach $tasks as $task}
{if not $task.is_completed }
<div class="panel panel-primary">
    {else}
    <div class="panel panel-default">
        {/if}
        <div class="panel-heading">
            {$task.username} ({$task.email})
        </div>
        <div class="panel-body">
            <div>
                {$task.content}
            </div>
            {foreach $task.images as $image}
                <img src="{$image}" style="max-height: 240px; max-width: 320px; padding: 5px;">
            {/foreach}
        </div>
        {if $isAdmin}
            <div class="panel-footer">
                <a href="/?page=edit&id={$task.id}">Edit</a>
                {if not $task.is_completed}
                    | <a href="/?page=mark&id={$task.id}">Mark as completed</a>
                {/if}
            </div>
        {/if}
    </div>
    {/foreach}
    <div style="text-align: center">
        {$paginator}
    </div>
    {/block}
