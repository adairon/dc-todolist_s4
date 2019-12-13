<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Todo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TodoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // test : en mode crétion, l'id de la todo est null, en édition, la todo a un id
        // dump($options['data']->getId());
        // fin test

        $builder
            ->add('title', TextType::class, [
                'label' => 'Un titre en quelques mots :',
                'required'=>false,
                'attr' => [
                    'placeholder' => 'Entrez votre titre ici !'
                ]
            ])

            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'label' => 'Quelle Catégorie ?'
            ])

            ->add('content', TextareaType::class, [
                'label' => 'Mais encore !',
                'required'=>false,
                'attr' => [
                    'placeholder' => 'Ajouter le détail ici'
                ]
            ]); //fin du builder et ajout d'une condition pour gérer la date todofor selon si création ou édition

            // Test si création (nouvelle date todofor) ou édition d'une Todo (date todofor existante) :
            if($options['data']->getId() == null) {

                // en mode création d'une nouvelle Todo : l'id est null
                $builder->add('todoFor', DateType::class,[
                    'years' => ['2019','2020'],
                    'format' => 'dd MM yyyy',
                    'data' => new \DateTime('now', new \DateTimeZone('Europe/Paris')) //nouvelle date pour création
                ]);

            } else {

                 // en mode édition d'une Todo existante : l'id n'est pas null
                 $builder->add('todoFor', DateType::class,[
                    'years' => ['2019','2020'],
                    'format' => 'dd MM yyyy',
                    //pas de nouvelle date pour édition
                ]);
            }

            $builder->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Todo::class,
        ]);
    }
}
