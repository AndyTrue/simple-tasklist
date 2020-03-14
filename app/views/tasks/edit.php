<?php require_once  ROOT . '/views/inc/header.php'?>

    <div class="card card-body bg-light mt-3">
        <h2>Edit task</h2>
        <p>Edit task with this form</p>
        <form action="<?php echo URLROOT?>/tasks/edit/<?php echo $data['id'];?>" method="post">
            <div class="form-group">
                <label for="title">Title: <sup>*</sup></label>
                <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''?>" value="<?php echo $data['title']?>">
                <span class="invalid-feedback"><?php echo $data['title_err']?></span>
            </div>
            <div class="form-group">
                <label for="body">Text: <sup>*</sup></label>
                <textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''?>"> <?php echo $data['body']?></textarea>
                <span class="invalid-feedback"><?php echo $data['body_err']?></span>
            </div>
            <input type="submit" value="Submit" class="btn btn-success">
        </form>
    </div>
<?php require_once  ROOT . '/views/inc/footer.php'?>