<?php

namespace App\Form;

use App\Entity\Taches;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TacheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nom' , TextType::class, [
            'label' => false,
            'attr' => ["placeholder" => "Nom de la tâche"]
        ])
        ->add('utilisateur' , TextType::class, [
            'label' => false,
            'attr' => ["placeholder" => "L'id de l'utilisateur"]
        ])
        ->add('submit',SubmitType::class, [
            'attr'=> ["class" => 'btn btn-primary']
        ])
    ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Taches::class,
        ]);
    }
}
