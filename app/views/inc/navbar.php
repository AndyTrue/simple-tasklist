<?php require_once ROOT . '/views/inc/header.php';?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-3">
    <div class="container">
        <a class="navbar-brand" href="/">Tasklist</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php URLROOT?>/pages/about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php URLROOT?>/tasks">Tasks</a>
                </li>
            </ul>


            <ul class="navbar-nav ml-auto">
                <?php if (isLoggedIn()) :?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Welcome <?php echo $_SESSION['user_name'];?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT;?>/users/logout">Logout</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT;?>/users/register">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT?>/users/login">Login</a>
                    </li>
                <?php endif;?>
            </ul>
        </div>
    </div>
</nav>
<?php require_once ROOT . '/views/inc/footer.php';?>
