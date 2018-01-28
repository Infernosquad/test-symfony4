<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Serializer\SerializerInterface;

class ProductController extends Controller
{
    /**
     * @Route("/products", name="product_list")
     * @Method({"GET"})
     */
    public function index(Request $request,SerializerInterface $serializer)
    {
        $parameters = [
            'limit'  => $request->query->get('limit'),
            'offset' => $request->query->get('offset'),
        ];

        $products = $this->getDoctrine()
             ->getRepository(Product::class)
             ->findProducts($parameters);

        return new Response($serializer->serialize($products,'json'),200,[
            'Content-Type' => 'application/json'
        ]);
    }

    /**
     * @Route("/product", name="product_create")
     * @Method({"POST"})
     */
    public function create(Request $request,SerializerInterface $serializer)
    {
        $form = $this->createForm(ProductType::class,new Product());

        $form->submit(json_decode($request->getContent(), true));

        if($form->isValid()){
            $em      = $this->getDoctrine()->getManager();
            $product = $form->getData();

            $em->persist($product);
            $em->flush();

            return new Response($serializer->serialize($product,'json'),201,[
                'Content-Type' => 'application/json'
            ]);
        }

        throw new HttpException(400);
    }
}
