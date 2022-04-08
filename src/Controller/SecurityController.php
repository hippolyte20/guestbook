<?php
namespace App\Controller;

use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface; // Soumission et persistence des donnéés du formulaire
use App\Entity\User;
use App\Form\BookFormType;
use App\Form\EditProfileType;
use Twig\Environment;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;




use App\Form\UsertFormType;
use App\Repository\CommandeRepository;
use App\Repository\BookRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class SecurityController extends AbstractController
{
    private $entityManager;

    /**
     * @Route("/connexion", name="security_login")
    */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
         $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
         $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }
    /**
     * @Route("/sucess", name="after_login_success")
     */
    public function after(): Response
    {
        
        return $this->render('security/after_login.html.twig');
    }

    /**
     * @Route("/sucess/dem", name="auto_dem")
     */
    public function order(Request $request): Response
    {
        $trip = new Book();
        //$user = new User();
        $form = $this->createForm(BookFormType::class, $trip);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $data = $form->getData();
            $distance = $this->calculdistance($form->get('lat')->getData(),$form->get('lng')->getData(),$form->get('lat2')->getData(),$form->get('lng2')->getData()  );
            if(($form->get('transmean')->getData()) == 'moto')
            {
                $distance = $distance * 150;
                $trip->setPrice($distance);
              
            }
            else
            {
                $distance = $distance * 200;
                $trip->setPrice($distance);
            }
            $trip->setUsere($this->getUser());
            

            //$trip->setTripid($user);

            $this->entityManager->persist($trip);
            $this->entityManager->flush();
            return $this->redirectToRoute('personal');
        }

        return $this->renderForm('security/demande.html.twig', [
            'form' => $form,
        ]); 
    }

    

    /**
     * @Route("/profiles/{id}", name="personals")
     */
    public function profil(UserRepository $productRepository, int $id): Response
    {
        
        $use = $productRepository->find($id);
        $categoryName = $use->getBooks();

        //$user = $trip->getUsere();
        return $this->render('security/profile.html.twig', [
            'commandes' => $categoryName
        ]);

    }
    /**

     * @Route("/profile", name="personal")
     */
    public function profile(): RedirectResponse
    {
        $user = $this->getUser();
        
        return $this->redirectToRoute('personals',
            ['id' => $this->getUser()->getId()]
        );

   }

    private function calculdistance(float $lat, float $lng, float $lat2, float $lng2)
    {
       $theta = $lng - $lng2;
       $mile = sin(deg2rad($lat)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
       $mile = acos($mile);
       $mile = rad2deg($mile);
       $resultat = $mile*60*1.1515;
       return $resultat;
       
    }

    public function __construct(Environment $twig, EntityManagerInterface $entityManager) 
     {
         $this->twig = $twig;
         $this->entityManager = $entityManager;
     }

    #[Route('/inscription', name: 'security_registration')]
    public function new(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        
        $user = new User();
        // ...

        $form = $this->createForm(UsertFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return $this->redirectToRoute('security_login');
        }
        return $this->renderForm('security/firstlog.html.twig', [
            'form' => $form,
        ]);
    }
    /**
     * @Route("/", name="racine_du_site")
     */
    public function main()
    {
        return $this->render('security/homes.html.twig');
    }
    /**
     * @Route("/logout", name="security_logout")
    */
    public function logout():RedirectResponse
    {
        return $this->redirectToRoute('racine_du_site');

        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}
