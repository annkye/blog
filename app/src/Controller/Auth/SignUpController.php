<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use App\Model\User\UseCase\SignUp;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SignUpController extends AbstractController
{
    /**
     * @Route("/signup", name="auth.signup")
     * @param Request $request
     * @param SignUp\Request\Handler $handler
     * @return Response
     */
    public function request(Request $request, SignUp\Request\Handler $handler): Response
    {
        $command = new SignUp\Request\Command();

        $form = $this->createForm(SignUp\Request\Form::class, $command);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $handler->handle($command);
                $this->addFlash('success', 'Проверьте вашу электронную почту.');
                return $this->redirectToRoute('app');
            } catch (\DomainException $e) {
                $this->addFlash('error', $e->getMessage());
            }
        }

        return $this->render('app/auth/signup.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
