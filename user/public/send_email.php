<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームからのデータを取得
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $reason = htmlspecialchars($_POST['reason'], ENT_QUOTES, 'UTF-8');
    $inputre = htmlspecialchars($_POST['inputre'], ENT_QUOTES, 'UTF-8');

    // 送信先のメールアドレス
    $to = '2201009@s.asojuku.ac.jp'; // ここにメールを受け取るあなたのメールアドレスを入力

    // メールの件名
    $subject = 'お問い合わせ: ' . $reason;

    // メールの内容
    $mailBody = "メールアドレス: $email\n\nお問い合わせ理由:\n$reason\n$inputre";

    // メールヘッダー
    $headers = 'From: ' . $email . "\r\n" .
               'Reply-To: ' . $email . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    // メール送信
    if (mail($to, $subject, $mailBody, $headers)) {
        echo '<span style="color:#ffffff;">お問い合わせが送信されました。</span>.';
    } else {
        echo '<span style="color:#ffffff;">お問い合わせの送信に失敗しました。もう一度お試しください。</span>';
    }

}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>お問い合わせ完了</title>
  <link rel="stylesheet" href="./css/send_email.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<script>
    setTimeout(function(){
        window.location.href = 'login.php'; // ログイン画面のURLにリダイレクト
    }, 2000); // 3秒後にリダイレクト
</script>
</body>
</html>
