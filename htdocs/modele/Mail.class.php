<?php 

namespace modele;

use Exception;
use modele\PHPMailer\PHPMailer;
use modele\PHPMailer\SMTP;
use PDO;

/**
 *
 *   Class de la gestion et création de mail
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * @license     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 */

class Mail {

    /**
     * Envois un mail via le protocol SMTP avec la librairie PHPMAILER
     *
     * @param String $obj Objet du mail
     * @param String $body Message du mail
     * @param String $to Adresse mail de destination
     * @param String $toName Pseudo / nom du destinataire
     * @return bool True si le mail c'est bien envoyé
     *
     * @access public
     * @static
     */
    public static function sendMail($obj, $body, $to, $toName) : bool {
        if($body == false) {
            return false;
        }
        $mail = new PHPMailer(true);
        try {

            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp-relay.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'guedesite77@gmail.com';                     //SMTP username
            $mail->Password   = 'hmiw fmni meyz saih';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('guedesite77@gmail.com', 'guedesite77');
            $mail->addAddress('guedesite77@gmail.com', 'guedesite77');     //Add a recipient
            $mail->addReplyTo('info@example.com', 'Information');


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject =  $obj;
            $mail->Body    = $body;

            if($mail->send()){
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }


    /**
     * Construie un mail avec une template
     * Le mail est stocker dans la base de donnée pour un visionnage ultérieur
     *
     * @param String $title Titre du mail
     * @param String $soustitle Sous titre du mail
     * @return string Message du mail
     *
     * @access public
     * @static
     */
    public static function build($title, $soustitle) : String {


        
        $html = '<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Email Confirmation</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap");
  
    @media screen {
            @font-face {
                font-family: "Poppins";
      font-style: normal;
      font-weight: 400;
    }

    @font-face {
                font-family: "Poppins";
      font-style: normal;
      font-weight: 700;
    }
  }

  body, table, td, a {
            -ms-text-size-adjust: 100%;
    -webkit-text-size-adjust: 100%;
  }

  table, td {
            mso-table-rspace: 0pt;
    mso-table-lspace: 0pt;
  }

  img {
            -ms-interpolation-mode: bicubic;
  }

  a[x-apple-data-detectors] {
  font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    color: inherit !important;
    text-decoration: none !important;
  }

  div[style*="margin: 16px 0;"] {
  margin: 0 !important;
  }

  body {
            width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
    margin: 0 !important;
  }

  table {
            border-collapse: collapse !important;
  }
  a {
            color: #1a82e2;
        }
  img {
            height: auto;
            line-height: 100%;
    text-decoration: none;
    border: 0;
    outline: none;
  }
  </style>

</head>
<body style="background-color: #e9ecef;">

  <div class="preheader" style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
            A preheader is the short summary text that follows the subject line when an email is viewed in the inbox.
  </div>

  <table border="0" cellpadding="0" cellspacing="0" width="100%">

    <tr>
      <td align="center" bgcolor="#e9ecef">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
          <tr>
            <td align="center" valign="top" style="padding: 36px 24px;">
              <a href="https://github.com/DockNet-Solutions" target="_blank" style="display: inline-block;">
              <img src="https://i.imgur.com/6UkwJGR.png" alt="Logo" border="0" width="48" style="display: block; width: 48px; max-width: 48px; min-width: 48px;">
              </a>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td align="center" bgcolor="#e9ecef">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
          <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family: \'Poppins\', sans-serif; border-top-left-radius: 15px; border-top-right-radius: 15px;">
              <h1 style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">'.$title.'</h1>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td align="center" bgcolor="#e9ecef">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
          <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: \'Poppins\', sans-serif; font-size: 16px; line-height: 24px;">
              <p style="margin: 0;">'.$soustitle.'</p>
            </td>
          </tr>
         
          <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: \'Poppins\', sans-serif; font-size: 16px; line-height: 24px;  border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
              <p style="margin: 0;">Cheers,<br> Team QuickDockNet</p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td align="center" bgcolor="#e9ecef" style="padding: 24px;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
          <tr>
            <td align="center" bgcolor="#e9ecef" style="padding: 12px 24px; font-family: \'Poppins\', sans-serif; font-size: 14px; line-height: 20px; color: #666;">
              <p style="margin: 0;">You received this email because we received a request for email confirmation for your account. If you didn\'t create an account, you can safely delete this email.</p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>';


        return $html;
    }
}

?>
