<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Order;
use App\Entity\Provider;
use App\Entity\Vehicle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehicleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plate')
            ->add('fuel')
            ->add('color')
            ->add('price_per_day')
            ->add('available')
            ->add('doors')
            ->add('capacity')
            ->add('transmission')
            ->add('description')
            ->add('category')
            ->add('isDeleted')
            ->add('provider', EntityType::class, [
                'class' => Provider::class,
                'choice_label' => 'id',
            ])
            ->add('brand', EntityType::class, [
                'class' => Brand::class,
                'choice_label' => 'id',
            ])
            ->add('vehicleOrder', EntityType::class, [
                'class' => Order::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicle::class,
        ]);
    }
}
