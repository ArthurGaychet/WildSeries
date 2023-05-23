<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAM = [
        ['title' => 'Walking dead', 'synopsis' => 'Des zombies envahissent la terre', 'category_name' => 'category_Action'],
        ['title' => 'Succession', 'synopsis' => 'Une famille se détruisent pour de l`argent', 'category_name' => 'category_Action'],
        ['title' => 'The Last Of Us', 'synopsis' => 'Des zombies énervé envahissent la terre', 'category_name' => 'category_Aventure'],
        ['title' => 'Severance', 'synopsis' => 'Une entreprise pas comme les autres', 'category_name' => 'category_Action'],
        ['title' => 'Game of Thrones', 'synopsis' => 'Une partie d`échec avec des dragons', 'category_name' => 'category_Fantastique'],
    ] ;

    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAM as $key =>$programSeries) {  
            $program = new Program();
            $program->setTitle($programSeries['title']);
            $program->setSynopsis($programSeries['synopsis']);
            $program->setCategory($this->getReference($programSeries['category_name']));

            $manager->persist($program);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          CategoryFixtures::class,
        ];
    }


}
