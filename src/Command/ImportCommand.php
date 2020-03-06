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

            $verify = $this->em->getRepository(Team::class)
               ->findOneBy([
                  'nameTeam' => $teams['Squad']
               ]);

            if (!$verify) {

               $team = (new Team())
                  ->setNameTeam($teams['Squad'])
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
               $verify
                  ->setNameTeam($teams['Squad'])
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
                  ->setTopTeamScoorer("")
                  ->setGoalKeeper("");
               $this->em->persist($verify);
            }
         }
         $this->em->flush();
      }
   }






   protected function execute(InputInterface $input, OutputInterface $output)
   {

      $io = new SymfonyStyle($input, $output);

      $io->title('import en progression...');
      $readerOfStandarsData = Reader::createFromPath('%kernel.root_dir%/../public/standars_data_pl.csv');
      $readerOfPassingData = Reader::createFromPath('%kernel.root_dir%/../public/passing_data_pl.csv');
      $readerOfShootingData = Reader::createFromPath('%kernel.root_dir%/../public/shooting_data_pl.csv');
      $readerOfTimmingData = Reader::createFromPath('%kernel.root_dir%/../public/timming_data_pl.csv');
      $readerOfMiscellaneousData = Reader::createFromPath('%kernel.root_dir%/../public/miscellaneous_data_pl.csv');
      $readerPermierLeagueTeams = Reader::createFromPath('%kernel.root_dir%/../public/premier_league_teams.csv');
      $readerPermierLeagueTeamsOtherData = Reader::createFromPath('%kernel.root_dir%/../public/premier_league_teams_other_data.csv');


      $readerOfStandarsData->setDelimiter(';');
      $readerOfPassingData->setDelimiter(';');
      $readerOfShootingData->setDelimiter(';');
      $readerOfTimmingData->setDelimiter(';');
      $readerOfMiscellaneousData->setDelimiter(';');
      $readerPermierLeagueTeams->setDelimiter(';');
      $readerPermierLeagueTeamsOtherData->setDelimiter(';');


      $standars = $readerOfStandarsData->fetchAssoc();
      $passing = $readerOfPassingData->fetchAssoc();
      $shooting = $readerOfShootingData->fetchAssoc();
      $timming = $readerOfTimmingData->fetchAssoc();
      $miscellaneous = $readerOfMiscellaneousData->fetchAssoc();
      $permierLeagueTeams = $readerPermierLeagueTeams->fetchAssoc();
      $permierLeagueTeamsOtherData = $readerPermierLeagueTeamsOtherData->fetchAssoc();

      $standars = iterator_to_array($standars, false);
      $passing = iterator_to_array($passing, false);
      $shooting = iterator_to_array($shooting, false);
      $timming = iterator_to_array($timming, false);
      $miscellaneous = iterator_to_array($miscellaneous, false);
      $permierLeagueTeams = iterator_to_array($permierLeagueTeams, false);
      $permierLeagueTeamsOtherData = iterator_to_array($permierLeagueTeamsOtherData, false);

      $comp = 0;


      $this->importTeams($permierLeagueTeams, $permierLeagueTeamsOtherData, 'Premier League');


      foreach ($timming as $fakeindex => $row) {

         $index = $fakeindex;

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
               ->setTimesDribbledPast(0);

            if ($index > count($standars) - 1) {
               $index = 0;
            }
            if ($row['name'] == $standars[$index]['name']) {

               $player->setMatchsPlayed(intval($standars[$index]['MP']))
                  ->setMatchStarts(intval($standars[$index]['Starts']))
                  ->setMinsPlayed(intval($standars[$index]['Min']))
                  ->setGoals(intval($standars[$index]['Gls']))
                  ->setAssits(intval($standars[$index]['Ast']))
                  ->setPkMade(intval($standars[$index]['PK']))
                  ->setPkAttempted(intval($standars[$index]['PKatt']))
                  ->setYellowCard(intval($standars[$index]['CrdY']))
                  ->setRedCard(intval($standars[$index]['CrdR']))
                  ->setGoalsPerMin(floatval($standars[$index]['Gls_per_match']))
                  ->setAssistsPerMin(floatval($standars[$index]['Ast_per_match']))
                  ->setGlsAssPerMin(floatval($standars[$index]['G_A_per_match']))
                  ->setGoalsWithoutPkPerMin(floatval($standars[$index]['G_PK_per_match']))
                  ->setGlsAssWithoutPkPerMin(floatval($standars[$index]['G_A_PK_per_match']))
                  ->setGoalsExp(floatval($standars[$index]['xG']))
                  ->setNonPenGoalsExp(floatval($standars[$index]['npxG']))
                  ->setAssistsExp(floatval($standars[$index]['xA']))
                  ->setGoalsPerMinExp(floatval($standars[$index]['xG_per_match']))
                  ->setAssistsPerMinExp(floatval($standars[$index]['xA_per_match']))
                  ->setGlsAssistsPerMinExp(floatval($standars[$index]['xG_xA']))
                  ->setNonPenGoalsExpPerMin(floatval($standars[$index]['npxG_per_match']))
                  ->setNonPenGoalsAssistsExpPerMin(floatval($standars[$index]['npxG_xA']));
            } else {
               for ($i = 0; $i <= count($standars) - 1; $i++) {
                  $comp++;
                  if ($row['name'] == $standars[$i]['name']) {

                     $player->setMatchsPlayed(intval($standars[$i]['MP']))
                        ->setMatchStarts(intval($standars[$i]['Starts']))
                        ->setMinsPlayed(intval($standars[$i]['Min']))
                        ->setGoals(intval($standars[$i]['Gls']))
                        ->setAssits(intval($standars[$i]['Ast']))
                        ->setPkMade(intval($standars[$i]['PK']))
                        ->setPkAttempted(intval($standars[$i]['PKatt']))
                        ->setYellowCard(intval($standars[$i]['CrdY']))
                        ->setRedCard(intval($standars[$i]['CrdR']))
                        ->setGoalsPerMin(floatval($standars[$i]['Gls_per_match']))
                        ->setAssistsPerMin(floatval($standars[$i]['Ast_per_match']))
                        ->setGlsAssPerMin(floatval($standars[$i]['G_A_per_match']))
                        ->setGoalsWithoutPkPerMin(floatval($standars[$i]['G_PK_per_match']))
                        ->setGlsAssWithoutPkPerMin(floatval($standars[$i]['G_A_PK_per_match']))
                        ->setGoalsExp(floatval($standars[$i]['xG']))
                        ->setNonPenGoalsExp(floatval($standars[$i]['npxG']))
                        ->setAssistsExp(floatval($standars[$i]['xA']))
                        ->setGoalsPerMinExp(floatval($standars[$i]['xG_per_match']))
                        ->setAssistsPerMinExp(floatval($standars[$i]['xA_per_match']))
                        ->setGlsAssistsPerMinExp(floatval($standars[$i]['xG_xA']))
                        ->setNonPenGoalsExpPerMin(floatval($standars[$i]['npxG_per_match']))
                        ->setNonPenGoalsAssistsExpPerMin(floatval($standars[$i]['npxG_xA']));
                     break;
                  }
               }
            }

            $index = $fakeindex;
            if ($index > count($shooting) - 1) {
               $index = 0;
            }
            if ($row['name'] == $shooting[$index]['name']) {
               $player->setShoots(intval($shooting[$index]['Sh']))
                  ->setShootsOnTarget(intval($shooting[$index]['SoT']))
                  ->setShootsFromFrKc(intval($shooting[$index]['FK']))
                  ->setShootsOnTargetPc(floatval($shooting[$index]['SoT%']))
                  ->setShootsPerMatch(floatval($shooting[$index]['Sh/90']))
                  ->setShootsOnTargetPerMatch(floatval($shooting[$index]['SoT/90']))
                  ->setGoalsPerShoot(floatval($shooting[$index]['G/Sh']))
                  ->setGoalPerShootOnTarget(floatval($shooting[$index]['G/SoT']));
            } else {
               for ($i = 0; $i <= count($shooting) - 1; $i++) {

                  if ($row['name'] == $shooting[$i]['name']) {

                     $player->setShoots(intval($shooting[$i]['Sh']))
                        ->setShootsOnTarget(intval($shooting[$i]['SoT']))
                        ->setShootsFromFrKc(intval($shooting[$i]['FK']))
                        ->setShootsOnTargetPc(floatval($shooting[$i]['SoT%']))
                        ->setShootsPerMatch(floatval($shooting[$i]['Sh/90']))
                        ->setShootsOnTargetPerMatch(floatval($shooting[$i]['SoT/90']))
                        ->setGoalsPerShoot(floatval($shooting[$i]['G/Sh']))
                        ->setGoalPerShootOnTarget(floatval($shooting[$i]['G/SoT']));
                     break;
                  }
               }
            }




            $index = $fakeindex;
            if ($index > count($passing) - 1) {
               $index = 0;
            }
            if ($row['name'] == $passing[$index]['name']) {
               $player->setKeyPasses(intval($passing[$index]['KP']))
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
                  ->setCrossIntoPenaltyArea(floatval($passing[$index]['CrsPA']));
            } else {
               for ($i = 0; $i <= count($passing) - 1; $i++) {

                  if ($row['name'] == $passing[$i]['name']) {
                     $player->setKeyPasses(intval($passing[$i]['KP']))
                        ->setPassesCompleted(intval($passing[$i]['Cmp']))
                        ->setPassesAttempted(intval($passing[$i]['Att']))
                        ->setPassCompPercent(floatval($passing[$i]['CmpPER']))
                        ->setShortPassesCompleted(intval($passing[$i]['shortCmp']))
                        ->setShortpassesAttempted(intval($passing[$i]['shortAtt']))
                        ->setShortPassesCompPercent(floatval($passing[$i]['shortCmpPER']))
                        ->setMediumPassesCompleted(intval($passing[$i]['mediumCmp']))
                        ->setMediumPassesAttempted(intval($passing[$i]['mediumAtt']))
                        ->setMediumPassesCompPercent(floatval($passing[$i]['mediumCmpPER']))
                        ->setLongPassCompleted(intval($passing[$i]['longCmp']))
                        ->setLongPassesAttempted(intval($passing[$i]['longAtt']))
                        ->setLongPassesCompPercent(floatval($passing[$i]['longCmpPER']))
                        ->setPassCompletedFinalThird(intval($passing[$i]['1/3']))
                        ->setPassCompletedPenaltyArea(intval($passing[$i]['PPA']))
                        ->setCrossIntoPenaltyArea(floatval($passing[$i]['CrsPA']));
                     break;
                  }
               }
            }
            $index = $fakeindex;
            if ($index > count($miscellaneous) - 1) {
               $index = 0;
            }
            if ($row['name'] == $miscellaneous[$index]['name']) {

               $player->setFoulsCommited(intval($miscellaneous[$index]['Fls']))
                  ->setFoulsDrawn(intval($miscellaneous[$index]['Fld']))
                  ->setOffsides(intval($miscellaneous[$index]['off']))
                  ->setCrosses(floatval($miscellaneous[$index]['Crs']))
                  ->setTacklesWon(floatval($miscellaneous[$index]['TklW']))
                  ->setInterceptions(floatval($miscellaneous[$index]['Int']))
                  ->setPenaltyKicksWon(floatval($miscellaneous[$index]['PKwon']))
                  ->setPenaltyKicksConceded(floatval($miscellaneous[$index]['Pkcon']))
                  ->setOwnGoal(floatval($miscellaneous[$index]['OG']))
                  ->setDribbleCompleted(floatval($miscellaneous[$index]['Succ']))
                  ->setDribbleAttempted(floatval($miscellaneous[$index]['Att']))
                  ->setDribblePercent(floatval($miscellaneous[$index]['Succ%']))
                  ->setNumberOfPlayerDriblled(floatval($miscellaneous[$index]['#Pl']))
                  ->setNutmegs(floatval($miscellaneous[$index]['Megs']))
                  ->setDribbleTackled(floatval($miscellaneous[$index]['Tkl']))
                  ->setDribbleTackledPercent(floatval($miscellaneous[$index]['Tkl%']))
                  ->setTimesDribbledPast(floatval($miscellaneous[$index]['Past']));
            } else {
               for ($i = 0; $i <= count($miscellaneous) - 1; $i++) {

                  if ($row['name'] == $miscellaneous[$i]['name']) {

                     $player->setFoulsCommited(intval($miscellaneous[$i]['Fls']))
                        ->setFoulsDrawn(intval($miscellaneous[$i]['Fld']))
                        ->setOffsides(intval($miscellaneous[$i]['off']))
                        ->setCrosses(floatval($miscellaneous[$i]['Crs']))
                        ->setTacklesWon(floatval($miscellaneous[$i]['TklW']))
                        ->setInterceptions(floatval($miscellaneous[$i]['Int']))
                        ->setPenaltyKicksWon(floatval($miscellaneous[$i]['PKwon']))
                        ->setPenaltyKicksConceded(floatval($miscellaneous[$i]['Pkcon']))
                        ->setOwnGoal(floatval($miscellaneous[$i]['OG']))
                        ->setDribbleCompleted(floatval($miscellaneous[$i]['Succ']))
                        ->setDribbleAttempted(floatval($miscellaneous[$i]['Att']))
                        ->setDribblePercent(floatval($miscellaneous[$i]['Succ%']))
                        ->setNumberOfPlayerDriblled(floatval($miscellaneous[$i]['#Pl']))
                        ->setNutmegs(floatval($miscellaneous[$i]['Megs']))
                        ->setDribbleTackled(floatval($miscellaneous[$i]['Tkl']))
                        ->setDribbleTackledPercent(floatval($miscellaneous[$i]['Tkl%']))
                        ->setTimesDribbledPast(floatval($miscellaneous[$i]['Past']));
                     break;
                  }
               }
            }



            $this->em->persist($player);
         } else {

            $verify->setMinutesPlayed(intval($row['Min']))
               ->setMinutesPercentPlayed(floatval($row['Min%']))
               ->setNintyMinPlayed(floatval($row['90s']))
               ->setMinPerMatchStarted(floatval($row['Mn/Start']))
               ->setPointsPerMatch(floatval($row['PPM']));

            if ($index > count($standars) - 1) {
               $index = 0;
            }
            if ($row['name'] == $standars[$index]['name']) {

               $verify->setMatchsPlayed(intval($standars[$index]['MP']))
                  ->setMatchStarts(intval($standars[$index]['Starts']))
                  ->setMinsPlayed(intval($standars[$index]['Min']))
                  ->setGoals(intval($standars[$index]['Gls']))
                  ->setAssits(intval($standars[$index]['Ast']))
                  ->setPkMade(intval($standars[$index]['PK']))
                  ->setPkAttempted(intval($standars[$index]['PKatt']))
                  ->setYellowCard(intval($standars[$index]['CrdY']))
                  ->setRedCard(intval($standars[$index]['CrdR']))
                  ->setGoalsPerMin(floatval($standars[$index]['Gls_per_match']))
                  ->setAssistsPerMin(floatval($standars[$index]['Ast_per_match']))
                  ->setGlsAssPerMin(floatval($standars[$index]['G_A_per_match']))
                  ->setGoalsWithoutPkPerMin(floatval($standars[$index]['G_PK_per_match']))
                  ->setGlsAssWithoutPkPerMin(floatval($standars[$index]['G_A_PK_per_match']))
                  ->setGoalsExp(floatval($standars[$index]['xG']))
                  ->setNonPenGoalsExp(floatval($standars[$index]['npxG']))
                  ->setAssistsExp(floatval($standars[$index]['xA']))
                  ->setGoalsPerMinExp(floatval($standars[$index]['xG_per_match']))
                  ->setAssistsPerMinExp(floatval($standars[$index]['xA_per_match']))
                  ->setGlsAssistsPerMinExp(floatval($standars[$index]['xG_xA']))
                  ->setNonPenGoalsExpPerMin(floatval($standars[$index]['npxG_per_match']))
                  ->setNonPenGoalsAssistsExpPerMin(floatval($standars[$index]['npxG_xA']));
            } else {

               for ($i = 0; $i <= count($standars) - 1; $i++) {
                  $comp++;
                  if ($row['name'] == $standars[$i]['name']) {

                     $verify->setMatchsPlayed(intval($standars[$i]['MP']))
                        ->setMatchStarts(intval($standars[$i]['Starts']))
                        ->setMinsPlayed(intval($standars[$i]['Min']))
                        ->setGoals(intval($standars[$i]['Gls']))
                        ->setAssits(intval($standars[$i]['Ast']))
                        ->setPkMade(intval($standars[$i]['PK']))
                        ->setPkAttempted(intval($standars[$i]['PKatt']))
                        ->setYellowCard(intval($standars[$i]['CrdY']))
                        ->setRedCard(intval($standars[$i]['CrdR']))
                        ->setGoalsPerMin(floatval($standars[$i]['Gls_per_match']))
                        ->setAssistsPerMin(floatval($standars[$i]['Ast_per_match']))
                        ->setGlsAssPerMin(floatval($standars[$i]['G_A_per_match']))
                        ->setGoalsWithoutPkPerMin(floatval($standars[$i]['G_PK_per_match']))
                        ->setGlsAssWithoutPkPerMin(floatval($standars[$i]['G_A_PK_per_match']))
                        ->setGoalsExp(floatval($standars[$i]['xG']))
                        ->setNonPenGoalsExp(floatval($standars[$i]['npxG']))
                        ->setAssistsExp(floatval($standars[$i]['xA']))
                        ->setGoalsPerMinExp(floatval($standars[$i]['xG_per_match']))
                        ->setAssistsPerMinExp(floatval($standars[$i]['xA_per_match']))
                        ->setGlsAssistsPerMinExp(floatval($standars[$i]['xG_xA']))
                        ->setNonPenGoalsExpPerMin(floatval($standars[$i]['npxG_per_match']))
                        ->setNonPenGoalsAssistsExpPerMin(floatval($standars[$i]['npxG_xA']));
                     break;
                  }
               }
            }

            $index = $fakeindex;
            if ($index > count($shooting) - 1) {
               $index = 0;
            }
            if ($row['name'] == $shooting[$index]['name']) {
               $verify->setShoots(intval($shooting[$index]['Sh']))
                  ->setShootsOnTarget(intval($shooting[$index]['SoT']))
                  ->setShootsFromFrKc(intval($shooting[$index]['FK']))
                  ->setShootsOnTargetPc(floatval($shooting[$index]['SoT%']))
                  ->setShootsPerMatch(floatval($shooting[$index]['Sh/90']))
                  ->setShootsOnTargetPerMatch(floatval($shooting[$index]['SoT/90']))
                  ->setGoalsPerShoot(floatval($shooting[$index]['G/Sh']))
                  ->setGoalPerShootOnTarget(floatval($shooting[$index]['G/SoT']));
            } else {
               for ($i = 0; $i <= count($shooting) - 1; $i++) {

                  if ($row['name'] == $shooting[$i]['name']) {

                     $verify->setShoots(intval($shooting[$i]['Sh']))
                        ->setShootsOnTarget(intval($shooting[$i]['SoT']))
                        ->setShootsFromFrKc(intval($shooting[$i]['FK']))
                        ->setShootsOnTargetPc(floatval($shooting[$i]['SoT%']))
                        ->setShootsPerMatch(floatval($shooting[$i]['Sh/90']))
                        ->setShootsOnTargetPerMatch(floatval($shooting[$i]['SoT/90']))
                        ->setGoalsPerShoot(floatval($shooting[$i]['G/Sh']))
                        ->setGoalPerShootOnTarget(floatval($shooting[$i]['G/SoT']));
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
                  ->setCrossIntoPenaltyArea(floatval($passing[$index]['CrsPA']));
            } else {
               for ($i = 0; $i <= count($passing) - 1; $i++) {

                  if ($row['name'] == $passing[$i]['name']) {
                     $verify->setKeyPasses(intval($passing[$i]['KP']))
                        ->setPassesCompleted(intval($passing[$i]['Cmp']))
                        ->setPassesAttempted(intval($passing[$i]['Att']))
                        ->setPassCompPercent(floatval($passing[$i]['CmpPER']))
                        ->setShortPassesCompleted(intval($passing[$i]['shortCmp']))
                        ->setShortpassesAttempted(intval($passing[$i]['shortAtt']))
                        ->setShortPassesCompPercent(floatval($passing[$i]['shortCmpPER']))
                        ->setMediumPassesCompleted(intval($passing[$i]['mediumCmp']))
                        ->setMediumPassesAttempted(intval($passing[$i]['mediumAtt']))
                        ->setMediumPassesCompPercent(floatval($passing[$i]['mediumCmpPER']))
                        ->setLongPassCompleted(intval($passing[$i]['longCmp']))
                        ->setLongPassesAttempted(intval($passing[$i]['longAtt']))
                        ->setLongPassesCompPercent(floatval($passing[$i]['longCmpPER']))
                        ->setPassCompletedFinalThird(intval($passing[$i]['1/3']))
                        ->setPassCompletedPenaltyArea(intval($passing[$i]['PPA']))
                        ->setCrossIntoPenaltyArea(floatval($passing[$i]['CrsPA']));
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
                  ->setCrosses(floatval($miscellaneous[$index]['Crs']))
                  ->setTacklesWon(floatval($miscellaneous[$index]['TklW']))
                  ->setInterceptions(floatval($miscellaneous[$index]['Int']))
                  ->setPenaltyKicksWon(floatval($miscellaneous[$index]['PKwon']))
                  ->setPenaltyKicksConceded(floatval($miscellaneous[$index]['PKcon']))
                  ->setOwnGoal(floatval($miscellaneous[$index]['OG']))
                  ->setDribbleCompleted(floatval($miscellaneous[$index]['Succ']))
                  ->setDribbleAttempted(floatval($miscellaneous[$index]['Att']))
                  ->setDribblePercent(floatval($miscellaneous[$index]['Succ%']))
                  ->setNumberOfPlayerDriblled(floatval($miscellaneous[$index]['#Pl']))
                  ->setNutmegs(floatval($miscellaneous[$index]['Megs']))
                  ->setDribbleTackled(floatval($miscellaneous[$index]['Tkl']))
                  ->setDribbleTackledPercent(floatval($miscellaneous[$index]['Tkl%']))
                  ->setTimesDribbledPast(floatval($miscellaneous[$index]['Past']));
            } else {
               for ($i = 0; $i <= count($miscellaneous) - 1; $i++) {

                  if ($row['name'] == $miscellaneous[$i]['name']) {

                     $verify->setFoulsCommited(intval($miscellaneous[$i]['Fls']))
                        ->setFoulsDrawn(intval($miscellaneous[$i]['Fld']))
                        ->setOffsides(intval($miscellaneous[$i]['Off']))
                        ->setCrosses(floatval($miscellaneous[$i]['Crs']))
                        ->setTacklesWon(floatval($miscellaneous[$i]['TklW']))
                        ->setInterceptions(floatval($miscellaneous[$i]['Int']))
                        ->setPenaltyKicksWon(floatval($miscellaneous[$i]['PKwon']))
                        ->setPenaltyKicksConceded(floatval($miscellaneous[$i]['PKcon']))
                        ->setOwnGoal(floatval($miscellaneous[$i]['OG']))
                        ->setDribbleCompleted(floatval($miscellaneous[$i]['Succ']))
                        ->setDribbleAttempted(floatval($miscellaneous[$i]['Att']))
                        ->setDribblePercent(floatval($miscellaneous[$i]['Succ%']))
                        ->setNumberOfPlayerDriblled(floatval($miscellaneous[$i]['#Pl']))
                        ->setNutmegs(floatval($miscellaneous[$i]['Megs']))
                        ->setDribbleTackled(floatval($miscellaneous[$i]['Tkl']))
                        ->setDribbleTackledPercent(floatval($miscellaneous[$i]['Tkl%']))
                        ->setTimesDribbledPast(floatval($miscellaneous[$i]['Past']));
                     break;
                  }
               }
            }
            $this->em->persist($verify);
         }





         $this->em->flush();
      }



      $io->success('importation avec succés $comp');
   }
}
