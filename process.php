<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'crud_produtos') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$nome = '';
$preco = '';
$descricao = '';

if (isset($_POST['salvar'])) {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];

    $mysqli->query("INSERT INTO produtos (nome, preco, descricao) VALUES('$nome', '$preco', '$descricao')") or
        die($mysqli->error);

    $_SESSION['message'] = "Produto salvo com sucesso!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM produtos WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "record has been deleted";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM produtos WHERE id=$id") or die($mysqli->error());
    $pkCount = (is_array($result) ? count($result) : 1);
    if ($pkCount == 1) {
        $row = $result->fetch_array();
        $nome = $row['nome'];
        $preco = $row['preco'];
        $descricao = $row['descricao'];
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];

    $mysqli->query("UPDATE produtos SET nome='$nome', preco='$preco', descricao='$descricao' WHERE id=$id")
        or die($mysqli->error);

    $_SESSION['message'] = "Produto Atualizado com sucesso!";
    $_SESSION['msg_type'] = "warning";

    header("location: index.php");
}

if(isset($_GET['exit'])){
    header("location: index.php");
}