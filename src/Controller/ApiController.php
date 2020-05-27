<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/average", name="average")
     */
    public function getAverage(Request $request)
    {
        $hotelId = $request->get('hotelId');

        if ($hotelId === null) {
            throw new \Exception('Hotel not found.');
        }

        $em = $this->getDoctrine();
        $average = $em->getConnection()->executeQuery('SELECT avg(score) as score FROM review WHERE hotel_id = '.$hotelId)->fetch(\PDO::FETCH_ASSOC);

        return new Response($average['score']);
    }

    /**
     * @Route("/api/reviews", name="review_list")
     */
    public function getReviews(Request $request)
    {
        $hotelId = $request->get('hotelId');

        $em = $this->getDoctrine();
        if ($hotelId === null) {
            $reviews = $em->getConnection()->executeQuery('SELECT * FROM review')->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            $reviews = $em->getConnection()->executeQuery('SELECT * FROM review WHERE hotel_id = ' . $hotelId)->fetchAll(\PDO::FETCH_ASSOC);
        }

        return new Response(json_encode($reviews));
    }

    /**
     * @Route("/api/hotels", name="hotel_list")
     */
    public function getHotels(Request $request)
    {
        $em = $this->getDoctrine();
        $hotels = $em->getConnection()->executeQuery('SELECT * FROM hotel')->fetchAll(\PDO::FETCH_ASSOC);

        return new Response(json_encode($hotels));
    }
}
