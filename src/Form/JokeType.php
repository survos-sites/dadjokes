<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Joke;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

final class JokeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('keyword', TextType::class, [
                'label' => 'Keyword (front of card)',
                'constraints' => [new NotBlank(), new Length(max: 64)],
            ])
            ->add('joke', TextareaType::class, [
                'label' => 'Joke (back of card)',
                'attr' => ['rows' => 4],
                'constraints' => [new NotBlank()],
            ])
            ->add('category', TextType::class, [
                'label' => 'Category',
                'constraints' => [new NotBlank(), new Length(max: 32)],
            ])
            ->add('save', SubmitType::class, ['label' => 'Save']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Joke::class]);
    }
}
