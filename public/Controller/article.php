<?php
require_once 'Model/article.php';
require_once 'Model/comment.php';

function showAction(): array
{
    $idArticle = (int)inputSanitizer($_GET['id']);


    if(isset($_POST['submitConmment'])){

        $username = inputSanitizer($_POST['username']);
        $content = inputSanitizer($_POST['content']);

        $result = addComment($username, $content, $idArticle);
        $params['messages'][] = [
            'type' => ($result) ? 'success' : 'error',
            'text' => ($result) ? 'success' : 'error',
        ];
    }


    $article = getArticle($idArticle);
    $params['article'] = $article;

    $params['comments'] = getComments($idArticle);;

    if (count($article) === 0) {
        return ['redirect' => '/'];
    }

    return [
        'view' => 'showArticle',
        'dir' => 'Article/showArticle.php',
        'params' => $params
    ];
}

function manageAction()
{
    if (isset($_SESSION['user']['id'])) {
        $idArticle = (int)inputSanitizer($_GET['id']);
        $article = getArticle($idArticle);

        if (isset($_POST['token']) && $_SESSION['token'] === $_POST['token']) {
            if ($_POST['action'] === 'save') {
                if (checkField($_POST['title'], ['min' => 5, 'max' => 100]) &&
                    isset($_POST['content'])) {

                    $title = inputSanitizer($_POST['title']);
                    $content = inputSanitizer($_POST['content']);
                    $author = (int)inputSanitizer($_SESSION['user']['id']);

                    if (!empty($_FILES['file']['name'])) {
                        $file = uploadFile();

                        if (is_string($file)) {
                            $result = modifyArticle($title, $content, $author, (int)$article[0]['id'], $file);

                        } else {
                            foreach ($file as $error) {
                                $params['messages'][] = [
                                    'type' => 'error',
                                    'text' => $error,
                                ];
                            }

                            $result = false;
                        }

                    } else {
                        $result = modifyArticle($title, $content, $author, (int)$article[0]['id']);
                    }

                    $params['messages'][] = [
                        'type' => ($result) ? 'success' : 'error',
                        'text' => ($result) ? 'success' : 'error',
                    ];


                } else {
                    $params['messages'][] = [
                        'type' => 'error',
                        'text' => 'Some value are missing',
                    ];
                }
            } elseif ($_POST['action'] === 'delete') {
                return deleteAction();
            }
        }
        $idArticle = (int)inputSanitizer($_GET['id']);
        $article = getArticle($idArticle);
        $params['article'] = $article;

        $params['comments'] = getComments($idArticle);


        if (count($article) === 0) {
            return ['redirect' => '/'];
        } else {
            return [
                'view' => 'openArticle',
                'dir' => 'Article/openArticle.php',
                'params' => $params,
            ];
        }
    } else {
        return ['redirect' => '/user/signin'];

    }
}

function listArticleAction()
{
    if (isset($_SESSION['user']['id'])) {
        $articles = getArticles();

        $params['articles'] = $articles;

        return [
            'view' => 'adminArticle',
            'params' => $params
        ];
    } else {
        return ['redirect' => '/user/signin'];
    }

}

function addAction()
{
    if (isset($_SESSION['user']['id'])) {
        if (isset($_POST['token']) && $_SESSION['token'] === $_POST['token']) {
            if (checkField($_POST['title'], ['min' => 5, 'max' => 100]) && isset($_POST['content'])) {

                $title = inputSanitizer($_POST['title']);
                $content = inputSanitizer($_POST['content']);
                $author = (int)inputSanitizer($_SESSION['user']['id']);
                $file = uploadFile();

                if (is_string($file)) { // If the picture is correctly downloaded
                    $result = addArticle($title, $file, $content, $author);


                    if ($result) {
                        return ['redirect' => '/article/articles'];
                    } else {
                        $params['messages'][] = [
                            'type' => 'error',
                            'text' => 'Error during the adding',
                        ];
                    }
                } else {
                    foreach ($file as $error) {
                        $params['messages'][] = [
                            'type' => 'error',
                            'text' => $error,
                        ];
                    }
                }

            } else {
                $params['messages'][] = [
                    'type' => 'error',
                    'text' => 'Some value are missing or too short',
                ];
            }

        }

        return [
            'view' => 'openArticle',
            'dir' => 'Article/openArticle.php',
            'action' => 'add',
            'params' => $params
        ];
    } else {
        return ['redirect' => '/user/signin'];
    }
}

function deleteAction()
{
    if (isset($_SESSION['user']['id'])) {
        $idArticle = (int)inputSanitizer($_GET['id']);

        if (isset($_POST['token']) && $_SESSION['token'] === $_POST['token']) {
            // todo : faire 2 eme verification (etes vous sur …)

            $result = deleteArticle($idArticle);
            return ['redirect' => '/article/articles'];

        } else {
            return ['redirect' => '/'];

        }
    } else {
        return ['redirect' => '/'];

    }


}

function uploadFile()
{
    if (isset($_FILES['file'])) {


        $errors = array();
        [
            'name' => $file_name,
            'size' => $file_size,
            'tmp_name' => $file_tmp,
            'type' => $file_type
        ] = $_FILES['file'];
        $regex = '/^.*\.(jpg|jpeg|png|gif)$/i';

        if (0 == preg_match($regex, $file_name, $ext)) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }

        // 2MB == default conf of upload_max_filesize == 2097152
        if ($file_size > 6097152) {
            $errors[] = 'File size must be excately 2 MB';
        }

        if (empty($errors) == true) {
            $name = "uploads/" . uniqid() . ".$ext[1]";
            move_uploaded_file($file_tmp, $name);
            return $name;
        } else {
            return $errors;
        }
    }
}
