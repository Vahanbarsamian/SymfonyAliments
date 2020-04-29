<?php

namespace App\Form;

use App\Entity\Aliment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FloatType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlimentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, ["attr" => ["placeholder" => "Nom de l'aliment"]])
            ->add('prix', MoneyType::class, ["attr" => ["placeholder" => "Prix moyen(kg)"]])
            ->add('image', TextType::class, ["attr" => ["placeholder" => "Url de l'image"]])
            ->add('calorie', FloatType::class, ["attr" => ["placeholder" => "Nb de calories"]])
            ->add('proteine', FloatType::class, ["attr" => ["placeholder" => "Nb de proteines"]])
            ->add('glucide', FloatType::class, ["attr" => ["placeholder" => "Nb de glucides"]])
            ->add('lipide', FloatType::class, ["attr" => ["placeholder" => "Nb de lipides"]]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Aliment::class,
            ]
        );
    }
}
