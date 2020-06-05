<?php

namespace App\Controller;

use App\Service\HotelService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HotelController extends AbstractController
{
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

        $averageScore = $this->hotelService->getHotelScore($hotelId);

        if ($averageScore === null) {
            throw new \Exception('Hotel score not found.');
        }

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

    /**
     * @Route("widget/{uuid}.js", name="score_widget")
     */
    public function getWidget(string $uuid)
    {
        $averageScore = $this->hotelService->getHotelScore($uuid);

        if ($averageScore === null) {
            throw new \Exception('Hotel score not found.');
        }

        $renderedView =  $this->renderView(
            'hotel/show_score.html.twig',
            ['score' => $averageScore]
        );

        $response = new Response($renderedView);
        $response->headers->set('Content-Type', 'text/javascript');

        return $response;
    }

    /**
     * @Route("widget-test/{uuid}.js", name="score_widget_test")
     */
    public function getWidgetTest(string $uuid)
    {
        $averageScore = $this->hotelService->getHotelScore($uuid);

        if ($averageScore === null) {
            throw new \Exception('Hotel score not found.');
        }

        $renderedView =  $this->renderView(
            'base.html.twig',
            ['score' => $averageScore]
        );

        $response = new Response($renderedView);

        return $response;
    }
}
