<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Event\ContactRegisteredEvent;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(
        Request $request,
        EntityManagerInterface $em,
        EventDispatcherInterface $dispatcher
    ): Response {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($contact);
            $em->flush();

            $dispatcher->dispatch(
                new ContactRegisteredEvent($contact),
                ContactRegisteredEvent::NAME
            );

            return $this->redirectToRoute('contact_thanks');
        }

        return $this->render('contact/index.html.twig', [
            'contactForm' => $form
        ]);

    }

    #[Route('/contact/thanks', name: 'contact_thanks')]
    public function thanks(): Response
    {
        return $this->render('contact/thanks.html.twig');
    }
}
