<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact-get", methods={"GET"})
     */
    public function contactGetAction()
    {
        return $this->render('default/contact.html.twig');
    }

    /**
     * @Route("/contact", name="contact-post", methods={"POST"})
     */
    public function contactPostAction(Request $request, \Swift_Mailer $mailer)
    {
        $subject = $request->get('subject');
        $sender = $request->get('name');
        $email = $request->get('email');
        $text = $request->get('message');

        $message = (new \Swift_Message($subject));
        $message->setFrom("floracare.official@gmail.com"); // tu powinien być adres nadawcy
        $message->setTo('floracare.official@gmail.com');
        $message->setBody($this->render("contact/mail.html.twig", ['sender' => $email,'text' => $text]), 'text/html');

        $mailer->send($message);

        return new Response('E-mail Sent');
    }
}