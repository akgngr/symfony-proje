<?php

namespace App\Form;

use App\Entity\CalismaAlanlari;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CalismaAlanlariType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('title', null, [
                'label' => 'Başlık',
            ])
            ->add('summary', TextareaType::class, [
                'label' => 'Giriş Yazısı',
                'attr' => [
                    'rows' => 6,
                    'style' => 'height:100% !important;'
                ]
            ])
            ->add('body', TextareaType::class, [
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
            ->add('icon', null, [ 'label' => 'Yazı iconu', 'help' => 'Ön sayfaya taşıyacaksanız icon seçin!'])
            ->add('show_frontpage', ChoiceType::class, [
                'label' => 'Anasayfaya Yükselt',
                'choices'  => [
                    'Seçiniz' => null,
                    'Evet' => 1,
                    'Hayır' => 0,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CalismaAlanlari::class,
        ]);
    }

}
