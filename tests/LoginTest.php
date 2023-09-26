<?php
use PHPUnit\Framework\TestCase;
session_start();
class LoginTest extends TestCase {
    
    public function testLoginWithValidUserAndPassword() {

        $conn = new mysqli('localhost:3306', 'root', 'mysqlRoot2023', 'biorecord');

        // Dados de login válidos
        $_POST['login-form-email'] = 'alex@gmail.com';
        $_POST['login-form-password'] = '1234';

        $this->assertFalse(isset($_SESSION['nao-autenticado']));
        $this->assertFalse(isset($_SESSION['msg-title']));
        $this->assertFalse(isset($_SESSION['mensagem']));
    }

    public function testLoginWithInvalidUserOrPassword() {
        $conn = new mysqli('localhost:3306', 'root', 'mysqlRoot2023', 'biorecord');

        // Dados de login inválidos
        $_POST['login-form-email'] = 'invalido@gmail.com';
        $_POST['login-form-password'] = 'invalido';

        $this->assertFalse(isset($_SESSION['login']));
    }
}
?>
