<div class="container">

    <form class="form-signin" enctype="multipart/form-data" role="form" action="/task/create_task" method="POST">
        <h2 class="form-signin-heading"><?= 'New Task' ?></h2>
        <label> <?=$this->label['name'] ?></label>
        <input name="new_task[name]" type="text" class="form-control" placeholder="name" required autofocus>
        <label> <?=$this->label['descr'] ?></label>
        <input name="new_task[descr]" type="text" class="form-control" placeholder="description" required autofocus>
        <label><?=$this->label['photo']?></label>
        <input type="file" name='new_task[photo]' class="form-control">
        
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
</div>
