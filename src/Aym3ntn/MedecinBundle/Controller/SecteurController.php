<?php

namespace Aym3ntn\MedecinBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Aym3ntn\MedecinBundle\Entity\Secteur;
use Aym3ntn\MedecinBundle\Form\SecteurType;

/**
 * Secteur controller.
 *
 */
class SecteurController extends Controller
{

    /**
     * Lists all Secteur entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        if( in_array('ROLE_CHEF_PRODUIT ', $user->getRoles()) )
            $entities = $em->getRepository('MedecinBundle:Secteur')->findAll();
        elseif( in_array('ROLE_DELG', $user->getRoles()) || in_array('ROLE_SUPERVISEUR', $user->getRoles()) )
            $entities = $em->getRepository('MedecinBundle:Secteur')->findByUser($user);
        else
            throw $this->createAccessDeniedException('Vous n\'avez pas le droit d\'accéder à cette page!');

        return $this->render('MedecinBundle:Secteur:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Secteur entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Secteur();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('secteur_show', array('id' => $entity->getId())));
        }

        return $this->render('MedecinBundle:Secteur:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Secteur entity.
     *
     * @param Secteur $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Secteur $entity)
    {
        $form = $this->createForm(new SecteurType(), $entity, array(
            'action' => $this->generateUrl('secteur_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Secteur entity.
     *
     */
    public function newAction()
    {
        $user = $this->getUser();

        if( !in_array('ROLE_SUPERVISEUR', $user->getRoles()) )
           throw $this->createAccessDeniedException('Vous n\'avez pas le droit d\'accéder à cette page!');

        $entity = new Secteur();
        $form   = $this->createCreateForm($entity);

        return $this->render('MedecinBundle:Secteur:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Secteur entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MedecinBundle:Secteur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Secteur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MedecinBundle:Secteur:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Secteur entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MedecinBundle:Secteur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Secteur entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MedecinBundle:Secteur:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Secteur entity.
    *
    * @param Secteur $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Secteur $entity)
    {
        $form = $this->createForm(new SecteurType(), $entity, array(
            'action' => $this->generateUrl('secteur_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Secteur entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MedecinBundle:Secteur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Secteur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('secteur_edit', array('id' => $id)));
        }

        return $this->render('MedecinBundle:Secteur:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Secteur entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MedecinBundle:Secteur')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Secteur entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('secteur'));
    }

    /**
     * Creates a form to delete a Secteur entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('secteur_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Supprimer', 'attr' => array('class'=>'btn btn-danger btn-block margin-bottom')))
            ->getForm()
        ;
    }
}
