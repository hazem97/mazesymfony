<?php

namespace BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roles', ChoiceType::class, array(
                    'attr'  =>  array('class' => 'form-control',
                        'style' => 'margin:5px 0;'),
                    'choices' =>
                        array
                        (
                            'ROLE_USER' => 'ROLE_USER',
                             'ROLE_CLIENT' =>'ROLE_CLIENT',
                             'ROLE_GESTIONNAIRE'=> 'ROLE_GESTIONNAIRE',
                              'ROLE_AGENTFINANCIER' =>'ROLE_AGENTFINANCIER',
                             'ROLE_AGENTTRANSPORT'=> 'ROLE_AGENTTRANSPORT',
                        ) ,
                    'multiple' => true,
                    'required' => true,
                )
            );
        $builder->remove('plainPassword');
    }

    /**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backendbundle_user';
    }


}
