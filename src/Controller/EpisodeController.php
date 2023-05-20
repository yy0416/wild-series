<?php

namespace App\Controller;

use App\Repository\EpisodeRepository;
use App\Repository\SeasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program/{programId}/season/{seasonId}', name: 'episode_')]
class EpisodeController extends AbstractController
{
    #[Route('/episode/{episodeId}', name: 'index')]
    public function index(int $programId, int $seasonId, int $episodeId, EpisodeRepository $episodeRepository, SeasonRepository $seasonRepository): Response
    {
        $season = $seasonRepository->findOneBy(['program_id' => $programId, 'id' => $seasonId]);
        if (!$season) {
            throw $this->createNotFoundException(
                'No season with program id:' . $programId . ' and season id:' . $seasonId . ' found in seasons table.'
            );
        }

        $episode = $episodeRepository->findOneBy(['id' => $episodeId, 'season_id' => $season]);

        if (!$episode) {
            throw $this->createNotFoundException(
                'No episode with season id:' . $seasonId . ' and episode id:' . $episodeId . ' found in episodes table.'
            );
        }

        return $this->render('episode/index.html.twig', [
            'episode' => $episode,
        ]);
    }

    #[Route('/episodes', name: 'show')]
    public function show(int $programId, int $seasonId, EpisodeRepository $episodeRepository, SeasonRepository $seasonRepository): Response
    {
        $season = $seasonRepository->findOneBy(['program_id' => $programId, 'id' => $seasonId]);
        if (!$season) {
            throw $this->createNotFoundException(
                'No season with program id:' . $programId . ' and season id:' . $seasonId . ' found in seasons table.'
            );
        }

        $episodes = $episodeRepository->findBy(['season_id' => $season]);

        return $this->render('season/episode_show.html.twig', [
            'episodes' => $episodes,
        ]);
    }
}
