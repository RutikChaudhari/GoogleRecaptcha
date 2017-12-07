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
Paste the following code in header of your file where you want to implement google captcha:<br>
 <script src='https://www.google.com/recaptcha/api.js'></script> 

Step 4.2 :-
Paste this code in the form where you want the widget to appear: <div class="g-recaptcha" data-sitekey="your site key"></div>

Step 4.3 :-
Paste the reCAPTCHA code on the submitted page where you want the response message to show:
<br>
<?php<br>
    function post_captcha($user_response) {<br>
        $fields_string = '';<br>
        $fields = array(
            'secret' => '___Paste your secret code____',
            'response' => $user_response
        );<br>
        foreach($fields as $key=>$value)<br>
        $fields_string .= $key . '=' . $value . '&';<br>
        $fields_string = rtrim($fields_string, '&');<br>

        $ch = curl_init();<br>
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');<br>
        curl_setopt($ch, CURLOPT_POST, count($fields));<br>
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);<br>
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);<br>

        $result = curl_exec($ch);<br>
        curl_close($ch);<br>

        return json_decode($result, true);<br>
    }<br>

    // Call the function post_captcha<br>
    
    $res = post_captcha($_POST['g-recaptcha-response']);<br>

    if (!$res['success']) {<br>
    
    // What happens when the CAPTCHA wasn't checked<br>
      echo '<p>Please go back and make sure you check the security CAPTCHA box.</p>';<br>
 } <br>else{<br>
        // If CAPTCHA is successfully completed...<br>
        // Paste mail function or whatever else you want to happen here!<br>
        echo '<p>CAPTCHA was completed successfully!</p>';
    }
?><br>

Step 5 :-
Congratulations !! You have made it.
Now use recaptcha in any program by following above steps.
