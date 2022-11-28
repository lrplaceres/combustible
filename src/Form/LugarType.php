<?php

namespace App\Form;

use App\Entity\Lugar;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LugarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control form-control-lg', 'placeholder' => 'Insertar nombre', 'maxlength' => '255']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lugar::class,
        ]);
    }
}
