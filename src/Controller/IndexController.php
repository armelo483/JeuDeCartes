<?php

declare(strict_types=1);

namespace App\Controller;

use App\Enums\GlobalSortedCardKeys;
use App\Form\SortOptionsType;
use App\Service\CardGenerator;
use App\Service\CardSorter;
use App\Sorting\ColorAndValueSortingStrategy;
use App\Sorting\ColorSortingStrategy;
use App\Sorting\DefaultSortingStrategy;
use App\Sorting\ValueSortingStrategy;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    private const GLOBAL_CARD = 'global_cards';


    public function __construct(private readonly CardSorter $cardSorter,  private readonly CardGenerator $cardGenerator) {}


    /**
     * @throws \Exception
     */
    #[Route('/', name: 'app_index')]
    public function index(Request $request): Response
    {
        $strategies = [
            GlobalSortedCardKeys::colorSorted->name => ColorSortingStrategy::getInstance(),
            GlobalSortedCardKeys::valueSorted->name => ValueSortingStrategy::getInstance(),
            GlobalSortedCardKeys::colorAndValueSorted->name => ColorAndValueSortingStrategy::getInstance(),
            GlobalSortedCardKeys::initial->name => DefaultSortingStrategy::getInstance($this->cardGenerator),
        ];

        $keyStrategy = GlobalSortedCardKeys::initial->name;
        $session = $request->getSession();

        $this->cardSorter->setSortingStrategy($strategies[$keyStrategy]);
        $cardsListSess = $session->get(self::GLOBAL_CARD, []);

        $cardsList = !empty($cardsListSess) ? array_merge([], $cardsListSess): $this->cardSorter->sortCards();
        $form = $this->createForm(SortOptionsType::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $keyStrategy = $form->get(SortOptionsType::SORTING_OPTION)->getData();
            $sortingStrategy = $strategies[$keyStrategy];
            $sortingStrategy->setGlobalCardsArray($cardsList);
            $this->cardSorter->setSortingStrategy($sortingStrategy);

            // Récupérez les cartes triées
            $cardsList = array_merge([], $this->cardSorter->sortCards());

        }

        $session->set(self::GLOBAL_CARD, $cardsList);

        return $this->render('index.html.twig', [
            'form' => $form->createView(),
            'cardsList' => $cardsList[$keyStrategy]
        ]);

    }
}
