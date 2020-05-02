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
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

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
   public $fixDataToUpdate = 0;

   public function importTeams(string $league): void
   {

      $readerOfStandarsTeamData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $league . '/standard_team_data.csv');
      $readerOfPassingTeamData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $league . '/passing_team_data.csv');
      $readerOfShootingTeamData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $league . '/shooting_team_data.csv');
      $readerOfTimmingTeamData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $league . '/timming_team_data.csv');
      $readerOfGkTeamData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $league . '/gk_team_data.csv');
      $readerOfAdvancedGkTeamData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $league . '/ad_gk_team_data.csv');
      $readerOfMiscellaneousTeamData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $league . '/miscellaneous_team_data.csv');
      $readerOfTypeOfPassTeamData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $league . '/pass_type_team_data.csv');
      $readerOfDefenseTeamData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $league . '/defense_team_data.csv');
      $readerOfPossessionTeamData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $league . '/possession_team_data.csv');

      $readerOfStandarsTeamData->setDelimiter(';');
      $readerOfPassingTeamData->setDelimiter(';');
      $readerOfShootingTeamData->setDelimiter(';');
      $readerOfTimmingTeamData->setDelimiter(';');
      $readerOfMiscellaneousTeamData->setDelimiter(';');
      $readerOfGkTeamData->setDelimiter(';');
      $readerOfAdvancedGkTeamData->setDelimiter(';');
      $readerOfTypeOfPassTeamData->setDelimiter(';');
      $readerOfDefenseTeamData->setDelimiter(';');
      $readerOfPossessionTeamData->setDelimiter(';');




      $standarsTeams = $readerOfStandarsTeamData->fetchAssoc();
      $passingTeams = $readerOfPassingTeamData->fetchAssoc();
      $shootingTeams = $readerOfShootingTeamData->fetchAssoc();
      $timmingTeams = $readerOfTimmingTeamData->fetchAssoc();
      $miscellaneousTeams = $readerOfMiscellaneousTeamData->fetchAssoc();
      $gkTeams = $readerOfGkTeamData->fetchAssoc();
      $advancedGkTeams = $readerOfAdvancedGkTeamData->fetchAssoc();
      $typePassTeams = $readerOfTypeOfPassTeamData->fetchAssoc();
      $DefenseTeams = $readerOfDefenseTeamData->fetchAssoc();
      $possessionTeams = $readerOfPossessionTeamData->fetchAssoc();




      // $permierLeagueTeams = $readerPermierLeagueTeams->fetchAssoc();
      // $permierLeagueTeamsOtherData = $readerPermierLeagueTeamsOtherData->fetchAssoc();


      $standarsTeams = iterator_to_array($standarsTeams, false);
      $passingTeams = iterator_to_array($passingTeams, false);
      $shootingTeams = iterator_to_array($shootingTeams, false);
      $timmingTeams = iterator_to_array($timmingTeams, false);
      $miscellaneousTeams = iterator_to_array($miscellaneousTeams, false);
      $gkTeams = iterator_to_array($gkTeams, false);
      $advancedGkTeams = iterator_to_array($advancedGkTeams, false);
      $typePassTeams = iterator_to_array($typePassTeams, false);
      $DefenseTeams = iterator_to_array($DefenseTeams, false);
      $possessionTeams = iterator_to_array($possessionTeams, false);







      if (!empty($standarsTeams) and !empty($gkTeams)) {

         // $count = sizeof($standarsTeams);
         // // echo sizeof($gkTeams);
         // echo $count ."\n";
         // echo sizeof($gkTeams)."\n";
         echo "import for " . $league . " league\n";


         foreach ($standarsTeams as $fakeIndex => $teams) {
            //echo sizeof($gkTeams);
            $squad = "";
            $this->fixDataToUpdate = 0;
            if ($league == 'CL' || $league == 'EL') {
               $this->fixDataToUpdate = 1;
               $squad = explode(' ', $teams['Squad'], 2)[1];
            } else $squad = $teams['Squad'];

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
                  /////shooting
                  ->setShootOnTarget($shootingTeams[$fakeIndex]['SoT'] ?? 0)
                  ->setShootFromFreeKick($shootingTeams[$fakeIndex]['FK'] ?? 0)
                  ->setShootOnTargetPercent($shootingTeams[$fakeIndex]['SoT%'] ?? 0)
                  ->setShootPer90Minutes($shootingTeams[$fakeIndex]['Sh/90'] ?? 0)
                  ->setShootOnTargetPer90Minutes($shootingTeams[$fakeIndex]['SoT/90'] ?? 0)
                  ->setGoalPerShoot($shootingTeams[$fakeIndex]['G/Sh'] ?? 0)
                  ->setGoalPerShootOnTarget($shootingTeams[$fakeIndex]['G/SoT'] ?? 0)
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
                  //->setPassAttemptedFromFK($passingTeams[$fakeIndex]['FK'])
                  ->setCornerKicks($passingTeams[$fakeIndex]['CK'])
                  ->setThrowInsTaken($passingTeams[$fakeIndex]['TI'])
                  ->setPassIntoFinalThird($passingTeams[$fakeIndex]['1/3'])
                  ->setPassIntoPenaltyArea($passingTeams[$fakeIndex]['PPA'])
                  ->setCrossIntoPenaltyArea($passingTeams[$fakeIndex]['CrsPA'])
                  //typePass
                  ->setLivePasses($typePassTeams[$fakeIndex]['Live'] ?? 0)
                  ->setDeadPasses($typePassTeams[$fakeIndex]['Dead'] ?? 0)
                  ->setPressPasses($typePassTeams[$fakeIndex]['Press'] ?? 0)
                  ->setSwitchPasses($typePassTeams[$fakeIndex]['Sw'] ?? 0)
                  ->setGroundPasses($typePassTeams[$fakeIndex]['Ground'] ?? 0)
                  ->setPassAttemptedFromFK($typePassTeams[$fakeIndex]['FK'] ?? 0)
                  ->setLowPasses($typePassTeams[$fakeIndex]['Low'] ?? 0)
                  ->setHighPasses($typePassTeams[$fakeIndex]['High'] ?? 0)
                  ->setThroughBalls($typePassTeams[$fakeIndex]['TB'] ?? 0)
                  ->setLeftFootPasses($typePassTeams[$fakeIndex]['Left'] ?? 0)
                  ->setRightFootPasses($typePassTeams[$fakeIndex]['Right'] ?? 0)
                  ->setBlockedPasses($typePassTeams[$fakeIndex]['Blocks'] ?? 0)
                  ->setOffsidesPasses($typePassTeams[$fakeIndex]['Off'] ?? 0)
                  //timming
                  ->setMinutesPlayed($timmingTeams[$fakeIndex]['Min'])
                  ->setSubstitutions($timmingTeams[$fakeIndex]['Subs'])
                  ->setPointPerMatch($timmingTeams[$fakeIndex]['PPM'])
                  //defense
                  ->setTacklesWon($DefenseTeams[$fakeIndex]['TklW'] ?? 0)
                  ->setInterceptions($DefenseTeams[$fakeIndex]['Int'] ?? 0)
                  ->setPressures($DefenseTeams[$fakeIndex]['Press'] ?? 0)
                  ->setPressureSucceded($DefenseTeams[$fakeIndex]['Succ'] ?? 0)
                  ->setPressureCompletion($DefenseTeams[$fakeIndex]['%'] ?? 0)
                  ->setBallBlocked($DefenseTeams[$fakeIndex]['Blocks'] ?? 0)
                  ->setShootBlocked($DefenseTeams[$fakeIndex]['Sh'] ?? 0)
                  ->setShootOnTargetBlocked($DefenseTeams[$fakeIndex]['ShSv'] ?? 0)
                  ->setPassBlocked($DefenseTeams[$fakeIndex]['Pass'] ?? 0)
                  ->setClearances($DefenseTeams[$fakeIndex]['Clr'] ?? 0)
                  ->setErrors($DefenseTeams[$fakeIndex]['Err'] ?? 0)
                  //miscellaneous
                  ->setYellowCards($miscellaneousTeams[$fakeIndex]['CrdY'])
                  ->setRedCards($miscellaneousTeams[$fakeIndex]['CrdR'])
                  ->setFoulCommited($miscellaneousTeams[$fakeIndex]['Fls'])
                  ->setFoulDrawn($miscellaneousTeams[$fakeIndex]['Fld'])
                  ->setOffsides($miscellaneousTeams[$fakeIndex]['Off'])
                  ->setCrosses($miscellaneousTeams[$fakeIndex]['Crs'])
                  //->setTacklesWon($miscellaneousTeams[$fakeIndex]['TklW'])
                  //->setInterceptions($miscellaneousTeams[$fakeIndex]['Int'])
                  ->setPenaltyKickWon($miscellaneousTeams[$fakeIndex]['PKwon'])
                  ->setPenaltyKickConceded($miscellaneousTeams[$fakeIndex]['PKcon'])
                  ->setOwnGoal($miscellaneousTeams[$fakeIndex]['OG'])
                  ->setArialDuelsWon($miscellaneousTeams[$fakeIndex]['Won'])
                  ->setArialDuelsLost($miscellaneousTeams[$fakeIndex]['Lost'])
                  ->setArialDuelsCompletion($miscellaneousTeams[$fakeIndex]['Won%'])
                  //possession
                  ->setDribblesSucceded($possessionTeams[$fakeIndex]['Succ'] ?? 0)
                  ->setDribblesAttempted($possessionTeams[$fakeIndex]['Att'] ?? 0)
                  ->setDribblesCompletion($possessionTeams[$fakeIndex]['Succ%'] ?? 0)
                  ->setBallControlls($possessionTeams[$fakeIndex]['Carries'] ?? 0)
                  ->setBallControllsMoveDistance($possessionTeams[$fakeIndex]['TotDist'] ?? 0)
                  ->setBallControllsMoveDistanceProgressive($possessionTeams[$fakeIndex]['PrgDist'] ?? 0);

               $this->em->persist($team);
            } else {
               // echo $league." ".$verify->getLeague()."\n";
               // $test = strpos($verify->getLeague(), $league);
               // echo $test;

               if ($league != 'CL' and $league != 'EL') {
                  $verify
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
                     ->setShootOnTarget($shootingTeams[$fakeIndex]['SoT'] ?? 0)
                     ->setShootFromFreeKick($shootingTeams[$fakeIndex]['FK'] ?? 0)
                     ->setShootOnTargetPercent($shootingTeams[$fakeIndex]['SoT%'] ?? 0)
                     ->setShootPer90Minutes($shootingTeams[$fakeIndex]['Sh/90'] ?? 0)
                     ->setShootOnTargetPer90Minutes($shootingTeams[$fakeIndex]['SoT/90'] ?? 0)
                     ->setGoalPerShoot($shootingTeams[$fakeIndex]['G/Sh'] ?? 0)
                     ->setGoalPerShootOnTarget($shootingTeams[$fakeIndex]['G/SoT'] ?? 0)
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
                     //->setPassAttemptedFromFK($passingTeams[$fakeIndex]['FK'])
                     //->setThroughBalls($passingTeams[$fakeIndex]['TB'])
                     ->setCornerKicks($passingTeams[$fakeIndex]['CK'])
                     ->setThrowInsTaken($passingTeams[$fakeIndex]['TI'])
                     ->setPassIntoFinalThird($passingTeams[$fakeIndex]['1/3'])
                     ->setPassIntoPenaltyArea($passingTeams[$fakeIndex]['PPA'])
                     ->setCrossIntoPenaltyArea($passingTeams[$fakeIndex]['CrsPA'] ?? 0)
                     //typePass
                     ->setLivePasses($typePassTeams[$fakeIndex]['Live'] ?? 0)
                     ->setDeadPasses($typePassTeams[$fakeIndex]['Dead'] ?? 0)
                     ->setPressPasses($typePassTeams[$fakeIndex]['Press'] ?? 0)
                     ->setSwitchPasses($typePassTeams[$fakeIndex]['Sw'] ?? 0)
                     ->setGroundPasses($typePassTeams[$fakeIndex]['Ground'] ?? 0)
                     ->setPassAttemptedFromFK($typePassTeams[$fakeIndex]['FK'] ?? 0)
                     ->setLowPasses($typePassTeams[$fakeIndex]['Low'] ?? 0)
                     ->setHighPasses($typePassTeams[$fakeIndex]['High'] ?? 0)
                     ->setThroughBalls($typePassTeams[$fakeIndex]['TB'] ?? 0)
                     ->setLeftFootPasses($typePassTeams[$fakeIndex]['Left'] ?? 0)
                     ->setRightFootPasses($typePassTeams[$fakeIndex]['Right'] ?? 0)
                     ->setBlockedPasses($typePassTeams[$fakeIndex]['Blocks'] ?? 0)
                     ->setOffsidesPasses($typePassTeams[$fakeIndex]['Off'] ?? 0)
                     //timming
                     ->setMinutesPlayed($timmingTeams[$fakeIndex]['Min'] ?? 0)
                     ->setSubstitutions($timmingTeams[$fakeIndex]['Subs'] ?? 0)
                     ->setPointPerMatch($timmingTeams[$fakeIndex]['PPM'] ?? 0)
                     //defense
                     ->setTacklesWon($DefenseTeams[$fakeIndex]['TklW'] ?? 0)
                     ->setInterceptions($DefenseTeams[$fakeIndex]['Int'] ?? 0)
                     ->setPressures($DefenseTeams[$fakeIndex]['Press'] ?? 0)
                     ->setPressureSucceded($DefenseTeams[$fakeIndex]['Succ'] ?? 0)
                     ->setPressureCompletion($DefenseTeams[$fakeIndex]['%'] ?? 0)
                     ->setBallBlocked($DefenseTeams[$fakeIndex]['Blocks'] ?? 0)
                     ->setShootBlocked($DefenseTeams[$fakeIndex]['Sh'] ?? 0)
                     ->setShootOnTargetBlocked($DefenseTeams[$fakeIndex]['ShSv'] ?? 0)
                     ->setPassBlocked($DefenseTeams[$fakeIndex]['Pass'] ?? 0)
                     ->setClearances($DefenseTeams[$fakeIndex]['Clr'] ?? 0)
                     ->setErrors($DefenseTeams[$fakeIndex]['Err'] ?? 0)
                     //miscellaneous
                     ->setYellowCards($miscellaneousTeams[$fakeIndex]['CrdY'] ?? 0)
                     ->setRedCards($miscellaneousTeams[$fakeIndex]['CrdR'] ?? 0)
                     ->setFoulCommited($miscellaneousTeams[$fakeIndex]['Fls'] ?? 0)
                     ->setFoulDrawn($miscellaneousTeams[$fakeIndex]['Fld'] ?? 0)
                     ->setOffsides($miscellaneousTeams[$fakeIndex]['Off'] ?? 0)
                     ->setCrosses($miscellaneousTeams[$fakeIndex]['Crs'] ?? 0)
                     //->setTacklesWon($miscellaneousTeams[$fakeIndex]['TklW'])
                     //->setInterceptions($miscellaneousTeams[$fakeIndex]['Int'])
                     ->setPenaltyKickWon($miscellaneousTeams[$fakeIndex]['PKwon'] ?? 0)
                     ->setPenaltyKickConceded($miscellaneousTeams[$fakeIndex]['PKcon'] ?? 0)
                     ->setOwnGoal($miscellaneousTeams[$fakeIndex]['OG'] ?? 0)
                     ->setArialDuelsWon($miscellaneousTeams[$fakeIndex]['Won'] ?? 0)
                     ->setArialDuelsLost($miscellaneousTeams[$fakeIndex]['Lost'] ?? 0)
                     ->setArialDuelsCompletion($miscellaneousTeams[$fakeIndex]['Won%'] ?? 0)
                     //possession
                     ->setDribblesSucceded($possessionTeams[$fakeIndex]['Succ'] ?? 0)
                     ->setDribblesAttempted($possessionTeams[$fakeIndex]['Att'] ?? 0)
                     ->setDribblesCompletion($possessionTeams[$fakeIndex]['Succ%'] ?? 0)
                     ->setBallControlls($possessionTeams[$fakeIndex]['Carries'] ?? 0)
                     ->setBallControllsMoveDistance($possessionTeams[$fakeIndex]['TotDist'] ?? 0)
                     ->setBallControllsMoveDistanceProgressive($possessionTeams[$fakeIndex]['PrgDist'] ?? 0);
                  $this->em->persist($verify);
               } else {
                  if (strpos($verify->getLeague(), $league) >= 0) {
                     $leagueString = $verify->getLeague() . '+' . $league;
                     $verify->setLeague($leagueString)
                        ->setLevel("");
                     $leagueString = "";
                  }
                  $verify
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
                     ->setShootOnTarget($verify->getShootOnTarget() + $shootingTeams[$fakeIndex]['SoT'] ?? 0)
                     ->setShootFromFreeKick($verify->getShootFromFreeKick() + $shootingTeams[$fakeIndex]['FK'] ?? 0)
                     ->setShootOnTargetPercent(($verify->getShootOnTargetPercent() + $shootingTeams[$fakeIndex]['SoT%'] ?? 0) / 2)
                     ->setShootPer90Minutes(($verify->getShootPer90Minutes() + $shootingTeams[$fakeIndex]['Sh/90'] ?? 0) / 2)
                     ->setShootOnTargetPer90Minutes(($verify->getShootOnTargetPer90Minutes() + $shootingTeams[$fakeIndex]['SoT/90'] ?? 0) / 2)
                     ->setGoalPerShoot($verify->getGoalPerShoot() + ($shootingTeams[$fakeIndex]['G/Sh'] ?? 0))
                     ->setGoalPerShootOnTarget($verify->getGoalPerShootOnTarget() + ($shootingTeams[$fakeIndex]['G/SoT'] ?? 0))
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
                     ->setPassAttemptedFromFK($verify->getPassAttemptedFromFK() + ($typePassTeams[$fakeIndex]['FK'] ?? 0))
                     ->setCornerKicks($verify->getCornerKicks() + ($passingTeams[$fakeIndex]['CK'] ?? 0))
                     ->setThrowInsTaken($verify->getThrowInsTaken() + ($passingTeams[$fakeIndex]['TI'] ?? 0))
                     ->setPassIntoFinalThird($verify->getPassIntoFinalThird() + ($passingTeams[$fakeIndex]['1/3'] ?? 0))
                     ->setPassIntoPenaltyArea($verify->getPassIntoPenaltyArea() + ($passingTeams[$fakeIndex]['PPA'] ?? 0))
                     ->setCrossIntoPenaltyArea($verify->getCrossIntoPenaltyArea() + ($passingTeams[$fakeIndex]['CrsPA'] ?? 0))
                     //typePass
                     ->setLivePasses($verify->getLivePasses() + ($typePassTeams[$fakeIndex]['Live'] ?? 0))
                     ->setDeadPasses($verify->getDeadPasses() + ($typePassTeams[$fakeIndex]['Dead'] ?? 0))
                     ->setPressPasses($verify->getPressPasses() + ($typePassTeams[$fakeIndex]['Press'] ?? 0))
                     ->setSwitchPasses($verify->getSwitchPasses() + ($typePassTeams[$fakeIndex]['Sw'] ?? 0))
                     ->setGroundPasses($verify->getGroundPasses() + ($typePassTeams[$fakeIndex]['Ground'] ?? 0))
                     ->setPassAttemptedFromFK($verify->getPassAttemptedFromFK() + ($typePassTeams[$fakeIndex]['FK'] ?? 0))
                     ->setLowPasses($verify->getLowPasses() + ($typePassTeams[$fakeIndex]['Low'] ?? 0))
                     ->setHighPasses($verify->getHighPasses() + ($typePassTeams[$fakeIndex]['High'] ?? 0))
                     ->setThroughBalls($verify->getThroughBalls() + ($typePassTeams[$fakeIndex]['TB'] ?? 0))
                     ->setLeftFootPasses($verify->getLeftFootPasses() + ($typePassTeams[$fakeIndex]['Left'] ?? 0))
                     ->setRightFootPasses($verify->getRightFootPasses() + ($typePassTeams[$fakeIndex]['Right'] ?? 0))
                     ->setBlockedPasses($verify->getBlockedPasses() + ($typePassTeams[$fakeIndex]['Blocks'] ?? 0))
                     ->setOffsidesPasses($verify->getOffsidesPasses() + ($typePassTeams[$fakeIndex]['Off'] ?? 0))
                     ->setMinutesPlayed($verify->getMinutesPlayed() + $timmingTeams[$fakeIndex]['Min'])
                     ->setSubstitutions($verify->getSubstitutions() + $timmingTeams[$fakeIndex]['Subs'])
                     ->setPointPerMatch(($verify->getPointPerMatch() + $timmingTeams[$fakeIndex]['PPM']) / 2)
                     //defense
                     ->setTacklesWon($verify->getTacklesWon() + ($DefenseTeams[$fakeIndex]['TklW']  ?? 0))
                     ->setInterceptions($verify->getInterceptions() + ($DefenseTeams[$fakeIndex]['Int'] ?? 0))
                     ->setPressures($verify->getPressures() + ($DefenseTeams[$fakeIndex]['Press'] ?? 0))
                     ->setPressureSucceded($verify->getPressureSucceded() + ($DefenseTeams[$fakeIndex]['Succ'] ?? 0))
                     ->setPressureCompletion(($verify->getPressureCompletion() + ($DefenseTeams[$fakeIndex]['%'] ?? 0)) / 2)
                     ->setBallBlocked($verify->getBallBlocked() + ($DefenseTeams[$fakeIndex]['Blocks'] ?? 0))
                     ->setShootBlocked($verify->getShootBlocked() + ($DefenseTeams[$fakeIndex]['Sh'] ?? 0))
                     ->setShootOnTargetBlocked($verify->getShootOnTargetBlocked() + ($DefenseTeams[$fakeIndex]['ShSv'] ?? 0))
                     ->setPassBlocked($verify->getPassBlocked() + ($DefenseTeams[$fakeIndex]['Pass'] ?? 0))
                     ->setClearances($verify->getClearances() + ($DefenseTeams[$fakeIndex]['Clr'] ?? 0))
                     ->setErrors($verify->getErrors() + ($DefenseTeams[$fakeIndex]['Err'] ?? 0))

                     ->setYellowCards($verify->getYellowCards() + $miscellaneousTeams[$fakeIndex]['CrdY'])
                     ->setRedCards($verify->getRedCards() + $miscellaneousTeams[$fakeIndex]['CrdR'])
                     ->setFoulCommited($verify->getFoulCommited() + $miscellaneousTeams[$fakeIndex]['Fls'])
                     ->setFoulDrawn($verify->getFoulDrawn() + $miscellaneousTeams[$fakeIndex]['Fld'])
                     ->setOffsides($verify->getOffsides() + $miscellaneousTeams[$fakeIndex]['Off'])
                     ->setCrosses($verify->getCrosses() + $miscellaneousTeams[$fakeIndex]['Crs'])
                     //->setTacklesWon($verify->getTacklesWon() + $miscellaneousTeams[$fakeIndex]['TklW'])
                     //->setInterceptions($verify->getInterceptions() + $miscellaneousTeams[$fakeIndex]['Int'])
                     ->setArialDuelsWon($verify->getArialDuelsWon() + $miscellaneousTeams[$fakeIndex]['Won'])
                     ->setArialDuelsLost($verify->getArialDuelsLost() + $miscellaneousTeams[$fakeIndex]['Lost'])
                     ->setArialDuelsCompletion(($verify->getArialDuelsCompletion() + $miscellaneousTeams[$fakeIndex]['Won%']) / 2)
                     ->setPenaltyKickWon($verify->getPenaltyKickWon() + $miscellaneousTeams[$fakeIndex]['PKwon'])
                     ->setPenaltyKickConceded($verify->getGkPassLaunchedComp() + $miscellaneousTeams[$fakeIndex]['PKcon'])
                     ->setOwnGoal($verify->getOwnGoal() + $miscellaneousTeams[$fakeIndex]['OG'])
                     ->setDribblesSucceded($verify->getDribblesSucceded() + (empty($possessionTeams[$fakeIndex]['Succ']) ? 0 : $possessionTeams[$fakeIndex]['Succ']))
                     ->setDribblesAttempted($verify->getDribblesAttempted() + (empty($possessionTeams[$fakeIndex]['Att']) ? 0 : $possessionTeams[$fakeIndex]['Att']))
                     ->setDribblesCompletion(($verify->getDribblesCompletion() + (empty($possessionTeams[$fakeIndex]['Succ%']) ? 0 : $possessionTeams[$fakeIndex]['Succ%'])) / 2)
                     ->setBallControlls($verify->getBallControlls() + (empty($possessionTeams[$fakeIndex]['Carries']) ? 0 : $possessionTeams[$fakeIndex]['Carries']))
                     ->setBallControllsMoveDistance($verify->getBallControllsMoveDistance() + (empty($possessionTeams[$fakeIndex]['TotDist']) ? 0 : $possessionTeams[$fakeIndex]['TotDist']))
                     ->setBallControllsMoveDistanceProgressive($verify->getBallControllsMoveDistanceProgressive() + (empty($possessionTeams[$fakeIndex]['PrgDist']) ? 0 : $possessionTeams[$fakeIndex]['PrgDist']));

                  $this->em->persist($verify);
               }
            }
         }
         $this->em->flush();
      }
   }
   ////////////////////////////  je suis arrivé jusqu'ici //////////////////
   public function import(String $dir)
   {


      $readerOfStandarsData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $dir . '/standard_data.csv');
      // $readerOfStandarsTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/standars_team_data.csv');
      $readerOfPassingData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $dir . '/passing_data.csv');
      //  $readerOfPassingTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/passing_team_data.csv');
      $readerOfShootingData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $dir . '/shooting_data.csv');
      //  $readerOfShootingTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/shooting_team_data.csv');
      $readerOfTimmingData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $dir . '/timming_data.csv');
      //  $readerOfTimmingTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/timming_team_data.csv');
      $readerOfMiscellaneousData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $dir . '/miscellaneous_data.csv');
      // $readerOfMiscellaneousTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/miscellaneous_team_data.csv');
      $readerOfTypePassData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $dir . '/pass_type_data.csv');
      // $readerOfMiscellaneousTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/miscellaneous_team_data.csv');
      $readerOfDefenseData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $dir . '/defense_data.csv');
      // $readerOfMiscellaneousTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/miscellaneous_team_data.csv');
      $readerOfPossessionData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $dir . '/possession_data.csv');
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
      $readerOfTypePassData->setDelimiter(';');
      //  $readerOfMiscellaneousTeamData->setDelimiter(';');
      $readerOfDefenseData->setDelimiter(';');
      //  $readerOfMiscellaneousTeamData->setDelimiter(';');
      $readerOfPossessionData->setDelimiter(';');
      //  $readerOfMiscellaneousTeamData->setDelimiter(';');





      $standars = $readerOfStandarsData->fetchAssoc();
      $passing = $readerOfPassingData->fetchAssoc();
      $shooting = $readerOfShootingData->fetchAssoc();
      $timming = $readerOfTimmingData->fetchAssoc();
      $miscellaneous = $readerOfMiscellaneousData->fetchAssoc();
      $typePass = $readerOfTypePassData->fetchAssoc();
      $defense = $readerOfDefenseData->fetchAssoc();
      $possession = $readerOfPossessionData->fetchAssoc();

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
      $typePass = iterator_to_array($typePass, false);
      $defense = iterator_to_array($defense, false);
      $possession = iterator_to_array($possession, false);

      // $standarsTeams = iterator_to_array($standarsTeams, false);
      // $passingTeams = iterator_to_array($passingTeams, false);
      // $shootingTeams = iterator_to_array($shootingTeams, false);
      // $timmingTeams = iterator_to_array($timmingTeams, false);
      // $miscellaneousTeams = iterator_to_array($miscellaneousTeams, false);
      // $permierLeagueTeams = iterator_to_array($permierLeagueTeams, false);
      // $permierLeagueTeamsOtherData = iterator_to_array($permierLeagueTeamsOtherData, false);

      $comp = 0;

      $output = new ConsoleOutput();
      $length = sizeOf($timming);
      $bar1 = new ProgressBar($output, $length);
      print "\n";

      $this->importTeams($dir);
      $bar1->start();
      foreach ($timming as $fakeindex => $row) {

         $bar1->advance();
         print "\n";
         $output->write("\033[1A");
         usleep(100000);
         $comp++;
         $index = $fakeindex;
         if ($dir == 'CL' || $dir == 'EL') $squad = explode(' ', $row['Squad'], 2)[1];
         else $squad = $row['Squad'];

         $name = explode("\\", $row['name'], 2)[1];
         $verify = $this->em->getRepository(Player::class)
            ->findOneBy([
               'Name' => $name,
               'born' => $row['born'],
               'position' =>  $row['position'],
               'squad' => $squad
            ]);


         if (empty($verify)) {
            $player = (new player())
               ->setIdPlayer($comp)
               ->setName($name)
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
               ->setAssists(0)
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
               ->setCrossIntoPenaltyArea(0)
               ->setLivePass(0)
               ->setDeadPasses(0)
               ->setPressPasses(0)
               ->setSwitchPasses(0)
               ->setGroundPasses(0)
               ->setLowPasses(0)
               ->setHighPasses(0)
               ->setLeftFootPasses(0)
               ->setRightFootPasses(0)
               ->setBlockedPasses(0)
               ->setPassAttemptedFromFK(0)
               ->setOffsidesPasses(0)
               ->setPressures(0)
               ->setPressureSucceded(0)
               ->setPressureCompletion(0)
               ->setBallBlocked(0)
               ->setShootBlocked(0)
               ->setShootOntTargetBlocked(0)
               ->setPassBlocked(0)
               ->setClearances(0)
               ->setErrors(0)
               ->setArialDuelsWon(0)
               ->setArialDuelsLost(0)
               ->setArialDuelsCompletion(0)
               ->setBallControlls(0)
               ->setBallControllsMoveDistance(0)
               ->setBallControllsMoveDistanceProgressive(0)
               ->setReceivingBallAttempted(0)
               ->setReceivingBallCompleted(0)
               ->setReceivingBallCompletion(0)
               ->setMisControlls(0)
               ->setDispossessed(0);


            if ($index > count($standars) - 1) {
               $index = 0;
            }
            if ($row['name'] == $standars[$index]['name']) {

               $player->setMatchsPlayed(intval($standars[$index]['MP'] ?? 0))
                  ->setMatchStarts(intval($standars[$index]['Starts'] ?? 0))
                  ->setMinsPlayed(intval($standars[$index]['Min'] ?? 0))
                  ->setGoals(intval($standars[$index]['Gls'] ?? 0))
                  ->setAssists(intval($standars[$index]['Ast'] ?? 0))
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
                        ->setAssists(intval($standars[$i]['Ast'] ?? 0))
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
            if ($row['name'] == (!empty($shooting[$index]['name']))) {
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

                  if ($row['name'] == (!empty($shooting[$i]['name']))) {

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
            if ($row['name'] == (!empty($passing[$index]['name']))) {
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
                  //->setThroughBalls(intval($passing[$index]['TB'] ?? 0))
                  ->setCrossIntoPenaltyArea(floatval($passing[$index]['CrsPA'] ?? 0.0));
            } else {
               for ($i = 0; $i <= count($passing) - 1; $i++) {

                  if ($row['name'] == (!empty($passing[$i]['name']))) {
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
                        //->setThroughBalls(intval($passing[$i]['TB'] ?? 0))
                        ->setCrossIntoPenaltyArea(floatval($passing[$i]['CrsPA'] ?? 0.0));
                     break;
                  }
               }
            }
            /////////////////////////////////////////////////////////////////////////////////
            $index = $fakeindex;
            if ($index > count($typePass) - 1) {
               $index = 0;
            }
            if ($row['name'] == (!empty($typePass[$index]['name']))) {
               $player->setLivePass(intval($typePass[$index]['KP'] ?? 0))
                  ->setDeadPasses(intval($typePass[$index]['Dead'] ?? 0))
                  ->setPressPasses(intval($typePass[$index]['Press'] ?? 0))
                  ->setSwitchPasses(floatval($typePass[$index]['Sw'] ?? 0.0))
                  ->setGroundPasses(intval($typePass[$index]['Ground'] ?? 0))
                  ->setLowPasses(intval($typePass[$index]['Low'] ?? 0))
                  ->setHighPasses(floatval($typePass[$index]['High'] ?? 0.0))
                  ->setLeftFootPasses(intval($typePass[$index]['Left'] ?? 0))
                  ->setRightFootPasses(intval($typePass[$index]['Right'] ?? 0))
                  ->setBlockedPasses(floatval($typePass[$index]['Blocks'] ?? 0.0))
                  ->setOffsidesPasses(intval($typePass[$index]['Off'] ?? 0))
                  ->setPassAttemptedFromFK(intval($typePass[$index]['FK'] ?? 0))
                  ->setThroughBalls(intval($typePass[$index]['TB'] ?? 0));
            } else {
               for ($i = 0; $i <= count($typePass) - 1; $i++) {

                  if ($row['name'] == (!empty($typePass[$i]['name']))) {
                     $player->setLivePass(intval($typePass[$i]['KP'] ?? 0))
                        ->setDeadPasses(intval($typePass[$i]['Dead'] ?? 0))
                        ->setPressPasses(intval($typePass[$i]['Press'] ?? 0))
                        ->setSwitchPasses(floatval($typePass[$i]['Sw'] ?? 0.0))
                        ->setGroundPasses(intval($typePass[$i]['Ground'] ?? 0))
                        ->setLowPasses(intval($typePass[$i]['Low'] ?? 0))
                        ->setHighPasses(floatval($typePass[$i]['High'] ?? 0.0))
                        ->setLeftFootPasses(intval($typePass[$i]['Left'] ?? 0))
                        ->setRightFootPasses(intval($typePass[$i]['Right'] ?? 0))
                        ->setBlockedPasses(floatval($typePass[$i]['Blocks'] ?? 0.0))
                        ->setOffsidesPasses(intval($typePass[$i]['Off'] ?? 0))
                        ->setPassAttemptedFromFK(intval($typePass[$i]['FK'] ?? 0))
                        ->setThroughBalls(intval($typePass[$i]['TB'] ?? 0));
                     break;
                  }
               }
            }
            ////////////////////////////////////////////////////////////////////////////////
            $index = $fakeindex;
            if ($index > count($defense) - 1 and count($defense) > 1) {
               $index = 0;
            }
            if ($row['name'] == (!empty($defense[$index]['name']))) {
               $player->setTacklesWon(intval($defense[$index]['TklW'] ?? 0))
                  ->setInterceptions(intval($defense[$index]['Int'] ?? 0))
                  ->setPressures(intval($defense[$index]['Press'] ?? 0))
                  ->setPressureSucceded(intval($defense[$index]['Succ'] ?? 0))
                  ->setPressureCompletion(intval($defense[$index]['%'] ?? 0))
                  ->setBallBlocked(floatval($defense[$index]['Blocks'] ?? 0.0))
                  ->setShootBlocked(intval($defense[$index]['Sh'] ?? 0))
                  ->setShootOntTargetBlocked(intval($defense[$index]['ShSv'] ?? 0))
                  ->setPassBlocked(floatval($defense[$index]['Pass'] ?? 0.0))
                  ->setDribbleTackled(intval($defense[$index]['Tkl'] ?? 0))
                  ->setDribbleTackledPercent(floatval($defense[$index]['Tkl%'] ?? 0.0))
                  ->setTimesDribbledPast(intval($defense[$index]['Past'] ?? 0))
                  ->setClearances(intval($defense[$index]['Clr'] ?? 0))
                  ->setErrors(intval($defense[$index]['Err'] ?? 0));
            } else {
               for ($i = 0; $i <= count($defense) - 1; $i++) {

                  if ($row['name'] == (!empty($defense[$i]['name']))) {
                     $player->setTacklesWon(intval($defense[$i]['TklW'] ?? 0))
                        ->setInterceptions(intval($defense[$i]['Int'] ?? 0))
                        ->setPressures(intval($defense[$i]['Press'] ?? 0))
                        ->setPressureSucceded(intval($defense[$i]['Succ'] ?? 0))
                        ->setPressureCompletion(intval($defense[$i]['%'] ?? 0))
                        ->setBallBlocked(floatval($defense[$i]['Blocks'] ?? 0.0))
                        ->setShootBlocked(intval($defense[$i]['Sh'] ?? 0))
                        ->setShootOntTargetBlocked(intval($defense[$i]['ShSv'] ?? 0))
                        ->setDribbleTackled(intval($defense[$i]['Tkl'] ?? 0))
                        ->setDribbleTackledPercent(floatval($defense[$i]['Tkl%'] ?? 0.0))
                        ->setTimesDribbledPast(intval($defense[$i]['Past'] ?? 0))
                        ->setPassBlocked(floatval($defense[$i]['Pass'] ?? 0.0))
                        ->setClearances(intval($defense[$i]['Clr'] ?? 0))
                        ->setErrors(intval($defense[$i]['Err'] ?? 0));
                     break;
                  }
               }
            }
            ///////////////////////////////////////////////////////////////////////////////
            $index = $fakeindex;
            if ($index > count($miscellaneous) - 1   and count($miscellaneous) > 1)  {
               $index = 0;
            }
            if ($row['name'] == $miscellaneous[$index]['name']) {

               $player->setFoulsCommited(intval($miscellaneous[$index]['Fls'] ?? 0))
                  ->setFoulsDrawn(intval($miscellaneous[$index]['Fld'] ?? 0))
                  ->setOffsides(intval($miscellaneous[$index]['Off'] ?? 0))
                  ->setCrosses(intval($miscellaneous[$index]['Crs'] ?? 0))
                  // ->setTacklesWon(intval($miscellaneous[$index]['TklW'] ?? 0))
                  // ->setInterceptions(intval($miscellaneous[$index]['Int'] ?? 0))
                  ->setPenaltyKicksWon(intval($miscellaneous[$index]['PKwon'] ?? 0))
                  ->setPenaltyKicksConceded(intval($miscellaneous[$index]['PKcon'] ?? 0))
                  ->setOwnGoal(intval($miscellaneous[$index]['OG'] ?? 0))
                  ->setDribbleCompleted(intval($miscellaneous[$index]['Succ'] ?? 0))
                  ->setDribbleAttempted(intval($miscellaneous[$index]['Att'] ?? 0))
                  ->setDribblePercent(floatval($miscellaneous[$index]['Succ%'] ?? 0.0))
                  ->setNumberOfPlayerDriblled(intval($miscellaneous[$index]['#Pl'] ?? 0))
                  ->setNutmegs(intval($miscellaneous[$index]['Megs'] ?? 0))
                  ->setSecondYellowCard(intval($miscellaneous[$index]['2CrdY']))
                  ->setArialDuelsWon(intval($miscellaneous[$index]['Won']))
                  ->setArialDuelsLost(intval($miscellaneous[$index]['Lost']))
                  ->setArialDuelsCompletion(floatval($miscellaneous[$index]['Won%']));
            } else {
               for ($i = 0; $i <= count($miscellaneous) - 1; $i++) {

                  if ($row['name'] == $miscellaneous[$i]['name']) {

                     $player->setFoulsCommited(intval($miscellaneous[$i]['Fls'] ?? 0))
                        ->setFoulsDrawn(intval($miscellaneous[$i]['Fld'] ?? 0))
                        ->setOffsides(intval($miscellaneous[$i]['Off'] ?? 0))
                        ->setCrosses(intval($miscellaneous[$i]['Crs'] ?? 0))
                        // ->setTacklesWon(intval($miscellaneous[$i]['TklW'] ?? 0))
                        // ->setInterceptions(intval($miscellaneous[$i]['Int'] ?? 0))
                        ->setPenaltyKicksWon(intval($miscellaneous[$i]['PKwon'] ?? 0))
                        ->setPenaltyKicksConceded(intval($miscellaneous[$i]['PKcon'] ?? 0))
                        ->setOwnGoal(intval($miscellaneous[$i]['OG'] ?? 0))
                        ->setDribbleCompleted(intval($miscellaneous[$i]['Succ'] ?? 0))
                        ->setDribbleAttempted(intval($miscellaneous[$i]['Att'] ?? 0))
                        ->setDribblePercent(floatval($miscellaneous[$i]['Succ%'] ?? 0.0))
                        ->setNumberOfPlayerDriblled(intval($miscellaneous[$i]['#Pl'] ?? 0))
                        ->setNutmegs(intval($miscellaneous[$i]['Megs'] ?? 0))
                        ->setSecondYellowCard(intval($miscellaneous[$i]['2CrdY'] ?? 0))
                        ->setArialDuelsWon(intval($miscellaneous[$i]['Won']))
                        ->setArialDuelsLost(intval($miscellaneous[$i]['Lost']))
                        ->setArialDuelsCompletion(floatval($miscellaneous[$i]['Won%']));
                     break;
                  }
               }
            }
            /////////////////////////////////////////////////////////////////////
            $index = $fakeindex;
            if ($index > count($possession) - 1 and count($possession) > 1) {
               $index = 0;
            }
            if ($row['name'] == (empty($possession[$index]['name']) ? "" :$possession[$index]['name'])) {
               $player->setBallControlls(intval($possession[$index]['Carries'] ?? 0))
                  ->setBallControllsMoveDistance(intval($possession[$index]['TotDist'] ?? 0))
                  ->setBallControllsMoveDistanceProgressive(intval($possession[$index]['PrgDist'] ?? 0))
                  ->setReceivingBallAttempted(intval($possession[$index]['Targ'] ?? 0))
                  ->setReceivingBallCompleted(intval($possession[$index]['Rec'] ?? 0))
                  ->setReceivingBallCompletion(floatval($possession[$index]['Rec%'] ?? 0.0))
                  ->setMisControlls(intval($possession[$index]['Miscon'] ?? 0))
                  ->setDispossessed(intval($possession[$index]['Dispos'] ?? 0));
            } else {
               for ($i = 0; $i <= count($possession) - 1; $i++) {

                  if ($row['name'] == (empty($possession[$i]['name']) ? "" :$possession[$index]['name'])) {
                     $player->setBallControlls(intval($possession[$i]['Carries'] ?? 0))
                        ->setBallControllsMoveDistance(intval($possession[$i]['TotDist'] ?? 0))
                        ->setBallControllsMoveDistanceProgressive(intval($possession[$i]['PrgDist'] ?? 0))
                        ->setReceivingBallAttempted(intval($possession[$i]['Targ'] ?? 0))
                        ->setReceivingBallCompleted(intval($possession[$i]['Rec'] ?? 0))
                        ->setReceivingBallCompletion(floatval($possession[$i]['Rec%'] ?? 0.0))
                        ->setMisControlls(intval($possession[$i]['Miscon'] ?? 0))
                        ->setDispossessed(intval($possession[$i]['Dispos'] ?? 0));
                     break;
                  }
               }
            }
            ////////////////////////////////////////////////////////////////


            $this->em->persist($player);
         } else {
          
            $verify->setMinutesPlayed(($verify->setMinutesPlayed() * $this->fixDataToUpdate) + intval($row['Min'] ?? 0))
               ->setMinutesPercentPlayed((($verify->setMinutesPercentPlayed() * $this->fixDataToUpdate) +floatval($row['Min%'] ?? 0.0)) / 2)
               ->setNintyMinPlayed((($verify->setNintyMinPlayed() * $this->fixDataToUpdate) +floatval($row['90s'] ?? 0.0)) / 2)
               ->setMinPerMatchStarted((($verify->setMinPerMatchStarted() * $this->fixDataToUpdate) +floatval($row['Mn/Start'] ?? 0.0)) / 2)
               ->setPointsPerMatch((($verify->setPointsPerMatch() * $this->fixDataToUpdate) +floatval($row['PPM'] ?? 0.0)) / 2);

            if ($index > count($standars) - 1) {
               $index = 0;
            }
            if ($row['name'] == $standars[$index]['name']) {

               $verify->setMatchsPlayed(($verify->setMatchsPlayed() * $this->fixDataToUpdate) + intval($standars[$index]['MP'] ?? 0))
                  ->setMatchStarts(($verify->setMatchStarts() * $this->fixDataToUpdate) + intval($standars[$index]['Starts'] ?? 0))
                  ->setMinsPlayed(($verify->setMinsPlayed() * $this->fixDataToUpdate) + intval($standars[$index]['Min'] ?? 0))
                  ->setGoals(($verify->setGoals() * $this->fixDataToUpdate) + intval($standars[$index]['Gls'] ?? 0))
                  ->setAssists(($verify->setAssists() * $this->fixDataToUpdate) + intval($standars[$index]['Ast'] ?? 0))
                  ->setPkMade(($verify->setPkMade() * $this->fixDataToUpdate) + intval($standars[$index]['PK'] ?? 0))
                  ->setPkAttempted(($verify->setPkAttempted() * $this->fixDataToUpdate) + intval($standars[$index]['PKatt'] ?? 0))
                  ->setYellowCard(($verify->setYellowCard() * $this->fixDataToUpdate) + intval($standars[$index]['CrdY'] ?? 0))
                  ->setRedCard(($verify->setRedCard() * $this->fixDataToUpdate) + intval($standars[$index]['CrdR'] ?? 0))
                  ->setGoalsPerMin((($verify->setGoalsPerMin() * $this->fixDataToUpdate) + floatval($standars[$index]['Gls_per_match'] ?? 0.0)) / 2)
                  ->setAssistsPerMin((($verify->setAssistsPerMin() * $this->fixDataToUpdate) + floatval($standars[$index]['Ast_per_match'] ?? 0.0)) / 2)
                  ->setGlsAssPerMin((($verify->setGlsAssPerMin() * $this->fixDataToUpdate) + floatval($standars[$index]['G_A_per_match'] ?? 0.0)) / 2)
                  ->setGoalsWithoutPkPerMin((($verify->setGoalsWithoutPkPerMin() * $this->fixDataToUpdate) + floatval($standars[$index]['G_PK_per_match'] ?? 0.0)) / 2)
                  ->setGlsAssWithoutPkPerMin((($verify->setGlsAssWithoutPkPerMin() * $this->fixDataToUpdate) + floatval($standars[$index]['G_A_PK_per_match'] ?? 0.0)) / 2)
                  ->setGoalsExp((($verify->setGoalsExp() * $this->fixDataToUpdate) + floatval($standars[$index]['xG'] ?? 0.0)) / 2)
                  ->setNonPenGoalsExp((($verify->setNonPenGoalsExp() * $this->fixDataToUpdate) + floatval($standars[$index]['npxG'] ?? 0.0)) / 2)
                  ->setAssistsExp((($verify->setAssistsExp() * $this->fixDataToUpdate) + floatval($standars[$index]['xA'] ?? 0.0)) / 2)
                  ->setGoalsPerMinExp((($verify->setGoalsPerMinExp() * $this->fixDataToUpdate) + floatval($standars[$index]['xG_per_match'] ?? 0.0)) / 2)
                  ->setAssistsPerMinExp((($verify->setAssistsPerMinExp() * $this->fixDataToUpdate) + floatval($standars[$index]['xA_per_match'] ?? 0.0)) / 2)
                  ->setGlsAssistsPerMinExp((($verify->setGlsAssistsPerMinExp() * $this->fixDataToUpdate) + floatval($standars[$index]['xG_xA'] ?? 0.0)) / 2)
                  ->setNonPenGoalsExpPerMin((($verify->setNonPenGoalsExpPerMin() * $this->fixDataToUpdate) + floatval($standars[$index]['npxG_per_match'] ?? 0.0)) / 2)
                  ->setNonPenGoalsAssistsExpPerMin((($verify->setNonPenGoalsAssistsExpPerMin() * $this->fixDataToUpdate) + floatval($standars[$index]['npxG_xA'] ?? 0.0)) / 2);
            } else {

               for ($i = 0; $i <= count($standars) - 1; $i++) {
                  $comp++;
                  if ($row['name'] == $standars[$i]['name']) {

                     $verify->setMatchsPlayed(($verify->setMatchsPlayed() * $this->fixDataToUpdate) + intval($standars[$i]['MP'] ?? 0))
                        ->setMatchStarts(($verify->setMatchStarts() * $this->fixDataToUpdate) + intval($standars[$i]['Starts'] ?? 0))
                        ->setMinsPlayed(($verify->setMinsPlayed() * $this->fixDataToUpdate) + intval($standars[$i]['Min'] ?? 0))
                        ->setGoals(($verify->setGoals() * $this->fixDataToUpdate) + intval($standars[$i]['Gls'] ?? 0))
                        ->setAssists(($verify->setAssists() * $this->fixDataToUpdate) + intval($standars[$i]['Ast'] ?? 0))
                        ->setPkMade(($verify->setPkMade() * $this->fixDataToUpdate) + intval($standars[$i]['PK'] ?? 0))
                        ->setPkAttempted(($verify->setPkAttempted() * $this->fixDataToUpdate) + intval($standars[$i]['PKatt'] ?? 0))
                        ->setYellowCard(($verify->setYellowCard() * $this->fixDataToUpdate) + intval($standars[$i]['CrdY'] ?? 0))
                        ->setRedCard(($verify->setRedCard() * $this->fixDataToUpdate) + intval($standars[$i]['CrdR'] ?? 0))
                        ->setGoalsPerMin((($verify->setGoalsPerMin() * $this->fixDataToUpdate) + floatval($standars[$i]['Gls_per_match'] ?? 0.0)) / 2)
                        ->setAssistsPerMin((($verify->setAssistsPerMin() * $this->fixDataToUpdate) + floatval($standars[$i]['Ast_per_match'] ?? 0.0)) / 2)
                        ->setGlsAssPerMin((($verify->setGlsAssPerMin() * $this->fixDataToUpdate) + floatval($standars[$i]['G_A_per_match'] ?? 0.0)) / 2)
                        ->setGoalsWithoutPkPerMin((($verify->setGoalsWithoutPkPerMin() * $this->fixDataToUpdate) + floatval($standars[$i]['G_PK_per_match'] ?? 0.0)) / 2)
                        ->setGlsAssWithoutPkPerMin((($verify->setGlsAssWithoutPkPerMin() * $this->fixDataToUpdate) + floatval($standars[$i]['G_A_PK_per_match'] ?? 0.0)) / 2)
                        ->setGoalsExp((($verify->setGoalsExp() * $this->fixDataToUpdate) + floatval($standars[$i]['xG'] ?? 0.0)) / 2)
                        ->setNonPenGoalsExp((($verify->setNonPenGoalsExp() * $this->fixDataToUpdate) + floatval($standars[$i]['npxG'] ?? 0.0)) / 2)
                        ->setAssistsExp((($verify->setAssistsExp() * $this->fixDataToUpdate) + floatval($standars[$i]['xA'] ?? 0.0)) / 2)
                        ->setGoalsPerMinExp((($verify->setGoalsPerMinExp() * $this->fixDataToUpdate) + floatval($standars[$i]['xG_per_match'] ?? 0.0)) / 2)
                        ->setAssistsPerMinExp((($verify->setAssistsPerMinExp() * $this->fixDataToUpdate) + floatval($standars[$i]['xA_per_match'] ?? 0.0)) / 2)
                        ->setGlsAssistsPerMinExp((($verify->setGlsAssistsPerMinExp() * $this->fixDataToUpdate) + floatval($standars[$i]['xG_xA'] ?? 0.0)) / 2)
                        ->setNonPenGoalsExpPerMin((($verify->setNonPenGoalsExpPerMin() * $this->fixDataToUpdate) + floatval($standars[$i]['npxG_per_match'] ?? 0.0)) / 2)
                        ->setNonPenGoalsAssistsExpPerMin((($verify->setNonPenGoalsAssistsExpPerMin() * $this->fixDataToUpdate) + floatval($standars[$i]['npxG_xA'] ?? 0.0)) / 2);
                     break;
                  }
               }
            }

            $index = $fakeindex;
            if ($index > count($shooting) - 1 and count($shooting) > 1) {
               $index = 0;
            }
            if ($row['name'] == (!empty($shooting[$index]['name']))) {
               $verify->setShoots(($verify->setShoots() * $this->fixDataToUpdate) + intval($shooting[$index]['Sh'] ?? 0))
                  ->setShootsOnTarget(($verify->setShootsOnTarget() * $this->fixDataToUpdate) + intval($shooting[$index]['SoT'] ?? 0))
                  ->setShootsFromFrKc(($verify->setShootsFromFrKc() * $this->fixDataToUpdate) + intval($shooting[$index]['FK'] ?? 0))
                  ->setShootsOnTargetPc((($verify->setShootsOnTargetPc() * $this->fixDataToUpdate) + floatval($shooting[$index]['SoT%'] ?? 0.0)) / 2)
                  ->setShootsPerMatch((($verify->setShootsPerMatch() * $this->fixDataToUpdate) + floatval($shooting[$index]['Sh/90'] ?? 0.0)) / 2)
                  ->setShootsOnTargetPerMatch((($verify->setShootsOnTargetPerMatch() * $this->fixDataToUpdate) + floatval($shooting[$index]['SoT/90'] ?? 0.0)) / 2)
                  ->setGoalsPerShoot((($verify->setGoalsPerShoot() * $this->fixDataToUpdate) + floatval($shooting[$index]['G/Sh'] ?? 0.0)) / 2)
                  ->setGoalPerShootOnTarget((($verify->setGoalPerShootOnTarget() * $this->fixDataToUpdate) + floatval($shooting[$index]['G/SoT'] ?? 0.0)) / 2);
            } else {
               for ($i = 0; $i <= count($shooting) - 1; $i++) {

                  if ($row['name'] == (!empty($shooting[$i]['name']))) {

                     $verify->setShoots(($verify->setShoots() * $this->fixDataToUpdate) + intval($shooting[$i]['Sh'] ?? 0))
                        ->setShootsOnTarget(($verify->setShootsOnTarget() * $this->fixDataToUpdate) + intval($shooting[$i]['SoT'] ?? 0))
                        ->setShootsFromFrKc(($verify->setShootsFromFrKc() * $this->fixDataToUpdate) + intval($shooting[$i]['FK'] ?? 0))
                        ->setShootsOnTargetPc((($verify->setShootsOnTargetPc() * $this->fixDataToUpdate) + floatval($shooting[$i]['SoT%'] ?? 0.0)) / 2)
                        ->setShootsPerMatch((($verify->setShootsPerMatch() * $this->fixDataToUpdate) + floatval($shooting[$i]['Sh/90'] ?? 0.0)) / 2)
                        ->setShootsOnTargetPerMatch((($verify->setShootsOnTargetPerMatch() * $this->fixDataToUpdate) + floatval($shooting[$i]['SoT/90'] ?? 0.0)) / 2)
                        ->setGoalsPerShoot((($verify->setGoalsPerShoot() * $this->fixDataToUpdate) + floatval($shooting[$i]['G/Sh'] ?? 0.0)) / 2)
                        ->setGoalPerShootOnTarget((($verify->setGoalPerShootOnTarget() * $this->fixDataToUpdate) + floatval( $shooting[$i]['G/SoT'] ?? 0.0)) / 2);
                     break;
                  }
               }
            }




            $index = $fakeindex;
            if ($index > count($passing) - 1) {
               $index = 0;
            }
            if ($row['name'] == (!empty($passing[$index]['name']))) {
               $verify->setKeyPasses(($verify->setKeyPasses() * $this->fixDataToUpdate) + intval($passing[$index]['KP']))
                  ->setPassesCompleted(($verify->setPassesCompleted() * $this->fixDataToUpdate) + intval($passing[$index]['Cmp']))
                  ->setPassesAttempted(($verify->setPassesAttempted() * $this->fixDataToUpdate) + intval($passing[$index]['Att'] ?? 0.0))
                  ->setPassCompPercent((($verify->setPassCompPercent() * $this->fixDataToUpdate) + floatval($passing[$index]['CmpPER'])) / 2)
                  ->setShortPassesCompleted(($verify->setShortPassesCompleted() * $this->fixDataToUpdate) + intval($passing[$index]['shortCmp']))
                  ->setShortpassesAttempted($verify->setShortpassesAttempted() * $this->fixDataToUpdate) + (intval($passing[$index]['shortAtt']))
                  ->setShortPassesCompPercent((($verify->setShortPassesCompPercent() * $this->fixDataToUpdate) + floatval($passing[$index]['shortCmpPER'] ?? 0.0)) / 2)
                  ->setMediumPassesCompleted(($verify->setMediumPassesCompleted() * $this->fixDataToUpdate) + intval($passing[$index]['mediumCmp']))
                  ->setMediumPassesAttempted(($verify->setMediumPassesAttempted() * $this->fixDataToUpdate) + intval($passing[$index]['mediumAtt'] ?? 0))
                  ->setMediumPassesCompPercent((($verify->setMediumPassesCompPercent() * $this->fixDataToUpdate) + floatval($passing[$index]['mediumCmpPER'] ?? 0.0)) / 2)
                  ->setLongPassCompleted(($verify->setLongPassCompleted() * $this->fixDataToUpdate) + intval($passing[$index]['longCmp']))
                  ->setLongPassesAttempted(($verify->setLongPassesAttempted() * $this->fixDataToUpdate) + intval($passing[$index]['longAtt']))
                  ->setLongPassesCompPercent((($verify->setLongPassesCompPercent() * $this->fixDataToUpdate) + floatval($passing[$index]['longCmpPER'] ?? 0.0)) / 2)
                  ->setPassCompletedFinalThird(($verify->setPassCompletedFinalThird() * $this->fixDataToUpdate) + intval($passing[$index]['1/3'] ?? 0))
                  ->setPassCompletedPenaltyArea(($verify->setPassCompletedPenaltyArea() * $this->fixDataToUpdate) + intval($passing[$index]['PPA'] ?? 0))
                  //->setThroughBalls(intval($passing[$index]['TB'] ?? 0))
                  ->setCrossIntoPenaltyArea((($verify->setCrossIntoPenaltyArea() * $this->fixDataToUpdate) + floatval($passing[$index]['CrsPA'] ?? 0.0)) / 2);
            } else {
               for ($i = 0; $i <= count($passing) - 1; $i++) {

                  if ($row['name'] == (!empty($passing[$i]['name']))) {
                     $verify->setKeyPasses(($verify->setKeyPasses() * $this->fixDataToUpdate) + intval($passing[$i]['KP']))
                        ->setPassesCompleted(($verify->setPassesCompleted() * $this->fixDataToUpdate) + intval($passing[$i]['Cmp']))
                        ->setPassesAttempted(($verify->setPassesAttempted() * $this->fixDataToUpdate) + intval($passing[$i]['Att']))
                        ->setPassCompPercent((($verify->setPassCompPercent() * $this->fixDataToUpdate) + floatval($passing[$i]['CmpPER'] ?? 0.0)) / 2)
                        ->setShortPassesCompleted(($verify->setShortPassesCompleted() * $this->fixDataToUpdate) + intval($passing[$i]['shortCmp']))
                        ->setShortpassesAttempted(($verify->setShortpassesAttempted() * $this->fixDataToUpdate) + intval($passing[$i]['shortAtt']))
                        ->setShortPassesCompPercent((($verify->setShortPassesCompPercent() * $this->fixDataToUpdate) + floatval($passing[$i]['shortCmpPER'] ?? 0.0)) / 2)
                        ->setMediumPassesCompleted(($verify->setMediumPassesCompleted() * $this->fixDataToUpdate) + intval($passing[$i]['mediumCmp']))
                        ->setMediumPassesAttempted(($verify->setMediumPassesAttempted() * $this->fixDataToUpdate) + intval($passing[$i]['mediumAtt']))
                        ->setMediumPassesCompPercent((($verify->setMediumPassesCompPercent() * $this->fixDataToUpdate) + floatval($passing[$i]['mediumCmpPER'] ?? 0.0)) / 2)
                        ->setLongPassCompleted(($verify->setLongPassCompleted() * $this->fixDataToUpdate) + intval($passing[$i]['longCmp']))
                        ->setLongPassesAttempted(($verify->setLongPassesAttempted() * $this->fixDataToUpdate) + intval($passing[$i]['longAtt']))
                        ->setLongPassesCompPercent((($verify->setLongPassesCompPercent() * $this->fixDataToUpdate) + floatval($passing[$i]['longCmpPER'] ?? 0.0)) / 2)
                        ->setPassCompletedFinalThird(($verify->setPassCompletedFinalThird() * $this->fixDataToUpdate) + intval($passing[$i]['1/3']))
                        ->setPassCompletedPenaltyArea(($verify->setPassCompletedPenaltyArea() * $this->fixDataToUpdate) + intval($passing[$i]['PPA']))
                        //->setThroughBalls(intval($passing[$i]['TB'] ?? 0))
                        ->setCrossIntoPenaltyArea((($verify->setCrossIntoPenaltyArea() * $this->fixDataToUpdate) + floatval($passing[$i]['CrsPA'] ?? 0.0)) / 2);
                     break;
                  }
               }
            }

            /////////////////////////////////////////////////////////////////////////////////
            $index = $fakeindex;
            if ($index > count($typePass) - 1 and count($passing) > 1) {
               $index = 0;
            }
            if ($row['name'] == (!empty($typePass[$index]['name']))) {
               $verify->setLivePass(($verify->setLivePass() * $this->fixDataToUpdate) + intval($typePass[$index]['KP'] ?? 0))
                  ->setDeadPasses(($verify->setDeadPasses() * $this->fixDataToUpdate) + intval($typePass[$index]['Dead'] ?? 0))
                  ->setPressPasses(($verify->setPressPasses() * $this->fixDataToUpdate) + intval($typePass[$index]['Press'] ?? 0))
                  ->setSwitchPasses((($verify->setSwitchPasses() * $this->fixDataToUpdate) + floatval($typePass[$index]['Sw'] ?? 0.0)) / 2)
                  ->setGroundPasses(($verify->setGroundPasses() * $this->fixDataToUpdate) + intval($typePass[$index]['Ground'] ?? 0))
                  ->setLowPasses(($verify->setLowPasses() * $this->fixDataToUpdate) + intval($typePass[$index]['Low'] ?? 0))
                  ->setHighPasses((($verify->setHighPasses() * $this->fixDataToUpdate) + floatval($typePass[$index]['High'] ?? 0.0)) / 2)
                  ->setLeftFootPasses(($verify->setLeftFootPasses() * $this->fixDataToUpdate) + intval($typePass[$index]['Left'] ?? 0))
                  ->setRightFootPasses(($verify->setRightFootPasses() * $this->fixDataToUpdate) + intval($typePass[$index]['Right'] ?? 0))
                  ->setBlockedPasses((($verify->setBlockedPasses() * $this->fixDataToUpdate) + floatval($typePass[$index]['Blocks'] ?? 0.0)) / 2)
                  ->setOffsidesPasses(($verify->setOffsidesPasses() * $this->fixDataToUpdate) + intval($typePass[$index]['Off'] ?? 0))
                  ->setPassAttemptedFromFK(($verify->setPassAttemptedFromFK() * $this->fixDataToUpdate) + intval($typePass[$index]['FK'] ?? 0))
                  ->setThroughBalls(($verify->setThroughBalls() * $this->fixDataToUpdate) + intval($typePass[$index]['TB'] ?? 0));
            } else {
               for ($i = 0; $i <= count($typePass) - 1; $i++) {

                  if ($row['name'] == (!empty($typePass[$i]['name'] ?? ""))) {
                     $verify->setLivePass(($verify->setLivePass() * $this->fixDataToUpdate) + intval($typePass[$i]['KP'] ?? 0))
                        ->setDeadPasses(($verify->setDeadPasses() * $this->fixDataToUpdate) + intval($typePass[$i]['Dead'] ?? 0))
                        ->setPressPasses(($verify->setPressPasses() * $this->fixDataToUpdate) + intval($typePass[$i]['Press'] ?? 0))
                        ->setSwitchPasses((($verify->setSwitchPasses() * $this->fixDataToUpdate) + floatval($typePass[$i]['Sw'] ?? 0.0)) / 2)
                        ->setGroundPasses(($verify->setGroundPasses() * $this->fixDataToUpdate) + intval($typePass[$i]['Ground'] ?? 0))
                        ->setLowPasses(($verify->setLowPasses() * $this->fixDataToUpdate) + intval($typePass[$i]['Low'] ?? 0))
                        ->setHighPasses((($verify->setHighPasses() * $this->fixDataToUpdate) + floatval($typePass[$i]['High'] ?? 0.0)) / 2)
                        ->setLeftFootPasses(($verify->setLeftFootPasses() * $this->fixDataToUpdate) + intval($typePass[$i]['Left'] ?? 0))
                        ->setRightFootPasses(($verify->setRightFootPasses() * $this->fixDataToUpdate) + intval($typePass[$i]['Right'] ?? 0))
                        ->setBlockedPasses((($verify->setBlockedPasses() * $this->fixDataToUpdate) + floatval($typePass[$i]['Blocks'] ?? 0.0)) / 2)
                        ->setOffsidesPasses(($verify->setOffsidesPasses() * $this->fixDataToUpdate) + intval($typePass[$i]['Off'] ?? 0))
                        ->setPassAttemptedFromFK(($verify->setPassAttemptedFromFK() * $this->fixDataToUpdate) + intval($typePass[$i]['FK'] ?? 0))
                        ->setThroughBalls(($verify->setThroughBalls() * $this->fixDataToUpdate) + intval($typePass[$i]['TB'] ?? 0));
                     break;
                  }
               }
            }

            /////////////////////////////////////////////////////////////////////////////////
            $index = $fakeindex;
            if ($index > count($defense) - 1 and count($defense) > 1) {
               $index = 0;
            }
            if ($row['name'] == (!empty($defense[$index]['name'] ?? ""))) {
               $verify->setTacklesWon(($verify->setTacklesWon() * $this->fixDataToUpdate) + intval($defense[$index]['TklW'] ?? 0))
                  ->setInterceptions(($verify->setInterceptions() * $this->fixDataToUpdate) + intval($defense[$index]['Int'] ?? 0))
                  ->setPressures(($verify->setPressures() * $this->fixDataToUpdate) + intval($defense[$index]['Press'] ?? 0))
                  ->setPressureSucceded(($verify->setPressureSucceded() * $this->fixDataToUpdate) + intval($defense[$index]['Succ'] ?? 0))
                  ->setPressureCompletion(($verify->setPressureCompletion() * $this->fixDataToUpdate) + intval($defense[$index]['%'] ?? 0))
                  ->setBallBlocked((($verify->setBallBlocked() * $this->fixDataToUpdate) + floatval($defense[$index]['Blocks'] ?? 0.0)) / 2)
                  ->setShootBlocked(($verify->setShootBlocked() * $this->fixDataToUpdate) + intval($defense[$index]['Sh'] ?? 0))
                  ->setShootOntTargetBlocked(($verify->setShootOntTargetBlocked() * $this->fixDataToUpdate) + intval($defense[$index]['ShSv'] ?? 0))
                  ->setPassBlocked((($verify->setPassBlocked() * $this->fixDataToUpdate) + floatval($defense[$index]['Pass'] ?? 0.0)) / 2)
                  ->setClearances(($verify->setClearances() * $this->fixDataToUpdate) + intval($defense[$index]['Clr'] ?? 0))
                  ->setErrors(($verify->setErrors() * $this->fixDataToUpdate) + intval($defense[$index]['Err'] ?? 0));
            } else {
               for ($i = 0; $i <= count($defense) - 1; $i++) {

                  if ($row['name'] == (!empty($defense[$i]['name'] ?? ""))) {
                     $verify->setTacklesWon(($verify->setTacklesWon() * $this->fixDataToUpdate) + intval($defense[$i]['TklW'] ?? 0))
                        ->setInterceptions(($verify->setInterceptions() * $this->fixDataToUpdate) + intval($defense[$i]['Int'] ?? 0))
                        ->setPressures(($verify->setPressures() * $this->fixDataToUpdate) + intval($defense[$i]['Press'] ?? 0))
                        ->setPressureSucceded(($verify->setPressureSucceded() * $this->fixDataToUpdate) + intval($defense[$i]['Succ'] ?? 0))
                        ->setPressureCompletion(($verify->setPressureCompletion() * $this->fixDataToUpdate) + intval($defense[$i]['%'] ?? 0))
                        ->setBallBlocked((($verify->setBallBlocked() * $this->fixDataToUpdate) + floatval($defense[$i]['Blocks'] ?? 0.0)) / 2)
                        ->setShootBlocked(($verify->setShootBlocked() * $this->fixDataToUpdate) + intval($defense[$i]['Sh'] ?? 0))
                        ->setShootOntTargetBlocked(($verify->setShootOntTargetBlocked() * $this->fixDataToUpdate) + intval($defense[$i]['ShSv'] ?? 0))
                        ->setPassBlocked((($verify->setPassBlocked() * $this->fixDataToUpdate) + floatval($defense[$i]['Pass'] ?? 0.0)) / 2)
                        ->setClearances(($verify->setClearances() * $this->fixDataToUpdate) + intval($defense[$i]['Clr'] ?? 0))
                        ->setErrors(($verify->setErrors() * $this->fixDataToUpdate) + intval($defense[$i]['Err'] ?? 0));
                     break;
                  }
               }
            }
            /////////////////////////////////////////////////////////////////////////////////


            $index = $fakeindex;
            if ($index > count($miscellaneous) - 1 and count($miscellaneous) > 1) {
               $index = 0;
            }
            if ($row['name'] == $miscellaneous[$index]['name'] ?? "") {

               $verify->setFoulsCommited(($verify->setFoulsCommited() * $this->fixDataToUpdate) + intval($miscellaneous[$index]['Fls'] ?? 0))
                  ->setFoulsDrawn(($verify->setFoulsDrawn() * $this->fixDataToUpdate) + intval($miscellaneous[$index]['Fld'] ?? 0))
                  ->setOffsides(($verify->setOffsides() * $this->fixDataToUpdate) + intval($miscellaneous[$index]['Off'] ?? 0))
                  ->setCrosses(($verify->setCrosses() * $this->fixDataToUpdate) + intval($miscellaneous[$index]['Crs'] ?? 0))
                  // ->setTacklesWon(intval($miscellaneous[$index]['TklW'] ?? 0))
                  // ->setInterceptions(intval($miscellaneous[$index]['Int'] ?? 0))
                  ->setPenaltyKicksWon(($verify->setPenaltyKicksWon() * $this->fixDataToUpdate) + intval($miscellaneous[$index]['PKwon'] ?? 0))
                  ->setPenaltyKicksConceded(($verify->setPenaltyKicksConceded() * $this->fixDataToUpdate) + intval($miscellaneous[$index]['PKcon'] ?? 0))
                  ->setOwnGoal(($verify->setOwnGoal() * $this->fixDataToUpdate) + intval($miscellaneous[$index]['OG'] ?? 0))
                  ->setDribbleCompleted(($verify->setDribbleCompleted() * $this->fixDataToUpdate) + intval($miscellaneous[$index]['Succ'] ?? 0))
                  ->setDribbleAttempted(($verify->setDribbleAttempted() * $this->fixDataToUpdate) + intval($miscellaneous[$index]['Att'] ?? 0))
                  ->setDribblePercent((($verify->setDribblePercent() * $this->fixDataToUpdate) + floatval($miscellaneous[$index]['Succ%'] ?? 0.0)) / 2)
                  ->setNumberOfPlayerDriblled(($verify->setNumberOfPlayerDriblled() * $this->fixDataToUpdate) + intval($miscellaneous[$index]['#Pl'] ?? 0))
                  ->setNutmegs(($verify->setNutmegs() * $this->fixDataToUpdate) + intval($miscellaneous[$index]['Megs'] ?? 0))
                  ->setSecondYellowCard(($verify->setSecondYellowCard() * $this->fixDataToUpdate) + intval($miscellaneous[$index]['2CrdY'] ?? 0))
                  ->setArialDuelsWon(($verify->setArialDuelsWon() * $this->fixDataToUpdate) + intval($miscellaneous[$index]['Won'] ?? 0))
                  ->setArialDuelsLost(($verify->setArialDuelsLost() * $this->fixDataToUpdate) + intval($miscellaneous[$index]['Lost'] ?? 0))
                  ->setArialDuelsCompletion((($verify->setArialDuelsCompletion() * $this->fixDataToUpdate) + floatval($miscellaneous[$index]['Won%'] ?? 0)) / 2);
            } else {
               for ($i = 0; $i <= count($miscellaneous) - 1; $i++) {

                  if ($row['name'] == $miscellaneous[$i]['name']) {

                     $verify->setFoulsCommited(($verify->setFoulsCommited() * $this->fixDataToUpdate) + intval($miscellaneous[$i]['Fls'] ?? 0))
                        ->setFoulsDrawn(($verify->setFoulsDrawn() * $this->fixDataToUpdate) + intval($miscellaneous[$i]['Fld'] ?? 0))
                        ->setOffsides(($verify->setOffsides() * $this->fixDataToUpdate) + intval($miscellaneous[$i]['Off'] ?? 0))
                        ->setCrosses(($verify->setCrosses() * $this->fixDataToUpdate) + intval($miscellaneous[$i]['Crs'] ?? 0))
                        // ->setTacklesWon(intval($miscellaneous[$index]['TklW'] ?? 0))
                        // ->setInterceptions(intval($miscellaneous[$index]['Int'] ?? 0))
                        ->setPenaltyKicksWon(($verify->setPenaltyKicksWon() * $this->fixDataToUpdate) + intval($miscellaneous[$i]['PKwon'] ?? 0))
                        ->setPenaltyKicksConceded(($verify->setPenaltyKicksConceded() * $this->fixDataToUpdate) + intval($miscellaneous[$i]['PKcon'] ?? 0))
                        ->setOwnGoal(($verify->setOwnGoal() * $this->fixDataToUpdate) + intval($miscellaneous[$i]['OG'] ?? 0))
                        ->setDribbleCompleted(($verify->setDribbleCompleted() * $this->fixDataToUpdate) + intval($miscellaneous[$i]['Succ'] ?? 0))
                        ->setDribbleAttempted(($verify->setDribbleAttempted() * $this->fixDataToUpdate) + intval($miscellaneous[$i]['Att'] ?? 0))
                        ->setDribblePercent((($verify->setDribblePercent() * $this->fixDataToUpdate) + floatval($miscellaneous[$i]['Succ%'] ?? 0.0)) / 2)
                        ->setNumberOfPlayerDriblled(($verify->setNumberOfPlayerDriblled() * $this->fixDataToUpdate) + intval($miscellaneous[$i]['#Pl'] ?? 0))
                        ->setNutmegs(($verify->setNutmegs() * $this->fixDataToUpdate) + intval($miscellaneous[$i]['Megs'] ?? 0))
                        ->setSecondYellowCard(($verify->setSecondYellowCard() * $this->fixDataToUpdate) + intval($miscellaneous[$i]['2CrdY'] ?? 0))
                        ->setArialDuelsWon(($verify->setArialDuelsWon() * $this->fixDataToUpdate) + intval($miscellaneous[$i]['Won'] ?? 0))
                        ->setArialDuelsLost(($verify->setArialDuelsLost() * $this->fixDataToUpdate) + intval($miscellaneous[$i]['Lost'] ?? 0))
                        ->setArialDuelsCompletion((($verify->setArialDuelsCompletion() * $this->fixDataToUpdate) + floatval($miscellaneous[$i]['Won%'] ?? 0)) / 2);
                     break;
                  }
               }
            }
            ///////////////////////////////////////////////////////////////////
            $index = $fakeindex;
            if ($index > count($possession) - 1 and count($possession) > 1) {
               $index = 0;
            }
            if ($row['name'] == (!empty($possession[$index]['name']))) {
               $verify->setBallControlls(($verify->setBallControlls() * $this->fixDataToUpdate) + intval($possession[$index]['Carries'] ?? 0))
                  ->setBallControllsMoveDistance(($verify->setBallControllsMoveDistance() * $this->fixDataToUpdate) + intval($possession[$index]['TotDist'] ?? 0))
                  ->setBallControllsMoveDistanceProgressive(($verify->setBallControllsMoveDistanceProgressive() * $this->fixDataToUpdate) + intval($possession[$index]['PrgDist'] ?? 0))
                  ->setReceivingBallAttempted(($verify->setReceivingBallAttempted() * $this->fixDataToUpdate) + intval($possession[$index]['Targ'] ?? 0))
                  ->setReceivingBallCompleted(($verify->setReceivingBallCompleted() * $this->fixDataToUpdate) + intval($possession[$index]['Rec'] ?? 0))
                  ->setReceivingBallCompletion((($verify->setReceivingBallCompletion() * $this->fixDataToUpdate) + floatval($possession[$index]['Rec%'] ?? 0.0)) / 2)
                  ->setMisControlls($verify->setMisControlls() * $this->fixDataToUpdate) + (intval($possession[$index]['Miscon'] ?? 0))
                  ->setDispossessed(($verify->setDispossessed() * $this->fixDataToUpdate) + intval($possession[$index]['Dispos'] ?? 0));
            } else {
               for ($i = 0; $i <= count($defense) - 1; $i++) {

                  if ($row['name'] == (!empty($defense[$i]['name'] ?? ""))) {
                     $verify->setBallControlls(($verify->setBallControlls() * $this->fixDataToUpdate) + intval($possession[$i]['Carries'] ?? 0))
                        ->setBallControllsMoveDistance(($verify->setBallControllsMoveDistance() * $this->fixDataToUpdate) + intval($possession[$i]['TotDist'] ?? 0))
                        ->setBallControllsMoveDistanceProgressive(($verify->setBallControllsMoveDistanceProgressive() * $this->fixDataToUpdate) + intval($possession[$i]['PrgDist'] ?? 0))
                        ->setReceivingBallAttempted(($verify->setReceivingBallAttempted() * $this->fixDataToUpdate) + intval($possession[$i]['Targ'] ?? 0))
                        ->setReceivingBallCompleted(($verify->setReceivingBallCompleted() * $this->fixDataToUpdate) + intval($possession[$i]['Rec'] ?? 0))
                        ->setReceivingBallCompletion((($verify->setReceivingBallCompletion() * $this->fixDataToUpdate) + floatval($possession[$i]['Rec%'] ?? 0.0)) / 2)
                        ->setMisControlls(($verify->setMisControlls() * $this->fixDataToUpdate) + intval($possession[$i]['Miscon'] ?? 0))
                        ->setDispossessed(($verify->setDispossessed() * $this->fixDataToUpdate) + intval($possession[$i]['Dispos'] ?? 0));
                     break;
                  }
               }
            }
            /////////////////////////////////////////////////////////////////////////////////


            $this->em->persist($verify);
         }





         $this->em->flush();
      }
      $bar1->finish();
      echo "_________________________Success__________________________\n";
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
