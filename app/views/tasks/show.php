<?php require_once  ROOT . '/views/inc/header.php'?>

    <h1><?php echo $data['task']->title;?></h1>
    <p><?php echo $data['task']->body?></p>

    <a href="<?php echo URLROOT?>/tasks/edit/<?php echo $data['task']->id?>" class="btn btn-dark">Edit</a>
    <a href="<?php echo URLROOT?>/tasks/index" class="btn btn-primary">Back</a>
    <form action="<?php echo URLROOT?>/tasks/delete/<?php echo $data['task']->id?>" method="post" class="float-right">
        <input type="submit" value="Delete" class="btn btn-danger">
    </form>
<?php require_once  ROOT . '/views/inc/footer.php'?>