<?php

namespace App\Form;

use App\Entity\Pages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('summary')
            ->add('body', null, [
                'label' => 'Gövde Yazısı',
                'required' => false,                
                'attr' => [
                    'rows' => 12,
                    'style' => 'height:100% !important;',
                    'class' => 'editor'
                ]
            ])
            ->add('image', FileType::class, [
                'label' => 'Resim Dosyası',
                'required' => false, 
            ])
            ->add('publish')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pages::class,
        ]);
    }
}
