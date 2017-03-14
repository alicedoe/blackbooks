<?php

namespace LibraryBundle\Controller;

use LibraryBundle\Entity\Books;
use LibraryBundle\Entity\Categories;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ConsultingController extends Controller {

    /**
     * @Route("/books", name="listbooks")
     * @Method({"GET"})
     */
    public function booksAction() {
        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository('LibraryBundle:Books')->findAll();
        return new JsonResponse($books);
    }
    
    /**
     * @Route("/books/{id}/copies", name="booksidcopies")
     * @Method({"GET"})
     */
    public function getCopies($id) {
        $em = $this->getDoctrine()->getManager();
        $copies = $em->getRepository(\LibraryBundle\Entity\Copy::class)->findByBook($id);
        return new JsonResponse($copies);
    }
    
    
    /**
     * @Route("/categories/{id}", name="getcatoriesid")
     * @Method({"GET"})
     */
    public function getcatoriesidAction(Categories $cat) {
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository('LibraryBundle:Categories')->find($cat);
        return new JsonResponse($cat->getNom());
    }

    /**
     * @Route("/books/{id}", name="getbooksid")
     * @Method({"GET"})
     */
    public function getbooksidAction(Books $book) {

        return new JsonResponse($book->getTitre());
        
    }

}
