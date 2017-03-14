<?php

namespace LibraryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use LibraryBundle\Entity\Categories;

class AdminController extends Controller
{
    
     /**
     * @Route("/categories", name="postnewcat")
     * @Method({"POST"})
     */
    public function postnewcatAction(Request $request)
    {        
        $categorie = new Categories();
        $categorie->setNom($request->get('nom'));

        $em = $this->get('doctrine.orm.entity_manager');
        $em->persist($categorie);
        $em->flush();

        return new JsonResponse($categorie->getNom());
    }
    
    /**
     * @Route("/categories", name="deletecat")
     * @Method({"DELETE"})
     */
    public function deletecatAction(Request $request)
    {   
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository('LibraryBundle:Categories')->find($request->get('id'));
        $em->remove($cat);
        $em->flush();
        return new JsonResponse($cat->getNom());
    }
    
     /**
     * @Route("/categories", name="patchcat")
     * @Method({"PATCH"})
     */
    public function patchcatAction(Request $request)
    {        
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository('LibraryBundle:Categories')->find($request->get('id'));
        $cat->setNom($request->get('nom'));
        $em->persist($cat);
        $em->flush();       
        return new JsonResponse($cat->getNom());
    }
    
     /**
     * @Route("/books", name="postnewbookscat")
     * @Method({"POST"})
     */
    public function postnewbooksAction(Request $request)
    {        
        $books = new Books();
        $books->setNom($request->get('nom'));

        $em = $this->get('doctrine.orm.entity_manager');
        $em->persist($books);
        $em->flush();

        return new JsonResponse($books->getNom());
    }
    
    /**
     * @Route("/books", name="deletebooks")
     * @Method({"DELETE"})
     */
    public function deletebooksAction(Request $request)
    {        
       $em = $this->getDoctrine()->getManager();
       $books = $em->getRepository('LibraryBundle:Categories')->find($request->get('id'));
       $em->remove($books);
       $em->flush();
       return new JsonResponse("ok");
    }
    
     /**
     * @Route("/books", name="patchbooks")
     * @Method({"PATCH"})
     */
    public function patchbooksAction(Request $request)
    {        
        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository('LibraryBundle:Categories')->find($request->get('id'));
        $books->setNom($request->get('nom'));
        $em->persist($books);
        $em->flush();       
        return new JsonResponse($books->getNom());
    }
    
}
