<?php

namespace App\Controller;

use App\Entity\Sport;
use App\Form\SportType;
use App\Repository\SportRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;

final class SportController extends AbstractController
{
  public function __construct(
    private EntityManagerInterface $entityManager,
  ) {}

  #[Route('/sports', name: 'sports')]
  public function index(Environment $twig): Response
  {
    $sports = $this->entityManager->getRepository(Sport::class)->findAll();

    return new Response($twig->render('sport/index.html.twig', [
        'sports' => $sports
    ]));
  }

  //Post route for adding a sport
  #[Route('/sport/create', name: 'sport_create')]
  public function createSport(
    Request $request) : Response {
    
    $name = $request->get('sport') |> trim(...) |> strtolower(...);
    
    // See if it already exists
    $repository = $this->entityManager->getRepository(Sport::class);
    $sport = $repository->findOneBy(['name' => $name]);
    
    if ($sport) {
      $this->addFlash('error', 'This sport already exists!');
      return new Response('Sport already exists', 200);
    } 
    else {
      $newSport = new Sport();
      $newSport->setName($name);
      
      $newIcon = $request->get('icon');
      $newColor = $request->get('color');
      if ($newIcon) {
        $newSport->setIcon($newIcon);
      }
      if ($newColor) {
        $newSport->setColor($newColor);
      }

      $this->entityManager->persist($newSport);
      $this->entityManager->flush();
    }

    return new Response("<li>{$name}</li>", 200);
  }

   #[Route('/sport/create/basic', name: 'sport_create_basic')]
  public function createSportBasic() : Response {
    return $this->render('sport/createBasic.html.twig');
  }

   #[Route('/sport/{id}/', name: 'sport_show')]
  public function show(
    Request $request, 
    Sport $sport
  ) : Response {
   
    $form = $this->createForm(SportType::class, $sport, [
      'attr' => [
        'hx-post' => $this->generateUrl('sport_show', ['id' => $sport->getId()]),
        'hx-target' => '#htmexcel-dialogue',
        'hx-swap' => 'innerHtml',
        'hx-trigger' => 'submit'
    ]
    ]);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $this->entityManager->flush();
      return $this->render('sport/_row.html.twig', ['sport' => $sport]);
    }

    return $this->render('sport/show.html.twig', [
      'sport_form' => $form
    ]);
  }



   #[Route('/sport/delete', name: 'sport_delete', methods: ['DELETE'])]
  public function deleteSport(Request $request) : Response {

    $name = $request->get('name');

    $repository = $this->entityManager->getRepository(Sport::class);
    $sport = $repository->findOneBy(['name' => $name]);

    if($sport) {
      $this->entityManager->remove($sport);
      $this->entityManager->flush();
    } 
    else {
      return new Response('Sport was not found', 500);
    }

    return new Response('Sport deleted successfully');
  }


}
