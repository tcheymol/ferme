<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SignupType;
use App\Services\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('security/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }

    #[Route('/signup', name: 'app_signup')]
    public function signup(Request $request, UserService $service, AuthenticationUtils $authenticationUtils): Response
    {
        $user = (new User())->setEmail($authenticationUtils->getLastUsername());
        $form = $this->createForm(SignupType::class, $user, [])->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $service->createUserAndLogin($user);

            return $this->redirectToRoute('home');
        }

        return $this->render('security/signup.html.twig', ['form' => $form]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): never
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
