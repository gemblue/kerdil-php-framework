<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<div class="container">
    <h1>Users</h1>
    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Email</th>
        </tr>
        <?php foreach ($users as $user) :?>
            <tr>
                <td><?php echo $user->name?></td>
                <td><?php echo $user->email?></td>
            </tr>
        <?php endforeach;?>
    </table>
</div>