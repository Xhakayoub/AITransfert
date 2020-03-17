<?php

namespace App\Services;

use App\Services\ExtractDataFromWeb;


class updateAllData
{

    public function mainFunction(ExtractDataFromWeb $service)
    {

        $service->updateLeagueData(9, 'stats', 'England');
        $service->updateLeagueData(9, 'shooting', 'England');
        $service->updateLeagueData(9, 'passing', 'England');
        $service->updateLeagueData(9, 'keepers', 'England');
        $service->updateLeagueData(9, 'misc', 'England');
        $service->updateLeagueData(9, 'keepersadv', 'England');

        $service->updateLeagueData(12, 'stats', 'Spain');
        $service->updateLeagueData(12, 'shooting', 'Spain');
        $service->updateLeagueData(12, 'passing', 'Spain');
        $service->updateLeagueData(12, 'keepers', 'Spain');
        $service->updateLeagueData(12, 'misc', 'Spain');
        $service->updateLeagueData(12, 'keepersadv', 'Spain');

        $service->updateLeagueData(11, 'stats', 'Italy');
        $service->updateLeagueData(11, 'shooting', 'Italy');
        $service->updateLeagueData(11, 'passing', 'Italy');
        $service->updateLeagueData(11, 'keepers', 'Italy');
        $service->updateLeagueData(11, 'misc', 'Italy');
        $service->updateLeagueData(11, 'keepersadv', 'Italy');

        $service->updateLeagueData(13, 'stats', 'France');
        $service->updateLeagueData(13, 'shooting', 'France');
        $service->updateLeagueData(13, 'passing', 'France');
        $service->updateLeagueData(13, 'keepers', 'France');
        $service->updateLeagueData(13, 'misc', 'France');
        $service->updateLeagueData(13, 'keepersadv', 'France');

        $service->updateLeagueData(20, 'stats', 'Germany');
        $service->updateLeagueData(20, 'shooting', 'Germany');
        $service->updateLeagueData(20, 'passing', 'Germany');
        $service->updateLeagueData(20, 'keepers', 'Germany');
        $service->updateLeagueData(20, 'misc', 'Germany');
        $service->updateLeagueData(20, 'keepersadv', 'Germany');

        $service->updateLeagueData(8, 'stats', 'CL');
        $service->updateLeagueData(8, 'shooting', 'CL');
        $service->updateLeagueData(8, 'passing', 'CL');
        $service->updateLeagueData(8, 'keepers', 'CL');
        $service->updateLeagueData(8, 'misc', 'CL');
        $service->updateLeagueData(8, 'keepersadv', 'CL');

        $service->updateLeagueData(19, 'stats', 'EL');
        $service->updateLeagueData(19, 'shooting', 'EL');
        $service->updateLeagueData(19, 'passing', 'EL');
        $service->updateLeagueData(19, 'keepers', 'EL');
        $service->updateLeagueData(19, 'misc', 'EL');
        $service->updateLeagueData(19, 'keepersadv', 'EL');
    }
}
