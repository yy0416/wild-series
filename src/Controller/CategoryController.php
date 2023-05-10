<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ProgramRepository;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findBy([], ['name' => 'ASC']);
        return $this->render('category/index.html.twig', ['categories' => $categories]);
    }

    #[Route('/{categoryName}', name: 'show')]
    public function show(
        string $categoryName,
        CategoryRepository $categoryRepository,
        ProgramRepository $programRepository
    ) {
        $category = $categoryRepository->findOneBy(['name' => $categoryName]);

        if (!$category) {
            throw $this->createNotFoundException(
                'There\'s no category' . $categoryName
            );
        }

        $programs = $programRepository->findBy(['category' => $category], ['id' => 'DESC'], 3);

        return $this->render(
            'category/show.html.twig',
            [
                'category' => $category,
                'programs' => $programs,
            ]
        );
    }
}
