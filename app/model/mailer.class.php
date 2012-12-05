<?php

class Mailer {
  public static function sendExamApplicationEmail($data) {
    $message = "Ime i prezime: " . $data['examName'] . '<br />';
    $message .= "Adresa: " . $data['examAddress'] . '<br />';
    $message .= "OIB: " . $data['examOib'] . '<br />';
    $message .= "Kontakt telefon: " . $data['examPhone'] . '<br />';
    $message .= "Kontakt e-mail: " . $data['examEmail'] . '<br />';
    
    $message .= "Tečaj: ";
    
    switch ($data['examClass']):
      case 'uefaB':
        $message .= 'Uefa B';
        break;
      case 'uefaA':
        $message .= 'Uefa A';
        break;
      case 'uefaPro':
        $message .= 'Uefa Pro';
        break;
      case 'futsalB':
        $message .= 'Futsal B';
        break;
    endswitch;
    
    $message .= '<br />';

    return self::sendHtmlMail (Config::read ('adminEmail'), 'Prijava za polaganje ispita', $message, Config::read ('adminEmail'));

    $_SESSION['message'] = 'Slanje poruke bilo je neuspješno, pokušajte ponovo';
    return FALSE;
  }
  
  public static function sendClassApplicationEmail($data) {
    $message = "Ime i prezime: " . $data['name'] . '<br />';
    $message .= "Adresa: " . $data['address'] . '<br />';
    $message .= "OIB: " . $data['oib'] . '<br />';
    $message .= "Kontakt telefon: " . $data['phone'] . '<br />';
    $message .= "Kontakt e-mail: " . $data['email'] . '<br />';
    
    $message .= "Stručna sprema: " . $data['education'] . '<br />';
    $message .= "Konfekcijski broj: " . $data['confection'] . '<br />';
    
    $message .= "Tečaj: ";
    
    switch ($data['class']):
      case 'uefaB':
        $message .= 'Uefa B';
        break;
      case 'uefaA':
        $message .= 'Uefa A';
        break;
      case 'uefaPro':
        $message .= 'Uefa Pro';
        break;
      case 'futsal':
        $message .= 'Futsal';
        break;
      case 'vratar':
        $message .= 'Vratar';
        break;
      case 'adaptacija':
        $message .= 'Adaptacija - UEFA A';
        break;
    endswitch;
    
    $message .= '<br />';
    
    
    $message .= "Tečaj: ";
    
    switch ($data['completedClass']):
      case 'niti_jedan':
        $message .= 'Niti jedan';
        break;
      case 'c':
        $message .= 'C';
        break;
      case 'uefaB':
        $message .= 'Uefa B';
        break;
      case 'uefaA':
        $message .= 'Uefa A';
        break;
    endswitch;
    
    $message .= '<br />';
    
    $message .= "Dokumentaciju ću dostaviti u: ";
    
    switch ($data['documentation']):
      case 'akademija':
        $message .= 'Akademiju';
        break;
      case 'srediste':
        $message .= 'Središte';
        break;
    endswitch;
    
    $message .= '<br />';

    return self::sendHtmlMail (Config::read ('adminEmail'), 'Prijava za tecaj', $message, Config::read ('adminEmail'));

    $_SESSION['message'] = 'Slanje poruke bilo je neuspješno, pokušajte ponovo';
    return FALSE;
  }

  // TODO: remove self from cc before launch
  private static function sendHtmlMail ($to, $subject, $message, $replyTo) {
   $headers =
      'From: ' . $replyTo . "\r\n" .
      'Reply-To: ' . $replyTo . "\r\n" .
      'Cc: mvrkljan@fiktiv.hr' . "\r\n" .
      'Errors-To: mvrkljan@fiktiv.hr' . "\r\n" .
      'Return-Path: mvrkljan@fiktiv.hr' . "\r\n" .
      'Content-type: text/html; charset=utf-8' . "\r\n" .
      'X-Mailer: PHP/' . phpversion () . "\r\n" .
      'MIME-Version: 1.0\r\n';
   return mail ($to, $subject, $message, $headers);
  }

  // TODO: remove self from cc before launch
  private static function sendPlainMail ($to, $subject, $message, $replyTo, $bounceEmail = NULL) {
    $headers =
      'From: ' . $replyTo . "\r\n" .
      'Reply-To: ' . $replyTo . "\r\n" .
      'Cc: mvrkljan@fiktiv.hr' . "\r\n" .
      'Errors-To: mvrkljan@fiktiv.hr' . "\r\n" .
      'Return-Path: mvrkljan@fiktiv.hr' . "\r\n" .
      'Content-type: text/plain; charset=utf-8' . "\r\n" .
      'X-Mailer: PHP/' . phpversion ();
    return mail($to, $subject, $message, $headers, ($bounceEmail ? '-f ' . $bounceEmail : NULL));
  }
}

?>
