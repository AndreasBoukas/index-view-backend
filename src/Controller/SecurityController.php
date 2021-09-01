<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{

    public function register(Request $request, UserPasswordHasherInterface $encoder)
    {
        //registers a user in the database and encodes the password.
        $em = $this->getDoctrine()->getManager();

        $username = $request->request->get('_username');
        $password = $request->request->get('_password');
        if ($username === "" || $password === "") {
            return new JsonResponse(sprintf('Invalid inputs passed , please check your data. '), 422);
        }
        $user = new User();
        $user->setUsername($username);
        $user->setPassword($encoder->hashPassword($user, $password));

        $em->persist($user);
        $em->flush();

        return new JsonResponse(sprintf('User %s successfully created', $user->getUserIdentifier()));
    }

    //The user log in is handled by the jwt auth package. Check securiy.yaml and lexik_jwt_authentication.yaml and routes.yaml
    }

