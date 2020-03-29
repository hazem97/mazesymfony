<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Staff;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BackendBundle\Form\StaffType;
/**
 * Staff controller.
 *
 */
class StaffController extends Controller
{

    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $staffs = $em->getRepository('BackendBundle:Staff')->findAll();

        return $this->render('@Backend/staff/index.html.twig', array(
            'staffs' => $staffs,
        ));

    }


    public function newAction(Request $request)
    {
        $staff = new Staff();
        $form = $this->createForm('BackendBundle\Form\StaffType', $staff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($staff);
            $em->flush();

            return $this->redirectToRoute('staff_show', array('id' => $staff->getId()));
        }

        return $this->render('@Backend/staff/new.html.twig', array(
            'staff' => $staff,
            'form' => $form->createView(),
        ));
    }


    public function showAction(Staff $staff)
    {
        $deleteForm = $this->createDeleteForm($staff);

        return $this->render('@Backend/staff/show.html.twig', array(
            'staff' => $staff,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function editAction(Request $request, Staff $staff)
    {
        $deleteForm = $this->createDeleteForm($staff);
        $editForm = $this->createForm('BackendBundle\Form\StaffType', $staff);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('staff_edit', array('id' => $staff->getId()));
        }

        return $this->render('@Backend/staff/edit.html.twig', array(
            'staff' => $staff,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function deleteAction(Request $request, Staff $staff)
    {
        $form = $this->createDeleteForm($staff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($staff);
            $em->flush();
        }

        return $this->redirectToRoute('staff_index');
    }


    private function createDeleteForm(Staff $staff)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('staff_delete', array('id' => $staff->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
