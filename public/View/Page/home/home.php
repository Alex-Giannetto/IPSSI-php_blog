<!-- todo : rendre propre (enlever les br) !! -->

<br><br><br>

<h3 class="center">Welcome on My Super Blog</h3>

<br><br><br>

<div class="ArticleslistPage">
    <div class="articles">
        <?php foreach ($return['params']['articles'] as $i => $article) { ?>
            <div class="articles__cards <?= ($i % 2 == 0) ? 'articles__cards--left' : 'articles__cards--right' ?>">
                <div class="cards__content">
                    <div class="cards__image" style="background-image: url(/<?= $article['picture'] ?>)"></div>
                    <div class="cards__info">
                        <h3 class="cards__info__date"><?= $article['date'] ?></h3>
                        <h2 class="cards__info__title"><?= $article['title'] ?></h2>
                        <p class="cards__info__text"><?= $article['content'] ?></p>
                        <a href="/article/show/<?= $article['id'] ?>" class="cards__info__comments"><?= getNbComments($article['id']) ?> comments</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>


<div class="paging">
    <?php
    $i = 1;
    while ($i <= $return['params']['nbPage']) { // With a while !
        ?>
        <a href="/page/<?= $i ?>" class="page <?= ($i == $_GET['page'])? 'active' : '' ?>"><?= $i ?></a>
        <?php
        $i++;
    }
    ?>
</div>


