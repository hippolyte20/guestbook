<?php

namespace App\Form;

use App\Entity\Book;
use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lat')
            ->add('lng')
            ->add('lat2')
            ->add('lng2')
            ->add('transmean', ChoiceType::class, [
                'label' => 'Moyen de deplacement',
                'choices'  => [
                    'moto' => 'moto',
                    'taxi' => 'taxi',
                ],
            ])
            ->add('numconducteur', ChoiceType::class, [
                'label' => 'Selectionnez un conducteur',
                'choices'  => [
                    'conducteur 1' => '1',
                    'conducteur 2' => '2',
                    'conducteur 3' => '3',
                    'conducteur 4' => '4',
                ],
            ])
            ->add('reserveAt')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
