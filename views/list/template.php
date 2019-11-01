<?php require 'views/' . $_GET['view'] . '/index.php' ?>

<?php require 'views/header.php' ?>

<div class="container">

    <table id="users_list" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th scope="col">#ID</th>
            <th>Фотография</th>
            <th>Имя</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody>

        <?php

        foreach ($view->all_users as $index => $user) {

            ?>

            <tr>
                <th scope="row"><?= $user->id ?></th>
                <td><img src="/storage/<?= $user->photo ?>" height="50" alt=""/></td>
                <td><?= $user->name ?></td>
                <td><?= $user->email ?></td>
            </tr>

            <?

        }

        ?>

        </tbody>
        <tfoot>
        <tr>
            <th scope="col">#ID</th>
            <th>Фотография</th>
            <th>Имя</th>
            <th>Email</th>
        </tr>
        </tfoot>
    </table>

</div>

<?php require 'views/footer.php' ?>