<?php

namespace App\Src\Command;

use App\Entity\Player;
use App\Entity\Team;
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
   
   public function importTeams(array $array, array $arrayBeta, string $league): void
   {
      if (!empty($array) and !empty($arrayBeta)) {
         $count = count($array);

         foreach ($array as $fakeIndex => $teams) {
            $squad = "";
            if ($league == 'CL' || $league == 'EL') $squad = explode(' ', $teams['Squad'], 2)[1];
            else $squad = $teams['Squad'];

            $verify = $this->em->getRepository(Team::class)
               ->findOneBy([
                  'nameTeam' => $squad
               ]);

            if (!$verify) {

               $team = (new Team())
                  ->setNameTeam($squad)
                  ->setLeague($league)
                  ->setLevel("")
                  ->setMatchPlayed($teams['MP'])
                  ->setGoals($teams['Gls'])
                  ->setAssists($teams['Ast'])
                  ->setGoalsAgainst($arrayBeta[$fakeIndex]['GA'])
                  ->setGoalsAgainstPerMatch($arrayBeta[$fakeIndex]['GA90'])
                  ->setSaves($arrayBeta[$fakeIndex]['Saves'])
                  ->setShootOnTargetAgainst($arrayBeta[$fakeIndex]['SoTA'])
                  ->setSavePercent($arrayBeta[$fakeIndex]['Save%'])
                  ->setCleanSheets($arrayBeta[$fakeIndex]['CS'])
                  ->setCleanSheetPercent($arrayBeta[$fakeIndex]['CS%'])
                  ->setPenaltyKickAllowed($arrayBeta[$fakeIndex]['PKA'])
                  ->setPenaltyKicksSaved($arrayBeta[$fakeIndex]['PKsv'])
                  ->setGoalPerMatch($teams['GlsPerM'])
                  ->setTopTeamScoorer("")
                  ->setGoalKeeper("");

               $this->em->persist($team);
            } else {
               if (!strpos($verify->getLeague(), $league)) $leagueString = $verify->getLeague() . '+' . $league;
               $verify
                  ->setLeague($leagueString)
                  ->setLevel("")
                  ->setMatchPlayed($verify->getMatchPlayed() + $teams['MP'])
                  ->setGoals($verify->getGoals() + $teams['Gls'])
                  ->setAssists($verify->getAssists() + $teams['Ast'])
                  ->setGoalsAgainst($verify->getGoalsAgainst() + $arrayBeta[$fakeIndex]['GA'])
                  ->setGoalsAgainstPerMatch($arrayBeta[$fakeIndex]['GA90'])
                  ->setSaves($verify->getSaves() + $arrayBeta[$fakeIndex]['Saves'])
                  ->setShootOnTargetAgainst($verify->getShootOnTargetAgainst() + $arrayBeta[$fakeIndex]['SoTA'])
                  ->setSavePercent(($verify->getSavePercent() + $arrayBeta[$fakeIndex]['Save%']) / 2)
                  ->setCleanSheets($verify->getCleanSheets() + $arrayBeta[$fakeIndex]['CS'])
                  ->setCleanSheetPercent(($verify->getCleanSheetPercent() + $arrayBeta[$fakeIndex]['CS%']) / 2)
                  ->setPenaltyKickAllowed($verify->getPenaltyKickAllowed() + $arrayBeta[$fakeIndex]['PKA'])
                  ->setPenaltyKicksSaved($verify->getPenaltyKicksSaved() + $arrayBeta[$fakeIndex]['PKsv'])
                  ->setTopTeamScoorer("")
                  ->setGoalKeeper("");
               $this->em->persist($verify);
            }
         }
         $this->em->flush();
      }
   }

   public function import(String $dir)
   {


      $readerOfStandarsData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/standars_data.csv');
      $readerOfStandarsTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/standars_team_data.csv');
      $readerOfPassingData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/passing_data.csv');
      $readerOfPassingTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/passing_team_data.csv');
      $readerOfShootingData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/shooting_data.csv');
      $readerOfShootingTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/shooting_team_data.csv');
      $readerOfTimmingData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/timming_data.csv');
      $readerOfTimmingTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/timming_team_data.csv');
      $readerOfMiscellaneousData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/miscellaneous_data.csv');
      $readerOfMiscellaneousTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/miscellaneous_team_data.csv');
      
      $readerOfStandarsData->setDelimiter(';');
      $readerOfStandarsTeamData->setDelimiter(';');
      $readerOfPassingData->setDelimiter(';');
      $readerOfPassingTeamData->setDelimiter(';');
      $readerOfShootingData->setDelimiter(';');
      $readerOfShootingTeamData->setDelimiter(';');
      $readerOfTimmingData->setDelimiter(';');
      $readerOfTimmingTeamData->setDelimiter(';');
      $readerOfMiscellaneousData->setDelimiter(';');
      $readerOfMiscellaneousTeamData->setDelimiter(';');
 


      $standars = $readerOfStandarsData->fetchAssoc();
      $passing = $readerOfPassingData->fetchAssoc();
      $shooting = $readerOfShootingData->fetchAssoc();
      $timming = $readerOfTimmingData->fetchAssoc();
      $miscellaneous = $readerOfMiscellaneousTeamData->fetchAssoc();
      $standarsTeams = $readerOfStandarsTeamData->fetchAssoc();
      $passingTeams = $readerOfPassingTeamData->fetchAssoc();
      $shootingTeams = $readerOfShootingTeamData->fetchAssoc();
      $timmingTeams = $readerOfTimmingTeamData->fetchAssoc();
      $miscellaneousTeams = $readerOfMiscellaneousData->fetchAssoc();

      // $permierLeagueTeams = $readerPermierLeagueTeams->fetchAssoc();
      // $permierLeagueTeamsOtherData = $readerPermierLeagueTeamsOtherData->fetchAssoc();

      $standars = iterator_to_array($standars, false);
      $passing = iterator_to_array($passing, false);
      $shooting = iterator_to_array($shooting, false);
      $timming = iterator_to_array($timming, false);
      $miscellaneous = iterator_to_array($miscellaneousTeams, false);
      $standarsTeams = iterator_to_array($standarsTeams, false);
      $passingTeams = iterator_to_array($passingTeams, false);
      $shootingTeams = iterator_to_array($shootingTeams, false);
      $timmingTeams = iterator_to_array($timmingTeams, false);
      $miscellaneousTeams = iterator_to_array($miscellaneousTeams, false);
      // $permierLeagueTeams = iterator_to_array($permierLeagueTeams, false);
      // $permierLeagueTeamsOtherData = iterator_to_array($permierLeagueTeamsOtherData, false);

      $comp = 0;


    //  $this->importTeams($permierLeagueTeams, $permierLeagueTeamsOtherData, $dir);


      foreach ($timming as $fakeindex => $row) {
         $comp++;
         $index = $fakeindex;
         if ($dir == 'CL' || $dir == 'EL') $squad = explode(' ', $row['Squad'], 2)[1];
         else $squad = $row['Squad'];
         $verify = $this->em->getRepository(Player::class)
            ->findOneBy([
               'Name' => $row['name'],
               'born' => $row['born'],
               'position' =>  $row['position'],
               'squad' => $squad
            ]);


         if (empty($verify)) {
            $player = (new player())
               ->setIdPlayer($comp)
               ->setName($row['name'])
               ->setNation($row['nation'])
               ->setPosition($row['position'])
               ->setSquad($squad)
               ->setAge(intval($row['age']))
               ->setBorn(intval($row['born']))
               ->setMinutesPlayed(intval($row['Min']))
               ->setMinutesPercentPlayed(floatval($row['Min%']))
               ->setNintyMinPlayed(floatval($row['90s']))
               ->setMinPerMatchStarted(floatval($row['Mn/Start']))
               ->setPointsPerMatch(floatval($row['PPM']))
               ->setMatchsPlayed(0)
               ->setMatchStarts(0)
               ->setMinsPlayed(0)
               ->setGoals(0)
               ->setAssits(0)
               ->setPkMade(0)
               ->setPkAttempted(0)
               ->setYellowCard(0)
               ->setRedCard(0)
               ->setGoalsPerMin(0.0)
               ->setAssistsPerMin(0.0)
               ->setGlsAssPerMin(0.0)
               ->setGoalsWithoutPkPerMin(0.0)
               ->setGlsAssWithoutPkPerMin(0.0)
               ->setGoalsExp(0.0)
               ->setNonPenGoalsExp(0.0)
               ->setAssistsExp(0.0)
               ->setGoalsPerMinExp(0.0)
               ->setAssistsPerMinExp(0.0)
               ->setGlsAssistsPerMinExp(0.0)
               ->setNonPenGoalsExpPerMin(0.0)
               ->setNonPenGoalsAssistsExpPerMin(0.0)
               ->setShoots(0)
               ->setShootsOnTarget(0)
               ->setShootsFromFrKc(0)
               ->setShootsOnTargetPc(0.0)
               ->setShootsPerMatch(0.0)
               ->setShootsOnTargetPerMatch(0.0)
               ->setGoalsPerShoot(0.0)
               ->setGoalPerShootOnTarget(0.0)
               ->setKeyPasses(0)
               ->setPassesCompleted(0)
               ->setPassesAttempted(0)
               ->setPassCompPercent(0.0)
               ->setShortPassesCompleted(0)
               ->setShortpassesAttempted(0)
               ->setShortPassesCompPercent(0.0)
               ->setMediumPassesCompleted(0)
               ->setMediumPassesAttempted(0)
               ->setMediumPassesCompPercent(0.0)
               ->setLongPassCompleted(0)
               ->setLongPassesAttempted(0)
               ->setLongPassesCompPercent(0.0)
               ->setPassCompletedFinalThird(0)
               ->setPassCompletedPenaltyArea(0)
               ->setThroughBalls(0)
               ->setFoulsCommited(0)
               ->setFoulsDrawn(0)
               ->setOffsides(0)
               ->setCrosses(0)
               ->setTacklesWon(0)
               ->setInterceptions(0)
               ->setPenaltyKicksWon(0)
               ->setPenaltyKicksConceded(0)
               ->setOwnGoal(0)
               ->setDribbleCompleted(0)
               ->setDribbleAttempted(0)
               ->setDribblePercent(0.0)
               ->setNumberOfPlayerDriblled(0)
               ->setNutmegs(0)
               ->setDribbleTackled(0)
               ->setDribbleTackledPercent(0.0)
               ->setTimesDribbledPast(0)
               ->setCrossIntoPenaltyArea(0);

            if ($index > count($standars) - 1) {
               $index = 0;
            }
            if ($row['name'] == $standars[$index]['name']) {

               $player->setMatchsPlayed(intval($standars[$index]['MP'] ?? 0))
                  ->setMatchStarts(intval($standars[$index]['Starts'] ?? 0))
                  ->setMinsPlayed(intval($standars[$index]['Min'] ?? 0))
                  ->setGoals(intval($standars[$index]['Gls'] ?? 0))
                  ->setAssits(intval($standars[$index]['Ast'] ?? 0))
                  ->setPkMade(intval($standars[$index]['PK'] ?? 0))
                  ->setPkAttempted(intval($standars[$index]['PKatt'] ?? 0))
                  ->setYellowCard(intval($standars[$index]['CrdY'] ?? 0))
                  ->setRedCard(intval($standars[$index]['CrdR'] ?? 0))
                  ->setGoalsPerMin(floatval($standars[$index]['Gls_per_match'] ?? 0.0))
                  ->setAssistsPerMin(floatval($standars[$index]['Ast_per_match'] ?? 0.0))
                  ->setGlsAssPerMin(floatval($standars[$index]['G_A_per_match'] ?? 0.0))
                  ->setGoalsWithoutPkPerMin(floatval($standars[$index]['G_PK_per_match'] ?? 0.0))
                  ->setGlsAssWithoutPkPerMin(floatval($standars[$index]['G_A_PK_per_match'] ?? 0.0))
                  ->setGoalsExp(floatval($standars[$index]['xG'] ?? 0.0))
                  ->setNonPenGoalsExp(floatval($standars[$index]['npxG'] ?? 0.0))
                  ->setAssistsExp(floatval($standars[$index]['xA'] ?? 0.0))
                  ->setGoalsPerMinExp(floatval($standars[$index]['xG_per_match'] ?? 0.0))
                  ->setAssistsPerMinExp(floatval($standars[$index]['xA_per_match']) ?? 0.0)
                  ->setGlsAssistsPerMinExp(floatval($standars[$index]['xG_xA'] ?? 0.0))
                  ->setNonPenGoalsExpPerMin(floatval($standars[$index]['npxG_per_match'] ?? 0.0))
                  ->setNonPenGoalsAssistsExpPerMin(floatval($standars[$index]['npxG_xA'] ?? 0.0));
            } else {
               for ($i = 0; $i <= count($standars) - 1; $i++) {

                  if ($row['name'] == $standars[$i]['name']) {

                     $player->setMatchsPlayed(intval($standars[$i]['MP'] ?? 0))
                        ->setMatchStarts(intval($standars[$i]['Starts'] ?? 0))
                        ->setMinsPlayed(intval($standars[$i]['Min'] ?? 0))
                        ->setGoals(intval($standars[$i]['Gls'] ?? 0))
                        ->setAssits(intval($standars[$i]['Ast'] ?? 0))
                        ->setPkMade(intval($standars[$i]['PK'] ?? 0))
                        ->setPkAttempted(intval($standars[$i]['PKatt'] ?? 0))
                        ->setYellowCard(intval($standars[$i]['CrdY'] ?? 0))
                        ->setRedCard(intval($standars[$i]['CrdR'] ?? 0))
                        ->setGoalsPerMin(floatval($standars[$i]['Gls_per_match'] ?? 0.0))
                        ->setAssistsPerMin(floatval($standars[$i]['Ast_per_match'] ?? 0.0))
                        ->setGlsAssPerMin(floatval($standars[$i]['G_A_per_match'] ?? 0.0))
                        ->setGoalsWithoutPkPerMin(floatval($standars[$i]['G_PK_per_match'] ?? 0.0))
                        ->setGlsAssWithoutPkPerMin(floatval($standars[$i]['G_A_PK_per_match'] ?? 0.0))
                        ->setGoalsExp(floatval($standars[$i]['xG'] ?? 0.0))
                        ->setNonPenGoalsExp(floatval($standars[$i]['npxG'] ?? 0.0))
                        ->setAssistsExp(floatval($standars[$i]['xA'] ?? 0.0))
                        ->setGoalsPerMinExp(floatval($standars[$i]['xG_per_match'] ?? 0.0))
                        ->setAssistsPerMinExp(floatval($standars[$i]['xA_per_match'] ?? 0.0))
                        ->setGlsAssistsPerMinExp(floatval($standars[$i]['xG_xA'] ?? 0.0))
                        ->setNonPenGoalsExpPerMin(floatval($standars[$i]['npxG_per_match'] ?? 0.0))
                        ->setNonPenGoalsAssistsExpPerMin(floatval($standars[$i]['npxG_xA'] ?? 0.0));
                     break;
                  }
               }
            }

            $index = $fakeindex;
            if ($index > count($shooting) - 1) {
               $index = 0;
            }
            if ($row['name'] == $shooting[$index]['name']) {
               $player->setShoots(intval($shooting[$index]['Sh'] ?? 0))
                  ->setShootsOnTarget(intval($shooting[$index]['SoT'] ?? 0))
                  ->setShootsFromFrKc(intval($shooting[$index]['FK'] ?? 0))
                  ->setShootsOnTargetPc(floatval($shooting[$index]['SoT%'] ?? 0.0))
                  ->setShootsPerMatch(floatval($shooting[$index]['Sh/90'] ?? 0.0))
                  ->setShootsOnTargetPerMatch(floatval($shooting[$index]['SoT/90'] ?? 0.0))
                  ->setGoalsPerShoot(floatval($shooting[$index]['G/Sh'] ?? 0.0))
                  ->setGoalPerShootOnTarget(floatval($shooting[$index]['G/SoT'] ?? 0.0));
            } else {
               for ($i = 0; $i <= count($shooting) - 1; $i++) {

                  if ($row['name'] == $shooting[$i]['name']) {

                     $player->setShoots(intval($shooting[$i]['Sh'] ?? 0))
                        ->setShootsOnTarget(intval($shooting[$i]['SoT'] ?? 0))
                        ->setShootsFromFrKc(intval($shooting[$i]['FK'] ?? 0))
                        ->setShootsOnTargetPc(floatval($shooting[$i]['SoT%'] ?? 0.0))
                        ->setShootsPerMatch(floatval($shooting[$i]['Sh/90'] ?? 0.0))
                        ->setShootsOnTargetPerMatch(floatval($shooting[$i]['SoT/90'] ?? 0.0))
                        ->setGoalsPerShoot(floatval($shooting[$i]['G/Sh'] ?? 0.0))
                        ->setGoalPerShootOnTarget(floatval($shooting[$i]['G/SoT'] ?? 0.0));
                     break;
                  }
               }
            }




            $index = $fakeindex;
            if ($index > count($passing) - 1) {
               $index = 0;
            }
            if ($row['name'] == $passing[$index]['name']) {
               $player->setKeyPasses(intval($passing[$index]['KP'] ?? 0))
                  ->setPassesCompleted(intval($passing[$index]['Cmp'] ?? 0))
                  ->setPassesAttempted(intval($passing[$index]['Att'] ?? 0))
                  ->setPassCompPercent(floatval($passing[$index]['CmpPER'] ?? 0.0))
                  ->setShortPassesCompleted(intval($passing[$index]['shortCmp'] ?? 0))
                  ->setShortpassesAttempted(intval($passing[$index]['shortAtt'] ?? 0))
                  ->setShortPassesCompPercent(floatval($passing[$index]['shortCmpPER'] ?? 0.0))
                  ->setMediumPassesCompleted(intval($passing[$index]['mediumCmp'] ?? 0))
                  ->setMediumPassesAttempted(intval($passing[$index]['mediumAtt'] ?? 0))
                  ->setMediumPassesCompPercent(floatval($passing[$index]['mediumCmpPER'] ?? 0.0))
                  ->setLongPassCompleted(intval($passing[$index]['longCmp'] ?? 0))
                  ->setLongPassesAttempted(intval($passing[$index]['longAtt'] ?? 0))
                  ->setLongPassesCompPercent(floatval($passing[$index]['longCmpPER'] ?? 0.0))
                  ->setPassCompletedFinalThird(intval($passing[$index]['1/3'] ?? 0))
                  ->setPassCompletedPenaltyArea(intval($passing[$index]['PPA'] ?? 0))
                  ->setThroughBalls(intval($passing[$index]['TB'] ?? 0))
                  ->setCrossIntoPenaltyArea(floatval($passing[$index]['CrsPA'] ?? 0.0));
                  
            } else {
               for ($i = 0; $i <= count($passing) - 1; $i++) {

                  if ($row['name'] == $passing[$i]['name']) {
                     $player->setKeyPasses(intval($passing[$i]['KP'] ?? 0))
                        ->setPassesCompleted(intval($passing[$i]['Cmp'] ?? 0))
                        ->setPassesAttempted(intval($passing[$i]['Att'] ?? 0))
                        ->setPassCompPercent(floatval($passing[$i]['CmpPER'] ?? 0.0))
                        ->setShortPassesCompleted(intval($passing[$i]['shortCmp'] ?? 0))
                        ->setShortpassesAttempted(intval($passing[$i]['shortAtt'] ?? 0))
                        ->setShortPassesCompPercent(floatval($passing[$i]['shortCmpPER'] ?? 0.0))
                        ->setMediumPassesCompleted(intval($passing[$i]['mediumCmp'] ?? 0))
                        ->setMediumPassesAttempted(intval($passing[$i]['mediumAtt'] ?? 0))
                        ->setMediumPassesCompPercent(floatval($passing[$i]['mediumCmpPER'] ?? 0.0))
                        ->setLongPassCompleted(intval($passing[$i]['longCmp'] ?? 0))
                        ->setLongPassesAttempted(intval($passing[$i]['longAtt'] ?? 0))
                        ->setLongPassesCompPercent(floatval($passing[$i]['longCmpPER'] ?? 0.0))
                        ->setPassCompletedFinalThird(intval($passing[$i]['1/3'] ?? 0))
                        ->setPassCompletedPenaltyArea(intval($passing[$i]['PPA'] ?? 0))
                        ->setThroughBalls(intval($passing[$i]['TB'] ?? 0))
                        ->setCrossIntoPenaltyArea(floatval($passing[$i]['CrsPA'] ?? 0.0));
                     break;
                  }
               }
            }
            $index = $fakeindex;
            if ($index > count($miscellaneous) - 1) {
               $index = 0;
            }
            if ($row['name'] == $miscellaneous[$index]['name']) {

               $player->setFoulsCommited(intval($miscellaneous[$index]['Fls'] ?? 0))
                  ->setFoulsDrawn(intval($miscellaneous[$index]['Fld'] ?? 0))
                  ->setOffsides(intval($miscellaneous[$index]['Off'] ?? 0))
                  ->setCrosses(intval($miscellaneous[$index]['Crs'] ?? 0))
                  ->setTacklesWon(intval($miscellaneous[$index]['TklW'] ?? 0))
                  ->setInterceptions(intval($miscellaneous[$index]['Int'] ?? 0))
                  ->setPenaltyKicksWon(intval($miscellaneous[$index]['PKwon'] ?? 0))
                  ->setPenaltyKicksConceded(intval($miscellaneous[$index]['PKcon'] ?? 0))
                  ->setOwnGoal(intval($miscellaneous[$index]['OG'] ?? 0))
                  ->setDribbleCompleted(intval($miscellaneous[$index]['Succ'] ?? 0))
                  ->setDribbleAttempted(intval($miscellaneous[$index]['Att'] ?? 0))
                  ->setDribblePercent(floatval($miscellaneous[$index]['Succ%'] ?? 0.0))
                  ->setNumberOfPlayerDriblled(intval($miscellaneous[$index]['#Pl'] ?? 0))
                  ->setNutmegs(intval($miscellaneous[$index]['Megs'] ?? 0))
                  ->setDribbleTackled(intval($miscellaneous[$index]['Tkl'] ?? 0))
                  ->setDribbleTackledPercent(floatval($miscellaneous[$index]['Tkl%'] ?? 0.0))
                  ->setTimesDribbledPast(intval($miscellaneous[$index]['Past'] ?? 0));
            } else {
               for ($i = 0; $i <= count($miscellaneous) - 1; $i++) {

                  if ($row['name'] == $miscellaneous[$i]['name']) {

                     $player->setFoulsCommited(intval($miscellaneous[$i]['Fls'] ?? 0))
                        ->setFoulsDrawn(intval($miscellaneous[$i]['Fld'] ?? 0))
                        ->setOffsides(intval($miscellaneous[$i]['Off'] ?? 0))
                        ->setCrosses(intval($miscellaneous[$i]['Crs'] ?? 0))
                        ->setTacklesWon(intval($miscellaneous[$i]['TklW'] ?? 0))
                        ->setInterceptions(intval($miscellaneous[$i]['Int'] ?? 0))
                        ->setPenaltyKicksWon(intval($miscellaneous[$i]['PKwon'] ?? 0))
                        ->setPenaltyKicksConceded(intval($miscellaneous[$i]['PKcon'] ?? 0))
                        ->setOwnGoal(intval($miscellaneous[$i]['OG'] ?? 0))
                        ->setDribbleCompleted(intval($miscellaneous[$i]['Succ'] ?? 0))
                        ->setDribbleAttempted(intval($miscellaneous[$i]['Att'] ?? 0))
                        ->setDribblePercent(floatval($miscellaneous[$i]['Succ%'] ?? 0.0))
                        ->setNumberOfPlayerDriblled(intval($miscellaneous[$i]['#Pl'] ?? 0))
                        ->setNutmegs(intval($miscellaneous[$i]['Megs'] ?? 0))
                        ->setDribbleTackled(intval($miscellaneous[$i]['Tkl'] ?? 0))
                        ->setDribbleTackledPercent(floatval($miscellaneous[$i]['Tkl%'] ?? 0.0))
                        ->setTimesDribbledPast(intval($miscellaneous[$i]['Past'] ?? 0));
                     break;
                  }
               }
            }



            $this->em->persist($player);
         } else {

            $verify->setMinutesPlayed(intval($row['Min'] ?? 0))
               ->setMinutesPercentPlayed(floatval($row['Min%'] ?? 0.0))
               ->setNintyMinPlayed(floatval($row['90s'] ?? 0.0))
               ->setMinPerMatchStarted(floatval($row['Mn/Start'] ?? 0.0))
               ->setPointsPerMatch(floatval($row['PPM'] ?? 0.0));

            if ($index > count($standars) - 1) {
               $index = 0;
            }
            if ($row['name'] == $standars[$index]['name']) {

               $verify->setMatchsPlayed(intval($standars[$index]['MP'] ?? 0))
                  ->setMatchStarts(intval($standars[$index]['Starts'] ?? 0))
                  ->setMinsPlayed(intval($standars[$index]['Min'] ?? 0))
                  ->setGoals(intval($standars[$index]['Gls'] ?? 0))
                  ->setAssits(intval($standars[$index]['Ast'] ?? 0))
                  ->setPkMade(intval($standars[$index]['PK'] ?? 0))
                  ->setPkAttempted(intval($standars[$index]['PKatt'] ?? 0))
                  ->setYellowCard(intval($standars[$index]['CrdY'] ?? 0))
                  ->setRedCard(intval($standars[$index]['CrdR'] ?? 0))
                  ->setGoalsPerMin(floatval($standars[$index]['Gls_per_match'] ?? 0.0))
                  ->setAssistsPerMin(floatval($standars[$index]['Ast_per_match'] ?? 0.0))
                  ->setGlsAssPerMin(floatval($standars[$index]['G_A_per_match'] ?? 0.0))
                  ->setGoalsWithoutPkPerMin(floatval($standars[$index]['G_PK_per_match'] ?? 0.0))
                  ->setGlsAssWithoutPkPerMin(floatval($standars[$index]['G_A_PK_per_match'] ?? 0.0))
                  ->setGoalsExp(floatval($standars[$index]['xG'] ?? 0.0))
                  ->setNonPenGoalsExp(floatval($standars[$index]['npxG'] ?? 0.0))
                  ->setAssistsExp(floatval($standars[$index]['xA'] ?? 0.0))
                  ->setGoalsPerMinExp(floatval($standars[$index]['xG_per_match'] ?? 0.0))
                  ->setAssistsPerMinExp(floatval($standars[$index]['xA_per_match'] ?? 0.0))
                  ->setGlsAssistsPerMinExp(floatval($standars[$index]['xG_xA'] ?? 0.0))
                  ->setNonPenGoalsExpPerMin(floatval($standars[$index]['npxG_per_match'] ?? 0.0))
                  ->setNonPenGoalsAssistsExpPerMin(floatval($standars[$index]['npxG_xA'] ?? 0.0));
            } else {

               for ($i = 0; $i <= count($standars) - 1; $i++) {
                  $comp++;
                  if ($row['name'] == $standars[$i]['name']) {

                     $verify->setMatchsPlayed(intval($standars[$i]['MP'] ?? 0))
                        ->setMatchStarts(intval($standars[$i]['Starts'] ?? 0))
                        ->setMinsPlayed(intval($standars[$i]['Min'] ?? 0))
                        ->setGoals(intval($standars[$i]['Gls'] ?? 0))
                        ->setAssits(intval($standars[$i]['Ast'] ?? 0))
                        ->setPkMade(intval($standars[$i]['PK'] ?? 0))
                        ->setPkAttempted(intval($standars[$i]['PKatt'] ?? 0))
                        ->setYellowCard(intval($standars[$i]['CrdY'] ?? 0))
                        ->setRedCard(intval($standars[$i]['CrdR'] ?? 0))
                        ->setGoalsPerMin(floatval($standars[$i]['Gls_per_match'] ?? 0.0))
                        ->setAssistsPerMin(floatval($standars[$i]['Ast_per_match'] ?? 0.0))
                        ->setGlsAssPerMin(floatval($standars[$i]['G_A_per_match'] ?? 0.0))
                        ->setGoalsWithoutPkPerMin(floatval($standars[$i]['G_PK_per_match'] ?? 0.0))
                        ->setGlsAssWithoutPkPerMin(floatval($standars[$i]['G_A_PK_per_match'] ?? 0.0))
                        ->setGoalsExp(floatval($standars[$i]['xG'] ?? 0.0))
                        ->setNonPenGoalsExp(floatval($standars[$i]['npxG'] ?? 0.0))
                        ->setAssistsExp(floatval($standars[$i]['xA'] ?? 0.0))
                        ->setGoalsPerMinExp(floatval($standars[$i]['xG_per_match'] ?? 0.0))
                        ->setAssistsPerMinExp(floatval($standars[$i]['xA_per_match'] ?? 0.0))
                        ->setGlsAssistsPerMinExp(floatval($standars[$i]['xG_xA'] ?? 0.0))
                        ->setNonPenGoalsExpPerMin(floatval($standars[$i]['npxG_per_match'] ?? 0.0))
                        ->setNonPenGoalsAssistsExpPerMin(floatval($standars[$i]['npxG_xA'] ?? 0.0));
                     break;
                  }
               }
            }

            $index = $fakeindex;
            if ($index > count($shooting) - 1) {
               $index = 0;
            }
            if ($row['name'] == $shooting[$index]['name']) {
               $verify->setShoots(intval($shooting[$index]['Sh'] ?? 0))
                  ->setShootsOnTarget(intval($shooting[$index]['SoT'] ?? 0))
                  ->setShootsFromFrKc(intval($shooting[$index]['FK'] ?? 0))
                  ->setShootsOnTargetPc(floatval($shooting[$index]['SoT%'] ?? 0.0))
                  ->setShootsPerMatch(floatval($shooting[$index]['Sh/90'] ?? 0.0))
                  ->setShootsOnTargetPerMatch(floatval($shooting[$index]['SoT/90'] ?? 0.0))
                  ->setGoalsPerShoot(floatval($shooting[$index]['G/Sh'] ?? 0.0))
                  ->setGoalPerShootOnTarget(floatval($shooting[$index]['G/SoT'] ?? 0.0));
            } else {
               for ($i = 0; $i <= count($shooting) - 1; $i++) {

                  if ($row['name'] == $shooting[$i]['name']) {

                     $verify->setShoots(intval($shooting[$i]['Sh'] ?? 0))
                        ->setShootsOnTarget(intval($shooting[$i]['SoT'] ?? 0))
                        ->setShootsFromFrKc(intval($shooting[$i]['FK'] ?? 0))
                        ->setShootsOnTargetPc(floatval($shooting[$i]['SoT%'] ?? 0.0))
                        ->setShootsPerMatch(floatval($shooting[$i]['Sh/90'] ?? 0.0))
                        ->setShootsOnTargetPerMatch(floatval($shooting[$i]['SoT/90'] ?? 0.0))
                        ->setGoalsPerShoot(floatval($shooting[$i]['G/Sh'] ?? 0.0))
                        ->setGoalPerShootOnTarget(floatval($shooting[$i]['G/SoT'] ?? 0.0));
                     break;
                  }
               }
            }




            $index = $fakeindex;
            if ($index > count($passing) - 1) {
               $index = 0;
            }
            if ($row['name'] == $passing[$index]['name']) {
               $verify->setKeyPasses(intval($passing[$index]['KP']))
                  ->setPassesCompleted(intval($passing[$index]['Cmp']))
                  ->setPassesAttempted(intval($passing[$index]['Att'] ?? 0.0))
                  ->setPassCompPercent(floatval($passing[$index]['CmpPER']))
                  ->setShortPassesCompleted(intval($passing[$index]['shortCmp']))
                  ->setShortpassesAttempted(intval($passing[$index]['shortAtt']))
                  ->setShortPassesCompPercent(floatval($passing[$index]['shortCmpPER'] ?? 0.0))
                  ->setMediumPassesCompleted(intval($passing[$index]['mediumCmp']))
                  ->setMediumPassesAttempted(intval($passing[$index]['mediumAtt'] ?? 0))
                  ->setMediumPassesCompPercent(floatval($passing[$index]['mediumCmpPER'] ?? 0.0))
                  ->setLongPassCompleted(intval($passing[$index]['longCmp']))
                  ->setLongPassesAttempted(intval($passing[$index]['longAtt']))
                  ->setLongPassesCompPercent(floatval($passing[$index]['longCmpPER'] ?? 0.0))
                  ->setPassCompletedFinalThird(intval($passing[$index]['1/3'] ?? 0))
                  ->setPassCompletedPenaltyArea(intval($passing[$index]['PPA'] ?? 0))
                  ->setThroughBalls(intval($passing[$index]['TB'] ?? 0))
                  ->setCrossIntoPenaltyArea(floatval($passing[$index]['CrsPA'] ?? 0.0));
            } else {
               for ($i = 0; $i <= count($passing) - 1; $i++) {

                  if ($row['name'] == $passing[$i]['name']) {
                     $verify->setKeyPasses(intval($passing[$i]['KP']))
                        ->setPassesCompleted(intval($passing[$i]['Cmp']))
                        ->setPassesAttempted(intval($passing[$i]['Att']))
                        ->setPassCompPercent(floatval($passing[$i]['CmpPER'] ?? 0.0))
                        ->setShortPassesCompleted(intval($passing[$i]['shortCmp']))
                        ->setShortpassesAttempted(intval($passing[$i]['shortAtt']))
                        ->setShortPassesCompPercent(floatval($passing[$i]['shortCmpPER'] ?? 0.0))
                        ->setMediumPassesCompleted(intval($passing[$i]['mediumCmp']))
                        ->setMediumPassesAttempted(intval($passing[$i]['mediumAtt']))
                        ->setMediumPassesCompPercent(floatval($passing[$i]['mediumCmpPER'] ?? 0.0))
                        ->setLongPassCompleted(intval($passing[$i]['longCmp']))
                        ->setLongPassesAttempted(intval($passing[$i]['longAtt']))
                        ->setLongPassesCompPercent(floatval($passing[$i]['longCmpPER'] ?? 0.0))
                        ->setPassCompletedFinalThird(intval($passing[$i]['1/3']))
                        ->setPassCompletedPenaltyArea(intval($passing[$i]['PPA']))
                        ->setThroughBalls(intval($passing[$i]['TB'] ?? 0))
                        ->setCrossIntoPenaltyArea(floatval($passing[$i]['CrsPA'] ?? 0.0));
                     break;
                  }
               }
            }

            $index = $fakeindex;
            if ($index > count($miscellaneous) - 1) {
               $index = 0;
            }
            if ($row['name'] == $miscellaneous[$index]['name']) {

               $verify->setFoulsCommited(intval($miscellaneous[$index]['Fls']))
                  ->setFoulsDrawn(intval($miscellaneous[$index]['Fld']))
                  ->setOffsides(intval($miscellaneous[$index]['Off']))
                  ->setCrosses(floatval($miscellaneous[$index]['Crs'] ?? 0.0))
                  ->setTacklesWon(floatval($miscellaneous[$index]['TklW'] ?? 0.0))
                  ->setInterceptions(floatval($miscellaneous[$index]['Int'] ?? 0.0))
                  ->setPenaltyKicksWon(floatval($miscellaneous[$index]['PKwon'] ?? 0.0))
                  ->setPenaltyKicksConceded(floatval($miscellaneous[$index]['PKcon'] ?? 0.0))
                  ->setOwnGoal(floatval($miscellaneous[$index]['OG'] ?? 0.0))
                  ->setDribbleCompleted(floatval($miscellaneous[$index]['Succ'] ?? 0.0))
                  ->setDribbleAttempted(floatval($miscellaneous[$index]['Att'] ?? 0.0))
                  ->setDribblePercent(floatval($miscellaneous[$index]['Succ%'] ?? 0.0))
                  ->setNumberOfPlayerDriblled(floatval($miscellaneous[$index]['#Pl'] ?? 0.0))
                  ->setNutmegs(floatval($miscellaneous[$index]['Megs'] ?? 0.0))
                  ->setDribbleTackled(floatval($miscellaneous[$index]['Tkl'] ?? 0.0))
                  ->setDribbleTackledPercent(floatval($miscellaneous[$index]['Tkl%'] ?? 0.0))
                  ->setTimesDribbledPast(floatval($miscellaneous[$index]['Past'] ?? 0.0));
            } else {
               for ($i = 0; $i <= count($miscellaneous) - 1; $i++) {

                  if ($row['name'] == $miscellaneous[$i]['name']) {

                     $verify->setFoulsCommited(intval($miscellaneous[$i]['Fls']))
                        ->setFoulsDrawn(intval($miscellaneous[$i]['Fld']))
                        ->setOffsides(intval($miscellaneous[$i]['Off']))
                        ->setCrosses(intval($miscellaneous[$i]['Crs'] ?? 0))
                        ->setTacklesWon(intval($miscellaneous[$i]['TklW'] ?? 0))
                        ->setInterceptions(intval($miscellaneous[$i]['Int'] ?? 0))
                        ->setPenaltyKicksWon(intval($miscellaneous[$i]['PKwon'] ?? 0))
                        ->setPenaltyKicksConceded(intval($miscellaneous[$i]['PKcon'] ?? 0))
                        ->setOwnGoal(intval($miscellaneous[$i]['OG'] ?? 0))
                        ->setDribbleCompleted(intval($miscellaneous[$i]['Succ'] ?? 0))
                        ->setDribbleAttempted(intval($miscellaneous[$i]['Att'] ?? 0))
                        ->setDribblePercent(floatval($miscellaneous[$i]['Succ%'] ?? 0.0))
                        ->setNumberOfPlayerDriblled(intval($miscellaneous[$i]['#Pl'] ?? 0))
                        ->setNutmegs(intval($miscellaneous[$i]['Megs'] ?? 0))
                        ->setDribbleTackled(intval($miscellaneous[$i]['Tkl'] ?? 0))
                        ->setDribbleTackledPercent(floatval($miscellaneous[$i]['Tkl%'] ?? 0.0))
                        ->setTimesDribbledPast(intval($miscellaneous[$i]['Past'] ?? 0));
                     break;
                  }
               }
            }
            $this->em->persist($verify);
         }





         $this->em->flush();
      }
   }





   protected function execute(InputInterface $input, OutputInterface $output)
   {

      $io = new SymfonyStyle($input, $output);

      $io->title('import en progression...');

      $this->import('Spain');
      $this->import('England');
      $this->import('Italy');
      $this->import('France');
      $this->import('Germany');
      $this->import('CL');
      $this->import('EL');

      $io->success('importation avec succés');
   }
}
