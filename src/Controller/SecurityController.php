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

class   SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route('/signup', name: 'app_signup')]
    public function signup(Request $request, UserService $service): Response
    {
        $user = (new User())->setEmail($service->getLastUsername());
        $form = $this->createForm(SignupType::class, $user, [])->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $service->createUserAndLogin($user, $request);
        }

        return $this->renderForm('security/signup.html.twig', ['form' => $form]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
