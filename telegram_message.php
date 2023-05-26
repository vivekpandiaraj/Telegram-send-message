<?php	
function sendMessage($chatID, $messaggio, $token) {
    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
    $url = $url . "&text=" . urlencode($messaggio);
    $ch = curl_init($url); 
    $optArray = array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false, //make this enable in SSL Connection if need
        CURLOPT_SSL_VERIFYHOST => false  //make this enable in SSL Connection if need
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    if ($result === false) {
        $myres= 'Curl error: ' . curl_error($ch);
    } else {
        //print_r($response); //you can get complete server side response here
        $response = json_decode($result, true);
        if (isset($response['ok']) && $response['ok'] === true) {
            $myres= 'Message sent successfully';
        } else {
            $myres= 'Failed to send message';
        }
    }
    curl_close($ch);
    return $myres;
    }
$token = "Your Bot Token which is available in Botfather";
$chatid = "Your Target Telegram Numeric id"; //You can find chat id using https://web.telegram.org/ in url bar. 
$yourmessage="Message here";    
echo sendMessage($chatid, $yourmessage , $token);
//Note: Target user(Chat id/Receiver) might be send atleast one message to bot to get message proper. 
?>