<?php

namespace App\Controller;
use App\Entity\Order;
use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\OrderRepository;
use League\Csv\Writer;


class OrderController extends AbstractController
{
    private $httpClient;
    private $entityManager;


    public function __construct(HttpClientInterface $httpClient, EntityManagerInterface $entityManager)
    {
        $this->httpClient = $httpClient;
        $this->entityManager = $entityManager;
    }

    #[Route('/order', name: 'app_order')]

    public function ordersList(): Response
    {
        // Ton code pour récupérer les données depuis l'API et décoder le JSON
        $apiUrl = 'https://internshipapi-pylfsebcoa-ew.a.run.app';
        $apiKey = 'PMAK-62642462da39cd50e9ab4ea7-815e244f4fdea2d2075d8966cac3b7f10b';

        $response = $this->httpClient->request('GET', $apiUrl . '/orders', [
            'headers' => [
                'x-api-key' => $apiKey,
            ],
        ]);

        $data = $response->toArray();

        // Passe les données à la vue Twig
        return $this->render('order/index.html.twig', [
            'results' => $data['results'],
        ]);
    }
    #[Route('/flow/orders_to_csv', name: 'app_orders_to_csv')]
    public function exportOrdersToCsv(OrderRepository $orderRepository): Response
    {
        // ...
        $orders = $orderRepository->findAll();

        $apiUrl = 'https://internshipapi-pylfsebcoa-ew.a.run.app';
        $apiKey = 'PMAK-62642462da39cd50e9ab4ea7-815e244f4fdea2d2075d8966cac3b7f10b';

        $response = $this->httpClient->request('GET', $apiUrl . '/orders', [
            'headers' => [
                'x-api-key' => $apiKey,
            ],
        ]);

        $data = $response->toArray();


        // Stocker les commandes en base de données
        foreach ($data['results'] as $orderData) {
            $order = new Order();
            $order->setOrderNumber($orderData['OrderNumber']);
            $order->setAmount($orderData['Amount']);
            $order->setCurrency($orderData['Currency']);
            $order->setDeliverTo($orderData['DeliverTo']);

            // Ajouter les articles associés à la commande
            foreach ($orderData['SalesOrderLines']['results'] as $articleData) {
                $article = new Article();
                $article->setDescription($articleData['Description']);
                //$article->setQuantity($articleData['Quantity']);
                // Ajouter d'autres attributs d'article si nécessaire

                $order->addSalesOrderLine($article);

                // À implémenter en utilisant les données des commandes
                // Vous pouvez accéder aux données de l'article ici et effectuer les opérations nécessaires

                // Exemple :
                // $article->setUnitPrice($articleData['UnitPrice']);
                // $article->setVATAmount($articleData['VATAmount']);
                // $article->setVATPercentage($articleData['VATPercentage']);

                // Enregistrer l'article en base de données
// Enregistrer l'article en base de données
                $this->entityManager->persist($article);
            }

            // Enregistrer l'ordre en base de données
            $this->entityManager->persist($order);
        }

        // Exécuter les opérations d'enregistrement
        $this->entityManager->flush();

        // ...

        // Répondre avec le fichier CSV
        // ...

        return new Response('Le fichier CSV a été généré et téléchargé avec succès.');

    }
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }

}
