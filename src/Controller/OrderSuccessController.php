<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderSuccessController extends AbstractController
{

   private $entityManager;

   public function __construct(EntityManagerInterface $em)
   {
       $this->entityManager = $em;
   }
    /**
     * @Route("/commande/merci/{stripeSessionId}", name="order_success")
     */
    public function index($stripeSessionId, Cart $cart): Response
    {
       $order = $this->entityManager->getRepository(Order::class)->findOneByStripeSessionId($stripeSessionId);

       if(!$order || $order->getUser() != $this->getuser()){
           return $this->redirectToRoute('home');
       }



       if(!$order->getIsPaid()){
           // vider la session "cart"
           $cart->remove();

           // modifier le statut isPaid à true
           $order->setIsPaid(true);
           $this->entityManager->flush();
    }


        //Envoyer un email à notre client pour lui confirmer sa commande
        //Afficher les quelques informations de la commade de l'utilisateur

        return $this->render('order_success/index.html.twig',[
            'order'=>$order
        ]);
    }
}
