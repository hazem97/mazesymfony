<?php

namespace UserBundle\Controller;
use BackendBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Ob\HighchartsBundle\Highcharts\Highchart;

class UserController extends Controller
{
    public function indexAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        return $this->render('@User/Admin/index.html.twig', array(
            'users' => $users,
        ));
    }

    public function adminAction(Request $request)
    {

        return $this->render('@User/Admin/base2.html.twig');
    }

    public function ClientAction(Request $request)
    {

        return $this->render('@User/Client/base2.html.twig');
    }

    public function AgentGestAction(Request $request)
    {
        $matriels =$this->getDoctrine()->getRepository('BackendBundle:MatrielMag')->findAll();
        $reservations=$this->getDoctrine()->getRepository('BackendBundle:ReserverMatriel')->findAll();
        return $this->render('@User/AgentGestionnaire/base2.html.twig', array(
            'matriels' => $matriels,'reservations'=>$reservations
        ));
    }

    public function AgentTraAction(Request $request)
    {
        return $this->render('@User/AgentTransport/base2.html.twig');
    }

    public function AgentFinancAction(Request $request)
    {
        return $this->render('@User/AgentFinancier/base2.html.twig');
    }

    public function deleteUserAction(Request $request)
    {
        $Users= $this->getDoctrine()->getManager()->getRepository('BackendBundle:User')->findAllUsers();
        $user=new User();
        $array = [];
        foreach ($Users as $Users) {
            if (!empty($Users->getUserName())) {
                $array[$Users->getUserName()] = $Users->getUserName();
            }
        }
        $form = $this->createForm('BackendBundle\Form\UserType',$user)
        ->add('username',ChoiceType::class,[
            'choices'  =>$array]);
        $form->remove('roles');
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $chev = $form['username']->getData();
            $em = $this->getDoctrine()->getManager();
            $us=$em->getRepository('BackendBundle:User')->findEntitiesByString($chev);
            foreach ($us as $usr) {
                $em->remove($usr);
            }
            $em->flush();
        }
        return $this->render('@User/Admin/delete.html.twig',['form'=>$form->createView()]);
    }
    public function editAction(Request $request, User $id)
    {

        $editForm = $this->createForm('BackendBundle\Form\UserType', $id);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($id);
            $em->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('@User/Admin/edit.html.twig', array(
            'article' => $id,
            'edit_form' => $editForm->createView(),

        ));
    }
    public function chartAction()
    {
        $dat=$this->getDoctrine()->getRepository('BackendBundle:Staff')->findAllStaffs();

        $data = [];
            foreach($dat as $da)
            {
            $data[] = [
                'type' => 'bar',
                'name' => $da->getFirstname(),
                'data' => [
                    'value',
                    $da->getNbHeur(),
                ],
            ];}

        $ob = new Highchart();
        $ob->chart->renderTo('barchart');

        $ob->title->text('');
        $ob->xAxis->title(array('text'  => "Employes"));
        $ob->xAxis->value('');
        $ob->yAxis->title(array('text'  => "heures_nomb" ));
        $ob->legend->legend(
            array(
                'layout' => 'vertical',
                'align'=> 'right',
                'verticalAlign'  =>'top',
                'floating'=> true,
                'borderWidth' =>1,

                'shadow'    =>true
            )
        );
        $ob->series($data);

        $ob1 = new Highchart();
        $ob1->chart->renderTo('piechart');
        $ob1->title->text('Nombre de Conje par employe');
        $ob1->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));

        $data = null;

        foreach($dat as $value)
        {
            $data[] = array(
                '' .$value->getFirstname(), (int)$value->getNbConj(),
            );
        }

        $ob1->series(array(array('type' => 'pie', 'name' => 'Browser share', 'data' => $data)));

        return $this->render('@User/Admin/chart.html.twig', [
            'chart' => $ob,'piechart'=>$ob1
        ]);

    }
    }
