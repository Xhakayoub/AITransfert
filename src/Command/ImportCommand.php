<?php
namespace App\Src\Command;
use App\Entity\Player;
use Symfony\Component\Console\Command\Command;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use League\Csv\Reader;
use Symfony\Component\HttpClient\HttpClient;

class importCommand extends Command
{
   public function __construct(EntityManagerInterface $em){
      parent::__construct();
      $this->em = $em;
   }

 protected function configure(){
  $this->setName('data:api:import')
       ->setDescription('importation API');
 }

 protected function execute(InputInterface $input, OutputInterface $output){

    $client = HttpClient::create();

    $response = $client->request('GET', 'https://fantasy.premierleague.com/api/bootstrap-static/');

  
    $content = $response->getContent();
    $content = $response->toArray();
   

    $io = new SymfonyStyle($input, $output);
    $io->title('import en progression...');
    
    // $reader = Reader::createFromPath('%kernel.root_dir%/../src/exports-des-gares-idf.csv');
    // $reader->setDelimiter(';');
    // $results = $reader->fetchAssoc();

    foreach($content['elements'] as $row){
    //    $intToVerif = 0;
       

       $verify = $this->em->getRepository(Player::class)
       ->findOneBy([
          'idPlayer' => $row['id']
       ]);

       if(empty($verify)){
        $player = (new player())
        ->setIdPlayer($row['id'])
        ->setName($row['first_name'])
        ->setLastName($row['second_name'])
        ->setGoals($row['goals_scored'])
        ->setAssists($row['assists'])
        ->setYellowCard($row['yellow_cards'])
        ->setRedCard($row['red_cards'])
        ;
        $this->em->persist($player);
        
 
       }

       
         
        

      $this->em->flush();
      
    }
   

    
    
    $io->success('importation avec succés');
 }
    
}
?>