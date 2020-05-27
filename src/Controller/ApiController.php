<?php

namespace App\Controller;

use App\Service\HotelService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @var HotelService
     */
    protected $hotelService;

    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    /**
     * @Route("/api/average", name="average")
     */
    public function getAverage(Request $request)
    {
        $hotelId = $request->get('hotelId');

        if ($hotelId === null) {
            throw new \Exception('Hotel not found.');
        }

        $averageScore = $this->hotelService->getHotelScore($hotelId);

        return new Response($averageScore);
    }

    /**
     * @Route("/api/reviews", name="review_list")
     */
    public function getReviews(Request $request)
    {
        $hotelId = $request->get('hotelId');

        $reviews = $this->hotelService->getReviews($hotelId);

        return new Response(json_encode($reviews));
    }

    /**
     * @Route("/api/hotels", name="hotel_list")
     */
    public function getHotels(Request $request)
    {
        $hotels = $this->hotelService->getHotels();

        return new Response(json_encode($hotels));
    }
}
