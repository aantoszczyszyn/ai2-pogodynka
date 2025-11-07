<?php

namespace App\Controller;


use App\Entity\Location;
use App\Repository\LocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class WeatherController extends AbstractController
{
    //po id
    /*#[Route('/weather/{id}', name: 'app_weather_show')]
    public function show(LocationRepository $locationRepository, int $id): Response
    {
        $location = $locationRepository->find($id);

        if (!$location) {
            throw $this->createNotFoundException('Nie znaleziono lokalizacji o ID ' . $id);
        }

        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'measurements' => $location->getMeasurements()
        ]);
    }*/

    // po nazwie miasta.
    #[Route('/weather/{city}', name: 'app_weather_show')]
    public function show(LocationRepository $locationRepository, string $city): Response
    {
        $location = $locationRepository->findOneBy(['city' => $city]);

        if (!$location) {
            throw $this->createNotFoundException('Nie znaleziono lokalizacji o nazwie ' . $city);
        }

        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'measurements' => $location->getMeasurements(),
        ]);
    }

}
