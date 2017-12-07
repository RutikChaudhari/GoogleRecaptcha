# GoogleRecaptcha
Google reCAPTCHA is a free service that protects your site from spam and abuse. It uses advanced risk analysis techniques to tell humans and bots apart.

Steps to implement in your program :

Step 1 :- 
Go on this link :- https://www.google.com/recaptcha/intro

Step 2 :-
Click on "Get reCaptcha" button

Step 3 :-
Register a new site with label then select reCaptcha V2 (Validates user with checkbox) next, add domain name (on which you have to implement google recaptcha). You can also use it for localhost by typing "localhost" in domains section. You can add Multiple domains one per line.

After completing all the above steps accept the reCaptcha terms and conditions and just click on "Register" button. (If you want to get recaptcha alerts about your site just click on "send alerts to owners" checkbox).

Step 4 :-
Click on keys tab which contains two keys :
i) Site key and ii) Secret key

Step 4.1 :-
Paste the following code in header of your file where you want to implement google captcha:
<script src='https://www.google.com/recaptcha/api.js'></script> 

Step 4.2 :-
Paste this code in the form where you want the widget (google reCaptcha with checkbox) to appear:
<div class="g-recaptcha" data-sitekey="******************paste your site key****************"></div>

Step 4.3 :-
Paste the reCAPTCHA code on the submitted page where you want the response message to show:

<?php
    function post_captcha($user_response) {
  
        $fields_string = '';
        $fields = array(
            'secret' => '**** Paste your secret code  ****'
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

    // Call the function post_captcha
    
    $res = post_captcha($_POST['g-recaptcha-response']);

    if (!$res['success']) {
    
    // What happens when the CAPTCHA wasn't checked
      echo '<p>Please go back and make sure you check the security CAPTCHA box.</p><br>';
 } else {
        // If CAPTCHA is successfully completed...

        // Paste mail function or whatever else you want to happen here!
        echo '<br><p>CAPTCHA was completed successfully!</p><br>';
    }
?>

Step 5 :-
Congratulations !! You have made it.
Now use recaptcha in any program by following above steps.
