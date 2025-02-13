<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'label' => 'Nom du livre :'
        ])
        ->add('summary', TextType::class, [
            'label' => 'Description'
        ])
            ->add('cover', FileType::class, [
                'label' => 'Cover du livre :',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5000k',
                        'mimeTypes' => ['image/*'],
                        'mimeTypesMessage' => 'Image trop lourde'
                    ])
                ]
            ])
            ->add('tags', EntityType::class, [
                'label' => 'Categorie :',
                'class' => Tag::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'attr' => ['class' => 'book-tag-edit']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
