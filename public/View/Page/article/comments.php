
<div class="commentsComponent">
    <div class="comments__cards">
        <div class="cards__content">
            <div class="cards__name">AG</div>
            <div class="cards__info">
                <header>
                    <h2 class="cards__info__name"><?= $comment['username'] ?? '' ?></h2>
                    <h3 class="cards__info__date"><?= $comment['date'] ?? '' ?></h3>
                </header>
                <p class="cards__info__text">
                    <?= $comment['content'] ?? '' ?>
                </p>
            </div>
        </div>
    </div>
</div>

