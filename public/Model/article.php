<?php


function addArticle(string $title, string $file, string $text, int $idUser): bool
{
    $query = getPDO()->prepare(
        "INSERT INTO articles(title, content, picture, date, author) " .
        "VALUES(:title, :content, :picture, :date, :author)"
    );

    $query->bindParam('title', $title);
    $query->bindParam('content', $text);
    $query->bindParam('picture', $file);
    $query->bindParam('date', date('Y-m-d'));
    $query->bindParam('author', $idUser);

    return $query->execute();
}

function getArticles(): array
{
    $query = getPDO()->prepare(
        "SELECT a.*, u.username " .
        "FROM articles a left join user u on a.author = u.id " .
        "ORDER BY a.id DESC"
    );

    $query->execute();
    return $query->fetchAll();
}

function getArticle(int $id): array
{
    $query = getPDO()->prepare(
        "SELECT a.*, u.username " .
        "FROM articles a left join user u on a.author = u.id " .
        "WHERE a.id = :id " .
        "ORDER BY a.id DESC"
    );

    $query->bindParam('id', $id);
    $query->execute();
    return $query->fetchAll();
}

function modifyArticle(string $title, string $text, string $file, int $idArticle): bool
{
    $query = getPDO()->prepare(
        "UPDATE articles " .
        "SET title = :title, content = :content, picture = :picture " .
        "WHERE id = :id"
    );

    $query->bindParam('title', $title);
    $query->bindParam('content', $text);
    $query->bindParam('picture', $file);
    $query->bindParam('id', $idArticle);

    return $query->execute();
}

function deleteArticle(int $idArticle): bool
{
    $query = getPDO()->prepare(
        "DELETE FROM articles " .
        "WHERE id = :id"
    );

    $query->bindParam('id', $idArticle);

    return $query->execute();
}