<?php

class Static_Operation {

    public static function Data_clean() {

        if (!empty($_POST)) {
            foreach ($_POST as $k => $v){
                $_POST[$k] = htmlspecialchars(stripslashes(trim($v)));
            }
        }   
        if (!empty($_GET)) {
            foreach ($_GET as $k => $v)
                $_GET[$k] = htmlspecialchars(stripslashes(trim($v)));
        }
    }
    
    public static function Data_slash() {
        if (!empty($_POST)) {
            foreach ($_POST as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $km => $vm) {
                        $_POST[$k][$km] = addslashes($vm);
                    }
                } else {
                    $_POST[$k] = addslashes($v);
                }
            }
        }
    }

    public static function ValidDate($data) {
        foreach ($data as $k => $v) {
            if (empty($v))
                return false;
            $d = explode('-', $v);
            if (!count($d) == 3)
                return false;
            elseif (!checkdate($d[1], $d[2], $d[0]))
                return false;
            $d = NULL;
        }
        return true;
    }

    public static function Validation($method, $Column) {
        if ($method == 'post') {
            $count = 0;
            while ($count < count($Column)) {
                if (empty($_POST[$Column[$count]])) {//echo 'validation-'.!isset($_POST[$Column[$count]])	;
                    $_SESSION['msg'] = 'Field Should Not Be Empty';
                    ++$count;
                    return $count;
                }
                $count++;
            }
        }
        if ($method == 'get') {
            $count = 0;
            while ($count < count($Column)) {
                if (!isset($_GET[$Column[$count]])) {
                    $_SESSION['msg'] = 'Field Should Not Be Empty';
                    return ++$count;
                }
                $count++;
            }
        }
        return true;
    }

    public static function Date_diff($start, $end) {
        return round(abs(strtotime($start) - strtotime($end)) / 86400);
    }

    public static function ValidEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL))
            return true;
        else
            return false;
    }

    public static function UploadImage($TempPath, $Path, $Fieldname) {
        $Fieldname = str_replace(" ", "_", $Fieldname);
        $ext = substr(strtolower(strrchr($Fieldname, '.')), 1); //get the extension
        $allextension = array("png", "jpg", "jpeg", "gif", "bmp");
        if (in_array($ext, $allextension)) {//check if extension match or not
            $url = substr(str_replace($ext, '', $Fieldname), 0, -1) . time() . '.' . $ext;  //get the url

            $Uploadurl = $Path . $url;
            if (@move_uploaded_file($TempPath, $Uploadurl))
                return $url;
            else
                return false;
        }else {
            return false;
        }
    }

    public static function UploadPdf($TempPath, $Path, $Fieldname) {
        $Fieldname = str_replace(" ", "_", $Fieldname);
        $ext = substr(strtolower(strrchr($Fieldname, '.')), 1); //get the extension
        $allextension = array("pdf");
        if (in_array($ext, $allextension)) {//check if extension match or not
            //$url= substr(str_replace($ext,'', $Fieldname),0,-1).time().'.'.$ext;  //get the url
            $url = substr(str_replace($ext, '', $Fieldname), 0, -1) . '.' . $ext;  //get the url
            $Uploadurl = $Path . $url;
            if (@move_uploaded_file($TempPath, $Uploadurl))
                return $url;
            else
                return false;
        }else {
            return false;
        }
    }

    public static function sendmail($msg, $subject, $to, $toname, $mail_from, $attach= NULL) {
       
        require_once('SMPTMailer/PHPMailerAutoload.php');
        $mail = new PHPMailer;
        $mail->setFrom($mail_from, 'Password Reset');
        $mail->addAddress($to, $toname);
        $mail->Subject = $subject;
        $mail->msgHTML($msg);
        //Attach the uploaded file
       // if (!empty($attach)) {
       //     foreach ($attach as $k => $v)
      //          $mail->addAttachment($v, $k);
       // }

		
		$mail->addAttachment($attach);
        //*** Attachment ***//
        //var_dump(file_exists($file));
        if ($mail->send())

            return true;
        else
            return false;
    }

    public static function youtube_id_from_url($url) {
        $pattern = '%^# Match any youtube URL
        (?:https?://)?  # Optional scheme. Either http or https
        (?:www\.)?      # Optional www subdomain
        (?:             # Group host alternatives
          youtu\.be/    # Either youtu.be,
        | youtube\.com  # or youtube.com
          (?:           # Group path alternatives
            /embed/     # Either /embed/
          | /v/         # or /v/
          | /watch\?v=  # or /watch\?v=
          )             # End path alternatives.
        )               # End host alternatives.
        ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
        $%x'
        ;
        $result = preg_match($pattern, $url, $matches);
        if (false !== $result) {
            return $matches[1];
        }
        return false;
    }

    public static function removeSpchar($str) {
        $str = str_replace("%", "-", $str);
        $str = preg_replace('/\s\&+/', '-', $str);
        $str = preg_replace("/\s/", "-", $str);
        $str = preg_replace('/\-\-+/', '-', $str);
        $str = str_replace("(", "-", $str);
        $str = str_replace(")", "-", $str);
        $str = str_replace("(", "-", $str);
        $str = str_replace(")", "_", $str);
        $str = str_replace("_", "-", $str);
        $str = str_replace("&", "-", $str);
        $str = str_replace("'", "-", $str);
        $str = preg_replace('/\-\-+/', '-', $str);
        $str = ltrim($str, '-');
        $str = rtrim($str, '-');
        $str = strtolower($str);
        return $str;
    }

    public static function word_limiter($str, $limit = 100, $end_char = '&#8230;') {
        if (trim($str) == '') {
            return $str;
        }

        preg_match('/^\s*+(?:\S++\s*+){1,' . (int) $limit . '}/', $str, $matches);

        if (strlen($str) == strlen($matches[0])) {
            $end_char = '';
        }

        return rtrim($matches[0]) . $end_char;
    }

    public static function generateToken(){

    //Generate a random string.
    $token = openssl_random_pseudo_bytes(20);
     
    //Convert the binary data into hexadecimal representation.
    $token = bin2hex($token);
    return $token;

}
    public static function encryptNew($pure_string) {
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($pure_string, $cipher, KEY, $options=OPENSSL_RAW_DATA, $iv);

        //$hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
        $ciphertext = base64_encode( $iv./*$hmac.*/$ciphertext_raw );
        return $ciphertext;
    }
    public static function decryptNew($encrypted_string) {
        $c = base64_decode($encrypted_string);
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = substr($c, 0, $ivlen);
        //$hmac = substr($c, $ivlen, $sha2len=32);
        $ciphertext_raw = substr($c, $ivlen/*+$sha2len*/);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, KEY, $options=OPENSSL_RAW_DATA, $iv);
        
        return $original_plaintext;
    }
    public static function replaceSingleQuote($string_data){
      return str_replace("'","\'",$string_data);
    }
}



?>