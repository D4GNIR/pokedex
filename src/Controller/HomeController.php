<?php

namespace App\Controller;

use App\Repository\AttackRepository;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private PokemonRepository $pokemonRepository;
    private PaginatorInterface $paginator;
    private EntityManagerInterface $em;
    private AttackRepository $attackRepository;

    public function __construct(
        PokemonRepository $pokemonRepository,
        PaginatorInterface $paginator,
        EntityManagerInterface $em,
        AttackRepository $attackRepository
    ) {
        $this->pokemonRepository = $pokemonRepository;
        $this->paginator = $paginator;
        $this->em = $em;
        $this->attackRepository = $attackRepository;
    }

    #[Route('/', name: 'app_home')]
    public function index(Request $request): Response
    {
        $qb = $this->pokemonRepository->getQbAll();

        $pagination = $this->paginator->paginate(
            $qb, //La query
            $request->query->getInt('page',1), //Le numero de page de depart
            9 //Le nombre de résultat pas page
        );

        return $this->render('home/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

        // Récupérer un jeu avec son slug
        #[Route('/Pokemon/{id}', name: 'show_pokemon')]
        public function getOnePokemonById(int $id): Response
        {
            $pokemonEntity = $this->pokemonRepository->find($id);
            $attacksArray = $this->attackRepository->getAttacksByPokemonId($id);
            return $this->render('home/show.html.twig', [
                'myPokemon' => $pokemonEntity,
                'attacksArray' => $attacksArray,
            ]);
        }

                // Récupérer un jeu avec son slug
                #[Route('/Pokemon/{id}/attacks', name: 'show_more_pokemon')]
                public function getOnePokemonByIdShowMore(int $id): Response
                {
                    $pokemonEntity = $this->pokemonRepository->find($id);
                    return $this->render('home/showMore.html.twig', [
                        'myPokemon' => $pokemonEntity,
                    ]);
                }
}
