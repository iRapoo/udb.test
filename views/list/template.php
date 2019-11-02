<?php require 'views/' . $_GET['view'] . '/index.php' ?>

<?php require 'views/header.php' ?>

<div class="container">

    <div class="main_user_data">
        <div class="mud_block_photo">
            <img src="/storage/<?=$view->user_data->photo?>" height="80" alt="">
        </div>
        <div class="mud_block_d">
            <div class="mud_block_name">Имя: <u><?=$view->user_data->name?></u></div>
            <div class="mud_block_email">Email: <u><?=$view->user_data->email?></u></div>
            <div class="mud_block_key">Ключ Api: <u><?=$view->user_data->key?></u></div>
        </div>

    </div>

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