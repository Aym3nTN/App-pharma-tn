<?php

namespace Aym3ntn\SiteBundle\Controller;

use Aym3ntn\MedecinBundle\Entity\Secteur;
use Aym3ntn\UserBundle\Entity\Note;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SiteController extends Controller
{
    public function indexAction()
    {
        $userManager = $this->get('fos_user.user_manager');

        return $this->render('SiteBundle:Site:home.html.twig');
    }

    public function noteAction(){
        $em = $this->getDoctrine()->getManager();

        $secteur = $em->getRepository('MedecinBundle:Secteur')->findByUser($this->getUser());

        $notesGenerales = $em->getRepository('UserBundle:Note')->findByUser($this->getUser()->getId(),'Note générale');

        if( in_array('ROLE_SUPERVISEUR', $this->getUser()->getRoles() ) ){
            $notes = $em->getRepository('UserBundle:Note')->findBy(array(
                'public' => 2,
                'secteur' => $secteur));
        }
        else
            $notes = [];

        $notes = array_merge($notes, $notesGenerales);
        return $this->render('UserBundle:Note:notes.html.twig', array(
            'notes' => $notes
        ));
    }

    public function noteRedirectAction(Note $id, $relatedTo){
        $em = $this->getDoctrine()->getManager();

        $note = $id;
        if( $relatedTo == 'note' ){

            $note->addTarget($this->getUser());
            $em->flush($note);
            return $this->redirect($this->generateUrl('note_show', array('id' => $note->getId())));
        }
    }
}
