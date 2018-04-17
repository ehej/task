<?php
//var_dump($this); die();

?>
<div class="container" id="list-tasks-block">
    <div class="starter-template">
        <h1>Tasks list</h1>
        <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?= $this->label['id'] ?></th>
                    <th><?= $this->label['name'] ?></th>
                    <th><?= $this->label['descr'] ?></th>
                    <th><?='#'?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $item) : ?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['name'] ?></td>
                        <td><?= $item['descr'] ?></td>
                        <td>
                            <a href="/task/view_task?id=<?=$item['id']?>" title="View" aria-label="View">
                                <span class="glyphicon glyphicon-eye-open">
                                </span>
                            </a>
                            <a href="/task/create_task" title="Create">
                            <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a href="javascript:void(0);" onclick="deleteTask(this)" val="<?=$item['id']?>" class="delete-task" title="Delete" aria-label="Delete"  data-confirm="Are you sure you want to delete this item?" >
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?=$pagin?>
    </div>
</div>

    
