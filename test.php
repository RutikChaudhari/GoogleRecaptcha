<html>

<head>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
    <form action="" method="post">
        Name : <input type="text" name="name">
        <div class="g-recaptcha" data-sitekey="___site key____"></div>
        <input type="submit" name="submit" value="submit">
    </form>
    <?php
if(isset($_POST['submit']))
{
function post_captcha($user_response) {
        $fields_string = '';
        $fields = array(
            'secret' => '____secret key____',
            'response' => $user_response
        );
        foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }

    $res = post_captcha($_POST['g-recaptcha-response']);
    
    if ($res['success']) {
        echo '<script>alert("Successfull");</script>';
    } else {
        echo '<script>alert("Error");</script>';
    }
    
}
    ?>
</body>

</html>
