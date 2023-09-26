<?php
  $servername = "localhost:3306"; // endereço do servidor MySQL
  $username = "root"; // nome de usuário do banco de dados
  $password = "mysqlRoot2023"; // senha do banco de dados
  $dbname = "biorecord";
  
  // cria uma conexão com o banco de dados usando mysqli_connect()
  $conn = mysqli_connect($servername, $username, $password, $dbname);  
?>