<?php

namespace App\Command;

use App\Service\WeatherService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * this Command permits to update Weather Forecast for all Musement Cities.
 */
class UpdateWeatherCommand extends Command
{
    /**
     * Configuration for Weather Command.
     *
     * @return void
     *
     * {@inheritDoc}
     *
     * @see \Symfony\Component\Console\Command\Command::configure()
     */
    protected function configure()
    {
        $this->setName('tui:update-weather')
             ->setDescription('Update Weather Forecast');
    }

    /**
     * get all Musement Cities and update Weather Forecast for each Cities
     * 
     * @return int
     * 
     * {@inheritDoc}
     *
     * @see \Symfony\Component\Console\Command\Command::execute()
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $weatherService = new WeatherService();
        $cities = $weatherService->getCities();

        foreach ($cities as $city) {
            
            $now = new \DateTime();
            
            $forecast = $now->format('Y-m-d H:i:s').' Processed city '.$city->getName().' | ';
            
            $weathers = $weatherService->getWeather($city->getLatitude(), $city->getLongitude(), 2);
            $forecast .= $weathers[0]->getCondition().' - '.$weathers[1]->getCondition();
            
            $output->writeln($forecast);
        }

        return 1;
    }
}
