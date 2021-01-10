<?php
declare(strict_types=1);

use App\Entities\Boy;
use App\Entities\Exam;
use App\Entities\Girl;
use App\Entities\Mark;
use App\Entities\SchoolClass;
use App\Entities\Student;

require __DIR__.'/init.php';

$containerBuilder = new \DI\ContainerBuilder();
$containerBuilder->userAutowiring(true);
$container = $containerBuilder->build();



// Faker
$faker = Faker\Factory::create();

$schoolClasses = [];

// SchoolClasses
for ($i = 0; $i < 3; $i++) {

    // Generate one SchoolClass
    $schoolClass = new SchoolClass($faker->uuid);

    // Students
    for ($y = 0; $y < 5; $y++) {
        $schoolClass->joinSchoolClass(new Boy($faker->uuid, $faker->firstName, $faker->lastName));
        $schoolClass->joinSchoolClass(new Girl($faker->uuid, $faker->firstName, $faker->lastName));
    }

    /** @var SchoolClass[] $schoolClasses */
    $schoolClasses[] = $schoolClass;
}

$mathsExam = new Exam($faker->uuid, 'Maths');

/**
 * @var int $key
 * @var Student $student
 */
foreach ($schoolClasses[0]->getStudents() as $student) {
    $mathsExam->addMarkToExam(new Mark($faker->uuid, $faker->numberBetween(0,20), $student));
}

dd($schoolClasses[0]->getStudents(), $schoolClasses, $mathsExam);