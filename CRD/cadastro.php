<?php
function enviarDados(){
    include("conexao.php");
    if (isset($_POST['submit'])) {  
        $nome = $_POST['nome'];
        $idade = $_POST['idade'];
        $cpf = $_POST['cpf'];
    
        
        $query = "INSERT INTO dados(nome,idade,cpf) VALUES ('$nome','$idade','$cpf')";
        if(mysqli_query($sql, $query)) {
            return "Deu certo";
        }
    }
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    enviarDados();
}
function buscarDados(){
    include("conexao.php");
    $query = "SELECT * FROM dados";
    $result = mysqli_query($sql, $query);

    $valores = [];
    while($row = mysqli_fetch_array($result)){
        $valores[] = $row;
    }
    return $valores;
}

$valores = buscarDados();

function deletar(){
    include("conexao.php");
    $cpf = $_GET["cpf"];
    $query = "DELETE FROM dados WHERE cpf ='$cpf'";
    $result = mysqli_query($sql, $query);

    return $result;
}
if(isset($_GET["cpf"])){
    deletar();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CADASTRO</title>
</head>

<body onsubmit="evitar_dados_reload()">
    <h1>Cadastre-se</h1>
    <form action="cadastro.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" placeholder="Digite o nome completo" required> <br><br>
        <label for="idade">Idade:</label>
        <input type="number" name="idade" id="idade" placeholder="Idade" min="1" max="110" required> <br> <br>
        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" id="cpf" placeholder="000.000.000-00" maxlength="14" required><br> <br>
        <button type="submit" name="submit" class="btn-form">Enviar</button>
    </form>
            <div class="lista">
                <table>
                    <tr>
                        <th>Nome</th>
                        <th>Idade</th>
                        <th>CPF</th>
                    </tr>
                <?php
                    foreach($valores as $dado){
                ?>
                    <tr>
                        <td><?=$dado['nome'] ?></td>
                        <td><?=$dado['idade'] ?></td>
                        <td><?=$dado['cpf'] ?></td>
                        <?php
                            $cpf = $dado["cpf"];
                        ?>
                        <td><a href=<?="cadastro.php?cpf=$cpf"?> class="btn-del">Deletar</a></td>
                    </tr>
                <?php
                    }
                ?>
                </table>
            </div>
    <script>
        function evitar_dados_reload(){

        if(window.history.replaceState) {
            window.history.replaceState( null, null, window.location.href );
        }

        function update(){
            window.location.reload();
        }
        }
        
        function fotmatarNumero(numero){
            numero = numero.replace(/(\d{4})$/);
            return numero;
        }
            document.getElementById('idade').addEventListener('input', function(evento) {
            let target = evento.target;
            let valor = target.value;

            valor = fotmatarNumero(valor);
            target.value = valor;
        });

        function formatarCPF(cpf) {
            cpf = cpf.replace(/\D/g, ''); //remover o que não for numero
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); //adicionar pontos apos ops 3 primeiros digitos
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); //adicionar pontos apos ops 3 primeiros digitos
            cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            return cpf;
        }
        document.getElementById('cpf').addEventListener('input', function(evento) {
            let target = evento.target;
            let valor = target.value;

            valor = formatarCPF(valor);
            target.value = valor;
        });
    </script>
</body>
</html>
