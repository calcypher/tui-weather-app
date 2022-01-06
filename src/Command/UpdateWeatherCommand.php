<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;

use App\Service\WeatherService;

class UpdateWeatherCommand extends Command
{
	private $generalInfoService;

	/*public function __construct(GeneralInfoService $generalInfoService) {
		$this->generalInfoService = $generalInfoService;
		parent::__construct();
	}*/
	
	// This is just a normal Command::configure() method
	protected function configure(){
		$this->setName('tui:update-weather')
			 ->setDescription('Aggiornamento Meteo');
	}

	// Execute will be called in a endless loop
	protected function execute(InputInterface $input, OutputInterface $output) : int {
		$now = new \DateTime();
		//$this->generalInfoService->getSiteTranslations();
		//$output->writeln($now->format('Y-m-d H:i:s') . ' updated translations for '. $_SERVER['SERVER_NAME']);
		//sleep(12 * 60 * 60);
		
		$weatherService = new WeatherService();
		
		$cities = $weatherService->getCities();
		
		//$output->writeln(print_r($cities, 1));
		
		foreach ($cities as $city)
		{
		    //getWeather
		    //print weather;
		    $weather = $weatherService->getWeather($city['latitude'], $city['longitude'], 2);
		    //$output->writeln(print_r($weather, 1));
		    $output->writeln($now->format('Y-m-d H:i:s') . ' Processed city '.$city['name'].' | '.$weather['forecast']['forecastday'][0]['day']['condition']['text'].' - '.$weather['forecast']['forecastday'][1]['day']['condition']['text'] );
		}
		
		return 1;
	}
}