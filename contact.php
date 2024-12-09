<?php
ob_start();
session_start();

// Инициализация переменных сессии
if (!isset($_SESSION['success_mail'])) $_SESSION['success_mail'] = '';
if (!isset($_SESSION['error_username'])) $_SESSION['error_username'] = '';
if (!isset($_SESSION['error_email'])) $_SESSION['error_email'] = '';
if (!isset($_SESSION['error_subject'])) $_SESSION['error_subject'] = '';
if (!isset($_SESSION['error_message'])) $_SESSION['error_message'] = '';
if (!isset($_SESSION['user_name'])) $_SESSION['user_name'] = '';
if (!isset($_SESSION['email'])) $_SESSION['email'] = '';
if (!isset($_SESSION['subject'])) $_SESSION['subject'] = '';
if (!isset($_SESSION['message'])) $_SESSION['message'] = '';

$title = 'Контакты';
require_once 'companents/header.php';
?>

<h1>Контакты</h1>

<!-- Сообщение об успешной отправке -->
<div class="alert alert-success"><?= $_SESSION['success_mail'] ?></div>

<form action="check_contact.php" method='post'>
    <input type="text" name="username" value="<?= $_SESSION['user_name'] ?>" placeholder="Введите имя" class="form-control mb-2">
    <div class="text-danger"><?= $_SESSION['error_username'] ?></div><br>

    <input type="email" name="email" value="<?= $_SESSION['email'] ?>" placeholder="Введите email" class="form-control mb-2">
    <div class="text-danger"><?= $_SESSION['error_email'] ?></div><br>

    <input type="text" name="subject" value="<?= $_SESSION['subject'] ?>" placeholder="Тема сообщения" class="form-control mb-2">
    <div class="text-danger"><?= $_SESSION['error_subject'] ?></div><br>

    <textarea name="message" placeholder="Ваше сообщение" class="form-control mb-2"><?= $_SESSION['message'] ?></textarea>
    <div class="text-danger"><?= $_SESSION['error_message'] ?></div><br>

    <button type="submit" class="btn btn-success">Отправить</button>
</form>

<?php
require_once 'companents/footer.php';
ob_end_flush();
?>
