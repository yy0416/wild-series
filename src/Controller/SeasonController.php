<?php

namespace App\Controller;

use App\Repository\SeasonRepository;
use App\Repository\ProgramRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/program/{programId}/season', name: 'season_')]
class SeasonController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(int $programId, SeasonRepository $seasonRepository, ProgramRepository $programRepository): Response
    {
        $program = $programRepository->find($programId);
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id:' . $programId . ' found in program\'s table.'
            );
        }

        $seasons = $seasonRepository->findBy(['program_id' => $program], ['number' => 'ASC']);

        return $this->render('season/index.html.twig', [
            'program' => $program,
            'seasons' => $seasons,
        ]);
    }

    #[Route('/{seasonId}', name: 'show')]
    public function show(int $programId, int $seasonId, SeasonRepository $seasonRepository): Response
    {
        $season = $seasonRepository->findOneBy(['program_id' => $programId, 'id' => $seasonId]);

        if (!$season) {
            throw $this->createNotFoundException(
                'No season with program id:' . $programId . ' and season id:' . $seasonId . ' found in seasons table.'
            );
        }

        return $this->render('program/season_show.html.twig', [
            'season' => $season,
            'programId' => $programId,
        ]);
    }
}
