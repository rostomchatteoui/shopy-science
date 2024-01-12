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
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;



class OrderController extends AbstractController
{
    private $httpClient;
    private $entityManager;


    public function __construct(HttpClientInterface $httpClient, EntityManagerInterface $entityManager)
    {
        $this->httpClient = $httpClient;
        $this->entityManager = $entityManager;
    }


    #[Route('/orders', name: 'app_order')]


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
    public function exportOrdersToCsv(OrderRepository $orderRepository, EntityManagerInterface $entityManager): Response
    {
        // Step 1: Retrieve new orders from the API
        $apiUrl = 'https://internshipapi-pylfsebcoa-ew.a.run.app';
        $apiKey = 'PMAK-62642462da39cd50e9ab4ea7-815e244f4fdea2d2075d8966cac3b7f10b';

        $response = $this->httpClient->request('GET', $apiUrl . '/orders', [
            'headers' => [
                'x-api-key' => $apiKey,
            ],
        ]);

        $newOrders = $response->toArray()['results'];

        // Step 2: Store new orders in the database
        foreach ($newOrders as $newOrderData) {
            $order = new Order();
            $order->setOrderNumber($newOrderData['OrderNumber']);
            $order->setAmount($newOrderData['Amount']);
            $order->setCurrency($newOrderData['Currency']);
            $order->setDeliverTo($newOrderData['DeliverTo']);

            foreach ($newOrderData['SalesOrderLines']['results'] as $articleData) {
                $article = new Article();
                $article->setDescription($articleData['Description']);
                $article->setQuantity($articleData['Quantity']);
                $article->setUnitPrice($articleData['UnitPrice']);

                // Assume you have a bidirectional relationship between Order and Article
                $order->addSalesOrderLine($article);

                // Persist the article (if needed)
                $entityManager->persist($article);
            }

            // Persist the order
            $entityManager->persist($order);
        }

        // Flush changes to the database
        $entityManager->flush();

        // Step 3: Generate and return a CSV response
        $csvWriter = Writer::createFromString('');
        $csvWriter->insertOne(['OrderNumber', 'Amount', 'Currency', 'DeliverTo', 'Description', 'Quantity', 'UnitPrice']);

        foreach ($newOrders as $newOrderData) {
            foreach ($newOrderData['SalesOrderLines']['results'] as $articleData) {
                $csvWriter->insertOne([
                    $newOrderData['OrderNumber'],
                    $newOrderData['Amount'],
                    $newOrderData['Currency'],
                    $newOrderData['DeliverTo'],
                    $articleData['Description'],
                    $articleData['Quantity'],
                    $articleData['UnitPrice'],
                ]);
            }
        }

        $response = new Response($csvWriter->toString());
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="export.csv"');

        return $response;
    }


    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }
}
