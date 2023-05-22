<?php

namespace App\Controller;

use App\Entity\Season;
use App\Entity\Episode;
use App\Entity\Program;
use App\Form\ProgramType;
use App\Repository\SeasonRepository;
use App\Repository\ProgramRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/new', name: 'new')]
    public function new(Request $request, ProgramRepository $programRepository): Response
    {
        $program = new Program();
        $form =  $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $programRepository->save($program, true);
            return $this->redirectToRoute('program_index');
        }

        return $this->render(
            'program/new.html.twig',
            ['form' => $form,]
        );
    }






    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();
        return $this->render(
            'program/index.html.twig',
            ['programs' => $programs]
        );
    }

    #[Route('/show/{id}', name: 'show')]
    public function show(Program $program): Response
    {
        // La conversion du paramètre {id} en instance de Program est gérée automatiquement par le ParamConverter



        return $this->render('program/show.html.twig', ['program' => $program]);
    }

    #[Route('/{program}/seasons/{season}', name: 'season_show')]
    public function showSeason(Program $program, Season $season): Response
    {

        $episodes = $season->getEpisodes();

        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episodes' => $episodes,
        ]);
    }

    #[Route('/{program}/seasons/{season}/episode/{episode}', name: 'episode_show')]
    public function showEpisode(Program $program, Season $season, Episode $episode)
    {

        return $this->render('program/episode_show.html.twig', [
            'program' => $program->getTitle(),
            'season' => $season,
            'episode' => $episode,
        ]);
    }
}
