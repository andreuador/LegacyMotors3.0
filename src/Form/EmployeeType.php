<?php

namespace App\Form;

use App\Entity\Employee;
use App\Entity\Login;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Constraints\Regex;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('lastname', TextType::class)
            ->add('email', TextType::class)
            ->add('phone', TextType::class)
            ->add('salary', NumberType::class, [
                'constraints' => [
                    new Range([
                        'min' => 1000,
                        'max' => 2000,
                    ]),
                    new Regex([
                        'pattern' => '/^\d+$/',
                        'message' => 'Este valor debería ser un número.',
                    ]),
                ],
            ])
            ->add('login', LoginType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
