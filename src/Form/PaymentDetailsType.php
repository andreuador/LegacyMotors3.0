<?php

namespace App\Form;

use App\Entity\PaymentDetails;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentDetailsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('payment_method', ChoiceType::class, [
                'choices' => [
                    'Visa' => 'Visa',
                    'Mastercard' => 'Mastercard',
                ],
                'label' => 'Método de Pago'
            ])
            ->add('card_number', TextType::class, [
                'label' => 'Número de Tarjeta',
                'attr' => [
                    'maxlength' => 12,
                    'pattern' => '^[0-9]{12}$'
                ]
            ])
            ->add('expiry_date', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Fecha de Expiración (MM/YY)'
            ])
            ->add('cvv', PasswordType::class, [
                'label' => 'CVV',
                'attr' => [
                    'maxlength' => 3,
                    'pattern' => '^[0-9]{3}$',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PaymentDetails::class,
        ]);
    }
}
