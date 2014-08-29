<?php

namespace Aym3ntn\SiteBundle\Controller;

use Aym3ntn\MedecinBundle\Entity\Secteur;
use Aym3ntn\TacheBundle\Entity\Tache;
use Aym3ntn\UserBundle\Entity\Note;
use Aym3ntn\UserBundle\Entity\UserNote;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SiteController extends Controller
{
    public function indexAction()
    {
        $userManager = $this->get('fos_user.user_manager');

        return $this->render('SiteBundle:Site:home.html.twig');
    }

    public function sort_array($a, $b){
        if( $a->date == $b->date ){ return 0; }
        return ($a->date < $b->date) ? -1 : 1;
    }

    public function noteAction(){
        $em = $this->getDoctrine()->getManager();

        $secteur = $em->getRepository('MedecinBundle:Secteur')->findByUser($this->getUser());

        $totalNotes = 0;
        /* * * * * * * * * * *\
            Note generales
        \* * * * * * * * * * */
//        $notesGenerales = $em->getRepository('UserBundle:UserNote')->findByType($this->getUser(),'Note générale');
//
//        $countNG = $em->getRepository('UserBundle:UserNote')->countUnseenNotes($notesGenerales);
//
//        $countNotes = 0;
//
//        if( in_array('ROLE_SUPERVISEUR', $this->getUser()->getRoles() ) ){
//            /* * * * * * * * * * *\
//                Note superviseur
//            \* * * * * * * * * * */
//            $notes = $em->getRepository('UserBundle:UserNote')->findTacheNotes($this->getUser(), 'demande tache');
//            $countNotes = $em->getRepository('UserBundle:UserNote')->countUnseenNotes($notes);
//        }
//        else
//            $notes = [];
//
//        $notes = array_merge($notes, $notesGenerales);
//        usort($notes, function ($a, $b){
//            if( $a->getNote()->getDate() == $b->getNote()->getDate() ){ return 0; }
//            return ($a->getNote()->getDate() > $b->getNote()->getDate()) ? -1 : 1;
//        });
//        $totalNotes = $countNG + $countNotes;

        $notes = $em->getRepository('UserBundle:UserNote')->findBy(array('user'=>$this->getUser()), array('note'=>'desc'));
        $countNotes = $em->getRepository('UserBundle:UserNote')->countUnseenNotes($notes);

        return $this->render('UserBundle:Note:notes.html.twig', array(
            'notes' => $notes,
            'countNotes' => $countNotes
        ));
    }

    public function noteRedirectAction(Note $note, $relatedTo){
        $em = $this->getDoctrine()->getManager();

        if( $relatedTo == 'note' ){
            $userNote = $em->getRepository('UserBundle:UserNote')->findOneBy(array('user'=>$this->getUser(), 'note' => $note));
            $userNote->setStatus(1);
            $em->persist($userNote);
            $em->flush();

            return $this->redirect($this->generateUrl('note_show', array('id' => $note->getId())));
        }

        if( in_array($note->getType(), ["demande tache", "nouvelle tache"]) ){
            $userNote = $em->getRepository('UserBundle:UserNote')->findOneBy(array('user'=>$this->getUser(), 'note' => $note));
            $userNote->setStatus(1);
            $em->persist($userNote);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_task_show', array('id' => $relatedTo)));
        }
    }
}
