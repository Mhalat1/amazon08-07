<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('categorie')
            ->add('price')
            ->add('image')
            ->add('description')
            // ->add('paniercommercant', EntityType::class, [
            //     'class' => Commercants::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
            // ->add('paniervisiteur', EntityType::class, [
            //     'class' => Visiteurs::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
