<?php

require_once('DataBase.php');
require_once('Telegram.php');
class Bot 
{
    public function start()
    {

        $DB = new DataBase;
        $TG = new Telegram;

        $update = json_decode(file_get_contents('php://input'), true);
        if(isset($update['message']['text'])){
            
            $idPerson = $update['message']['from']['id'];
            $namePerson = $update['message']['from']['first_name'];
            $secondPerson = $update['message']['from']['username'];
            
            switch ($update['message']['text']) {
            case('/start'):
                $text = 'Добро пожаловать';
                $TG->request([
                    'chat_id' => $idPerson,
                    'text' => $text,
                ] , 'sendMessage');
                $DB->pushTooBase([
                    'chat_id' => $idPerson,
                    'user_name' => $secondPerson,
                    'name' => $namePerson
                ]);
            break;
            case 'Привет':
                $text = 'Ну привет';
                $TG->request([
                    'chat_id' => $idPerson,
                    'text' => $text,
                ] , 'sendMessage');
                break;
            case 'Как дела?':
                $text = 'Норм, а ты как?';
                $TG->request([
                    'chat_id' => $idPerson,
                    'text' => $text,
                ] , 'sendMessage');
                break;
                
                default:
                    $text = 'Что ж интересно...';
                    $TG->request([
                        'chat_id' => $idPerson,
                        'text' => $text,
                    ] , 'sendMessage');
                    break;
            }
            var_dump($update); // выводим ['message']['from']['id']
        }
        // var_dump($_POST);
        
    }
}