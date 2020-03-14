<?php require_once ROOT . '/views/inc/header.php';?>

<div class="row">
    <div class="col-md-8">
        <a href="<?php echo URLROOT;?>/tasks/add" class="btn btn-success mb-3">Add task</a>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($data['tasks'] as $task) : ?>
                <tr>
                    <td scope="col"><?php echo $task->id;?></td>
                    <td scope="col"><?php echo $task->title;?></td>
                    <td scope="col"><a href="<?php echo URLROOT?>/tasks/show/<?php echo $task->id?>" class="btn btn-primary">Show</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>


<?php require_once ROOT . '/views/inc/footer.php';?>