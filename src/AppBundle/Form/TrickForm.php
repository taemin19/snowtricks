<?php

namespace AppBundle\Form;

use AppBundle\Entity\Category;
use AppBundle\Entity\Trick;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
                'label_attr' => ['class' => 'sr-only'],
                'attr' => ['placeholder' => 'e.g. Air']
            ])
            ->add('description', TextareaType::class, [
                'label_attr' => ['class' => 'sr-only'],
                'attr' => [
                    'placeholder' => 'e.g. A front jump, one of the basics.',
                    'rows' => '3'
                ]
            ])
            ->add('content', TextareaType::class, [
                'label_attr' => ['class' => 'sr-only'],
                'attr' => [
                        'placeholder' => 'e.g. Accelerate, riding straight on a flat board.
Before the jump, crouch down a little more and prepare for the launch.
Pop off the jump with your back leg. Once you’re in the air, relax and watch your landing spot.
Land, absorbing the impact with your legs.',
                        'rows' => '10'
                ]
            ])
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'label_attr' => ['class' => 'sr-only'],
                'choice_label' => 'name'
            ])
            ->add('images', CollectionType::class, [
                'entry_type'   => ImageForm::class,
                'entry_options' => ['label' => false],
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
                'required' => false
            ])
            ->add('videos', CollectionType::class, [
                'entry_type'   => VideoForm::class,
                'entry_options' => ['label' => false],
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trick::class
        ]);
    }
}
