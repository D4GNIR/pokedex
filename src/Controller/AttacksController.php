<?php

namespace App\Controller;

use App\Form\FilterAttacksType;
use App\Repository\AttackRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AttacksController extends AbstractController
{

    private PaginatorInterface $paginator;
    private AttackRepository $attackRepository;

    public function __construct(
        AttackRepository $attackRepository,
        PaginatorInterface $paginator
    ) {
        $this->attackRepository = $attackRepository;
        $this->paginator = $paginator;
    }
    #[Route('/attacks', name: 'app_attacks')]
    public function index(Request $request): Response
    {
        $qb = $this->attackRepository->getQbAll();

        $formFilter = $this->createForm(FilterAttacksType::class);
        $formFilter->handleRequest($request);

        if ($formFilter->isSubmitted() && $formFilter->isValid()) {
            $qb = $this->attackRepository->updateQbByData($qb, $formFilter->getData());  
        }

        $pagination = $this->paginator->paginate(
            $qb, //La query
            $request->query->getInt('page',1), //Le numero de page de depart
            25 //Le nombre de résultat pas page
        );

        return $this->render('attacks/index.html.twig', [
            'pagination' => $pagination,
            'form' => $formFilter->createView(),
        ]);
    }
}
