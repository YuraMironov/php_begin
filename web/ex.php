<?php 
require '../src/core/init.php';

use Repositories\UserRepository;
use Entities\UserWithPass;

$userRepository = new UserRepository();
// var_dump($userRepository);

$userwp = new UserWithPass();
$userwp->username = 'ramil';
$userwp->email = 'ramil@ramil.ru';
$userwp->password = 'ramilramil';

$userwp2 = new UserWithPass();
$userwp2->username = 'ramilupdate';
$userwp2->email = 'ramil@ramil.ru';

$userRepository->add($userwp);

// $userRepository->update($userwp, $userwp2);

// $userRepository->delete($userwp2);


$userRepository->getAll();




// use Model\SingletonCat;

// // echo "<pre>";
// $cat = SingletonCat::getCat();
// $cat->setVoice("mrrrrrr");
// $catf = SingletonCat::getCat();

// $cat->setVoice("rrrrr");
// var_dump($cat->getVoice(), $catf->getVoice());


