# twilio_sms_to_telegram

Receive SMS messages to Telegram account through Twilio

## Requirements
  - PHP 5.5 or greater
  - Composer

## Installation
1. Change file mode for *sms.log* to allow write in the file. For example:

    ```
    chmod 777 sms.log
    ```
2. Run composer update to install dependencies:

    ```
    composer update
    ```
    
## Configuration

### Twilio
After you create an account and add new phone number you should go to *Manage Numbers -> Active Numbers -> Configure*. On the bottom of the page you will see *Messaging* and *A MESSAGE COMES IN*. You should fill in it with your callback url (like http://example.com/sms_to_telegram.php )

See Twilio documentation for more info - https://support.twilio.com/hc/en-us/articles/223134127-Receive-SMS-messages-without-Responding

### Telegram
  - To create a new bot see the instruction - https://core.telegram.org/bots#creating-a-new-bot
  - You will get a token and a bot name. Change **BOT_NAME** and **API_KEY** in the php file.
  - Add the new bot in your telegram account. Type any word (like "test"). Then go to https://api.telegram.org/bot<**API_KEY**>/getUpdates (change <**API_KEY**> with your token) and you will see something like this:
  
  ```json
  {"ok":true,"result":[{"update_id":279129775,
"message":{"message_id":11,"from":{"id":123456,"first_name":"Name","username":"username"},"date":1487955282,"text":"1"}}]}
  ```
  - Copy your user id (*123456* in the example) to CHAT_ID in the php file.

License
----

MIT
