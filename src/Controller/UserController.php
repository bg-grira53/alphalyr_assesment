<?php
namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\GroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class UserController extends AbstractController
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/users/", methods={"GET"})
     */
    public function list(): JsonResponse
    {
        $users = $this->userRepository->findAll();
        $data = [];

        foreach ($users as $user) {
            $data[] = [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'group' => [
                    'id' => $user->getGroup()->getId(),
                    'name' => $user->getGroup()->getName(),
                ],
                'actif' => $user->isActif(),
                'dateCreation' => $user->getDateCreation()->format('Y-m-d H:i:s'),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }


        /**
     * @Route("/users/", methods={"POST"})
     */
    public function create(Request $request , GroupRepository $groupRepo )
    {
        $data = json_decode($request->getContent(), true);

      

        try {
            $user = new User();
            $user->setEmail($data['email']);
            $user->setNom($data['nom']);
            $user->setPrenom($data['prenom']);
            $user->setActif($data['actif']);          
            $user->setDateCreation(new \DateTime());
            $group = $groupRepo->find($data['group']['id']);
            $user->setGroup($group);    
            $this->userRepository->create($user) ;    
            return new JsonResponse(['message' => 'User created!', 'user_id' => $user->getId()]);

        }catch(\Exception $e) {
            return new JsonResponse(['status' => 'Error creating a user: ' . $e->getMessage()], 500);

         }

      
    }



    /**
     * @Route("/users/{id}", methods={"GET"})
     */
    public function getOne(int $id): Response
    {
        $user = $this->userRepository->find($id);

        if (!$user) {
            return new JsonResponse(['error' => 'Group not found'], 404);
        }

        return new JsonResponse(array(
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'nom' => $user->getNom(),
            'prenom' => $user->getPrenom(),
            'group' => [
                'id' => $user->getGroup()->getId(),
                'name' => $user->getGroup()->getName(),
            ],
            'actif' => $user->isActif(),
            'dateCreation' => $user->getDateCreation()->format('Y-m-d H:i:s'),
        ));
    }

    /**
     * @Route("/users/{id}", methods={"PUT"})
     */
    public function update(Request $request, int $id , GroupRepository $groupRepo): Response
    {
        $data = json_decode($request->getContent(), true);
        $user = $this->userRepository->find($id);

        if (!$user) {
            return new JsonResponse(['error' => 'Group not found'], 404);
        }
       
        if (isset($data['email'])) {
            $user->setEmail($data['email']);
        }
        if (isset($data['nom'])) {
            $user->setNom($data['nom']);
        }
        if (isset($data['prenom'])) {
            $user->setPrenom($data['prenom']);
        }
        if (isset($data['actif'])) {
            $user->setActif($data['actif']);
        }
        if (isset($data['group'])) {
            $group = $groupRepo->find($data['group']['id']);
            if (!$group) {
                return new JsonResponse(['error' => 'Group not found.'], Response::HTTP_NOT_FOUND);
            }
            $user->setGroup($group);
        }

         try {

            $this->userRepository->update($user);    

            return new JsonResponse(['status' => 'User updated!']);
         }catch(\Exception $e) {
            return new JsonResponse(['status' => 'Error updating a user: ' . $e->getMessage()], 500);

         }
       
    }
}