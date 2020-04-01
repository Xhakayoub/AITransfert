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

   public function importTeams(string $league): void
   {

      $readerOfStandarsTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $league . '/standars_team_data.csv');
      $readerOfPassingTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $league . '/passing_team_data.csv');
      $readerOfShootingTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $league . '/shooting_team_data.csv');
      $readerOfTimmingTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $league . '/timming_team_data.csv');
      $readerOfGkTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $league . '/gk_team_data.csv');
      $readerOfAdvancedGkTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $league . '/ad_gk_team_data.csv');
      $readerOfMiscellaneousTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $league . '/miscellaneous_team_data.csv');

      $readerOfStandarsTeamData->setDelimiter(';');
      $readerOfPassingTeamData->setDelimiter(';');
      $readerOfShootingTeamData->setDelimiter(';');
      $readerOfTimmingTeamData->setDelimiter(';');
      $readerOfMiscellaneousTeamData->setDelimiter(';');
      $readerOfGkTeamData->setDelimiter(';');
      $readerOfAdvancedGkTeamData->setDelimiter(';');


      $standarsTeams = $readerOfStandarsTeamData->fetchAssoc();
      $passingTeams = $readerOfPassingTeamData->fetchAssoc();
      $shootingTeams = $readerOfShootingTeamData->fetchAssoc();
      $timmingTeams = $readerOfTimmingTeamData->fetchAssoc();
      $miscellaneousTeams = $readerOfMiscellaneousTeamData->fetchAssoc();
      $gkTeams = $readerOfGkTeamData->fetchAssoc();
      $advancedGkTeams = $readerOfAdvancedGkTeamData->fetchAssoc();

      // $permierLeagueTeams = $readerPermierLeagueTeams->fetchAssoc();
      // $permierLeagueTeamsOtherData = $readerPermierLeagueTeamsOtherData->fetchAssoc();


      $standarsTeams = iterator_to_array($standarsTeams, false);
      $passingTeams = iterator_to_array($passingTeams, false);
      $shootingTeams = iterator_to_array($shootingTeams, false);
      $timmingTeams = iterator_to_array($timmingTeams, false);
      $miscellaneousTeams = iterator_to_array($miscellaneousTeams, false);
      $gkTeams = iterator_to_array($gkTeams, false);
      $advancedGkTeams = iterator_to_array($advancedGkTeams, false);


      if (!empty($standarsTeams) and !empty($gkTeams)) {

         // $count = sizeof($standarsTeams);
         // // echo sizeof($gkTeams);
         // echo $count ."\n";
         // echo sizeof($gkTeams)."\n";
         echo "import for " . $league . " league\n";
         echo "_________________________\n" ;

         foreach ($standarsTeams as $fakeIndex => $teams) {
            //echo sizeof($gkTeams);
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
                  ->setGoalPerMatch($teams['Gls_per_match'])
                  //goalkepping
                  ->setGoalsAgainst($gkTeams[$fakeIndex]['GA'])
                  ->setGoalsAgainstPerMatch($gkTeams[$fakeIndex]['GA90'])
                  ->setSaves($gkTeams[$fakeIndex]['Saves'])
                  ->setShootOnTargetAgainst($gkTeams[$fakeIndex]['SoTA'])
                  ->setSavePercent($gkTeams[$fakeIndex]['Save%'])
                  ->setCleanSheets($gkTeams[$fakeIndex]['CS'])
                  ->setCleanSheetPercent($gkTeams[$fakeIndex]['CS%'])
                  ->setPenaltyKickAllowed($gkTeams[$fakeIndex]['PKA'])
                  ->setPenaltyKicksSaved($gkTeams[$fakeIndex]['PKsv'])
                  ->setTopTeamScoorer("")
                  ->setGoalKeeper("")
                  //advanced goalkeeping
                  ->setGkPassLaunchedComp($advancedGkTeams[$fakeIndex]['Cmp'])
                  ->setGkPassLaunchedAtt($advancedGkTeams[$fakeIndex]['AttLaunched'])
                  ->setGkPassLaunchedCompletion($advancedGkTeams[$fakeIndex]['Cmp%'])
                  ->setGkPassAttempted($advancedGkTeams[$fakeIndex]['AttPass'])
                  ->setGkPassThrows($advancedGkTeams[$fakeIndex]['Thr'])
                  ->setGkPassLaunchedPercent($advancedGkTeams[$fakeIndex]['PassLaunch%'])
                  ->setAvgLengthOfPasses($advancedGkTeams[$fakeIndex]['AvgLenPass'])
                  ->setGoalKicksAtt($advancedGkTeams[$fakeIndex]['AttGks'])
                  ->setGoalKicksLaunchedPercent($advancedGkTeams[$fakeIndex]['GksLaunch%'])
                  ->setGoalKicksAvgLength($advancedGkTeams[$fakeIndex]['AvgLenGks'])
                  ->setGkCrossesAttempted($advancedGkTeams[$fakeIndex]['Att'])
                  ->setGkCrossesStopped($advancedGkTeams[$fakeIndex]['Stp'])
                  ->setGkCrossesStpPercent($advancedGkTeams[$fakeIndex]['Stp%'])
                  ->setOpa($advancedGkTeams[$fakeIndex]['#OPA'])
                  ->setOpaPerMatch($advancedGkTeams[$fakeIndex]['#OPA/90'])
                  ->setAverageDistance($advancedGkTeams[$fakeIndex]['AvgDist'])
                  //shooting
                  ->setShootOnTarget($shootingTeams[$fakeIndex]['SoT'])
                  ->setShootFromFreeKick($shootingTeams[$fakeIndex]['FK'])
                  ->setShootOnTargetPercent($shootingTeams[$fakeIndex]['SoT%'])
                  ->setShootPer90Minutes($shootingTeams[$fakeIndex]['Sh/90'])
                  ->setShootOnTargetPer90Minutes($shootingTeams[$fakeIndex]['SoT/90'])
                  ->setGoalPerShoot($shootingTeams[$fakeIndex]['G/Sh'])
                  ->setGoalPerShootOnTarget($shootingTeams[$fakeIndex]['G/SoT'])
                  //passing
                  ->setPassesCompleted($passingTeams[$fakeIndex]['Cmp'])
                  ->setPassesAttempted($passingTeams[$fakeIndex]['Att'])
                  ->setPassCompletion($passingTeams[$fakeIndex]['CmpPER'])
                  ->setShortPassCompleted($passingTeams[$fakeIndex]['shortCmp'])
                  ->setShortPassAttempted($passingTeams[$fakeIndex]['shortAtt'])
                  ->setShortPassCompletion($passingTeams[$fakeIndex]['shortCmpPER'])
                  ->setMediumPassCompleted($passingTeams[$fakeIndex]['mediumCmp'])
                  ->setMediumPassAttempted($passingTeams[$fakeIndex]['mediumAtt'])
                  ->setMediumPassCompletion($passingTeams[$fakeIndex]['mediumCmpPER'])
                  ->setLongPassCompleted($passingTeams[$fakeIndex]['longCmp'])
                  ->setLongPassAttempted($passingTeams[$fakeIndex]['longAtt'])
                  ->setLongPassCompletion($passingTeams[$fakeIndex]['longCmpPER'])
                  ->setPassAttemptedFromFK($passingTeams[$fakeIndex]['FK'])
                  ->setThroughBalls($passingTeams[$fakeIndex]['TB'])
                  ->setCornerKicks($passingTeams[$fakeIndex]['CK'])
                  ->setThrowInsTaken($passingTeams[$fakeIndex]['TI'])
                  ->setPassIntoFinalThird($passingTeams[$fakeIndex]['1/3'])
                  ->setPassIntoPenaltyArea($passingTeams[$fakeIndex]['PPA'])
                  ->setCrossIntoPenaltyArea($passingTeams[$fakeIndex]['CrsPA'])
                  //timming
                  ->setMinutesPlayed($timmingTeams[$fakeIndex]['Min'])
                  ->setSubstitutions($timmingTeams[$fakeIndex]['Subs'])
                  ->setPointPerMatch($timmingTeams[$fakeIndex]['PPM'])
                  //miscellaneous
                  ->setYellowCards($miscellaneousTeams[$fakeIndex]['CrdY'])
                  ->setRedCards($miscellaneousTeams[$fakeIndex]['CrdR'])
                  ->setFoulCommited($miscellaneousTeams[$fakeIndex]['Fls'])
                  ->setFoulDrawn($miscellaneousTeams[$fakeIndex]['Fld'])
                  ->setOffsides($miscellaneousTeams[$fakeIndex]['Off'])
                  ->setCrosses($miscellaneousTeams[$fakeIndex]['Crs'])
                  ->setTacklesWon($miscellaneousTeams[$fakeIndex]['TklW'])
                  ->setInterceptions($miscellaneousTeams[$fakeIndex]['Int'])
                  ->setPenaltyKickWon($miscellaneousTeams[$fakeIndex]['PKwon'])
                  ->setPenaltyKickConceded($miscellaneousTeams[$fakeIndex]['PKcon'])
                  ->setOwnGoal($miscellaneousTeams[$fakeIndex]['OG'])
                  ->setDribblesSucceded($miscellaneousTeams[$fakeIndex]['Succ'])
                  ->setDribblesAttempted($miscellaneousTeams[$fakeIndex]['Att'])
                  ->setDribblesCompletion($miscellaneousTeams[$fakeIndex]['Succ%']);

               $this->em->persist($team);
            } else {
               if (!strpos($verify->getLeague(), $league)) $leagueString = $verify->getLeague() . '+' . $league;
               $verify
                  ->setLeague($leagueString)
                  ->setLevel("")
                  ->setMatchPlayed($verify->getMatchPlayed() + $teams['MP'])
                  ->setGoals($verify->getGoals() + $teams['Gls'])
                  ->setAssists($verify->getAssists() + $teams['Ast'])
                  ->setGoalsAgainst($verify->getGoalsAgainst() + $gkTeams[$fakeIndex]['GA'])
                  ->setGoalsAgainstPerMatch($gkTeams[$fakeIndex]['GA90'])
                  ->setSaves($verify->getSaves() + $gkTeams[$fakeIndex]['Saves'])
                  ->setShootOnTargetAgainst($verify->getShootOnTargetAgainst() + $gkTeams[$fakeIndex]['SoTA'])
                  ->setSavePercent(($verify->getSavePercent() + $gkTeams[$fakeIndex]['Save%']) / 2)
                  ->setCleanSheets($verify->getCleanSheets() + $gkTeams[$fakeIndex]['CS'])
                  ->setCleanSheetPercent(($verify->getCleanSheetPercent() + $gkTeams[$fakeIndex]['CS%']) / 2)
                  ->setPenaltyKickAllowed($verify->getPenaltyKickAllowed() + $gkTeams[$fakeIndex]['PKA'])
                  ->setPenaltyKicksSaved($verify->getPenaltyKicksSaved() + $gkTeams[$fakeIndex]['PKsv'])
                  ->setTopTeamScoorer("")
                  ->setGoalKeeper("")
                  ->setGkPassLaunchedComp($verify->getGkPassLaunchedComp() + $advancedGkTeams[$fakeIndex]['Cmp'])
                  ->setGkPassLaunchedAtt($verify->getGkPassLaunchedAtt() + $advancedGkTeams[$fakeIndex]['AttLaunched'])
                  ->setGkPassLaunchedCompletion(($verify->getGkPassLaunchedCompletion() + $advancedGkTeams[$fakeIndex]['Cmp%']) / 2)
                  ->setGkPassAttempted($verify->getGkPassAttempted() + $advancedGkTeams[$fakeIndex]['AttPass'])
                  ->setGkPassThrows($verify->getGkPassThrows() + $advancedGkTeams[$fakeIndex]['Thr'])
                  ->setGkPassLaunchedPercent(($verify->getGkPassLaunchedPercent() + $advancedGkTeams[$fakeIndex]['PassLaunch%']) / 2)
                  ->setAvgLengthOfPasses($verify->getAvgLengthOfPasses() + $advancedGkTeams[$fakeIndex]['AvgLenPass'])
                  ->setGoalKicksAtt($verify->getGoalKicksAtt() + $advancedGkTeams[$fakeIndex]['AttGks'])
                  ->setGoalKicksLaunchedPercent(($verify->getGoalKicksLaunchedPercent() + $advancedGkTeams[$fakeIndex]['GksLaunch%']) / 2)
                  ->setGoalKicksAvgLength($verify->getGoalKicksAvgLength() + $advancedGkTeams[$fakeIndex]['AvgLenGks'])
                  ->setGkCrossesAttempted($verify->getGkCrossesAttempted() + $advancedGkTeams[$fakeIndex]['Att'])
                  ->setGkCrossesStopped($verify->getGkCrossesStopped() + $advancedGkTeams[$fakeIndex]['Stp'])
                  ->setGkCrossesStpPercent(($verify->getGkCrossesStpPercent() + $advancedGkTeams[$fakeIndex]['Stp%']) / 2)
                  ->setOpa($verify->getOpa() + $advancedGkTeams[$fakeIndex]['#OPA'])
                  ->setOpaPerMatch(($verify->getOpaPerMatch() + $advancedGkTeams[$fakeIndex]['#OPA/90']) / 2)
                  ->setAverageDistance($verify->getAverageDistance() + $advancedGkTeams[$fakeIndex]['AvgDist'])
                  ->setShootOnTarget($verify->getShootOnTarget() + $shootingTeams[$fakeIndex]['SoT'])
                  ->setShootFromFreeKick($verify->getShootFromFreeKick() + $shootingTeams[$fakeIndex]['FK'])
                  ->setShootOnTargetPercent(($verify->getShootOnTargetPercent() + $shootingTeams[$fakeIndex]['SoT%']) / 2)
                  ->setShootPer90Minutes(($verify->getShootPer90Minutes() + $shootingTeams[$fakeIndex]['Sh/90']) / 2)
                  ->setShootOnTargetPer90Minutes(($verify->getShootOnTargetPer90Minutes() + $shootingTeams[$fakeIndex]['SoT/90']) / 2)
                  ->setGoalPerShoot($verify->getGoalPerShoot() + $shootingTeams[$fakeIndex]['G/Sh'])
                  ->setGoalPerShootOnTarget($verify->getGoalPerShootOnTarget() + $shootingTeams[$fakeIndex]['G/SoT'])
                  ->setPassesCompleted($verify->getPassesCompleted() + $passingTeams[$fakeIndex]['Cmp'])
                  ->setPassesAttempted($verify->getPassesAttempted() + $passingTeams[$fakeIndex]['Att'])
                  ->setPassCompletion(($verify->getPassCompletion() + $passingTeams[$fakeIndex]['CmpPER']) / 2)
                  ->setShortPassCompleted($verify->getShortPassCompleted() + $passingTeams[$fakeIndex]['shortCmp'])
                  ->setShortPassAttempted($verify->getShortPassAttempted() + $passingTeams[$fakeIndex]['shortAtt'])
                  ->setShortPassCompletion(($verify->getShortPassCompletion() + $passingTeams[$fakeIndex]['shortCmpPER']) / 2)
                  ->setMediumPassCompleted($verify->getMediumPassCompleted() + $passingTeams[$fakeIndex]['mediumCmp'])
                  ->setMediumPassAttempted($verify->getMediumPassAttempted() + $passingTeams[$fakeIndex]['mediumAtt'])
                  ->setMediumPassCompletion(($verify->getMediumPassCompletion() + $passingTeams[$fakeIndex]['mediumCmpPER']) / 2)
                  ->setLongPassCompleted($verify->getLongPassCompleted() + $passingTeams[$fakeIndex]['longCmp'])
                  ->setLongPassAttempted($verify->getLongPassAttempted() + $passingTeams[$fakeIndex]['longAtt'])
                  ->setLongPassCompletion(($verify->getLongPassCompletion() + $passingTeams[$fakeIndex]['longCmpPER']) / 2)
                  ->setPassAttemptedFromFK($verify->getPassAttemptedFromFK() + $passingTeams[$fakeIndex]['FK'])
                  ->setThroughBalls($verify->getThroughBalls() + $passingTeams[$fakeIndex]['TB'])
                  ->setCornerKicks($verify->getCornerKicks() + $passingTeams[$fakeIndex]['CK'])
                  ->setThrowInsTaken($verify->getThrowInsTaken() + $passingTeams[$fakeIndex]['TI'])
                  ->setPassIntoFinalThird($verify->getPassIntoFinalThird() + $passingTeams[$fakeIndex]['1/3'])
                  ->setPassIntoPenaltyArea($verify->getPassIntoPenaltyArea() + $passingTeams[$fakeIndex]['PPA'])
                  ->setCrossIntoPenaltyArea($verify->getCrossIntoPenaltyArea() + $passingTeams[$fakeIndex]['CrsPA'])
                  ->setMinutesPlayed($verify->getMinutesPlayed() + $timmingTeams[$fakeIndex]['Min'])
                  ->setSubstitutions($verify->getSubstitutions() + $timmingTeams[$fakeIndex]['Subs'])
                  ->setPointPerMatch(($verify->getPointPerMatch() + $timmingTeams[$fakeIndex]['PPM']) / 2)
                  ->setYellowCards($verify->getYellowCards() + $miscellaneousTeams[$fakeIndex]['CrdY'])
                  ->setRedCards($verify->getRedCards() + $miscellaneousTeams[$fakeIndex]['CrdR'])
                  ->setFoulCommited($verify->getFoulCommited() + $miscellaneousTeams[$fakeIndex]['Fls'])
                  ->setFoulDrawn($verify->getFoulDrawn() + $miscellaneousTeams[$fakeIndex]['Fld'])
                  ->setOffsides($verify->getOffsides() + $miscellaneousTeams[$fakeIndex]['Off'])
                  ->setCrosses($verify->getCrosses() + $miscellaneousTeams[$fakeIndex]['Crs'])
                  ->setTacklesWon($verify->getTacklesWon() + $miscellaneousTeams[$fakeIndex]['TklW'])
                  ->setInterceptions($verify->getInterceptions() + $miscellaneousTeams[$fakeIndex]['Int'])
                  ->setPenaltyKickWon($verify->getPenaltyKickWon() + $miscellaneousTeams[$fakeIndex]['PKwon'])
                  ->setPenaltyKickConceded($verify->getGkPassLaunchedComp() + $miscellaneousTeams[$fakeIndex]['PKcon'])
                  ->setOwnGoal($verify->getOwnGoal() + $miscellaneousTeams[$fakeIndex]['OG'])
                  ->setDribblesSucceded($verify->getDribblesSucceded() + $miscellaneousTeams[$fakeIndex]['Succ'])
                  ->setDribblesAttempted($verify->getDribblesAttempted() + $miscellaneousTeams[$fakeIndex]['Att'])
                  ->setDribblesCompletion(($verify->getDribblesCompletion() + $miscellaneousTeams[$fakeIndex]['Succ%']) / 2);

               $this->em->persist($verify);
            }
         }
         $this->em->flush();
      }
   }

   public function import(String $dir)
   {


      $readerOfStandarsData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/standars_data.csv');
      // $readerOfStandarsTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/standars_team_data.csv');
      $readerOfPassingData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/passing_data.csv');
      //  $readerOfPassingTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/passing_team_data.csv');
      $readerOfShootingData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/shooting_data.csv');
      //  $readerOfShootingTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/shooting_team_data.csv');
      $readerOfTimmingData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/timming_data.csv');
      //  $readerOfTimmingTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/timming_team_data.csv');
      $readerOfMiscellaneousData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/miscellaneous_data.csv');
      // $readerOfMiscellaneousTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/miscellaneous_team_data.csv');

      $readerOfStandarsData->setDelimiter(';');
      //  $readerOfStandarsTeamData->setDelimiter(';');
      $readerOfPassingData->setDelimiter(';');
      // $readerOfPassingTeamData->setDelimiter(';');
      $readerOfShootingData->setDelimiter(';');
      // $readerOfShootingTeamData->setDelimiter(';');
      $readerOfTimmingData->setDelimiter(';');
      // $readerOfTimmingTeamData->setDelimiter(';');
      $readerOfMiscellaneousData->setDelimiter(';');
      //  $readerOfMiscellaneousTeamData->setDelimiter(';');



      $standars = $readerOfStandarsData->fetchAssoc();
      $passing = $readerOfPassingData->fetchAssoc();
      $shooting = $readerOfShootingData->fetchAssoc();
      $timming = $readerOfTimmingData->fetchAssoc();
      $miscellaneous = $readerOfMiscellaneousData->fetchAssoc();
      // $standarsTeams = $readerOfStandarsTeamData->fetchAssoc();
      // $passingTeams = $readerOfPassingTeamData->fetchAssoc();
      // $shootingTeams = $readerOfShootingTeamData->fetchAssoc();
      // $timmingTeams = $readerOfTimmingTeamData->fetchAssoc();
      // $miscellaneousTeams = $readerOfMiscellaneousData->fetchAssoc();

      // $permierLeagueTeams = $readerPermierLeagueTeams->fetchAssoc();
      // $permierLeagueTeamsOtherData = $readerPermierLeagueTeamsOtherData->fetchAssoc();

      $standars = iterator_to_array($standars, false);
      $passing = iterator_to_array($passing, false);
      $shooting = iterator_to_array($shooting, false);
      $timming = iterator_to_array($timming, false);
      $miscellaneous = iterator_to_array($miscellaneous, false);
      // $standarsTeams = iterator_to_array($standarsTeams, false);
      // $passingTeams = iterator_to_array($passingTeams, false);
      // $shootingTeams = iterator_to_array($shootingTeams, false);
      // $timmingTeams = iterator_to_array($timmingTeams, false);
      // $miscellaneousTeams = iterator_to_array($miscellaneousTeams, false);
      // $permierLeagueTeams = iterator_to_array($permierLeagueTeams, false);
      // $permierLeagueTeamsOtherData = iterator_to_array($permierLeagueTeamsOtherData, false);

      $comp = 0;


      $this->importTeams($dir);


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

      $io->title('import on loading...');

      $this->import('Spain');
      $this->import('England');
      $this->import('Italy');
      $this->import('France');
      $this->import('Germany');
      $this->import('CL');
      $this->import('EL');

      $io->success('import succesfully');
   }
}
