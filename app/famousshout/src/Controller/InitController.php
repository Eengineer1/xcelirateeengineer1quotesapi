<?php

namespace App\Controller;

use App\Entity\Quotes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InitController extends AbstractController
{
    /**
     * @Route("/init", name="init", methods={"POST"})
     */
    public function inittable(): Response
    {
        $em=$this->getDoctrine()->getManager();
        $providedquotefile=json_decode(file_get_contents(__DIR__.'/../../resources/quotes.json'),true);
        foreach($providedquotefile['quotes'] as $providedquote){
            $quote=new Quotes();
            $quote->setQuote($providedquote['quote']);
            $quote->setAuthor($providedquote['author']);
            $quote->setRoute(str_replace(' ','_',strtolower($providedquote['author'])));
            $em->persist($quote);
            $em->flush();
        }
        return new Response('Initialisation is complete.',Response::HTTP_OK);
    }
}
