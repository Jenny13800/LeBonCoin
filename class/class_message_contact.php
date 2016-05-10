<?php

class MessageContact {

    private $sName;
    private $sEmail;
    private $sNum;
    private $sQuestion;

    public function __construct($name, $email, $num, $question) {
        $this->sName = $name;
        $this->sEmail = $email;
        $this->sNum = $num;
        $this->sQuestion = $question;
    }

    public function send() {
        echo 'message envoyé';
    }

}
?>

