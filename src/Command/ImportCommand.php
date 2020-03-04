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
      $reader = Reader::createFromPath('%kernel.root_dir%/../public/standars_data_pl.csv');    
      $reader->setDelimiter(';') ;
      $results = $reader->fetchAssoc();
      //echo "im here";

      foreach ($results as $row) {
         //    $intToVerif = 0;
         // dump($row) ;

         $verify = $this->em->getRepository(Player::class)
            ->findOneBy([
               'idPlayer' => $row['id']
            ]);

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
               ->setNonPenGoalsAssistsExpPerMin(floatval($row['npxG_xA']));
            $this->em->persist($player);
         }





         $this->em->flush();
      }




      $io->success('importation avec succés');
   }
}
