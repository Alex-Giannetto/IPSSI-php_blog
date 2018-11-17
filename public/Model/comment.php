<?php

function getComments(int $article): array
{
    $query = getPDO()->prepare('SELECT * FROM comments WHERE article = :article');
    $query->bindParam('article', $article);
    $query->execute();

    return $query->fetchAll();
}


function addComment(string $username, string $content, int $article): bool
{

    $query = getPDO()->prepare('INSERT INTO  comments(username, content, date, article)' .
        'VALUES(:username, :content, :date, :article)');

    $date = (string)date('Y-m-d');

    $query->bindParam('username', $username);
    $query->bindParam('content', $content);
    $query->bindParam('date', $date);
    $query->bindParam('article', $article);


    return $query->execute();
}

function getNbComments($article): int
{
    $query = getPDO()->prepare('SELECT count(id) FROM comments WHERE article = :article');

    $query->bindParam('article', $article);

    $query->execute();

    $result = $query->fetch();

    return $result[0] ?? 0;
}