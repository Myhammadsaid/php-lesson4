<?php
ob_start();
session_start();

// Очистка старых ошибок и данных
unset($_SESSION['user_name']);
unset($_SESSION['email']);
unset($_SESSION['subject']);
unset($_SESSION['message']);
unset($_SESSION['error_username']);
unset($_SESSION['error_email']);
unset($_SESSION['error_subject']);
unset($_SESSION['error_message']);

// Перенаправление
function redirect() {
    header('Location: contact.php');
    exit();
}

// Получение данных из формы
$user_name = htmlspecialchars(trim($_POST['username']));
$from = htmlspecialchars(trim($_POST['email']));
$subject = htmlspecialchars(trim($_POST['subject']));
$message = htmlspecialchars(trim($_POST['message']));

// Сохранение данных в сессии
$_SESSION['user_name'] = $user_name;
$_SESSION['email'] = $from;
$_SESSION['subject'] = $subject;
$_SESSION['message'] = $message;

// Валидация данных
if (strlen($user_name) <= 1) {
    $_SESSION['error_username'] = 'Введите корректное имя';
    redirect();
} else if (strlen($from) < 5 || strpos($from, '@') === false) {
    $_SESSION['error_email'] = 'Вы ввели некорректный email';
    redirect();
} else if (strlen($subject) <= 5) {
    $_SESSION['error_subject'] = 'Тема сообщения должна быть не менее 5 символов';
    redirect();
} else if (strlen($message) <= 15) {
    $_SESSION['error_message'] = 'Сообщение должно быть не менее 15 символов';
    redirect();
} else {
    // Отправка письма
    $subject = '=?utf-8?B?' . base64_encode($subject) . '?=';
    $headers = "From: $from\r\nReply-to: $from\r\nContent-type: text/plain; charset=utf-8\r\n";

    if (mail('muhammadsaidmm4@gmail.com', $subject, $message, $headers)) {
        $_SESSION['success_mail'] = 'Вы успешно отправили письмо!';
    } else {
        $_SESSION['success_mail'] = 'Ошибка при отправке письма!';
    }
    redirect();
}

ob_end_flush();
?>
