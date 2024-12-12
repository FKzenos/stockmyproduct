<?php
namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class, ['required' => false])
            ->add('price', NumberType::class)
            ->add('quantity', NumberType::class)
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',  // Affiche le nom de la catégorie
                'placeholder' => 'Choisissez une catégorie parent', // Optionnel : message d'indication
            ]);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
            'categories' => [], 
        ]);
    }
}
