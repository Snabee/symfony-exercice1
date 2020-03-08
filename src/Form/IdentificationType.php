<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class IdentificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom' , TextType::class, [
                'label' => false,
                'attr' => ["placeholder" => "Votre nom"]
            ])
            ->add('prenom' , TextType::class, [
                'label' => false,
                'attr' => ["placeholder" => "Votre prénom"]
            ])
            ->add('email' , TextType::class, [
                'label' => false,
                'attr' => ["placeholder" => "Votre email"]
            ])
            ->add('submit',SubmitType::class, [
                'attr'=> ["class" => 'btn btn-primary']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
