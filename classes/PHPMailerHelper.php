<?php

require_once 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;

class PHPMailerHelper {
    private PHPMailer $phpMailer;

    public function __construct($debug = false) {
        $config = include 'config/mail.php';

        $this->phpMailer = new PHPMailer();
        if ($debug) $this->phpMailer->SMTPDebug = 2;                   // Enable verbose debug output
        $this->phpMailer->isSMTP();                        // Set mailer to use SMTP
        $this->phpMailer->Host       = $config['server'];    // Specify main SMTP server
        $this->phpMailer->SMTPAuth   = true;               // Enable SMTP authentication
        $this->phpMailer->Username   = $config['login'];     // SMTP username
        $this->phpMailer->Password   = $config['password'];         // SMTP password
        $this->phpMailer->SMTPSecure = $config['security'];              // Enable TLS encryption, 'ssl' also accepted
        $this->phpMailer->Port       = $config['port'];                // TCP port to connect to
        $this->phpMailer->setFrom($config['email'], $config['name']);
    }

    public function sendMail(
        array $addresses,
        string $header,
        string $message,
    ) {
        foreach($addresses as $address) {
            $this->phpMailer->addAddress($address);
        }

        $this->phpMailer->isHTML(true);                                  
        $this->phpMailer->Subject = $header;
        $this->phpMailer->Body    = $message;

        $this->phpMailer->send();
    }
}