<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;

class BotManController extends Controller
{
    public function handle(){
        $botman = app('botman');
  
        $botman->hears('{message}', function($botman, $message) {
  
            if ($message == 'hi' || $message == 'hello') {
                $this->askName($botman);
            }else{
                $botman->reply("Biết 'hi' or 'hello' để test..");
            }
  
        });
  
        $botman->listen();
    }

    public function askName($botman)
    {
        $botman->ask('Hello! Bạn tên là gì?', function(Answer $answer) {
  
            $name = $answer->getText();
  
            $this->say('Rất vui được gặp bạn '.$name);
            $this->say('Bạn cần hỗ trợ gì ạ ');

        });
    }
}
