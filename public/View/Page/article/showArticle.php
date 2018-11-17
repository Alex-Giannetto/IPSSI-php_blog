<div class="articlePage">
    <div class="article__cards">

        <h3 class="cards__date"><?= $return['params']['article'][0]['date'] ?> - <?= $return['params']['article'][0]['username'] ?></h3>
        <h2 class="cards__title"><?= $return['params']['article'][0]['title'] ?></h2>
        <div class="cards__image"
             style="background-image: url(/<?= $return['params']['article'][0]['picture'] ?>)"></div>
        <p class="cards__text">
            <?= $return['params']['article'][0]['content'] ?>
        </p>
    </div>
</div>
<?php
$i = 0;
while ($i < count($return['params']['comments'])) { // while …
    $comment = $return['params']['comments'][$i];
    include 'comments.php';
    $i++;
}
?>


<div class="commentsComponent">
    <div class="comments__cards">
        <div class="cards__content">
            <div class="cards__name" id="name">U</div>
            <div class="cards__info">
                <form method="post">
                    <header>
                        <input class="cards__info__name validate" data-lenght="4" type="text" placeholder="Username"
                               id="username" name="username" required>
                        <h3 class="cards__info__date"><?= date('d/m/Y') ?></h3>
                    </header>
                    <div class="input-field col s12">
                        <textarea id="comment" class="materialize-textarea validate" data-lenght="2"
                                  placeholder="Comment" name="content" required></textarea>
                    </div>
                    <div class="center"><input type="submit" name="submitConmment" class="cards__info__comments"
                                               value="Send"></div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('username').addEventListener('keyup', (event) => {
        let username = document.getElementById('username').value;

        let name = "";

        if (username.length > 0) {
            username = username.split(" ");
            username = username.slice(0, 3);

            for (let word of username) {
                name += word[0] || '';
            }
        } else {
            name = "U";
        }

        document.getElementById("name").innerHTML = name;

    });
</script>