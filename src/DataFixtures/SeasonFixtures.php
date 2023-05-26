<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use Symfony\Component\Console\Helper\ProgressBar;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public static int $numberOfSeason = 0;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        foreach (ProgramFixtures::PROGRAM as $programName)
            for($i = 1; $i <= 5; $i++) {
                self::$numberOfSeason++;
                $season = new Season();
                //Ce Faker va nous permettre d'alimenter l'instance de Season que l'on souhaite ajouter en base
                $season->setNumber($i);
                $season->setYear($faker->year());
                $season->setDescription($faker->paragraphs(2, true));
                $this->setReference('season_' . self::$numberOfSeason, $season);

                $season->setProgram($this->getReference($programName['program_name']));
                $manager->persist($season);
            }

        $manager->flush();
    }

     public function getDependencies()
    {
        return [
          ProgramFixtures::class,
        ];
    }
}