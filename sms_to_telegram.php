<?php
/*
 * DON'T FORGET TO CONFIGURE!
 * See Readme.md
 */
define('CHAT_ID', 0);
//bot @username
define('BOT_NAME', 'username');
define('API_KEY', '');

require __DIR__ . '/vendor/autoload.php';
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;

function sendTelegramMessage($message)
{
    $telegram = new Telegram(API_KEY, BOT_NAME);

    $data = [
        'chat_id' => CHAT_ID,
        'text' => $message,
    ];

    $result = Request::sendMessage($data);

    if ($result->isOk()) {
        $logMessage = array('telegram' => 'Message was sent successfully to: ' . CHAT_ID);
        file_put_contents('sms.log', json_encode($logMessage) . "\n", FILE_APPEND);
    } else {
        $logMessage = array('telegram' => 'Message was not sent to: ' . CHAT_IDD);
        file_put_contents('sms.log', json_encode($logMessage) . "\n", FILE_APPEND);
    }
}

function receiveSMS() {
    $smsMessage = $_POST['Body'];
    if (!$smsMessage) {
        $logMessage = array(
            'time' => time(),
            'error' => 'Blank message'
        );
        file_put_contents('sms.log', json_encode($logMessage). "\n", FILE_APPEND);
    } else {
        $fromMessage = @$_POST['From'] ? $_POST['From'] : 'Undefined';
        $logMessage = array(
            'time' => time(),
            'from' => $fromMessage,
            'message' => $smsMessage
        );
        file_put_contents('sms.log', json_encode($logMessage) . "\n", FILE_APPEND);
        sendTelegramMessage('(' . $fromMessage . '): ' . $smsMessage );
    }
}

receiveSMS();
header('Content-type: text/xml');
echo '<Response></Response>';