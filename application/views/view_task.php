
<div class="container">
     <div class="starter-template">
        <h1>Task view</h1>
    </div>
     <img height="100" src="<?=$model['photo']?>">
    <dl class="dl-horizontal">
        <dt><?=$this->label['id'] ?></dt>
        <dd><?=$model['id'] ?></dd>

        <dt><?=$this->label['name'] ?></dt>
        <dd><?=$model['name'] ?></dd>

        <dt><?=$this->label['descr'] ?></dt>
        <dd><?=$model['descr'] ?></dd>

        <dt><?=$this->label['created_time'] ?></dt>
        <dd><?=$model['created_time'] ?></dd>

        <dt><?=$this->label['updated_time'] ?></dt>
        <dd><?=$model['updated_time'] ?></dd>
    </dl>
</div>

