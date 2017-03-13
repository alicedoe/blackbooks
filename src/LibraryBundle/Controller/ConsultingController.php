<?php

namespace LibraryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use LibraryBundle\Entity\Books;
use LibraryBundle\Entity\Categories;

class ConsultingController extends Controller
{
    /**
     * @Route("/books", name="listbooks")
     * @Method({"GET"})
     */
    public function booksAction()
    {   
        $em = $this->getDoctrine()->getManager();

        $books = $em->getRepository('LibraryBundle:Books')->findAll();

        $formatted = [];
        foreach ($books as $book) {
            $formatted[] = [
               'id' => $book->getId(),
               'titre' => $book->getTitre(),
               'auteur' => $book->getAuteur(),            
               'cat' => $book->getCategorie()->getNom(),
            ];
        }

        return new JsonResponse($formatted);
    }

    /**
     * @Route("/cat/{id}", name="listcat")
     */
    public function catAction(Categories $cat)
    {   
        $em = $this->getDoctrine()->getManager();

        $books = $em->getRepository('LibraryBundle:Books')->findBy( array('categorie' => $cat));
        
        return $this->render('LibraryBundle:Controller:cat.html.twig', array(
            'books' => $books,
        ));
    }

    /**
     * @Route("/book/{id}", name="detailbooks")
     * @Method({"GET"})
     */
    public function bookAction(Books $book)
    {

        return new JsonResponse([
               'id' => $book->getId(),
               'titre' => $book->getTitre(),
               'auteur' => $book->getAuteur(),            
               'cat' => $book->getCategorie()->getNom(),
            ]);
    }

}
