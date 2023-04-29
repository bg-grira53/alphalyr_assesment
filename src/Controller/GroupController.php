<?php
namespace App\Controller;

use App\Entity\Group;
use App\Repository\GroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GroupController extends AbstractController
{
  
    private $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
     
        $this->groupRepository = $groupRepository;
    }

    /**
     * @Route("/groups", methods={"GET"})
     */
    public function index(): Response
    {
        $groups = $this->groupRepository->findAll();

        $data = [];

        foreach ($groups as $group) {
            $data[] = [
                'id' => $group->getId(),
       
                'name' => $group->getName(),
               
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);

    }

    /**
     * @Route("/groups", methods={"POST"})
     */
    public function create(Request $request): Response
    {
        $name = $request->request->get('name');

        $group = new Group();
        $group->setName($name);

        try{
            $this->groupRepository->create($group) ;
            return new JsonResponse(['status' => 'Group created!']);
        }catch (\Exception $e) { 
           
            return new JsonResponse(['status' => 'Error creating a group: ' . $e->getMessage()], 500);

        }
      

       
    }

    /**
     * @Route("/groups/{id}", methods={"GET"})
     */
    public function show(int $id): Response
    {
        $group = $this->groupRepository->find($id);

        if (!$group) {
            return new JsonResponse(['error' => 'Group not found'], 404);
        }

        return new JsonResponse(array("id" => $group->getId() , "name" => $group->getName()));
    }

    /**
     * @Route("/groups/{id}", methods={"PUT"})
     */
    public function update(Request $request, int $id): Response
    {
        $data = json_decode($request->getContent(), true);
        $group = $this->groupRepository->find($id);

        if (!$group) {
            return new JsonResponse(['error' => 'Group not found'], 404);
        }
        if(isset($data['name'])) {
            $group->setName($data['name']);

        }

         try {

            $this->groupRepository->update($group);    

            return new JsonResponse(['status' => 'Group updated!']);
         }catch(\Exception $e) {
            return new JsonResponse(['status' => 'Error updating a group: ' . $e->getMessage()], 500);

         }
       
    }
}
