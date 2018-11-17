<div class="articleAdminPage">
    <h1 class="center">Articles manager</h1>

    <br>

    <div class="container table">


        <table id="table" class="striped highlight centered">
            <thead>
            <th>ID</th>
            <th>Date</th>
            <th>Title</th>
            <th>Author</th>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < count($return['params']['articles']); $i++) { ?>
                <tr>
                    <td><?= $return['params']['articles'][$i]['id'] ?></td>
                    <td><?= $return['params']['articles'][$i]['date'] ?></td>
                    <td><a href="/article/manage/<?= $return['params']['articles'][$i]['id'] ?>" target=”_blank”><?= $return['params']['articles'][$i]['title'] ?></a></td>
                    <td><?= $return['params']['articles'][$i]['username'] ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

        <div class="buttons buttons--one">
            <a href="/article/add" class="button button--modify">Add</a>
        </div>
    </div>
</div>
