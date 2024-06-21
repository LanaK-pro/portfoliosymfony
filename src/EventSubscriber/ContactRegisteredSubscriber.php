<?php

namespace App\EventSubscriber;

use App\Event\ContactRegisteredEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


class ContactRegisteredSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private MailerInterface $mailer,
    ) {
    }
    public function onContactRegistered(ContactRegisteredEvent $event): void
    {
        $contact = $event->getEmail();

        $email = (new Email())
            ->from($contact->getEmail())
            ->to("Lana@gmail.com")
            ->subject("Nouveau message")
            ->text($contact->getContent());

        $this->mailer->send($email);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ContactRegisteredEvent::NAME  => 'onContactRegistered',
        ];
    }
}
