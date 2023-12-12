<?php

declare(strict_types=1);

namespace App\Form;

use App\Enums\GlobalSortedCardKeys;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class SortOptionsType extends AbstractType
{
    public const SORTING_OPTION = 'sortingOption';

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(self::SORTING_OPTION, ChoiceType::class, [
                'choices' => [
                    'Trier par ordre de couleur puis par valeur' => GlobalSortedCardKeys::colorAndValueSorted->name,
                    'Trier par ordre de couleur' => GlobalSortedCardKeys::colorSorted->name,
                    'Trier par ordre de valeur' => GlobalSortedCardKeys::valueSorted->name,
                    'Pas de tri (Ordre aléatoire)' => GlobalSortedCardKeys::initial->name,
                ],
                'expanded' => true,
                'multiple' => false,
                'data' => GlobalSortedCardKeys::initial->name,
            ]);
    }
}
