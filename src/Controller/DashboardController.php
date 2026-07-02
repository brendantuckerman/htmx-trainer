<?php

namespace App\Controller;

use App\Repository\SportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashboardController extends AbstractController
{
  #[Route('/', name: 'home')]
  public function index(Request $request, SportRepository $sportRepository): Response
  {
    
    $sports = $sportRepository->findAll();

    return $this->render('dashboard/index.html.twig', [
        'controller_name' => 'DashboardController',
        'request' => $request,
        'sports' => $sports
    ]);
  }
}
