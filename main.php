<?php
require_once('Slime.class.php');
const SLIMES = [
    [
        'name' => '〇',
        'footprints' => '='
    ],
    [
        'name' => '☆',
        'footprints' => '~'
    ]
];

function setRunner(array $slimes): array
{
    $runners = [];
    foreach ($slimes as $slime){
        $runners[] = new Slime($slime);
    }
    return $runners;
}

function outputRun($runner): void
{
    for($i=0;$i<$runner->getPosition();$i++){
        echo $runner->getFootprints();
    }
    echo $runner->getName() . PHP_EOL;
}

function outputBorder(): void
{
    echo "----------|--------------" . PHP_EOL;
}

function main(array $runners): void
{
    $slimeRunners = setRunner($runners);
    $isGoal = true;

    echo '[List of runners]' . PHP_EOL;
    foreach($slimeRunners as $index => $slime){
        echo 'No.' . $index + 1 . ': ' . $slime->getName() . PHP_EOL;
    }

    do{
        echo '[Bet]' . PHP_EOL . 'No:';
        $input = intval(fgets(STDIN));
    }while(!is_numeric($input) && !(0 < $input && $input <= count($slimeRunners)));
    $betRunner = $slimeRunners[$input-1];

    echo '[Ready]' . PHP_EOL;
    for($i = 3;$i > 0;$i--){
        echo $i . ' ';
        sleep(1);
    }
    echo 'Go!!' . PHP_EOL;

    outputBorder();
    while($isGoal){
        foreach($slimeRunners as $slime){
            $slime->run();
            outputRun($slime);
            if($slime->getPosition() >= 10) $isGoal = false;
            usleep(100000);
        }
        outputBorder();
    }

    echo 'Winner!' . PHP_EOL;
    foreach($slimeRunners as $slime){
        if($slime->getPosition() >= 10){
            echo $slime->getName() . PHP_EOL;
        }
    }

    echo 'You bet on ' . $betRunner->getName() . PHP_EOL;
    if($betRunner->getPosition() >= 10){
        echo 'You win!';
    }else{
        echo 'You lose...';
    }
}

main(SLIMES);