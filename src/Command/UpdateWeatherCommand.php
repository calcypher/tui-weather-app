<?php

namespace App\Command;

use App\Service\WeatherService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * 
 * this Command permits to update Weather Forecast for all Musement Cities
 *
 */
class UpdateWeatherCommand extends Command
{

    /**
     * Configuration for Weather Command
     * 
     * {@inheritDoc}
     * @see \Symfony\Component\Console\Command\Command::configure()
     */
    protected function configure()
    {
        $this->setName('tui:update-weather')
             ->setDescription('Update Weather Forecast');
    }

    /**
     * get all Musement Cities and update Weather Forecast for each Cities
     * {@inheritDoc}
     * @see \Symfony\Component\Console\Command\Command::execute()
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $weatherService = new WeatherService();
        $cities = $weatherService->getCities();

        foreach ($cities as $city) {
            $weather = $weatherService->getWeather($city['latitude'], $city['longitude'], 2);
            $now = new \DateTime();
            $output->writeln($now->format('Y-m-d H:i:s').' Processed city '.$city['name'].' | '.$weather['forecast']['forecastday'][0]['day']['condition']['text'].' - '.$weather['forecast']['forecastday'][1]['day']['condition']['text']);
        }

        return 1;
    }
}
