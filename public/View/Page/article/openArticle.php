<div class="articlePage">
    <div class="article__cards">
        <form method="post" enctype="multipart/form-data">
            <h3 class="cards__date"><?= $return['params']['article'][0]['date'] ?? date('d M Y') ?></h3>
            <input type="text" name="title" class="cards__title" placeholder="Title"
                   value="<?= $return['params']['article'][0]['title'] ?? '' ?>"/>
            <div class="cards__image" style="background-image: url(/<?= $return['params']['article'][0]['picture'] ?>);"></div>

            <div class="file-field input-field ">
                <div class="btn">
                    <span>File</span>
                    <input type="file" name="file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" id="file" type="text"/>
                </div>
            </div>
            <textarea class="materialize-textarea validate cards__text" name="content"
                      placeholder="Content"><?= $return['params']['article'][0]['content'] ?? '' ?></textarea>

            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>"/>

            <div class="buttons <?= ($return['action'] === 'add') ? 'buttons--one' : '' ?>">
                <input type="submit" name="action" class="button button--add" value="save">
                <?php if ($return['action'] !== 'add') { ?>
                    <input type="submit" name="action" class="button button--delete" value="delete">
                <?php } ?>
            </div>
        </form>
    </div>
    <?php
    for ($i = 1; $i < 5; $i++) {
        include 'comments.php';
    }
    ?>
</div>