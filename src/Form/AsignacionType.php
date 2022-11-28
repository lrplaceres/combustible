<?php

namespace App\Form;

use App\Entity\Asignacion;
use App\Entity\Empresa;
use App\Entity\Lugar;
use App\Entity\Tipo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AsignacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cantidad')
            ->add('fecha')
            ->add('chapa')
            ->add('empresa', EntityType::class, [
                'class' => Empresa::class
            ])
            ->add('lugar', EntityType::class, [
                'class' => Lugar::class
            ])
            ->add('tipo', EntityType::class, [
                'class' => Tipo::class
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Asignacion::class,
        ]);
    }
}
