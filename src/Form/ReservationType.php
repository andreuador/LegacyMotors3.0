<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Customer;
use App\Entity\Model;
use App\Entity\PaymentDetails;
use App\Entity\Reservation;
use App\Entity\Vehicle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('start_date', null, [
                'widget' => 'single_text',
            ])
            ->add('end_date', null, [
                'widget' => 'single_text',
            ])
            ->add('total_price')
            ->add('vehicle', EntityType::class, [
                'class' => Vehicle::class,
                'choice_label' => 'plate',
            ])
            ->add('vehicle', EntityType::class, [
                'class' => Brand::class,
                'choice_label' => 'name',
            ])
            ->add('vehicle', EntityType::class, [
                'class' => Model::class,
                'choice_label' => 'name',
            ])
            ->add('paymentDetails', EntityType::class, [
                'class' => PaymentDetails::class,
                'choice_label' => 'paymentMethod',
            ])
            ->add('customer', EntityType::class, [
                'class' => Customer::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
