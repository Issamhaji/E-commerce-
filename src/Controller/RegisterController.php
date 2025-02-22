<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterUserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RegisterController extends AbstractController
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {}

    #[Route('/register', name: 'app_register')]
    public function index(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(RegisterUserType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->userRepository->save($user);

            return $this->redirectToRoute('app_home');
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
