<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolo da Poly - Cadastro de Imagens</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="src/css/system.css">
    <link rel="stylesheet" href="src/css/sistema.css">
    <link rel="stylesheet" href="src/css/upload.css">

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h4>Upload de Imagens no Sistema</h4>
                <form method="POST" enctype="multipart/form-data">
                    <input type="file" name="uploadImage" id="uploadImagem" />
                    <button class="btn btn-info">Upload</button><br /><br />
                    <a class="btn btn-info" href='http://localhost/bolodapoly/views/produto.php'>VOLTAR</a>
                </form>
            </div>

            <?php

            session_start();

            if(!isset($_SESSION['idUsuario'])){
                header("Location: http://localhost/bolodapoly");
            }

            if($_SERVER["REQUEST_METHOD"] === "POST"){

                $file = $_FILES["uploadImage"];

                if($file["error"]){
                    
                throw new Exception("Error: ". $file["error"]);
                    
                }

                $dir = "img";

                if(!is_dir($dir)){
                    mkdir($dir);
                }

                if(move_uploaded_file($file["tmp_name"], $dir . DIRECTORY_SEPARATOR . $file["name"])){
                    echo "<script>alert('Upload realizado com sucesso!');</script>";
                }else{

                throw new Exception("Não foi possível realizar o upload.");
                }                     
                    
            }

        ?>
        </div>
    </div>
</body>

</html>