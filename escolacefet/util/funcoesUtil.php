<?php
 
/*criar uma conexão com o banco MySQL usando PDO
Configurar opções da conexão
Tratar erros com try/catch
Retornar respostas JSON em caso de erro
*/
 
 //Define os dados de conexão: servidor, banco,usuário,senha e charset;
function getPDO():PDO{
$host = 'localhost';
$db = "basealunos";
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';
 //É a string usada pelo PDO para conectar no banco.
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
//Configurações da conexão.
$options = [
    PDO::ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION, //Faz o PDO lançar exceções quando ocorrer erro.
    PDO::ATTR_PERSISTENT => true //Mantém conexões persistentes abertas para melhorar desempenho.
];
 
$pdo = null; //declaro o pdo fora se não ele deixa de exitir fora do try catch
//Tenta criar a conexão.
try{
    $pdo = new PDO($dsn, $user, $pass, $options);
}
catch (PDOException $e){ //Captura erros de conexão e envia um json com a mensagem de erro.
    responderJson(['erro' => "erro ao conectar ao banco. {$e->getMessage()}"], 400);
 
}
return $pdo;
}
 function responderJson(array|null $infoDados, int $codStatus = 200):void{
    header('Content-Type: application/json; charset=utf-8'); // vai devolver umn json
    http_response_code($codStatus); // vai devolver o codigo de status
    die(json_encode($infoDados, JSON_UNESCAPED_UNICODE, JSON_UNESCAPED_SLASHES)); // transforma os dados em JSON, imprime o JSON e encerra o script imediatamente
}
/* PDO
→ classe para acessar banco de dados
try/catch
→ tratamento de exceções
json_encode
→ transforma array PHP em JSON
header()
→ define o tipo da resposta HTTP
http_response_code()
→ define status HTTP
*/
?>
