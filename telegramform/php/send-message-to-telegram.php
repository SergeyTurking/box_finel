<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['user_name'];
  $phone = $_POST['user_phone'];
  $age = $_POST['user_age'];

  // Проверяем, что данные были переданы
  if (!empty($name) && !empty($phone) && !empty($age)) {
    $token = "6816639184:AAFpviaRcyzwS5j7Fhb-2MQm-yesbmU2L_Q";
    $chat_id = "-4147414117";
    $arr = array(
      'Имя пользователя: ' => $name,
      'Телефон: ' => $phone,
      'Возраст: ' => $age
    );

    $txt = '';
    foreach($arr as $key => $value) {
      $txt .= "<b>".$key."</b> ".$value."%0A";
    }

    $ch = curl_init();
    curl_setopt_array($ch, array(
      CURLOPT_URL => "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}",
      CURLOPT_RETURNTRANSFER => true
    ));

    $response = curl_exec($ch);

    if ($response === false) {
      echo "Error: " . curl_error($ch);
    } else {
      // Перенаправляем на другую страницу после успешной отправки сообщения
      header('Location: https://cv36528.tw1.ru/');
      exit;
    }

    curl_close($ch);
  } else {
    echo "Ошибка: Не все данные были переданы";
  }
}
?>