<?php

require_once 'Model/article.php';
require_once 'Model/comment.php';

function pageAction()
{
    $page = ($_GET['page'] ) * 5 - 5;

    $params['articles'] = getArticlePage($page);
    $params['nbPage'] = ceil(getNbArticle()['count'] / 5) ?? 0;

    return [
        'view' => 'home',
        'params' => $params

    ];
}


