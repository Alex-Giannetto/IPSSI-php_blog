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

function modifyArticle(string $title, string $text, int $author, int $idArticle, string $file = null): bool
{
    $sql = "UPDATE articles " .
        "SET title = :title, content = :content, author = :author";
    $sql .= ($file !== null) ? ', picture = :picture ' : ' ';
    $sql .= "WHERE id = :id";

    $query = getPDO()->prepare($sql);

    $query->bindParam('title', $title);
    $query->bindParam('content', $text);
    $query->bindParam('author', $author);
    $query->bindParam('id', $idArticle);

    if ($file) {
        $query->bindParam('picture', $file);
    }

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

function getArticlePage(int $page): array
{
    $query = getPDO()->prepare(
        "SELECT *" .
        "FROM articles a " .
        "ORDER BY id DESC " .
        "LIMIT 5 OFFSET :num "
    );

    $query->bindValue(':num', $page, PDO::PARAM_INT);

    $query->execute();
    return $query->fetchAll();
}

function getNbArticle(): array
{
    $query = getPDO()->prepare(
        "SELECT count(*) as count " .
        "FROM articles"
    );

    $query->execute();
    return $query->fetch();
}