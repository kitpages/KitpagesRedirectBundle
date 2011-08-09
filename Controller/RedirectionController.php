<?php

namespace Kitpages\RedirectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Kitpages\RedirectBundle\Entity\Redirection;
use Kitpages\RedirectBundle\Form\RedirectionType;

/**
 * Redirection controller.
 *
 */
class RedirectionController extends Controller
{
    /**
     * Lists all Redirection entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('KitpagesRedirectBundle:Redirection')->findAll();

        return $this->render('KitpagesRedirectBundle:Redirection:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Redirection entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('KitpagesRedirectBundle:Redirection')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Redirection entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KitpagesRedirectBundle:Redirection:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Redirection entity.
     *
     */
    public function newAction()
    {
        $entity = new Redirection();
        $form   = $this->createForm(new RedirectionType(), $entity);

        return $this->render('KitpagesRedirectBundle:Redirection:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Redirection entity.
     *
     */
    public function createAction()
    {
        $entity  = new Redirection();
        $request = $this->getRequest();
        $form    = $this->createForm(new RedirectionType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('redirection_show', array('id' => $entity->getId())));
            
        }

        return $this->render('KitpagesRedirectBundle:Redirection:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Redirection entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('KitpagesRedirectBundle:Redirection')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Redirection entity.');
        }

        $editForm = $this->createForm(new RedirectionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KitpagesRedirectBundle:Redirection:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Redirection entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('KitpagesRedirectBundle:Redirection')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Redirection entity.');
        }

        $editForm   = $this->createForm(new RedirectionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('redirection_edit', array('id' => $id)));
        }

        return $this->render('KitpagesRedirectBundle:Redirection:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Redirection entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('KitpagesRedirectBundle:Redirection')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Redirection entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('redirection'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
