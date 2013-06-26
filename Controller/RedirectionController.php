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
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KitpagesRedirectBundle:Redirection')->findAll();

        return $this->render('KitpagesRedirectBundle:Redirection:index.html.twig', array(
            'entities' => $entities,
            'base_layout' => $this->container->getParameter('kitpages.redirect.layout'),
        ));
    }

    /**
     * Finds and displays a Redirection entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KitpagesRedirectBundle:Redirection')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Redirection entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('KitpagesRedirectBundle:Redirection:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'base_layout' => $this->container->getParameter('kitpages.redirect.layout'),

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
            'form'   => $form->createView(),
            'base_layout' => $this->container->getParameter('kitpages.redirect.layout'),
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
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->setFlash('notice', 'Redirection has been created');

            return $this->redirect($this->generateUrl('redirection'));
        }
        else {
            $this->get('session')->setFlash('error', 'An error occured while creating redirection');
        }

        return $this->render('KitpagesRedirectBundle:Redirection:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'base_layout' => $this->container->getParameter('kitpages.redirect.layout'),
        ));
    }

    /**
     * Displays a form to edit an existing Redirection entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

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
            'base_layout' => $this->container->getParameter('kitpages.redirect.layout'),
        ));
    }

    /**
     * Edits an existing Redirection entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KitpagesRedirectBundle:Redirection')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Redirection entity.');
        }

        $editForm   = $this->createForm(new RedirectionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->setFlash('notice', 'Redirection has been updated');

            return $this->redirect($this->generateUrl('redirection'));
        }
        else {
            $this->get('session')->setFlash('error', 'An error occured while updating redirection');
        }

        return $this->render('KitpagesRedirectBundle:Redirection:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'base_layout' => $this->container->getParameter('kitpages.redirect.layout'),
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

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
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
