<?php

namespace BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;


class StaffType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname',TextType::class,array('attr' => array('class' => 'form-control')))

            ->add('lastname',TextType::class,array('attr' => array('class' => 'form-control')))

            ->add('salary',TextType::class,array('attr' => array('class' => 'form-control')))

            ->add('post',TextType::class,array('attr' => array('class' => 'form-control')))

            ->add('rib',TextType::class,array('attr' => array('class' => 'form-control')))

            ->add('prime',NumberType::class,array('attr' => array('class' => 'form-control')))

            ->add('statut',ChoiceType::class,[
                'choices'  => [
                    '0' => 'verifié',
                    '1' => 'non vérifié',
                ],
            ])

            ->add('date_deb',DateType::class,array('attr' => array('class' => 'form-control')))

            ->add('nb_conj',IntegerType::class,array('attr' => array('class' => 'form-control')))

            ->add('nb_heur',NumberType::class,array('attr' => array('class' => 'form-control')))

            ->add('phoneNumber',TelType::class,array('attr' => array('class' => 'form-control')
            ))

            ->add('reference',TextType::class,array('attr' => array('class' => 'form-control')))
        ;
    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\Staff'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backendbundle_staff';
    }


}
