<?php

namespace App\Controller;

use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;

final class ProgramController extends AbstractController
{
    #[Route('/programs', name: 'Programs')]
    public function index(Environment $twig, ProgramRepository $programRepository, Request $request): Response
    {
        // Grab all the progams
        return new Response($twig->render('program/index.html.twig', [
            'programs' => $programRepository->findAll(),
        ]));
    }

    #[Route('/api/programs', name: 'testClick')]
    public function clicked(Request $request): Response
    {
        return new Response('<div>Hello</div>');
    }
}
