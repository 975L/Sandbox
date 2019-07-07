<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use c975L\UserBundle\Form\UserSignupType as BaseSignupType;

class UserSignupType extends BaseSignupType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('credits', TextType::class, array(
                'label' => 'label.credits_offered',
                'translation_domain' => 'shortcuts',
                'required' => false,
                'disabled' => true,
                'attr' => array(
                    'value' => 3,
                )))
        ;
    }

    public function getParent()
    {
        return 'c975L\UserBundle\Form\UserSignupType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_signup';
    }
}