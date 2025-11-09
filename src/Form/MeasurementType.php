<?php

namespace App\Form;

use App\Entity\Measurement;
use App\Entity\Location;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeasurementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'choice_label' => 'city',
                'label' => 'Lokalizacja',
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Data pomiaru',
            ])
            ->add('celcius', NumberType::class, [
                'label' => 'Temperatura (°C)',
            ])
            ->add('humidity', NumberType::class, [
                'label' => 'Wilgotność (%)',
            ])
            ->add('pressure', NumberType::class, [
                'label' => 'Ciśnienie (hPa)',
            ])
            ->add('windKmh', NumberType::class, [
                'label' => 'Prędkość wiatru (km/h)',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Measurement::class,
            'validation_groups' => ['Default']
        ]);
    }
}
