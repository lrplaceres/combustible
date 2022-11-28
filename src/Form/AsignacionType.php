<?php

namespace App\Form;

use App\Entity\Asignacion;
use App\Entity\Empresa;
use App\Entity\Lugar;
use App\Entity\Tipo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AsignacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cantidad', IntegerType::class, [
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control form-control-lg', 'placeholder' => 'Insertar cantidad', 'maxlength' => '255']
            ])
            ->add('fecha',DateType::class,[
                'attr' => ['class' =>'form-control form-control-lg']
            ])
            ->add('chapa', TextType::class, [
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control form-control-lg', 'placeholder' => 'Insertar chapa', 'maxlength' => '255']
            ])
            ->add('empresa', EntityType::class, [
                'class' => Empresa::class,
                'attr' => ['class' => 'form-select'],
            ])
            ->add('lugar', EntityType::class, [
                'class' => Lugar::class,
                'attr' => ['class' => 'form-select'],            
            ])
            ->add('tipo', EntityType::class, [
                'class' => Tipo::class,
                'attr' => ['class' => 'form-select'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Asignacion::class,
        ]);
    }
}
