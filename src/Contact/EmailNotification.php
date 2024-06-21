<?php

namespace App\Contact;

use App\Entity\Contact;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\EventSubscriber\ContactRegisteredSubscriber;
class EmailNotification
{
    public function __construct(
        private MailerInterface $mailer,
        private string $adminEmail
    ) {
    }

    public function sendConfirmationEmail(
        Contact $newContact
    ): void {
        $email = (new Email())
            ->from($this->adminEmail)
            ->to($newContact->getEmail())
            ->subject('Inscription à la newsletter')
            ->text('Votre message a bien été envoyé, merci');

        $this->mailer->send($email);
    }
}