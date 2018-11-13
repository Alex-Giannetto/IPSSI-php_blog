<div class="row">
    <div class="col s6 offset-s3">

        <form class="col s12" method="post">
            <div class="row">
                <div class="input-field col s6">
                    <input id="input__username" type="text" value="<?= $return['params']['values']['username'] ?? '' ?>"
                           name="username" class="validate"
                           minlength="4" data-length="20" required>
                    <label for="input__username">Username</label>
                </div>
                <div class="input-field col s6">
                    <input id="input__password" type="password"
                           value="<?= $return['params']['values']['password'] ?? '' ?>" name="password" class="validate"
                           data-length="30" minlength="8" required>
                    <label for="input__password">Password</label>
                </div>

                <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>"/>
            </div>
            <div class="center">
                <button class="btn waves-effect waves-light" type="submit">
                    Sign In
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </div>
</div>