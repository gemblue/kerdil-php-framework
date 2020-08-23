<?php

declare(strict_types=1);

use Core\Utility\Url;

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<div class="container">
    <h1>Users</h1>
    
    <form action="<?php echo Url::base();?>users/register" method="post">
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>