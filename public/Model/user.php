<?php

/**
 * Add an user in the database
 *
 * @param string $username
 * @param string $password
 * @return bool
 */
function addUser(string $username, string $password): bool
{
    $pdo = getPDO();
    $query = $pdo->prepare('INSERT INTO user(username, password) VALUES (:username, :password)');

    $query->bindParam(':username', $username);
    $query->bindParam(':password', $password);

    return $query->execute();
}


function getUserPassword($username)
{
    $pdo = getPDO();
    $query = $pdo->prepare('SELECT password FROM user WHERE username = :username LIMIT 1');
    $query->bindParam(':username', $username);
    $query->execute();

    return $query->fetch();
}

function getUser($username){
    $pdo = getPDO();
    $query = $pdo->prepare('SELECT id, username FROM user WHERE username = :username LIMIT 1');
    $query->bindParam(':username', $username);
    $query->execute();

    return $query->fetch();
}
