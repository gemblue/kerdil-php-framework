<?php
use Core\Utility\Url;
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<div class="container">
    <h1>Users</h1>
        
    <div class="text-right">
        <a href="<?php echo Url::base();?>users/add" class="btn btn-success mb-4">New User</a>
    </div>
    
    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th></th>
        </tr>
        <?php foreach ($users as $user) :?>
            <tr>
                <td><?php echo $user->name?></td>
                <td><?php echo $user->email?></td>
                <td>
                    <a href="<?php echo Url::base();?>users/delete?id=<?php echo $user->id?>" onclick="return confirm('You sure?');" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
</div>