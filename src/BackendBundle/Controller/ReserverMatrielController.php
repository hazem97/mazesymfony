<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\ReserverMatriel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
/**
 * Reservermatriel controller.
 *
 */
class ReserverMatrielController extends Controller
{
    /**
     * Lists all reserverMatriel entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reserverMatriels = $em->getRepository('BackendBundle:ReserverMatriel')->findAll();

        return $this->render('@Backend/reservermatriel/index.html.twig', array(
            'reserverMatriels' => $reserverMatriels,
        ));
    }

    /**
     * Creates a new reserverMatriel entity.
     *
     */
    public function newAction(Request $request)
    {

        $staffs= $this->getDoctrine()->getManager()->getRepository('BackendBundle:Staff')->findAllStaffs();
        $array = [];
        foreach ($staffs as $staffs) {
            if (!empty($staffs->getFirstname())) {
                $array[$staffs->getFirstname()] = $staffs->getFirstname();
            }
        }
        $matriels= $this->getDoctrine()->getManager()->getRepository('BackendBundle:MatrielMag')->findAllmatriels();
        $array1 = [];
        foreach ($matriels as $matriels) {
            if (!empty($matriels->getReference())) {
                $array1[$matriels->getReference()] = $matriels->getReference();
            }
        }
        $reserverMatriel = new Reservermatriel();
        $form = $this->createForm('BackendBundle\Form\ReserverMatrielType', $reserverMatriel)
            ->add('staff',ChoiceType::class,array(
                'attr'  =>  array('class' => 'form-control',
                    'style' => 'margin:5px 0;'),
                'choices' =>$array,
                'multiple' => true,
                'required' => true,
            ))
            ->add('matriel',ChoiceType::class,array(
                'attr'  =>  array('class' => 'form-control',
                    'style' => 'margin:5px 0;'),
                'choices' =>$array1,
                'multiple' => true,
                'required' => true,
            ));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $mat = $form['matriel']->getData();
            foreach ($mat as $mat)
            {
                $us = $em->getRepository('BackendBundle:MatrielMag')->findEntityByString($mat);
            foreach ($us as $us) {
                $reserverMatriel->setMatriel($us);
            }
        }
            $staf = $form['staff']->getData();
            foreach ($staf as $staf) {
                $us1 = $em->getRepository('BackendBundle:Staff')->findEntitiesByString($staf);
                foreach ($us1 as $us1) {
                    $reserverMatriel->setStaff($us1);
                }
            }
            $em->persist($reserverMatriel);
            $em->flush();

            return $this->redirectToRoute('reservermatriel_show', array('id' => $reserverMatriel->getId()));
        }

        return $this->render('@Backend/reservermatriel/new.html.twig', array(
            'reserverMatriel' => $reserverMatriel,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reserverMatriel entity.
     *
     */
    public function showAction(ReserverMatriel $reserverMatriel)
    {
        $deleteForm = $this->createDeleteForm($reserverMatriel);

        return $this->render('@Backend/reservermatriel/show.html.twig', array(
            'reserverMatriel' => $reserverMatriel,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reserverMatriel entity.
     *
     */
    public function editAction(Request $request, ReserverMatriel $reserverMatriel)
    {
        $deleteForm = $this->createDeleteForm($reserverMatriel);
        $editForm = $this->createForm('BackendBundle\Form\ReserverMatrielType', $reserverMatriel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservermatriel_edit', array('id' => $reserverMatriel->getId()));
        }

        return $this->render('@Backend/reservermatriel/edit.html.twig', array(
            'reserverMatriel' => $reserverMatriel,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reserverMatriel entity.
     *
     */
    public function deleteAction(Request $request, ReserverMatriel $reserverMatriel)
    {
        $form = $this->createDeleteForm($reserverMatriel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reserverMatriel);
            $em->flush();
        }

        return $this->redirectToRoute('reservermatriel_index');
    }

    /**
     * Creates a form to delete a reserverMatriel entity.
     *
     * @param ReserverMatriel $reserverMatriel The reserverMatriel entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ReserverMatriel $reserverMatriel)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reservermatriel_delete', array('id' => $reserverMatriel->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
