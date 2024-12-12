<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\Product1Type;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\StockMovement;
use App\Form\StockMovementType;
use App\Respository\StockMovementRespository;

#[Route('/product')]
final class ProductController extends AbstractController
{
    #[Route(name: 'app_product_index', methods: ['GET'])]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_product_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $product = new Product();
        $form = $this->createForm(Product1Type::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_product_show', methods: ['GET'])]
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_product_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Product $product, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Product1Type::class, $product);
        $form->handleRequest($request);
    
        // Sauvegarde de la quantité initiale avant modification
        $initialQuantity = $product->getQuantity();
        $stockMovementInserted = false; // Flag pour savoir si l'insert dans StockMovement a réussi
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Vérification de la différence de quantité
            $newQuantity = $product->getQuantity();
            $quantityDifference = $newQuantity - $initialQuantity;
    
            // Si la quantité a changé, créer un StockMovement
            if ($quantityDifference !== 0) {
                $stockMovement = new StockMovement();
                $stockMovement->setProduct($product);
                $stockMovement->setQuantity(abs($quantityDifference));
                $stockMovement->setMovementType($quantityDifference > 0 ? 'entry' : 'exit');
                $stockMovement->setDate(new \DateTimeImmutable()); // Date actuelle
                $stockMovement->setReason('Quantity updated due to product edit');
                
                try {
                    // Persister le mouvement de stock
                    $entityManager->persist($stockMovement);
                    $entityManager->flush();
    
                    $stockMovementInserted = true; // L'insert a réussi
    
                } catch (\Exception $e) {
                    // En cas d'erreur lors de l'insertion du StockMovement
                    $this->addFlash('error', 'An error occurred while inserting the stock movement.');
                }
            }
    
            try {
                // Enregistrer les modifications du produit
                $entityManager->flush();
    
                // Flash message de succès
                $this->addFlash('success', 'Product updated successfully.');
    
                // Si l'insertion dans StockMovement a réussi
                if ($stockMovementInserted) {
                    $this->addFlash('success', 'Stock movement recorded successfully.');
                }
    
            } catch (\Exception $e) {
                // En cas d'erreur
                $this->addFlash('error', 'An error occurred while updating the product.');
            }
    
            return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }
    
    
    
    #[Route('/{id}', name: 'app_product_delete', methods: ['POST'])]
    public function delete(Request $request, Product $product, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
    }
}
