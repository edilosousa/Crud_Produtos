<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crud com PHP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>

<style>
    input[type='file'] {
        display: none
    }

    /* Aparência que terá o seletor de arquivo */
    /* label {
        background-color: #3498db;
        border-radius: 5px;
        color: #fff;
        cursor: pointer;
        margin: 10px;
        padding: 6px 20px
    } */
</style>


<body>
    <?php require_once 'process.php'; ?>

    <div class="container-fluid">
        <h1 class="text-center">Cadastro de Produtos</h1>

        <div class="container">
            <form action="process.php" method="post" class="mt-3">
                <div class="row form-group">
                    <div class="col-3">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <!-- <label>Nome</label> -->
                        <input type="text" name="nome" value="<?php echo $nome; ?>" placeholder="Nome" class="form-control">
                    </div>
                    <div class="col-3">
                        <!-- <label>Preço</label> -->
                        <input type="text" name="preco" value="<?php echo $preco; ?>" placeholder="Preço" class="form-control">
                    </div>
                    <div class="col-3">
                        <!-- <label>Descrição</label> -->
                        <input type="text" name="descricao" value="<?php echo $descricao; ?>" placeholder="Descrição" class="form-control">
                    </div>
                    <div class="col-1">
                        <label for='selecao-arquivo' class="btn btn-primary"><i class="fas fa-image"></i></label>
                        <input id='selecao-arquivo' type='file'>
                    </div>
                    <div class="col-2">
                        <?php
                        if ($update == true) :
                            ?>
                            <button type="submit" name="update" class="btn btn-info"><i class="fas fa-edit"></i></button>
                            <button type="submit" name="exit" class="btn btn-dark"><i class="fas fa-times"></i></button>
                        <?php else :  ?>
                            <button type="submit" name="salvar" class="btn btn-success"><i class="fas fa-plus"></i></button>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>


        <?php
        if (isset($_SESSION['message'])) :  ?>

            <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif ?>


        <?php
        $mysqli = new mysqli('localhost', 'root', '', 'crud_produtos') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM produtos") or die($mysqli->error);
        //pre_r($result);
        ?>

        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>Cod:</th>
                        <th>Nome:</th>
                        <th>Preço:</th>
                        <th>Descrição</th>
                        <th colspan="4">Action</th>
                    </tr>
                </thead>
                <?php
                while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nome']; ?></td>
                        <td><?php echo $row['preco']; ?></td>
                        <td><?php echo $row['descricao']; ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="index.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endwhile ?>
            </table>
        </div>

    </div>


</body>

</html>