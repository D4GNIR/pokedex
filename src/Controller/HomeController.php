<?php

namespace App\Controller;

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


    public function __construct(
        PokemonRepository $pokemonRepository,
        PaginatorInterface $paginator,
        EntityManagerInterface $em,
    ) {
        $this->pokemonRepository = $pokemonRepository;
        $this->paginator = $paginator;
        $this->em = $em;
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
}
