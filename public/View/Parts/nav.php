<ul id="nav-dropdown" class="dropdown-content">
    <li><a href="/article/articles">Articles Manager</a></li>
    <li><a href="/user/disconnect">Disconnect</a></li>
</ul>

<nav>
    <div class="nav-wrapper">
        <a href="/" class="brand-logo">My Super Blog</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <?php if (empty($_SESSION['user'])) {?>
                <li><a href="/user/signin">Sign In</a></li>
                <li><a href="/user/signup">Sign Up</a></li>
            <?php } else {?>
                <li><a class="dropdown-trigger" href="/user/disconnect" data-target="nav-dropdown"><?= $_SESSION['user']['name'] ?><i class="material-icons right">arrow_drop_down</i></a></li>
            <?php } ?>
        </ul>
    </div>
</nav>
