<?php

namespace App\Src\Command;

use App\Entity\Player;
use Symfony\Component\Console\Command\Command;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use League\Csv\Reader;

class importCommand extends Command
{
   public function __construct(EntityManagerInterface $em)
   {
      parent::__construct();
      $this->em = $em;
   }

   protected function configure()
   {
      $this->setName('csv:import')
         ->setDescription('importation data');
   }

   protected function execute(InputInterface $input, OutputInterface $output)
   {

      $io = new SymfonyStyle($input, $output);
      //  $client = HttpClient::create();
      //  $response = $client->request('GET', 'https://fantasy.premierleague.com/api/bootstrap-static/');
      //  $content = $response->getContent();
      //  $content = $response->toArray();
      $io->title('import en progression...');
      $readerOfStandarsData = Reader::createFromPath('%kernel.root_dir%/../public/standars_data_pl.csv');   
      $readerOfPassingData = Reader::createFromPath('%kernel.root_dir%/../public/passing_data_pl.csv');  
      $readerOfShootingData = Reader::createFromPath('%kernel.root_dir%/../public/shooting_data_pl.csv'); 
      $readerOfTimmingData = Reader::createFromPath('%kernel.root_dir%/../public/timming_data_pl.csv');  

      $readerOfStandarsData->setDelimiter(';') ;
      $readerOfPassingData->setDelimiter(';') ;
      $readerOfShootingData->setDelimiter(';') ;
      $readerOfTimmingData->setDelimiter(';') ;

      $standars = $readerOfStandarsData->fetchAssoc();
      $passing = $readerOfPassingData->fetchAssoc();
      $shooting = $readerOfShootingData->fetchAssoc();
      $timming = $readerOfTimmingData->fetchAssoc();
      //echo "im here";
      $passing = iterator_to_array($passing, false);
      $shooting = iterator_to_array($shooting, false);
      $timming = iterator_to_array($timming, false);
      foreach ($standars as $index => $row) {
     
         $verify = $this->em->getRepository(Player::class)
            ->findOneBy([
               'idPlayer' => $row['id']
            ]);
      // echo $shooting[$index]['Sh'];
         if (empty($verify)) {
            $player = (new player())
               ->setIdPlayer($row['id'])
               ->setName($row['name'])
               ->setNation($row['nation'])
               ->setPosition($row['position'])
               ->setSquad($row['team'])
               ->setAge(intval($row['age']))
               ->setBorn(intval($row['born']))
               ->setMatchsPlayed(intval($row['MP']))
               ->setMatchStarts(intval($row['Starts']))
               ->setMinsPlayed(intval($row['Min']))
               ->setGoals(intval($row['Gls']))
               ->setAssits(intval($row['Ast']))
               ->setPkMade(intval($row['PK']))
               ->setPkAttempted(intval($row['PKatt']))
               ->setYellowCard(intval($row['CrdY']))
               ->setRedCard(intval($row['CrdR']))
               ->setGoalsPerMin(floatval($row['Gls_per_match']))
               ->setAssistsPerMin(floatval($row['Ast_per_match']))
               ->setGlsAssPerMin(floatval($row['G_A_per_match']))
               ->setGoalsWithoutPkPerMin(floatval($row['G_PK_per_match']))
               ->setGlsAssWithoutPkPerMin(floatval($row['G_A_PK_per_match']))
               ->setGoalsExp(floatval($row['xG']))
               ->setNonPenGoalsExp(floatval($row['npxG']))
               ->setAssistsExp(floatval($row['xA']))
               ->setGoalsPerMinExp(floatval($row['xG_per_match']))
               ->setAssistsPerMinExp(floatval($row['xA_per_match']))
               ->setGlsAssistsPerMinExp(floatval($row['xG_xA']))
               ->setNonPenGoalsExpPerMin(floatval($row['npxG_per_match']))
               ->setNonPenGoalsAssistsExpPerMin(floatval($row['npxG_xA']))

               ->setShoots(intval($shooting[$index]['Sh']))
               ->setShootsOnTarget(intval($shooting[$index]['SoT']))
               ->setShootsFromFrKc(intval($shooting[$index]['FK']))
               ->setShootsOnTargetPc(floatval($shooting[$index]['SoT%']))
               ->setShootsPerMatch(floatval($shooting[$index]['Sh/90']))
               ->setShootsOnTargetPerMatch(floatval($shooting[$index]['SoT/90']))
               ->setGoalsPerShoot(floatval($shooting[$index]['G/Sh']))
               ->setGoalPerShootOnTarget(floatval($shooting[$index]['G/SoT']))
               
               ->setKeyPasses(intval($passing[$index]['KP']))
               ->setPassesCompleted(intval($passing[$index]['Cmp']))
               ->setPassesAttempted(intval($passing[$index]['Att']))
               ->setPassCompPercent(floatval($passing[$index]['CmpPER']))
               ->setShortPassesCompleted(intval($passing[$index]['shortCmp']))
               ->setShortpassesAttempted(intval($passing[$index]['shortAtt']))
               ->setShortPassesCompPercent(floatval($passing[$index]['shortCmpPER']))
               ->setMediumPassesCompleted(intval($passing[$index]['mediumCmp']))
               ->setMediumPassesAttempted(intval($passing[$index]['mediumAtt']))
               ->setMediumPassesCompPercent(floatval($passing[$index]['mediumCmpPER']))
               ->setLongPassCompleted(intval($passing[$index]['longCmp']))
               ->setLongPassesAttempted(intval($passing[$index]['longAtt']))
               ->setLongPassesCompPercent(floatval($passing[$index]['longCmpPER']))
               ->setPassCompletedFinalThird(intval($passing[$index]['1/3']))
               ->setPassCompletedPenaltyArea(intval($passing[$index]['PPA']))
               ->setCrossIntoPenaltyArea(floatval($passing[$index]['CrsPA']))

               ->setMinutesPlayed(intval($timming[$index]['Min']))
               ->setMinutesPercentPlayed(floatval($timming[$index]['Min%']))
               ->setNintyMinPlayed(floatval($timming[$index]['90s']))
               ->setMinPerMatchStarted(floatval($timming[$index]['Mn/Start']))
               ->setPointsPerMatch(floatval($timming[$index]['PPM']));
            $this->em->persist($player);
         }





         $this->em->flush();
      }




      $io->success('importation avec succés');
   }
}
