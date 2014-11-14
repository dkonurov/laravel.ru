@extends('_layout.nosidebar')

@section('title')
    Апдейты документации
@stop

@section('content')

<h1>Апдейты документации</h1>

<?foreach($docs as $version=>$pages){?>

<h2>Ветка <?= $version ?></h2>
<table class="table table-bordered">
    <tr>
        <th></th>
        <th>Наименование</th>
        <th>Перевод</th>
        <th>от оригинала</th>
        <th>Текущий оригинал</th>
        <th>Новые коммиты</th>
    </tr>
    <?foreach($pages as $i=>$page){?>
    <tr>
        <td><?= $i+1 ?></td>
        <td><?= $page->name ?></td>
        <td><?= $page->last_commit_at->format("d.m.Y H:i") ?> <span class="text-muted"><?= substr($page->last_commit, 0, 7) ?></span></td>
        <td><?= $page->last_original_commit_at->format("d.m.Y H:i") ?> <span class="text-muted"><?= substr($page->last_original_commit, 0, 7) ?></span></td>
        <td><span class="text-muted"><?=$page->current_original_commit?></span></td>
        <td>
            <?if($page->original_commits_ahead==0){?>
                    <span class="text-success"></span>
            <?}else{?>
                <span class="text-danger"><?= $page->original_commits_ahead ?></span>
                git difftool <?=substr($page->last_original_commit, 0, 7)?> <?=substr($page->current_original_commit, 0, 7)?> <?= $page->name ?>.md
            <?}?>
        </td>
    </tr>

    <?}?>
</table>

<?}?>

@stop