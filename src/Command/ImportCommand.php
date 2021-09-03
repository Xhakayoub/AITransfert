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
      $this->setName('data:update')
         ->setDescription('importation data');
   }

   public function importTeams(string $league): void
   {

      // $readerOfStandarsTeamData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $league . '/standard_team_data.csv');
      // $readerOfPassingTeamData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $league . '/passing_team_data.csv');
      // $readerOfShootingTeamData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $league . '/shooting_team_data.csv');
      // $readerOfTimmingTeamData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $league . '/timming_team_data.csv');
      // $readerOfGkTeamData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $league . '/gk_team_data.csv');
      // $readerOfAdvancedGkTeamData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $league . '/ad_gk_team_data.csv');
      // $readerOfMiscellaneousTeamData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $league . '/miscellaneous_team_data.csv');
      // $readerOfTypeOfPassTeamData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $league . '/type_pass_team_data.csv');
      // $readerOfDefenseTeamData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $league . '/defense_team_data.csv');
      // $readerOfPossessionTeamData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $league . '/possession_team_data.csv');

      $readerOfStandarsTeamData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/csv/' . $league . '/standard_team_data.csv');
      $readerOfPassingTeamData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/csv/' . $league . '/passing_team_data.csv');
      $readerOfShootingTeamData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/csv/' . $league . '/shooting_team_data.csv');
      $readerOfTimmingTeamData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/csv/' . $league . '/timming_team_data.csv');
      $readerOfGkTeamData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/csv/' . $league . '/gk_team_data.csv');
      $readerOfAdvancedGkTeamData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/csv/' . $league . '/ad_gk_team_data.csv');
      $readerOfMiscellaneousTeamData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/csv/' . $league . '/miscellaneous_team_data.csv');
      $readerOfTypeOfPassTeamData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/csv/' . $league . '/pass_type_team_data.csv');
      $readerOfDefenseTeamData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/csv/' . $league . '/defense_team_data.csv');
      $readerOfPossessionTeamData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/csv/' . $league . '/possession_team_data.csv');

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


      $standarsTeams = $readerOfStandarsTeamData->setHeaderOffset(0);
      $passingTeams = $readerOfPassingTeamData->setHeaderOffset(0);
      $shootingTeams = $readerOfShootingTeamData->setHeaderOffset(0);
      $timmingTeams = $readerOfTimmingTeamData->setHeaderOffset(0);
      $miscellaneousTeams = $readerOfMiscellaneousTeamData->setHeaderOffset(0);
      $gkTeams = $readerOfGkTeamData->setHeaderOffset(0);
      $advancedGkTeams = $readerOfAdvancedGkTeamData->setHeaderOffset(0);
      $typePassTeams = $readerOfTypeOfPassTeamData->setHeaderOffset(0);
      $DefenseTeams = $readerOfDefenseTeamData->setHeaderOffset(0);
      $possessionTeams = $readerOfPossessionTeamData->setHeaderOffset(0);




      // $permierLeagueTeams = $readerPermierLeagueTeams->setHeaderOffset(0);
      // $permierLeagueTeamsOtherData = $readerPermierLeagueTeamsOtherData->setHeaderOffset(0);


      $standarsTeams = iterator_to_array($readerOfStandarsTeamData, false);
      $passingTeams = iterator_to_array($readerOfPassingTeamData, false);
      $shootingTeams = iterator_to_array($readerOfShootingTeamData, false);
      $timmingTeams = iterator_to_array($readerOfTimmingTeamData, false);
      $miscellaneousTeams = iterator_to_array($readerOfMiscellaneousTeamData, false);
      $gkTeams = iterator_to_array($readerOfGkTeamData, false);
      $advancedGkTeams = iterator_to_array($readerOfAdvancedGkTeamData, false);
      $typePassTeams = iterator_to_array($readerOfTypeOfPassTeamData, false);
      $DefenseTeams = iterator_to_array($readerOfDefenseTeamData, false);
      $possessionTeams = iterator_to_array($readerOfPossessionTeamData, false);







      if (!empty($standarsTeams) and !empty($gkTeams)) {

         // $count = sizeof($standarsTeams);
         // // echo sizeof($gkTeams);
         // echo $count ."\n";
         // echo sizeof($gkTeams)."\n";
         echo "import for " . $league . " league\n";


         foreach ($standarsTeams as $fakeIndex => $teams) {
            //echo sizeof($gkTeams);
            $squad = "";
            if ($league == 'CL' || $league == 'EL') {
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
                  ->setMatchPlayed($teams['Playing Time-MP'])
                  ->setGoals($teams['Performance-Gls'])
                  ->setAssists($teams['Performance-Ast'])
                  ->setGoalPerMatch($teams['Per 90 Minutes-Gls'])
                  //goalkepping
                  ->setGoalsAgainst($gkTeams[$fakeIndex]['Performance-GA'])
                  ->setGoalsAgainstPerMatch($gkTeams[$fakeIndex]['Performance-GA90'])
                  ->setSaves($gkTeams[$fakeIndex]['Performance-Saves'])
                  ->setShootOnTargetAgainst($gkTeams[$fakeIndex]['Performance-SoTA'])
                  ->setSavePercent($gkTeams[$fakeIndex]['Performance-Save%'])
                  ->setCleanSheets($gkTeams[$fakeIndex]['Performance-CS'])
                  ->setCleanSheetPercent($gkTeams[$fakeIndex]['Performance-CS%'])
                  ->setPenaltyKickAllowed($gkTeams[$fakeIndex]['Penalty Kicks-PKA'])
                  ->setPenaltyKicksSaved($gkTeams[$fakeIndex]['Penalty Kicks-PKsv'])
                  ->setTopTeamScoorer("")
                  ->setGoalKeeper("")
                  //advanced goalkeeping
                  ->setGkPassLaunchedComp($advancedGkTeams[$fakeIndex]['Launched-Cmp'])
                  ->setGkPassLaunchedAtt($advancedGkTeams[$fakeIndex]['Launched-Att'])
                  ->setGkPassLaunchedCompletion($advancedGkTeams[$fakeIndex]['Launched-Cmp%'])
                  ->setGkPassAttempted($advancedGkTeams[$fakeIndex]['Passes-Att'])
                  ->setGkPassThrows($advancedGkTeams[$fakeIndex]['Passes-Thr'])
                  ->setGkPassLaunchedPercent($advancedGkTeams[$fakeIndex]['Passes-Launch%'])
                  ->setAvgLengthOfPasses($advancedGkTeams[$fakeIndex]['Passes-AvgLen'])
                  ->setGoalKicksAtt($advancedGkTeams[$fakeIndex]['Goal Kicks-Att'])
                  ->setGoalKicksLaunchedPercent($advancedGkTeams[$fakeIndex]['Goal Kicks-Launch%'])
                  ->setGoalKicksAvgLength($advancedGkTeams[$fakeIndex]['Goal Kicks-AvgLen'])
                  ->setGkCrossesAttempted($advancedGkTeams[$fakeIndex]['Crosses-Opp'])
                  ->setGkCrossesStopped($advancedGkTeams[$fakeIndex]['Crosses-Stp'])
                  ->setGkCrossesStpPercent($advancedGkTeams[$fakeIndex]['Crosses-Stp%'])
                  ->setOpa($advancedGkTeams[$fakeIndex]['Sweeper-#OPA'])
                  ->setOpaPerMatch($advancedGkTeams[$fakeIndex]['Sweeper-#OPA/90'])
                  ->setAverageDistance($advancedGkTeams[$fakeIndex]['Sweeper-AvgDist'])
                  /////shooting
                  ->setShootOnTarget(intval($shootingTeams[$fakeIndex]['Standard-SoT']))
                  ->setShootFromFreeKick(intval($shootingTeams[$fakeIndex]['Standard-FK']))
                  ->setShootOnTargetPercent(intval($shootingTeams[$fakeIndex]['Standard-SoT%']))
                  ->setShootPer90Minutes(intval($shootingTeams[$fakeIndex]['Standard-Sh/90']))
                  ->setShootOnTargetPer90Minutes(intval($shootingTeams[$fakeIndex]['Standard-SoT/90']))
                  ->setGoalPerShoot(intval($shootingTeams[$fakeIndex]['Standard-G/Sh']))
                  ->setGoalPerShootOnTarget(intval($shootingTeams[$fakeIndex]['Standard-G/SoT']))
                  //passing
                  ->setPassesCompleted($passingTeams[$fakeIndex]['Total-Cmp'])
                  ->setPassesAttempted($passingTeams[$fakeIndex]['Total-Att'])
                  ->setPassCompletion($passingTeams[$fakeIndex]['Total-Cmp%'])
                  ->setShortPassCompleted($passingTeams[$fakeIndex]['Short-Cmp'])
                  ->setShortPassAttempted($passingTeams[$fakeIndex]['Short-Att'])
                  ->setShortPassCompletion($passingTeams[$fakeIndex]['Short-Cmp%'])
                  ->setMediumPassCompleted($passingTeams[$fakeIndex]['Medium-Cmp'])
                  ->setMediumPassAttempted($passingTeams[$fakeIndex]['Medium-Att'])
                  ->setMediumPassCompletion($passingTeams[$fakeIndex]['Medium-Cmp%'])
                  ->setLongPassCompleted($passingTeams[$fakeIndex]['Long-Cmp'])
                  ->setLongPassAttempted($passingTeams[$fakeIndex]['Long-Att'])
                  ->setLongPassCompletion($passingTeams[$fakeIndex]['Long-Cmp%'])
                  //->setPassAttemptedFromFK($passingTeams[$fakeIndex]['Pass Types-FK'])
                  // ->setCornerKicks($passingTeams[$fakeIndex]['CK'])
                  // ->setThrowInsTaken($passingTeams[$fakeIndex]['TI'])
                  ->setPassIntoFinalThird($passingTeams[$fakeIndex]['1/3'])
                  ->setPassIntoPenaltyArea($passingTeams[$fakeIndex]['PPA'])
                  ->setCrossIntoPenaltyArea($passingTeams[$fakeIndex]['CrsPA'])
                  //typePass
                  ->setLivePasses($typePassTeams[$fakeIndex]['Pass Types-Live'])
                  ->setDeadPasses($typePassTeams[$fakeIndex]['Pass Types-Dead'])
                  ->setPressPasses($typePassTeams[$fakeIndex]['Pass Types-Press'])
                  ->setSwitchPasses($typePassTeams[$fakeIndex]['Pass Types-Sw'])
                  ->setGroundPasses($typePassTeams[$fakeIndex]['Height-Ground'])
                  ->setPassAttemptedFromFK($typePassTeams[$fakeIndex]['Pass Types-FK'])
                  ->setLowPasses($typePassTeams[$fakeIndex]['Height-Low'])
                  ->setHighPasses($typePassTeams[$fakeIndex]['Height-High'])
                  ->setThroughBalls($typePassTeams[$fakeIndex]['Pass Types-TB'])
                  ->setLeftFootPasses($typePassTeams[$fakeIndex]['Body Parts-Left'])
                  ->setRightFootPasses($typePassTeams[$fakeIndex]['Body Parts-Right'])
                  ->setBlockedPasses($typePassTeams[$fakeIndex]['Outcomes-Blocks'])
                  ->setOffsidesPasses($typePassTeams[$fakeIndex]['Outcomes-Off'])
                  //timming
                  ->setMinutesPlayed($timmingTeams[$fakeIndex]['Playing Time-Min'])
                  ->setSubstitutions($timmingTeams[$fakeIndex]['Subs-Subs'])
                  ->setPointPerMatch($timmingTeams[$fakeIndex]['Team Success-PPM'])
                  //defense
                  ->setTacklesWon($DefenseTeams[$fakeIndex]['Tackles-TklW'])
                  ->setInterceptions($DefenseTeams[$fakeIndex]['Int'])
                  ->setPressures($DefenseTeams[$fakeIndex]['Pressures-Press'])
                  ->setPressureSucceded($DefenseTeams[$fakeIndex]['Pressures-Succ'])
                  ->setPressureCompletion($DefenseTeams[$fakeIndex]['Pressures-%'])
                  ->setBallBlocked($DefenseTeams[$fakeIndex]['Blocks-Blocks'])
                  ->setShootBlocked($DefenseTeams[$fakeIndex]['Blocks-Sh'])
                  ->setShootOnTargetBlocked($DefenseTeams[$fakeIndex]['Blocks-ShSv'])
                  ->setPassBlocked($DefenseTeams[$fakeIndex]['Blocks-ShSv'])
                  ->setClearances($DefenseTeams[$fakeIndex]['Clr'])
                  ->setErrors($DefenseTeams[$fakeIndex]['Err'])
                  //miscellaneous
                  ->setYellowCards($miscellaneousTeams[$fakeIndex]['Performance-CrdY'])
                  ->setRedCards($miscellaneousTeams[$fakeIndex]['Performance-CrdR'])
                  ->setFoulCommited($miscellaneousTeams[$fakeIndex]['Performance-Fls'])
                  ->setFoulDrawn($miscellaneousTeams[$fakeIndex]['Performance-Fld'])
                  ->setOffsides($miscellaneousTeams[$fakeIndex]['Performance-Off'])
                  ->setCrosses($miscellaneousTeams[$fakeIndex]['Performance-Crs'])
                  ->setTacklesWon($miscellaneousTeams[$fakeIndex]['Performance-TklW'])
                  ->setInterceptions($miscellaneousTeams[$fakeIndex]['Performance-Int'])
                  ->setPenaltyKickWon($miscellaneousTeams[$fakeIndex]['Performance-PKwon'])
                  ->setPenaltyKickConceded($miscellaneousTeams[$fakeIndex]['Performance-PKcon'])
                  ->setOwnGoal($miscellaneousTeams[$fakeIndex]['Performance-OG'])
                  ->setArialDuelsWon($miscellaneousTeams[$fakeIndex]['Aerial Duels-Won'])
                  ->setArialDuelsLost($miscellaneousTeams[$fakeIndex]['Aerial Duels-Lost'])
                  ->setArialDuelsCompletion($miscellaneousTeams[$fakeIndex]['Aerial Duels-Won%'])
                  //possession
                  ->setDribblesSucceded($possessionTeams[$fakeIndex]['Dribbles-Succ'])
                  ->setDribblesAttempted($possessionTeams[$fakeIndex]['Dribbles-Att'])
                  ->setDribblesCompletion($possessionTeams[$fakeIndex]['Dribbles-Succ%'])
                  ->setBallControlls($possessionTeams[$fakeIndex]['Carries-Carries'])
                  ->setBallControllsMoveDistance($possessionTeams[$fakeIndex]['Carries-TotDist'])
                  ->setBallControllsMoveDistanceProgressive($possessionTeams[$fakeIndex]['Carries-PrgDist']);

               $this->em->persist($team);
            } else {
               // echo $league." ".$verify->getLeague()."\n";
               // $test = strpos($verify->getLeague(), $league);
               // echo $test;

               if ($league != 'CL' and $league != 'EL') {
                  $verify
                     ->setMatchPlayed($teams['Playing Time-MP'])
                     ->setGoals($teams['Performance-Gls'])
                     ->setAssists($teams['Playing Time-Min'])
                     ->setGoalPerMatch($teams['Per 90 Minutes-Gls'])
                     //goalkepping
                     ->setGoalsAgainst($gkTeams[$fakeIndex]['Performance-GA'])
                     ->setGoalsAgainstPerMatch($gkTeams[$fakeIndex]['Performance-GA90'])
                     ->setSaves($gkTeams[$fakeIndex]['Performance-Saves'])
                     ->setShootOnTargetAgainst($gkTeams[$fakeIndex]['Performance-SoTA'])
                     ->setSavePercent($gkTeams[$fakeIndex]['Performance-Save%'])
                     ->setCleanSheets($gkTeams[$fakeIndex]['Performance-CS'])
                     ->setCleanSheetPercent($gkTeams[$fakeIndex]['Performance-CS'])
                     ->setPenaltyKickAllowed($gkTeams[$fakeIndex]['Penalty Kicks-PKA'])
                     ->setPenaltyKicksSaved($gkTeams[$fakeIndex]['Penalty Kicks-PKsv'])
                     ->setTopTeamScoorer("")
                     ->setGoalKeeper("")
                     //advanced goalkeeping
                     ->setGkPassLaunchedComp($advancedGkTeams[$fakeIndex]['Launched-Cmp'])
                     ->setGkPassLaunchedAtt($advancedGkTeams[$fakeIndex]['Launched-Att'])
                     ->setGkPassLaunchedCompletion($advancedGkTeams[$fakeIndex]['Launched-Cmp%'])
                     ->setGkPassAttempted($advancedGkTeams[$fakeIndex]['Passes-Att'])
                     ->setGkPassThrows($advancedGkTeams[$fakeIndex]['Passes-Thr'])
                     ->setGkPassLaunchedPercent($advancedGkTeams[$fakeIndex]['Passes-Launch%'])
                     ->setAvgLengthOfPasses($advancedGkTeams[$fakeIndex]['Passes-AvgLen'])
                     ->setGoalKicksAtt($advancedGkTeams[$fakeIndex]['Goal Kicks-Att'])
                     ->setGoalKicksLaunchedPercent($advancedGkTeams[$fakeIndex]['Goal Kicks-Launch%'])
                     ->setGoalKicksAvgLength($advancedGkTeams[$fakeIndex]['Goal Kicks-AvgLen'])
                     ->setGkCrossesAttempted($advancedGkTeams[$fakeIndex]['Crosses-Opp'])
                     ->setGkCrossesStopped($advancedGkTeams[$fakeIndex]['Crosses-Stp'])
                     ->setGkCrossesStpPercent($advancedGkTeams[$fakeIndex]['Crosses-Stp%'])
                     ->setOpa($advancedGkTeams[$fakeIndex]['Sweeper-#OPA'])
                     ->setOpaPerMatch($advancedGkTeams[$fakeIndex]['Sweeper-#OPA/90'])
                     ->setAverageDistance($advancedGkTeams[$fakeIndex]['Sweeper-AvgDist'])
                     //shooting
                     ->setShootOnTarget(intval($shootingTeams[$fakeIndex]['Standard-SoT']))
                     ->setShootFromFreeKick(intval($shootingTeams[$fakeIndex]['Standard-FK']))
                     ->setShootOnTargetPercent(intval($shootingTeams[$fakeIndex]['Standard-SoT%']))
                     ->setShootPer90Minutes(intval($shootingTeams[$fakeIndex]['Standard-Sh/90']))
                     ->setShootOnTargetPer90Minutes(intval($shootingTeams[$fakeIndex]['Standard-SoT/90']))
                     ->setGoalPerShoot(intval($shootingTeams[$fakeIndex]['Standard-G/Sh']))
                     ->setGoalPerShootOnTarget(intval($shootingTeams[$fakeIndex]['Standard-G/SoT']))
                     //passing
                     ->setPassesCompleted($passingTeams[$fakeIndex]['Total-Cmp'])
                     ->setPassesAttempted($passingTeams[$fakeIndex]['Total-Att'])
                     ->setPassCompletion($passingTeams[$fakeIndex]['Total-Cmp%'])
                     ->setShortPassCompleted($passingTeams[$fakeIndex]['Short-Cmp'])
                     ->setShortPassAttempted($passingTeams[$fakeIndex]['Short-Att'])
                     ->setShortPassCompletion($passingTeams[$fakeIndex]['Short-Cmp%'])
                     ->setMediumPassCompleted($passingTeams[$fakeIndex]['Medium-Cmp'])
                     ->setMediumPassAttempted($passingTeams[$fakeIndex]['Medium-Att'])
                     ->setMediumPassCompletion($passingTeams[$fakeIndex]['Medium-Cmp%'])
                     ->setLongPassCompleted($passingTeams[$fakeIndex]['Long-Cmp'])
                     ->setLongPassAttempted($passingTeams[$fakeIndex]['Long-Att'])
                     ->setLongPassCompletion($passingTeams[$fakeIndex]['Long-Cmp%'])
                     //->setPassAttemptedFromFK($passingTeams[$fakeIndex]['Pass Types-FK'])
                     //->setThroughBalls($passingTeams[$fakeIndex]['Pass Types-TB'])
                     // ->setCornerKicks($passingTeams[$fakeIndex]['CK'])
                     // ->setThrowInsTaken($passingTeams[$fakeIndex]['TI'])
                     ->setPassIntoFinalThird($passingTeams[$fakeIndex]['1/3'])
                     ->setPassIntoPenaltyArea($passingTeams[$fakeIndex]['PPA'])
                     ->setCrossIntoPenaltyArea($passingTeams[$fakeIndex]['CrsPA'])
                     //typePass
                     ->setLivePasses($typePassTeams[$fakeIndex]['Pass Types-Live'])
                     ->setDeadPasses($typePassTeams[$fakeIndex]['Pass Types-Dead'])
                     ->setPressPasses($typePassTeams[$fakeIndex]['Pass Types-Press'])
                     ->setSwitchPasses($typePassTeams[$fakeIndex]['Pass Types-Sw'])
                     ->setGroundPasses($typePassTeams[$fakeIndex]['Height-Ground'])
                     ->setPassAttemptedFromFK($typePassTeams[$fakeIndex]['Pass Types-FK'])
                     ->setLowPasses($typePassTeams[$fakeIndex]['Height-Low'])
                     ->setHighPasses($typePassTeams[$fakeIndex]['Height-High'])
                     ->setThroughBalls($typePassTeams[$fakeIndex]['Pass Types-TB'])
                     ->setLeftFootPasses($typePassTeams[$fakeIndex]['Body Parts-Left'])
                     ->setRightFootPasses($typePassTeams[$fakeIndex]['Body Parts-Right'])
                     ->setBlockedPasses($typePassTeams[$fakeIndex]['Outcomes-Blocks'])
                     ->setOffsidesPasses($typePassTeams[$fakeIndex]['Outcomes-Off'])
                     //timming
                     ->setMinutesPlayed($timmingTeams[$fakeIndex]['Playing Time-Min'])
                     ->setSubstitutions($timmingTeams[$fakeIndex]['Subs-Subs'])
                     ->setPointPerMatch($timmingTeams[$fakeIndex]['Team Success-PPM'])
                     //defense
                     ->setTacklesWon($DefenseTeams[$fakeIndex]['Tackles-TklW'])
                     ->setInterceptions($DefenseTeams[$fakeIndex]['Int'])
                     ->setPressures($DefenseTeams[$fakeIndex]['Pressures-Press'])
                     ->setPressureSucceded($DefenseTeams[$fakeIndex]['Pressures-Succ'])
                     ->setPressureCompletion($DefenseTeams[$fakeIndex]['Pressures-%'])
                     ->setBallBlocked($DefenseTeams[$fakeIndex]['Blocks-Blocks'])
                     ->setShootBlocked($DefenseTeams[$fakeIndex]['Blocks-Sh'])
                     ->setShootOnTargetBlocked($DefenseTeams[$fakeIndex]['Blocks-ShSv'])
                     ->setPassBlocked($DefenseTeams[$fakeIndex]['Blocks-ShSv'])
                     ->setClearances($DefenseTeams[$fakeIndex]['Clr'])
                     ->setErrors($DefenseTeams[$fakeIndex]['Err'])
                     //miscellaneous
                     ->setYellowCards($miscellaneousTeams[$fakeIndex]['Performance-CrdY'])
                     ->setRedCards($miscellaneousTeams[$fakeIndex]['Performance-CrdR'])
                     ->setFoulCommited($miscellaneousTeams[$fakeIndex]['Performance-Fls'])
                     ->setFoulDrawn($miscellaneousTeams[$fakeIndex]['Performance-Fld'])
                     ->setOffsides($miscellaneousTeams[$fakeIndex]['Performance-Off'])
                     ->setCrosses($miscellaneousTeams[$fakeIndex]['Performance-Crs'])
                     ->setTacklesWon($miscellaneousTeams[$fakeIndex]['Performance-TklW'])
                     ->setInterceptions($miscellaneousTeams[$fakeIndex]['Performance-Int'])
                     ->setPenaltyKickWon($miscellaneousTeams[$fakeIndex]['Performance-PKwon'])
                     ->setPenaltyKickConceded($miscellaneousTeams[$fakeIndex]['Performance-PKcon'])
                     ->setOwnGoal($miscellaneousTeams[$fakeIndex]['Performance-OG'])
                     ->setArialDuelsWon($miscellaneousTeams[$fakeIndex]['Aerial Duels-Won'])
                     ->setArialDuelsLost($miscellaneousTeams[$fakeIndex]['Aerial Duels-Lost'])
                     ->setArialDuelsCompletion($miscellaneousTeams[$fakeIndex]['Aerial Duels-Won%'])
                     //possession
                     ->setDribblesSucceded($possessionTeams[$fakeIndex]['Dribbles-Succ'])
                     ->setDribblesAttempted($possessionTeams[$fakeIndex]['Dribbles-Att'])
                     ->setDribblesCompletion($possessionTeams[$fakeIndex]['Dribbles-Succ%'])
                     ->setBallControlls($possessionTeams[$fakeIndex]['Carries-Carries'])
                     ->setBallControllsMoveDistance($possessionTeams[$fakeIndex]['Carries-TotDist'])
                     ->setBallControllsMoveDistanceProgressive($possessionTeams[$fakeIndex]['Carries-PrgDist']);
                  $this->em->persist($verify);
               } else {
                  if (strpos($verify->getLeague(), $league) >= 0) {
                     $leagueString = $verify->getLeague() . '+' . $league;
                     $verify->setLeague($leagueString)
                        ->setLevel("");
                     $leagueString = "";
                  }
                  $verify
                     ->setMatchPlayed($verify->getMatchPlayed() + $teams['Performance-MP'])
                     ->setGoals($verify->getGoals() + $teams['Performance-Gls'])
                     ->setAssists($verify->getAssists() + $teams['Performance-Ast'])
                     ->setGoalsAgainst($verify->getGoalsAgainst() + $gkTeams[$fakeIndex]['Performance-GA'])
                     ->setGoalsAgainstPerMatch($gkTeams[$fakeIndex]['Performance-GA90'])
                     ->setSaves($verify->getSaves() + $gkTeams[$fakeIndex]['Performance-Saves'])
                     ->setShootOnTargetAgainst($verify->getShootOnTargetAgainst() + $gkTeams[$fakeIndex]['Performance-SoTA'])
                     ->setSavePercent(($verify->getSavePercent() + $gkTeams[$fakeIndex]['Performance-Save%']) / 2)
                     ->setCleanSheets($verify->getCleanSheets() + $gkTeams[$fakeIndex]['Performance-CS'])
                     ->setCleanSheetPercent(($verify->getCleanSheetPercent() + $gkTeams[$fakeIndex]['Performance-CS']) / 2)
                     ->setPenaltyKickAllowed($verify->getPenaltyKickAllowed() + $gkTeams[$fakeIndex]['Penalty Kicks-CS'])
                     ->setPenaltyKicksSaved($verify->getPenaltyKicksSaved() + $gkTeams[$fakeIndex]['Penalty Kicks-PKsv'])
                     ->setTopTeamScoorer("")
                     ->setGoalKeeper("")
                     ->setGkPassLaunchedComp($verify->getGkPassLaunchedComp() + $advancedGkTeams[$fakeIndex]['Launched-Cmp'])
                     ->setGkPassLaunchedAtt($verify->getGkPassLaunchedAtt() + $advancedGkTeams[$fakeIndex]['Launched-Att'])
                     ->setGkPassLaunchedCompletion(($verify->getGkPassLaunchedCompletion() + $advancedGkTeams[$fakeIndex]['Launched-Cmp%']) / 2)
                     ->setGkPassAttempted($verify->getGkPassAttempted() + $advancedGkTeams[$fakeIndex]['Passes-Att'])
                     ->setGkPassThrows($verify->getGkPassThrows() + $advancedGkTeams[$fakeIndex]['Passes-Thr'])
                     ->setGkPassLaunchedPercent(($verify->getGkPassLaunchedPercent() + $advancedGkTeams[$fakeIndex]['Passes-Launch%']) / 2)
                     ->setAvgLengthOfPasses($verify->getAvgLengthOfPasses() + $advancedGkTeams[$fakeIndex]['Passes-AvgLen'])
                     ->setGoalKicksAtt($verify->getGoalKicksAtt() + $advancedGkTeams[$fakeIndex]['Goal Kicks-Att'])
                     ->setGoalKicksLaunchedPercent(($verify->getGoalKicksLaunchedPercent() + $advancedGkTeams[$fakeIndex]['Goal Kicks-Launch%']) / 2)
                     ->setGoalKicksAvgLength($verify->getGoalKicksAvgLength() + $advancedGkTeams[$fakeIndex]['Goal Kicks-AvgLen'])
                     ->setGkCrossesAttempted($verify->getGkCrossesAttempted() + $advancedGkTeams[$fakeIndex]['Crosses-Opp'])
                     ->setGkCrossesStopped($verify->getGkCrossesStopped() + $advancedGkTeams[$fakeIndex]['Crosses-Stp'])
                     ->setGkCrossesStpPercent(($verify->getGkCrossesStpPercent() + $advancedGkTeams[$fakeIndex]['Crosses-Stp%']) / 2)
                     ->setOpa($verify->getOpa() + $advancedGkTeams[$fakeIndex]['Sweeper-#OPA'])
                     ->setOpaPerMatch(($verify->getOpaPerMatch() + $advancedGkTeams[$fakeIndex]['Sweeper-#OPA/90']) / 2)
                     ->setAverageDistance($verify->getAverageDistance() + $advancedGkTeams[$fakeIndex]['Sweeper-AvgDist'])
                     ->setShootOnTarget($verify->getShootOnTarget() + $shootingTeams[$fakeIndex]['Standard-SoT'])
                     ->setShootFromFreeKick($verify->getShootFromFreeKick() + $shootingTeams[$fakeIndex]['Standard-FK'])
                     ->setShootOnTargetPercent(($verify->getShootOnTargetPercent() + $shootingTeams[$fakeIndex]['Standard-SoT%']) / 2)
                     ->setShootPer90Minutes(($verify->getShootPer90Minutes() + $shootingTeams[$fakeIndex]['Standard-Sh/90']) / 2)
                     ->setShootOnTargetPer90Minutes(($verify->getShootOnTargetPer90Minutes() + $shootingTeams[$fakeIndex]['Standard-SoT/90']) / 2)
                     ->setGoalPerShoot($verify->getGoalPerShoot() + $shootingTeams[$fakeIndex]['Standard-G/Sh'])
                     ->setGoalPerShootOnTarget($verify->getGoalPerShootOnTarget() + $shootingTeams[$fakeIndex]['Standard-G/SoT'])
                     ->setPassesCompleted($verify->getPassesCompleted() + $passingTeams[$fakeIndex]['Total-Cmp'])
                     ->setPassesAttempted($verify->getPassesAttempted() + $passingTeams[$fakeIndex]['Total-Att'])
                     ->setPassCompletion(($verify->getPassCompletion() + $passingTeams[$fakeIndex]['Total-Cmp%']) / 2)
                     ->setShortPassCompleted($verify->getShortPassCompleted() + $passingTeams[$fakeIndex]['Short-Cmp'])
                     ->setShortPassAttempted($verify->getShortPassAttempted() + $passingTeams[$fakeIndex]['Short-Att'])
                     ->setShortPassCompletion(($verify->getShortPassCompletion() + $passingTeams[$fakeIndex]['Short-Cmp%']) / 2)
                     ->setMediumPassCompleted($verify->getMediumPassCompleted() + $passingTeams[$fakeIndex]['Medium-Cmp'])
                     ->setMediumPassAttempted($verify->getMediumPassAttempted() + $passingTeams[$fakeIndex]['Medium-Att'])
                     ->setMediumPassCompletion(($verify->getMediumPassCompletion() + $passingTeams[$fakeIndex]['Medium-Cmp%']) / 2)
                     ->setLongPassCompleted($verify->getLongPassCompleted() + $passingTeams[$fakeIndex]['Long-Cmp'])
                     ->setLongPassAttempted($verify->getLongPassAttempted() + $passingTeams[$fakeIndex]['Long-Att'])
                     ->setLongPassCompletion(($verify->getLongPassCompletion() + $passingTeams[$fakeIndex]['Long-Cmp%']) / 2)
                     ->setPassAttemptedFromFK($verify->getPassAttemptedFromFK() + $typePassTeams[$fakeIndex]['Pass Types-FK'])
                     // ->setCornerKicks($verify->getCornerKicks() + $passingTeams[$fakeIndex]['CK'])
                     // ->setThrowInsTaken($verify->getThrowInsTaken() + $passingTeams[$fakeIndex]['TI'])
                     ->setPassIntoFinalThird($verify->getPassIntoFinalThird() + $passingTeams[$fakeIndex]['1/3'])
                     ->setPassIntoPenaltyArea($verify->getPassIntoPenaltyArea() + $passingTeams[$fakeIndex]['PPA'])
                     ->setCrossIntoPenaltyArea($verify->getCrossIntoPenaltyArea() + $passingTeams[$fakeIndex]['CrsPA'])
                     //typePass
                     ->setLivePasses($verify->getLivePasses() + $typePassTeams[$fakeIndex]['Live'])
                     ->setDeadPasses($verify->getDeadPasses() + $typePassTeams[$fakeIndex]['Pass Types-Dead'])
                     ->setPressPasses($verify->getPressPasses() + $typePassTeams[$fakeIndex]['Pass Types-Press'])
                     ->setSwitchPasses($verify->getSwitchPasses() + $typePassTeams[$fakeIndex]['Pass Types-Sw'])
                     ->setGroundPasses($verify->getGroundPasses() + $typePassTeams[$fakeIndex]['Height-Ground'])
                     ->setPassAttemptedFromFK($verify->getPassAttemptedFromFK() + $typePassTeams[$fakeIndex]['Pass Types-FK'])
                     ->setLowPasses($verify->getLowPasses() + $typePassTeams[$fakeIndex]['Height-Low'])
                     ->setHighPasses($verify->getHighPasses() + $typePassTeams[$fakeIndex]['Height-High'])
                     ->setThroughBalls($verify->getThroughBalls() + $typePassTeams[$fakeIndex]['Pass Types-TB'])
                     ->setLeftFootPasses($verify->getLeftFootPasses() + $typePassTeams[$fakeIndex]['Body Parts-Left'])
                     ->setRightFootPasses($verify->getRightFootPasses() + $typePassTeams[$fakeIndex]['Body Parts-Right'])
                     ->setBlockedPasses($verify->getBlockedPasses() + $typePassTeams[$fakeIndex]['Outcomes-Blocks'])
                     ->setOffsidesPasses($verify->getOffsidesPasses() + $typePassTeams[$fakeIndex]['Outcomes-Off'])
                     ->setMinutesPlayed($verify->getMinutesPlayed() + $timmingTeams[$fakeIndex]['Playing Time-Min'])
                     ->setSubstitutions($verify->getSubstitutions() + $timmingTeams[$fakeIndex]['Subs-Subs'])
                     ->setPointPerMatch(($verify->getPointPerMatch() + $timmingTeams[$fakeIndex]['Team Success-PPM']) / 2)
                     //defense
                     ->setTacklesWon($verify->getTacklesWon() + $DefenseTeams[$fakeIndex]['Tackles-TklW'])
                     ->setInterceptions($verify->getInterceptions() + $DefenseTeams[$fakeIndex]['Int'])
                     ->setPressures($verify->getPressures() + $DefenseTeams[$fakeIndex]['Pressures-Press'])
                     ->setPressureSucceded($verify->getPressureSucceded() + $DefenseTeams[$fakeIndex]['Pressures-Succ'])
                     ->setPressureCompletion(($verify->getPressureCompletion() + $DefenseTeams[$fakeIndex]['Pressures-%']) / 2)
                     ->setBallBlocked($verify->getBallBlocked() + $DefenseTeams[$fakeIndex]['Blocks-Blocks'])
                     ->setShootBlocked($verify->getShootBlocked() + $DefenseTeams[$fakeIndex]['Blocks-Sh'])
                     ->setShootOnTargetBlocked($verify->getShootOnTargetBlocked() + $DefenseTeams[$fakeIndex]['Blocks-ShSv'])
                     ->setPassBlocked($verify->getPassBlocked() + $DefenseTeams[$fakeIndex]['Blocks-ShSv'])
                     ->setClearances($verify->getClearances() + $DefenseTeams[$fakeIndex]['Clr'])
                     ->setErrors($verify->getErrors() + $DefenseTeams[$fakeIndex]['Err'])

                     ->setYellowCards($verify->getYellowCards() + $miscellaneousTeams[$fakeIndex]['Performance-CrdY'])
                     ->setRedCards($verify->getRedCards() + $miscellaneousTeams[$fakeIndex]['Performance-CrdR'])
                     ->setFoulCommited($verify->getFoulCommited() + $miscellaneousTeams[$fakeIndex]['Performance-Fls'])
                     ->setFoulDrawn($verify->getFoulDrawn() + $miscellaneousTeams[$fakeIndex]['Performance-Fld'])
                     ->setOffsides($verify->getOffsides() + $miscellaneousTeams[$fakeIndex]['Off'])
                     ->setCrosses($verify->getCrosses() + $miscellaneousTeams[$fakeIndex]['Performance-Crs'])
                     ->setTacklesWon($verify->getTacklesWon() + $miscellaneousTeams[$fakeIndex]['Performance-TklW'])
                     ->setInterceptions($verify->getInterceptions() + $miscellaneousTeams[$fakeIndex]['Performance-Int'])
                     ->setArialDuelsWon($verify->getArialDuelsWon() + $miscellaneousTeams[$fakeIndex]['Aerial Duels-Won'])
                     ->setArialDuelsLost($verify->getArialDuelsLost() + $miscellaneousTeams[$fakeIndex]['Aerial Duels-Lost'])
                     ->setArialDuelsCompletion(($verify->getArialDuelsCompletion() + $miscellaneousTeams[$fakeIndex]['Aerial Duels-Won%']) / 2)
                     ->setPenaltyKickWon($verify->getPenaltyKickWon() + $miscellaneousTeams[$fakeIndex]['Performance-PKwon'])
                     ->setPenaltyKickConceded($verify->getGkPassLaunchedComp() + $miscellaneousTeams[$fakeIndex]['Performance-PKcon'])
                     ->setOwnGoal($verify->getOwnGoal() + $miscellaneousTeams[$fakeIndex]['Performance-OG'])
                     ->setDribblesSucceded($verify->getDribblesSucceded() + $possessionTeams[$fakeIndex]['Dribbles-Succ'])
                     ->setDribblesAttempted($verify->getDribblesAttempted() + $possessionTeams[$fakeIndex]['Dribbles-Att'])
                     ->setDribblesCompletion(($verify->getDribblesCompletion() + $possessionTeams[$fakeIndex]['Dribbles-Succ%']) / 2)
                     ->setBallControlls($verify->getBallControlls() + $possessionTeams[$fakeIndex]['Carries-Carries'])
                     ->setBallControllsMoveDistance($verify->getBallControllsMoveDistance() + $possessionTeams[$fakeIndex]['Carries-TotDist'])
                     ->setBallControllsMoveDistanceProgressive($verify->getBallControllsMoveDistanceProgressive() + $possessionTeams[$fakeIndex]['Carries-PrgDist']);

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

      $readerOfStandarsData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/csv/' . $dir . '/standard_data.csv');
      // $readerOfStandarsTeamData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/' . $dir . '/standars_team_data.csv');
      $readerOfPassingData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/csv/' . $dir . '/passing_data.csv');
      //  $readerOfPassingTeamData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/' . $dir . '/passing_team_data.csv');
      $readerOfShootingData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/csv/' . $dir . '/shooting_data.csv');
      //  $readerOfShootingTeamData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/' . $dir . '/shooting_team_data.csv');
      $readerOfTimmingData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/csv/' . $dir . '/timming_data.csv');
      //  $readerOfTimmingTeamData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/' . $dir . '/timming_team_data.csv');
      $readerOfMiscellaneousData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/csv/' . $dir . '/miscellaneous_data.csv');
      // $readerOfMiscellaneousTeamData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/' . $dir . '/miscellaneous_team_data.csv');
      $readerOfTypePassData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/csv/' . $dir . '/pass_type_data.csv');
      // $readerOfMiscellaneousTeamData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/' . $dir . '/miscellaneous_team_data.csv');
      $readerOfDefenseData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/csv/' . $dir . '/defense_data.csv');
      // $readerOfMiscellaneousTeamData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/' . $dir . '/miscellaneous_team_data.csv');
      $readerOfPossessionData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/csv/' . $dir . '/possession_data.csv');
      // $readerOfMiscellaneousTeamData = Reader::createFromPath('C:/wamp64/www/AITranfert/public/' . $dir . '/miscellaneous_team_data.csv');

      // $readerOfStandarsData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $dir . '/standard_data.csv');
      // // $readerOfStandarsTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/standars_team_data.csv');
      // $readerOfPassingData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $dir . '/passing_data.csv');
      // //  $readerOfPassingTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/passing_team_data.csv');
      // $readerOfShootingData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $dir . '/shooting_data.csv');
      // //  $readerOfShootingTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/shooting_team_data.csv');
      // $readerOfTimmingData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $dir . '/timming_data.csv');
      // //  $readerOfTimmingTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/timming_team_data.csv');
      // $readerOfMiscellaneousData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $dir . '/miscellaneous_data.csv');
      // // $readerOfMiscellaneousTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/miscellaneous_team_data.csv');
      // $readerOfTypePassData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $dir . '/pass_type_data.csv');
      // // $readerOfMiscellaneousTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/miscellaneous_team_data.csv');
      // $readerOfDefenseData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $dir . '/defense_data.csv');
      // // $readerOfMiscellaneousTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/miscellaneous_team_data.csv');
      // $readerOfPossessionData = Reader::createFromPath('%kernel.root_dir%/../public/csv/' . $dir . '/possession_data.csv');
      // // $readerOfMiscellaneousTeamData = Reader::createFromPath('%kernel.root_dir%/../public/' . $dir . '/miscellaneous_team_data.csv');


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





      $standars = $readerOfStandarsData->setHeaderOffset(0);
      $passing = $readerOfPassingData->setHeaderOffset(0);
      $shooting = $readerOfShootingData->setHeaderOffset(0);
      $timming = $readerOfTimmingData->setHeaderOffset(0);
      $miscellaneous = $readerOfMiscellaneousData->setHeaderOffset(0);
      $typePass = $readerOfTypePassData->setHeaderOffset(0);
      $defense = $readerOfDefenseData->setHeaderOffset(0);
      $possession = $readerOfPossessionData->setHeaderOffset(0);

      $standars->getHeader();
      // $standarsTeams = $readerOfStandarsTeamData->setHeaderOffset(0);
      // $passingTeams = $readerOfPassingTeamData->setHeaderOffset(0);
      // $shootingTeams = $readerOfShootingTeamData->setHeaderOffset(0);
      // $timmingTeams = $readerOfTimmingTeamData->setHeaderOffset(0);
      // $miscellaneousTeams = $readerOfMiscellaneousData->setHeaderOffset(0);

      // $permierLeagueTeams = $readerPermierLeagueTeams->setHeaderOffset(0);
      // $permierLeagueTeamsOtherData = $readerPermierLeagueTeamsOtherData->setHeaderOffset(0);

      $standars = iterator_to_array($readerOfStandarsData, false);
      $passing = iterator_to_array($readerOfPassingData, false);
      $shooting = iterator_to_array($readerOfShootingData, false);
      $timming = iterator_to_array($readerOfTimmingData, false);
      $miscellaneous = iterator_to_array($readerOfMiscellaneousData, false);
      $typePass = iterator_to_array($readerOfTypePassData, false);
      $defense = iterator_to_array($readerOfDefenseData, false);
      $possession = iterator_to_array($readerOfPossessionData, false);

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

         $name = explode("\\", $row['Player'], 2)[1];
         $verify = $this->em->getRepository(Player::class)
            ->findOneBy([
               'Name' => $name,
               'born' => $row['Born'],
               'position' =>  $row['Pos'],
               'squad' => $squad
            ]);


         if (empty($verify)) {
            $player = (new player())
               ->setIdPlayer($comp)
               ->setName($name)
               ->setNation($row['Nation'])
               ->setPosition($row['Pos'])
               ->setSquad($squad)
               ->setAge(intval($row['Age']))
               ->setBorn(intval($row['Born']))
               ->setMatchsPlayed(intval($row['Playing Time-MP']))
               ->setMinutesPlayed(intval($row['Playing Time-Min']))
               ->setMinutesPercentPlayed(floatval($row['Playing Time-Min%']))
               ->setNintyMinPlayed(floatval($row['Playing Time-90s']))
               //to redo
               ->setMinPerMatchStarted(/*floatval($timming['Starts-Mn/Start']) ? :*/0)
               ->setPointsPerMatch(/*floatval($timming['PPM']) ? :*/0)
               ////////////////////
               // ->setMatchsPlayed(0)
               // ->setMatchStarts(0)
               // ->setMinsPlayed(0)
               // ->setGoals(0)
               // ->setAssists(0)
               ->setPkMade(0)
               ->setPkAttempted(0)
               ->setYellowCard(0)
               ->setRedCard(0)
               ->setGoalsPerMin(0.0)
               ->setAssistsPerMin(0.0)
               ->setGlsAssPerMin(0.0)
               ->setGoalsWithoutPkPerMin(0.0)
               // new datas 
               ->setGoalsWithoutPK(0)
               ->setPenaltyKicksMissed(0)
               ->setCornerKicksGlsAgainst(0)
               ->setAverageDistShootFromGoal(0.0)
               ->setPassTotalDistance(0)
               ->setPassTotalPrgDistance(0)
               ->setProgressivePasses(0)
               //passtype
               ->setCornerKicks(0)
               ->setThrowInsTaken(0)
               ->setPartsOtherPasses(0)
               ->setHeadPasses(0)
               ->setStraightCKs(0)
               ->setOutswingingCKs(0)
               ->setInswingingCKs(0)
               // defense
               ->setPressInMidThird(0)
               ->setPressInDefThird(0)
               ->setPressInAttThird(0)
               ->setTacklesInAttThird(0)
               ->setTacklesInMidThird(0)
               ->setTacklesInDefThird(0)
               //possesion
               ->setTouchesInMidThird(0)
               ->setTouchesInAttThird(0)
               ->setTouchesInDefThird(0)
               ->setLiveBallTouched(0)
               ->setProgressivePassRecieved(0)
               ->setCarriesInto18YardBox(0)
               ->setCarriesCloseToGoal(0)
               ///////////////////////////

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
            if ($row['Player'] == $standars[$index]['Player']) {

               $player->setMatchsPlayed(intval($standars[$index]['Playing Time-MP'] ?? 0))
                  ->setMatchStarts(intval($standars[$index]['Playing Time-Starts'] ?? 0))
                  ->setMinsPlayed(intval($standars[$index]['Playing Time-Min'] ?? 0))
                  ->setGoals(intval($standars[$index]['Performance-Gls'] ?? 0))
                  ->setAssists(intval($standars[$index]['Performance-Ast'] ?? 0))
                  ->setPkMade(intval($standars[$index]['Performance-PK'] ?? 0))
                  ->setPkAttempted(intval($standars[$index]['Performance-PKatt'] ?? 0))
                  ->setYellowCard(intval($standars[$index]['Performance-CrdY'] ?? 0))
                  ->setRedCard(intval($standars[$index]['Performance-CrdR'] ?? 0))
                  ->setGoalsPerMin(floatval($standars[$index]['Per 90 Minutes-Gls'] ?? 0.0))
                  ->setAssistsPerMin(floatval($standars[$index]['Per 90 Minutes-Ast'] ?? 0.0))
                  ->setGlsAssPerMin(floatval($standars[$index]['Per 90 Minutes-G+A'] ?? 0.0))
                  ->setGoalsWithoutPkPerMin(floatval($standars[$index]['Per 90 Minutes-G-PK'] ?? 0.0))
                  ->setGlsAssWithoutPkPerMin(floatval($standars[$index]['Per 90 Minutes-G+A-PK'] ?? 0.0))
                  ->setGoalsExp(floatval($standars[$index]['Expected-xG'] ?? 0.0))
                  ->setNonPenGoalsExp(floatval($standars[$index]['Expected-npxG'] ?? 0.0))
                  ->setAssistsExp(floatval($standars[$index]['Expected-xA'] ?? 0.0))
                  ->setGoalsPerMinExp(floatval($standars[$index]['Per 90 Minutes-xG'] ?? 0.0))
                  ->setAssistsPerMinExp(floatval($standars[$index]['Per 90 Minutes-xA']) ?? 0.0)
                  ->setGlsAssistsPerMinExp(floatval($standars[$index]['Per 90 Minutes-xG+xA'] ?? 0.0))
                  ->setNonPenGoalsExpPerMin(floatval($standars[$index]['Per 90 Minutes-npxG'] ?? 0.0))
                  ->setNonPenGoalsAssistsExpPerMin(floatval($standars[$index]['Per 90 Minutes-npxG+xA'] ?? 0.0));
            } else {
               for ($i = 0; $i <= count($standars) - 1; $i++) {

                  if ($row['Player'] == $standars[$i]['Player']) {

                     $player->setMatchsPlayed(intval($standars[$i]['Playing Time-MP'] ?? 0))
                        ->setMatchStarts(intval($standars[$i]['Playing Time-Starts'] ?? 0))
                        ->setMinsPlayed(intval($standars[$i]['Playing Time-Min'] ?? 0))
                        ->setGoals(intval($standars[$i]['Performance-Gls'] ?? 0))
                        ->setAssists(intval($standars[$i]['Performance-Ast'] ?? 0))
                        ->setPkMade(intval($standars[$i]['Performance-PK'] ?? 0))
                        ->setPkAttempted(intval($standars[$i]['Performance-PKatt'] ?? 0))
                        ->setYellowCard(intval($standars[$i]['Performance-CrdY'] ?? 0))
                        ->setRedCard(intval($standars[$i]['Performance-CrdR'] ?? 0))
                        ->setGoalsPerMin(floatval($standars[$i]['Per 90 Minutes-Gls'] ?? 0.0))
                        ->setAssistsPerMin(floatval($standars[$i]['Per 90 Minutes-Ast'] ?? 0.0))
                        ->setGlsAssPerMin(floatval($standars[$i]['Per 90 Minutes-G+A'] ?? 0.0))
                        ->setGoalsWithoutPkPerMin(floatval($standars[$i]['Per 90 Minutes-G-PK'] ?? 0.0))
                        ->setGlsAssWithoutPkPerMin(floatval($standars[$i]['Per 90 Minutes-G+A-PK'] ?? 0.0))
                        ->setGoalsExp(floatval($standars[$i]['Expected-xG'] ?? 0.0))
                        ->setNonPenGoalsExp(floatval($standars[$i]['Expected-npxG'] ?? 0.0))
                        ->setAssistsExp(floatval($standars[$i]['Expected-xA'] ?? 0.0))
                        ->setGoalsPerMinExp(floatval($standars[$i]['Per 90 Minutes-xG'] ?? 0.0))
                        ->setAssistsPerMinExp(floatval($standars[$i]['Per 90 Minutes-xA'] ?? 0.0))
                        ->setGlsAssistsPerMinExp(floatval($standars[$i]['Per 90 Minutes-xG_xA'] ?? 0.0))
                        ->setNonPenGoalsExpPerMin(floatval($standars[$i]['Per 90 Minutes-npxG'] ?? 0.0))
                        ->setNonPenGoalsAssistsExpPerMin(floatval($standars[$i]['Per 90 Minutes-npxG_xA'] ?? 0.0));
                     break;
                  }
               }
            }

            $index = $fakeindex;
            if ($index > count($shooting) - 1) {
               $index = 0;
            }
            if ($row['Player'] == $shooting[$index]['Player']) {
               $player->setShoots(intval($shooting[$index]['Standard-Sh'] ?? 0))
                  ->setShootsOnTarget(intval($shooting[$index]['Standard-SoT'] ?? 0))
                  ->setShootsFromFrKc(intval($shooting[$index]['Standard-FK'] ?? 0))
                  ->setShootsOnTargetPc(floatval($shooting[$index]['Standard-SoT%'] ?? 0.0))
                  ->setShootsPerMatch(floatval($shooting[$index]['Standard-Sh/90'] ?? 0.0))
                  ->setShootsOnTargetPerMatch(floatval($shooting[$index]['Standard-SoT/90'] ?? 0.0))
                  ->setGoalsPerShoot(floatval($shooting[$index]['Standard-G/Sh'] ?? 0.0))
                  ->setGoalPerShootOnTarget(floatval($shooting[$index]['Standard-G/SoT'] ?? 0.0));
            } else {
               for ($i = 0; $i <= count($shooting) - 1; $i++) {

                  if ($row['Player'] == $shooting[$i]['Player']) {

                     $player->setShoots(intval($shooting[$i]['Standard-Sh'] ?? 0))
                        ->setShootsOnTarget(intval($shooting[$i]['Standard-SoT'] ?? 0))
                        ->setShootsFromFrKc(intval($shooting[$i]['Standard-FK'] ?? 0))
                        ->setShootsOnTargetPc(floatval($shooting[$i]['Standard-SoT%'] ?? 0.0))
                        ->setShootsPerMatch(floatval($shooting[$i]['Standard-Sh/90'] ?? 0.0))
                        ->setShootsOnTargetPerMatch(floatval($shooting[$i]['Standard-SoT/90'] ?? 0.0))
                        ->setGoalsPerShoot(floatval($shooting[$i]['Standard-G/Sh'] ?? 0.0))
                        ->setGoalPerShootOnTarget(floatval($shooting[$i]['Standard-G/SoT'] ?? 0.0));
                     break;
                  }
               }
            }




            $index = $fakeindex;
            if ($index > count($passing) - 1) {
               $index = 0;
            }
            if ($row['Player'] == $passing[$index]['Player']) {
               $player->setKeyPasses(intval($passing[$index]['KP'] ?? 0))
                  ->setPassesCompleted(intval($passing[$index]['Total-Cmp'] ?? 0))
                  ->setPassesAttempted(intval($passing[$index]['Total-Att'] ?? 0))
                  ->setPassCompPercent(floatval($passing[$index]['Total-Cmp%'] ?? 0.0))
                  ->setShortPassesCompleted(intval($passing[$index]['Short-Cmp'] ?? 0))
                  ->setShortpassesAttempted(intval($passing[$index]['Short-Att'] ?? 0))
                  ->setShortPassesCompPercent(floatval($passing[$index]['Short-Cmp%'] ?? 0.0))
                  ->setMediumPassesCompleted(intval($passing[$index]['Medium-Cmp'] ?? 0))
                  ->setMediumPassesAttempted(intval($passing[$index]['Medium-Att'] ?? 0))
                  ->setMediumPassesCompPercent(floatval($passing[$index]['Medium-Cmp%'] ?? 0.0))
                  ->setLongPassCompleted(intval($passing[$index]['Long-Cmp'] ?? 0))
                  ->setLongPassesAttempted(intval($passing[$index]['Long-Att'] ?? 0))
                  ->setLongPassesCompPercent(floatval($passing[$index]['Long-Cmp%'] ?? 0.0))
                  ->setPassCompletedFinalThird(intval($passing[$index]['1/3'] ?? 0))
                  ->setPassCompletedPenaltyArea(intval($passing[$index]['PPA'] ?? 0))
                  //->setThroughBalls(intval($passing[$index]['Pass Types-TB'] ?? 0))
                  ->setCrossIntoPenaltyArea(floatval($passing[$index]['CrsPA'] ?? 0.0));
            } else {
               for ($i = 0; $i <= count($passing) - 1; $i++) {

                  if ($row['Player'] == $passing[$i]['Player']) {
                     $player->setKeyPasses(intval($passing[$i]['KP'] ?? 0))
                        ->setPassesCompleted(intval($passing[$i]['Total-Cmp'] ?? 0))
                        ->setPassesAttempted(intval($passing[$i]['Total-Att'] ?? 0))
                        ->setPassCompPercent(floatval($passing[$i]['Total-Cmp%'] ?? 0.0))
                        ->setShortPassesCompleted(intval($passing[$i]['Short-Cmp'] ?? 0))
                        ->setShortpassesAttempted(intval($passing[$i]['Short-Att'] ?? 0))
                        ->setShortPassesCompPercent(floatval($passing[$i]['Short-Cmp%'] ?? 0.0))
                        ->setMediumPassesCompleted(intval($passing[$i]['Medium-Cmp'] ?? 0))
                        ->setMediumPassesAttempted(intval($passing[$i]['Medium-Att'] ?? 0))
                        ->setMediumPassesCompPercent(floatval($passing[$i]['Medium-Cmp%'] ?? 0.0))
                        ->setLongPassCompleted(intval($passing[$i]['Long-Cmp'] ?? 0))
                        ->setLongPassesAttempted(intval($passing[$i]['Long-Att'] ?? 0))
                        ->setLongPassesCompPercent(floatval($passing[$i]['Long-Cmp%'] ?? 0.0))
                        ->setPassCompletedFinalThird(intval($passing[$i]['1/3'] ?? 0))
                        ->setPassCompletedPenaltyArea(intval($passing[$i]['PPA'] ?? 0))
                        //->setThroughBalls(intval($passing[$i]['Pass Types-TB'] ?? 0))
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
            if ($row['Player'] == $typePass[$index]['Player']) {
               $player->setLivePass(intval($typePass[$index]['KP'] ?? 0))
                  ->setDeadPasses(intval($typePass[$index]['Pass Types-Dead'] ?? 0))
                  ->setPressPasses(intval($typePass[$index]['Pass Types-Press'] ?? 0))
                  ->setSwitchPasses(floatval($typePass[$index]['Pass Types-Sw'] ?? 0.0))
                  ->setGroundPasses(intval($typePass[$index]['Height-Ground'] ?? 0))
                  ->setLowPasses(intval($typePass[$index]['Height-Low'] ?? 0))
                  ->setHighPasses(floatval($typePass[$index]['Height-High'] ?? 0.0))
                  ->setLeftFootPasses(intval($typePass[$index]['Body Parts-Left'] ?? 0))
                  ->setRightFootPasses(intval($typePass[$index]['Body Parts-Right'] ?? 0))
                  ->setBlockedPasses(floatval($typePass[$index]['Outcomes-Blocks'] ?? 0.0))
                  ->setOffsidesPasses(intval($typePass[$index]['Outcomes-Off'] ?? 0))
                  ->setPassAttemptedFromFK(intval($typePass[$index]['Pass Types-FK'] ?? 0))
                  ->setThroughBalls(intval($typePass[$index]['Pass Types-TB'] ?? 0));
            } else {
               for ($i = 0; $i <= count($typePass) - 1; $i++) {

                  if ($row['Player'] == $typePass[$i]['Player']) {
                     $player->setLivePass(intval($typePass[$i]['KP'] ?? 0))
                        ->setDeadPasses(intval($typePass[$i]['Pass Types-Dead'] ?? 0))
                        ->setPressPasses(intval($typePass[$i]['Pass Types-Press'] ?? 0))
                        ->setSwitchPasses(floatval($typePass[$i]['Pass Types-Sw'] ?? 0.0))
                        ->setGroundPasses(intval($typePass[$i]['Height-Ground'] ?? 0))
                        ->setLowPasses(intval($typePass[$i]['Height-Low'] ?? 0))
                        ->setHighPasses(floatval($typePass[$i]['Height-High'] ?? 0.0))
                        ->setLeftFootPasses(intval($typePass[$i]['Body Parts-Left'] ?? 0))
                        ->setRightFootPasses(intval($typePass[$i]['Body Parts-Right'] ?? 0))
                        ->setBlockedPasses(floatval($typePass[$i]['Outcomes-Blocks'] ?? 0.0))
                        ->setOffsidesPasses(intval($typePass[$i]['Outcomes-Off'] ?? 0))
                        ->setPassAttemptedFromFK(intval($typePass[$i]['Pass Types-FK'] ?? 0))
                        ->setThroughBalls(intval($typePass[$i]['Pass Types-TB'] ?? 0));
                     break;
                  }
               }
            }
            ////////////////////////////////////////////////////////////////////////////////
            $index = $fakeindex;
            if ($index > count($defense) - 1) {
               $index = 0;
            }
            if ($row['Player'] == $defense[$index]['Player']) {
               $player->setTacklesWon(intval($defense[$index]['Tackles-TklW'] ?? 0))
                  ->setInterceptions(intval($defense[$index]['Int'] ?? 0))
                  ->setPressures(intval($defense[$index]['Pressures-Press'] ?? 0))
                  ->setPressureSucceded(intval($defense[$index]['Pressures-Succ'] ?? 0))
                  ->setPressureCompletion(intval($defense[$index]['Pressures-%'] ?? 0))
                  ->setBallBlocked(floatval($defense[$index]['Blocks-Blocks'] ?? 0.0))
                  ->setShootBlocked(intval($defense[$index]['Blocks-Sh'] ?? 0))
                  ->setShootOntTargetBlocked(intval($defense[$index]['Blocks-ShSv'] ?? 0))
                  ->setPassBlocked(floatval($defense[$index]['Blocks-Pass'] ?? 0.0))
                  ->setDribbleTackled(intval($defense[$index]['Vs Dribbles-Tkl'] ?? 0))
                  ->setDribbleTackledPercent(floatval($defense[$index]['Vs Dribbles-Tkl%'] ?? 0.0))
                  ->setTimesDribbledPast(intval($defense[$index]['Vs Dribbles-Past'] ?? 0))
                  ->setClearances(intval($defense[$index]['Clr'] ?? 0))
                  ->setErrors(intval($defense[$index]['Err'] ?? 0));
            } else {
               for ($i = 0; $i <= count($defense) - 1; $i++) {

                  if ($row['Player'] == $defense[$i]['Player']) {
                     $player->setTacklesWon(intval($defense[$i]['Tackles-TklW'] ?? 0))
                        ->setInterceptions(intval($defense[$i]['Int'] ?? 0))
                        ->setPressures(intval($defense[$i]['Pressures-Press'] ?? 0))
                        ->setPressureSucceded(intval($defense[$i]['Pressures-Succ'] ?? 0))
                        ->setPressureCompletion(intval($defense[$i]['Pressures-%'] ?? 0))
                        ->setBallBlocked(floatval($defense[$i]['Blocks-Blocks'] ?? 0.0))
                        ->setShootBlocked(intval($defense[$i]['Blocks-Sh'] ?? 0))
                        ->setShootOntTargetBlocked(intval($defense[$i]['Blocks-ShSv'] ?? 0))
                        ->setDribbleTackled(intval($defense[$i]['Vs Dribbles-Tkl'] ?? 0))
                        ->setDribbleTackledPercent(floatval($defense[$i]['Vs Dribbles-Tkl%'] ?? 0.0))
                        ->setTimesDribbledPast(intval($defense[$i]['Vs Dribbles-Past'] ?? 0))
                        ->setPassBlocked(floatval($defense[$i]['Blocks-ShSv'] ?? 0.0))
                        ->setClearances(intval($defense[$i]['Clr'] ?? 0))
                        ->setErrors(intval($defense[$i]['Err'] ?? 0));
                     break;
                  }
               }
            }
            ///////////////////////////////////////////////////////////////////////////////
            $index = $fakeindex;
            if ($index > count($miscellaneous) - 1) {
               $index = 0;
            }
            if ($row['Player'] == $miscellaneous[$index]['Player']) {

               $player->setFoulsCommited(intval($miscellaneous[$index]['Performance-Fls'] ?? 0))
                  ->setFoulsDrawn(intval($miscellaneous[$index]['Performance-Fld'] ?? 0))
                  ->setOffsides(intval($miscellaneous[$index]['Performance-Off'] ?? 0))
                  ->setCrosses(intval($miscellaneous[$index]['Crs'] ?? 0))
                  ->setTacklesWon(intval($miscellaneous[$index]['Performance-TklW'] ?? 0))
                  ->setInterceptions(intval($miscellaneous[$index]['Int'] ?? 0))
                  ->setPenaltyKicksWon(intval($miscellaneous[$index]['Performance-PKwon'] ?? 0))
                  ->setPenaltyKicksConceded(intval($miscellaneous[$index]['Performance-PKcon'] ?? 0))
                  ->setOwnGoal(intval($miscellaneous[$index]['Performance-OG'] ?? 0))
                  // ->setSecondYellowCard($miscellaneous[$index]['2CrdY'])
                  ->setArialDuelsWon(intval($miscellaneous[$index]['Aerial Duels-Won']))
                  ->setArialDuelsLost(intval($miscellaneous[$index]['Aerial Duels-Lost']))
                  ->setArialDuelsCompletion(intval($miscellaneous[$index]['Aerial Duels-Won%']));
            } else {
               for ($i = 0; $i <= count($miscellaneous) - 1; $i++) {

                  if ($row['Player'] == $miscellaneous[$i]['Player']) {

                     $player->setFoulsCommited(intval($miscellaneous[$i]['Performance-Fls'] ?? 0))
                        ->setFoulsDrawn(intval($miscellaneous[$i]['Performance-Fld'] ?? 0))
                        ->setOffsides(intval($miscellaneous[$i]['Performance-Off'] ?? 0))
                        ->setCrosses(intval($miscellaneous[$i]['Crs'] ?? 0))
                        ->setTacklesWon(intval($miscellaneous[$i]['Performance--TklW'] ?? 0))
                        ->setInterceptions(intval($miscellaneous[$i]['Int'] ?? 0))
                        ->setPenaltyKicksWon(intval($miscellaneous[$i]['Performance-PKwon'] ?? 0))
                        ->setPenaltyKicksConceded(intval($miscellaneous[$i]['Performance-PKcon'] ?? 0))
                        ->setOwnGoal(intval($miscellaneous[$i]['Performance-OG'] ?? 0))
                        // ->setSecondYellowCard(intval($miscellaneous[$i]['2CrdY'] ?? 0))
                        ->setArialDuelsWon(intval($miscellaneous[$i]['Aerial Duels-Won']))
                        ->setArialDuelsLost(intval($miscellaneous[$i]['Aerial Duels-Lost']))
                        ->setArialDuelsCompletion(intval($miscellaneous[$i]['Aerial Duels-Won%']));
                     break;
                  }
               }
            }
            /////////////////////////////////////////////////////////////////////
            $index = $fakeindex;
            if ($index > count($possession) - 1) {
               $index = 0;
            }
            if ($row['Player'] == $possession[$index]['Player']) {
               $player->setBallControlls(intval($possession[$index]['Carries-Carries'] ?? 0))
                  ->setBallControllsMoveDistance(intval($possession[$index]['Carries-TotDist'] ?? 0))
                  ->setBallControllsMoveDistanceProgressive(intval($possession[$index]['Carries-PrgDist'] ?? 0))
                  ->setReceivingBallAttempted(intval($possession[$index]['Targ'] ?? 0))
                  ->setReceivingBallCompleted(intval($possession[$index]['Rec'] ?? 0))
                  ->setReceivingBallCompletion(floatval($possession[$index]['Rec%'] ?? 0.0))
                  ->setMisControlls(intval($possession[$index]['Miscon'] ?? 0))
                  ->setDispossessed(intval($possession[$index]['Dispos'] ?? 0))
                  ->setDribbleCompleted(intval($possession[$index]['Dribbles-Succ'] ?? 0))
                  ->setDribbleAttempted(intval($possession[$index]['Dribbles-Att'] ?? 0))
                  ->setDribblePercent(floatval($possession[$index]['Dribbles-Succ%'] ?? 0.0))
                  ->setNumberOfPlayerDriblled(intval($possession[$index]['Dribbles-#Pl'] ?? 0))
                  ->setNutmegs(intval($possession[$index]['Dribbles-Megs'] ?? 0));
            } else {
               for ($i = 0; $i <= count($possession) - 1; $i++) {

                  if ($row['Player'] == $possession[$i]['Player']) {
                     $player->setBallControlls(intval($possession[$i]['Carries-Carries'] ?? 0))
                        ->setBallControllsMoveDistance(intval($possession[$i]['Carries-TotDist'] ?? 0))
                        ->setBallControllsMoveDistanceProgressive(intval($possession[$i]['Carries-PrgDist'] ?? 0))
                        ->setReceivingBallAttempted(intval($possession[$i]['Targ'] ?? 0))
                        ->setReceivingBallCompleted(intval($possession[$i]['Rec'] ?? 0))
                        ->setReceivingBallCompletion(floatval($possession[$i]['Rec%'] ?? 0.0))
                        ->setMisControlls(intval($possession[$i]['Miscon'] ?? 0))
                        ->setDispossessed(intval($possession[$i]['Dispos'] ?? 0))
                        ->setDribbleCompleted(intval($possession[$i]['Dribbles-Succ'] ?? 0))
                        ->setDribbleAttempted(intval($possession[$i]['Dribbles-Att'] ?? 0))
                        ->setDribblePercent(floatval($possession[$i]['Dribbles-Succ%'] ?? 0.0))
                        ->setNumberOfPlayerDriblled(intval($possession[$i]['Dribbles-#Pl'] ?? 0))
                        ->setNutmegs(intval($possession[$i]['Dribbles-Megs'] ?? 0));
                     break;
                  }
               }
            }

            /////////////////////////////////////////////////////////////////////
            $index = $fakeindex;
            if ($index > count($timming) - 1) {
               $index = 0;
            }
            if ($row['Player'] == $timming[$index]['Player']) {
               $verify->setMinutesPerMatchPlayeds(intval($timming[$index]['Playing Time-Mn/MP'] ?? 0))
                  ->setPercentageOfMinutesPlayed(floatval($timming[$index]['Playing Time-Min%'] ?? 0))
                  ->setMinPerMatchStarted(intval($timming[$index]['Starts-Mn/Start'] ?? 0))
                  ->setnintyMinPlayed(floatval($timming[$index]['Playing Time-90s'] ?? 0))
                  ->setCompleteMatchsPlayed(intval($timming[$index]['Starts-Compl'] ?? 0))
                  ->setMatchsAsSubstitute(intval($timming[$index]['Subs-Subs'] ?? 0.0))
                  ->setMintuesPerSubstitute(intval($timming[$index]['Subs-Mn/Sub'] ?? 0))
                  ->setMatchsAsUnusedSubstitute(intval($timming[$index]['Subs-unSub'] ?? 0))
                  ->setPointsPerMatch(intval($timming[$index]['Team Success-PPM'] ?? 0))
                  ->setGoalScoredByTeamWhileOnPitch(intval($timming[$index]['Team Success-onG'] ?? 0))
                  ->setGoalAllowedByTeamWhileOnPitch(intval($timming[$index]['Team Success-onGA'] ?? 0))
                  ->setgoalScoredMinusAllowedWhileOnPitchPer90(floatval($timming[$index]['Team Success-+/-90'] ?? 0));
            } else {
               for ($i = 0; $i <= count($timming) - 1; $i++) {

                  if ($row['Player'] == $timming[$i]['Player']) {
                     $verify->setMinutesPerMatchPlayeds(intval($timming[$i]['Playing Time-Mn/MP'] ?? 0))
                        ->setPercentageOfMinutesPlayed(intval($timming[$i]['Playing Time-Min%'] ?? 0))
                        ->setMinPerMatchStarted(intval($timming[$i]['Starts-Mn/Start'] ?? 0))
                        ->setnintyMinPlayed(intval($timming[$i]['Playing Time-90s'] ?? 0))
                        ->setCompleteMatchsPlayed(intval($timming[$i]['Starts-Compl'] ?? 0))
                        ->setMatchsAsSubstitute(floatval($timming[$i]['Subs-Subs'] ?? 0.0))
                        ->setMintuesPerSubstitute(intval($timming[$i]['Subs-Mn/Sub'] ?? 0))
                        ->setMatchsAsUnusedSubstitute(intval($timming[$i]['Subs-unSub'] ?? 0))
                        ->setPointsPerMatch(intval($timming[$i]['Team Success-PPM'] ?? 0))
                        ->setGoalScoredByTeamWhileOnPitch(intval($timming[$i]['Team Success-onG'] ?? 0))
                        ->setGoalAllowedByTeamWhileOnPitch(intval($timming[$i]['Team Success-onGA'] ?? 0))
                        ->setgoalScoredMinusAllowedWhileOnPitchPer90(floatval($timming[$i]['Team Success-+/-90'] ?? 0));
                     break;
                  }
               }
            }
            ////////////////////////////////////////////////////////////////


            $this->em->persist($player);
         } else {

            $verify->setMinutesPlayed(intval($row['Playing Time-Min'] ?? 0))
               ->setMinutesPercentPlayed(floatval($row['Min%'] ?? 0.0))
               ->setNintyMinPlayed(floatval($row['90s'] ?? 0.0))
               ->setMinPerMatchStarted(floatval($row['Mn/Start'] ?? 0.0))
               ->setPointsPerMatch(floatval($row['PPM'] ?? 0.0));

            if ($index > count($standars) - 1) {
               $index = 0;
            }
            if ($row['Player'] == $standars[$index]['Player']) {

               $verify->setMatchsPlayed(intval($standars[$index]['Playing Time-MP'] ?? 0))
                  ->setMatchStarts(intval($standars[$index]['Playing Time-Starts'] ?? 0))
                  ->setMinsPlayed(intval($standars[$index]['Playing Time-Min'] ?? 0))
                  ->setGoals(intval($standars[$index]['Performance-Min'] ?? 0))
                  ->setAssists(intval($standars[$index]['Performance-Ast'] ?? 0))
                  ->setPkMade(intval($standars[$index]['Performance-PK'] ?? 0))
                  ->setPkAttempted(intval($standars[$index]['Performance-PKatt'] ?? 0))
                  ->setYellowCard(intval($standars[$index]['Performance-CrdY'] ?? 0))
                  ->setRedCard(intval($standars[$index]['Performance-CrdR'] ?? 0))
                  ->setGoalsPerMin(floatval($standars[$index]['Per 90 Minutes-Gls'] ?? 0.0))
                  ->setAssistsPerMin(floatval($standars[$index]['Per 90 Minutes-Ast'] ?? 0.0))
                  ->setGlsAssPerMin(floatval($standars[$index]['Per 90 Minutes-G+A'] ?? 0.0))
                  ->setGoalsWithoutPkPerMin(floatval($standars[$index]['Per 90 Minutes-G-PK'] ?? 0.0))
                  ->setGlsAssWithoutPkPerMin(floatval($standars[$index]['Per 90 Minutes-G+A-PK'] ?? 0.0))
                  ->setGoalsExp(floatval($standars[$index]['Expected-xG'] ?? 0.0))
                  ->setNonPenGoalsExp(floatval($standars[$index]['Expected-npxG'] ?? 0.0))
                  ->setAssistsExp(floatval($standars[$index]['Expected-xA'] ?? 0.0))
                  ->setGoalsPerMinExp(floatval($standars[$index]['Per 90 Minutes-xG'] ?? 0.0))
                  ->setAssistsPerMinExp(floatval($standars[$index]['Per 90 Minutes-xA'] ?? 0.0))
                  ->setGlsAssistsPerMinExp(floatval($standars[$index]['Per 90 Minutes-xG+xA'] ?? 0.0))
                  ->setNonPenGoalsExpPerMin(floatval($standars[$index]['Per 90 Minutes-npxG'] ?? 0.0))
                  ->setNonPenGoalsAssistsExpPerMin(floatval($standars[$index]['Per 90 Minutes-npxG+xA'] ?? 0.0));
            } else {

               for ($i = 0; $i <= count($standars) - 1; $i++) {
                  $comp++;
                  if ($row['Player'] == $standars[$i]['Player']) {

                     $verify->setMatchsPlayed(intval($standars[$i]['Playing Time-MP'] ?? 0))
                        ->setMatchStarts(intval($standars[$i]['Playing Time-Starts'] ?? 0))
                        ->setMinsPlayed(intval($standars[$i]['Playing Time-Min'] ?? 0))
                        ->setGoals(intval($standars[$i]['Performance--Min'] ?? 0))
                        ->setAssists(intval($standars[$i]['Performance-Min'] ?? 0))
                        ->setPkMade(intval($standars[$i]['Performance-PK'] ?? 0))
                        ->setPkAttempted(intval($standars[$i]['Performance-PKatt'] ?? 0))
                        ->setYellowCard(intval($standars[$i]['Performance-CrdY'] ?? 0))
                        ->setRedCard(intval($standars[$i]['Performance-CrdR'] ?? 0))
                        ->setGoalsPerMin(floatval($standars[$i]['Per 90 Minutes-Gls'] ?? 0.0))
                        ->setAssistsPerMin(floatval($standars[$i]['Per 90 Minutes-Ast'] ?? 0.0))
                        ->setGlsAssPerMin(floatval($standars[$i]['Per 90 Minutes-G+A'] ?? 0.0))
                        ->setGoalsWithoutPkPerMin(floatval($standars[$i]['Per 90 Minutes-G-PK'] ?? 0.0))
                        ->setGlsAssWithoutPkPerMin(floatval($standars[$i]['Per 90 Minutes-G+A-PK'] ?? 0.0))
                        ->setGoalsExp(floatval($standars[$i]['Expected-xG'] ?? 0.0))
                        ->setNonPenGoalsExp(floatval($standars[$i]['Expected-npxG'] ?? 0.0))
                        ->setAssistsExp(floatval($standars[$i]['Expected-xA'] ?? 0.0))
                        ->setGoalsPerMinExp(floatval($standars[$i]['Per 90 Minutes-xG'] ?? 0.0))
                        ->setAssistsPerMinExp(floatval($standars[$i]['Per 90 Minutes-xA'] ?? 0.0))
                        ->setGlsAssistsPerMinExp(floatval($standars[$i]['Per 90 Minutes-xG+xA'] ?? 0.0))
                        ->setNonPenGoalsExpPerMin(floatval($standars[$i]['Per 90 Minutes-npxG'] ?? 0.0))
                        ->setNonPenGoalsAssistsExpPerMin(floatval($standars[$i]['Per 90 Minutes-npxG+xA'] ?? 0.0));
                     break;
                  }
               }
            }

            $index = $fakeindex;
            if ($index > count($shooting) - 1) {
               $index = 0;
            }
            if ($row['Player'] == $shooting[$index]['Player']) {
               $verify->setShoots(intval($shooting[$index]['Standard-Sh'] ?? 0))
                  ->setShootsOnTarget(intval($shooting[$index]['Standard-SoT'] ?? 0))
                  ->setShootsFromFrKc(intval($shooting[$index]['Standard-FK'] ?? 0))
                  ->setShootsOnTargetPc(floatval($shooting[$index]['Standard-SoT%'] ?? 0.0))
                  ->setShootsPerMatch(floatval($shooting[$index]['Standard-Sh/90'] ?? 0.0))
                  ->setShootsOnTargetPerMatch(floatval($shooting[$index]['Standard-SoT/90'] ?? 0.0))
                  ->setGoalsPerShoot(floatval($shooting[$index]['Standard-G/Sh'] ?? 0.0))
                  ->setGoalPerShootOnTarget(floatval($shooting[$index]['Standard-G/SoT'] ?? 0.0));
            } else {
               for ($i = 0; $i <= count($shooting) - 1; $i++) {

                  if ($row['Player'] == $shooting[$i]['Player']) {

                     $verify->setShoots(intval($shooting[$i]['Standard-Sh'] ?? 0))
                        ->setShootsOnTarget(intval($shooting[$i]['Standard-SoT'] ?? 0))
                        ->setShootsFromFrKc(intval($shooting[$i]['Standard-FK'] ?? 0))
                        ->setShootsOnTargetPc(floatval($shooting[$i]['Standard-SoT%'] ?? 0.0))
                        ->setShootsPerMatch(floatval($shooting[$i]['Standard-Sh/90'] ?? 0.0))
                        ->setShootsOnTargetPerMatch(floatval($shooting[$i]['Standard-SoT/90'] ?? 0.0))
                        ->setGoalsPerShoot(floatval($shooting[$i]['Standard-G/Sh'] ?? 0.0))
                        ->setGoalPerShootOnTarget(floatval($shooting[$i]['Standard-G/SoT'] ?? 0.0));
                     break;
                  }
               }
            }




            $index = $fakeindex;
            if ($index > count($passing) - 1) {
               $index = 0;
            }
            if ($row['Player'] == $passing[$index]['Player']) {
               $verify->setKeyPasses(intval($passing[$index]['KP']))
                  ->setPassesCompleted(intval($passing[$index]['Total-Cmp']))
                  ->setPassesAttempted(intval($passing[$index]['Total-Att'] ?? 0.0))
                  ->setPassCompPercent(floatval($passing[$index]['Total-Cmp%']))
                  ->setShortPassesCompleted(intval($passing[$index]['Short-Cmp']))
                  ->setShortpassesAttempted(intval($passing[$index]['Short-Att']))
                  ->setShortPassesCompPercent(floatval($passing[$index]['Short-Cmp%'] ?? 0.0))
                  ->setMediumPassesCompleted(intval($passing[$index]['Medium-Cmp']))
                  ->setMediumPassesAttempted(intval($passing[$index]['Medium-Att'] ?? 0))
                  ->setMediumPassesCompPercent(floatval($passing[$index]['Medium-Cmp%'] ?? 0.0))
                  ->setLongPassCompleted(intval($passing[$index]['Long-Cmp']))
                  ->setLongPassesAttempted(intval($passing[$index]['Long-Att']))
                  ->setLongPassesCompPercent(floatval($passing[$index]['Long-Cmp%'] ?? 0.0))
                  ->setPassCompletedFinalThird(intval($passing[$index]['1/3'] ?? 0))
                  ->setPassCompletedPenaltyArea(intval($passing[$index]['PPA'] ?? 0))
                  //->setThroughBalls(intval($passing[$index]['Pass Types-TB'] ?? 0))
                  ->setCrossIntoPenaltyArea(floatval($passing[$index]['CrsPA'] ?? 0.0));
            } else {
               for ($i = 0; $i <= count($passing) - 1; $i++) {

                  if ($row['Player'] == $passing[$i]['Player']) {
                     $verify->setKeyPasses(intval($passing[$i]['KP']))
                        ->setPassesCompleted(intval($passing[$i]['Total-Cmp']))
                        ->setPassesAttempted(intval($passing[$i]['Total-Att']))
                        ->setPassCompPercent(floatval($passing[$i]['Total-Cmp%'] ?? 0.0))
                        ->setShortPassesCompleted(intval($passing[$i]['Short-Cmp']))
                        ->setShortpassesAttempted(intval($passing[$i]['Short-Att']))
                        ->setShortPassesCompPercent(floatval($passing[$i]['Short-Cmp%'] ?? 0.0))
                        ->setMediumPassesCompleted(intval($passing[$i]['Medium-Cmp']))
                        ->setMediumPassesAttempted(intval($passing[$i]['Medium-Att']))
                        ->setMediumPassesCompPercent(floatval($passing[$i]['Medium-Cmp%'] ?? 0.0))
                        ->setLongPassCompleted(intval($passing[$i]['Long-Cmp']))
                        ->setLongPassesAttempted(intval($passing[$i]['Long-Att']))
                        ->setLongPassesCompPercent(floatval($passing[$i]['Long-Cmp%'] ?? 0.0))
                        ->setPassCompletedFinalThird(intval($passing[$i]['1/3']))
                        ->setPassCompletedPenaltyArea(intval($passing[$i]['PPA']))
                        //->setThroughBalls(intval($passing[$i]['Pass Types-TB'] ?? 0))
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
            if ($row['Player'] == $typePass[$index]['Player']) {
               $verify->setLivePass(intval($typePass[$index]['KP'] ?? 0))
                  ->setDeadPasses(intval($typePass[$index]['Pass Types-Dead'] ?? 0))
                  ->setPressPasses(intval($typePass[$index]['Pass Types-Press'] ?? 0))
                  ->setSwitchPasses(floatval($typePass[$index]['Pass Types-Sw'] ?? 0.0))
                  ->setGroundPasses(intval($typePass[$index]['Height-Ground'] ?? 0))
                  ->setLowPasses(intval($typePass[$index]['Height-Low'] ?? 0))
                  ->setHighPasses(floatval($typePass[$index]['Height-High'] ?? 0.0))
                  ->setLeftFootPasses(intval($typePass[$index]['Body Parts-Left'] ?? 0))
                  ->setRightFootPasses(intval($typePass[$index]['Body Parts-Right'] ?? 0))
                  ->setBlockedPasses(floatval($typePass[$index]['Blocks'] ?? 0.0))
                  ->setOffsidesPasses(intval($typePass[$index]['Outcomes-Off'] ?? 0))
                  ->setPassAttemptedFromFK(intval($typePass[$index]['Pass Types-FK'] ?? 0))
                  ->setThroughBalls(intval($typePass[$index]['Pass Types-TB'] ?? 0));
            } else {
               for ($i = 0; $i <= count($typePass) - 1; $i++) {

                  if ($row['Player'] == $typePass[$i]['Player']) {
                     $verify->setLivePass(intval($typePass[$i]['KP'] ?? 0))
                        ->setDeadPasses(intval($typePass[$i]['Pass Types-Dead'] ?? 0))
                        ->setPressPasses(intval($typePass[$i]['Pass Types-Press'] ?? 0))
                        ->setSwitchPasses(floatval($typePass[$i]['Pass Types-Sw'] ?? 0.0))
                        ->setGroundPasses(intval($typePass[$i]['Height-Ground'] ?? 0))
                        ->setLowPasses(intval($typePass[$i]['Height-Low'] ?? 0))
                        ->setHighPasses(floatval($typePass[$i]['Height-High'] ?? 0.0))
                        ->setLeftFootPasses(intval($typePass[$i]['Body Parts-Left'] ?? 0))
                        ->setRightFootPasses(intval($typePass[$i]['Body Parts-Right'] ?? 0))
                        ->setBlockedPasses(floatval($typePass[$i]['Blocks'] ?? 0.0))
                        ->setOffsidesPasses(intval($typePass[$i]['Outcomes-Off'] ?? 0))
                        ->setPassAttemptedFromFK(intval($typePass[$i]['Pass Types-FK'] ?? 0))
                        ->setThroughBalls(intval($typePass[$i]['Pass Types-TB'] ?? 0));
                     break;
                  }
               }
            }

            /////////////////////////////////////////////////////////////////////////////////
            $index = $fakeindex;
            if ($index > count($defense) - 1) {
               $index = 0;
            }
            if ($row['Player'] == $defense[$index]['Player']) {
               $verify->setTacklesWon(intval($defense[$index]['Tackles-TklW'] ?? 0))
                  ->setInterceptions(intval($defense[$index]['Int'] ?? 0))
                  ->setPressures(intval($defense[$index]['Pressures-Press'] ?? 0))
                  ->setPressureSucceded(intval($defense[$index]['Pressures-Succ'] ?? 0))
                  ->setPressureCompletion(intval($defense[$index]['Pressures-%'] ?? 0))
                  ->setBallBlocked(floatval($defense[$index]['Blocks-Blocks'] ?? 0.0))
                  ->setShootBlocked(intval($defense[$index]['Blocks-Sh'] ?? 0))
                  ->setShootOntTargetBlocked(intval($defense[$index]['Blocks-ShSv'] ?? 0))
                  ->setPassBlocked(floatval($defense[$index]['Blocks-ShSv'] ?? 0.0))
                  ->setClearances(intval($defense[$index]['Clr'] ?? 0))
                  ->setErrors(intval($defense[$index]['Err'] ?? 0));
            } else {
               for ($i = 0; $i <= count($defense) - 1; $i++) {

                  if ($row['Player'] == $defense[$i]['Player']) {
                     $verify->setTacklesWon(intval($defense[$i]['Tackles-TklW'] ?? 0))
                        ->setInterceptions(intval($defense[$i]['Int'] ?? 0))
                        ->setPressures(intval($defense[$i]['Pressures-Press'] ?? 0))
                        ->setPressureSucceded(intval($defense[$i]['Pressures-Succ'] ?? 0))
                        ->setPressureCompletion(intval($defense[$i]['Pressures-%'] ?? 0))
                        ->setBallBlocked(floatval($defense[$i]['Blocks-Blocks'] ?? 0.0))
                        ->setShootBlocked(intval($defense[$i]['Blocks-Sh'] ?? 0))
                        ->setShootOntTargetBlocked(intval($defense[$i]['Blocks-ShSv'] ?? 0))
                        ->setPassBlocked(floatval($defense[$i]['Blocks-ShSv'] ?? 0.0))
                        ->setClearances(intval($defense[$i]['Clr'] ?? 0))
                        ->setErrors(intval($defense[$i]['Err'] ?? 0));
                     break;
                  }
               }
            }
            /////////////////////////////////////////////////////////////////////////////////


            $index = $fakeindex;
            if ($index > count($miscellaneous) - 1) {
               $index = 0;
            }
            if ($row['Player'] == $miscellaneous[$index]['Player']) {

               $verify->setFoulsCommited(intval($miscellaneous[$index]['Performance-Fls'] ?? 0))
                  ->setFoulsDrawn(intval($miscellaneous[$index]['Performance-Fld'] ?? 0))
                  ->setOffsides(intval($miscellaneous[$index]['Performance-Off'] ?? 0))
                  ->setCrosses(intval($miscellaneous[$index]['Crs'] ?? 0))
                  ->setTacklesWon(intval($miscellaneous[$index]['Performance-TklW'] ?? 0))
                  ->setInterceptions(intval($miscellaneous[$index]['Int'] ?? 0))
                  ->setPenaltyKicksWon(intval($miscellaneous[$index]['Performance-PKwon'] ?? 0))
                  ->setPenaltyKicksConceded(intval($miscellaneous[$index]['Performance-PKcon'] ?? 0))
                  ->setOwnGoal(intval($miscellaneous[$index]['Performance-OG'] ?? 0))
                  // ->setSecondYellowCard($miscellaneous[$index]['2CrdY'])
                  ->setArialDuelsWon(intval($miscellaneous[$index]['Aerial Duels-Won']))
                  ->setArialDuelsLost(intval($miscellaneous[$index]['Aerial Duels-Lost']))
                  ->setArialDuelsCompletion(intval($miscellaneous[$index]['Aerial Duels-Won%']));
            } else {
               for ($i = 0; $i <= count($miscellaneous) - 1; $i++) {

                  if ($row['Player'] == $miscellaneous[$i]['Player']) {

                     $verify->setFoulsCommited(intval($miscellaneous[$i]['Performance-Fls'] ?? 0))
                        ->setFoulsDrawn(intval($miscellaneous[$i]['Performance-Fld'] ?? 0))
                        ->setOffsides(intval($miscellaneous[$i]['Performance-Off'] ?? 0))
                        ->setCrosses(intval($miscellaneous[$i]['Performance-Crs'] ?? 0))
                        ->setTacklesWon(intval($miscellaneous[$index]['Performance-TklW'] ?? 0))
                        ->setInterceptions(intval($miscellaneous[$index]['Int'] ?? 0))
                        ->setPenaltyKicksWon(intval($miscellaneous[$i]['Performance-PKwon'] ?? 0))
                        ->setPenaltyKicksConceded(intval($miscellaneous[$i]['Performance-PKcon'] ?? 0))
                        ->setOwnGoal(intval($miscellaneous[$i]['Performance-OG'] ?? 0))
                        // ->setSecondYellowCard($miscellaneous[$i]['2CrdY'])
                        ->setArialDuelsWon(intval($miscellaneous[$i]['Aerial Duels-Won']))
                        ->setArialDuelsLost(intval($miscellaneous[$i]['Aerial Duels-Lost']))
                        ->setArialDuelsCompletion(intval($miscellaneous[$i]['Aerial Duels-Won%']));
                     break;
                  }
               }
            }
            ///////////////////////////////////////////////////////////////////
            $index = $fakeindex;
            if ($index > count($possession) - 1) {
               $index = 0;
            }
            if ($row['Player'] == $possession[$index]['Player']) {
               $verify->setBallControlls(intval($possession[$index]['Carries-Carries'] ?? 0))
                  ->setBallControllsMoveDistance(intval($possession[$index]['Carries-TotDist'] ?? 0))
                  ->setBallControllsMoveDistanceProgressive(intval($possession[$index]['Carries-PrgDist'] ?? 0))
                  ->setReceivingBallAttempted(intval($possession[$index]['Targ'] ?? 0))
                  ->setReceivingBallCompleted(intval($possession[$index]['Rec'] ?? 0))
                  ->setReceivingBallCompletion(floatval($possession[$index]['Rec%'] ?? 0.0))
                  ->setMisControlls(intval($possession[$index]['Miscon'] ?? 0))
                  ->setDispossessed(intval($possession[$index]['Dispos'] ?? 0))
                  ->setDribbleCompleted(intval($possession[$index]['Dribbles-Succ'] ?? 0))
                  ->setDribbleAttempted(intval($possession[$index]['Att'] ?? 0))
                  ->setDribblePercent(floatval($possession[$index]['Dribbles-Succ%'] ?? 0.0))
                  ->setNumberOfPlayerDriblled(intval($possession[$index]['Dribbles-#Pl'] ?? 0))
                  ->setNutmegs(intval($possession[$index]['Dribbles-Megs'] ?? 0));
            } else {
               for ($i = 0; $i <= count($possession) - 1; $i++) {

                  if ($row['Player'] == $possession[$i]['Player']) {
                     $verify->setBallControlls(intval($possession[$i]['Carries-Carries'] ?? 0))
                        ->setBallControllsMoveDistance(intval($possession[$i]['Carries-TotDist'] ?? 0))
                        ->setBallControllsMoveDistanceProgressive(intval($possession[$i]['Carries-PrgDist'] ?? 0))
                        ->setReceivingBallAttempted(intval($possession[$i]['Targ'] ?? 0))
                        ->setReceivingBallCompleted(intval($possession[$i]['Rec'] ?? 0))
                        ->setReceivingBallCompletion(floatval($possession[$i]['Rec%'] ?? 0.0))
                        ->setMisControlls(intval($possession[$i]['Miscon'] ?? 0))
                        ->setDispossessed(intval($possession[$i]['Dispos'] ?? 0))
                        ->setDribbleCompleted(intval($possession[$i]['Dribbles-Succ'] ?? 0))
                        ->setDribbleAttempted(intval($possession[$i]['Att'] ?? 0))
                        ->setDribblePercent(floatval($possession[$i]['Dribbles-Succ%'] ?? 0.0))
                        ->setNumberOfPlayerDriblled(intval($possession[$i]['Dribbles-#Pl'] ?? 0))
                        ->setNutmegs(intval($possession[$i]['Dribbles-Megs'] ?? 0));
                     break;
                  }
               }
            }
            ///////////////////////////////////////////////////////////////////
            $index = $fakeindex;
            if ($index > count($timming) - 1) {
               $index = 0;
            }
            if ($row['Player'] == $timming[$index]['Player']) {
               $verify->setMinutesPerMatchPlayeds(intval($timming[$index]['Playing Time-Mn/MP'] ?? 0))
                  ->setPercentageOfMinutesPlayed(floatval($timming[$index]['Playing Time-Min%'] ?? 0))
                  ->setMinPerMatchStarted(intval($timming[$index]['Starts-Mn/Start'] ?? 0))
                  ->setnintyMinPlayed(floatval($timming[$index]['Playing Time-90s'] ?? 0))
                  ->setCompleteMatchsPlayed(intval($timming[$index]['Starts-Compl'] ?? 0))
                  ->setMatchsAsSubstitute(intval($timming[$index]['Subs-Subs'] ?? 0.0))
                  ->setMintuesPerSubstitute(intval($timming[$index]['Subs-Mn/Sub'] ?? 0))
                  ->setMatchsAsUnusedSubstitute(intval($timming[$index]['Subs-unSub'] ?? 0))
                  ->setPointsPerMatch(intval($timming[$index]['Team Success-PPM'] ?? 0))
                  ->setGoalScoredByTeamWhileOnPitch(intval($timming[$index]['Team Success-onG'] ?? 0))
                  ->setGoalAllowedByTeamWhileOnPitch(intval($timming[$index]['Team Success-onGA'] ?? 0))
                  ->setgoalScoredMinusAllowedWhileOnPitchPer90(floatval($timming[$index]['Team Success-+/-90'] ?? 0));
            } else {
               for ($i = 0; $i <= count($timming) - 1; $i++) {

                  if ($row['Player'] == $timming[$i]['Player']) {
                     $verify->setMinutesPerMatchPlayeds(intval($timming[$i]['Playing Time-Mn/MP'] ?? 0))
                        ->setPercentageOfMinutesPlayed(intval($timming[$i]['Playing Time-Min%'] ?? 0))
                        ->setMinPerMatchStarted(intval($timming[$i]['Starts-Mn/Start'] ?? 0))
                        ->setnintyMinPlayed(intval($timming[$i]['Playing Time-90s'] ?? 0))
                        ->setCompleteMatchsPlayed(intval($timming[$i]['Starts-Compl'] ?? 0))
                        ->setMatchsAsSubstitute(floatval($timming[$i]['Subs-Subs'] ?? 0.0))
                        ->setMintuesPerSubstitute(intval($timming[$i]['Subs-Mn/Sub'] ?? 0))
                        ->setMatchsAsUnusedSubstitute(intval($timming[$i]['Subs-unSub'] ?? 0))
                        ->setPointsPerMatch(intval($timming[$i]['Team Success-PPM'] ?? 0))
                        ->setGoalScoredByTeamWhileOnPitch(intval($timming[$i]['Team Success-onG'] ?? 0))
                        ->setGoalAllowedByTeamWhileOnPitch(intval($timming[$i]['Team Success-onGA'] ?? 0))
                        ->setgoalScoredMinusAllowedWhileOnPitchPer90(floatval($timming[$i]['Team Success-+/-90'] ?? 0));
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
      // $this->import('CL');
      // $this->import('EL');

      $io->success('import succesfully');
   }
}
