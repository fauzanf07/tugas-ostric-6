<?php

	class Robot
	{
		private $robotName;
		private $healthPoint;
		private $weaponName;
		private $attackPower;
		private $armorName;
		private $defense;
		private static $arrRobots = array();

		public function __construct($robotName,$healthPoint,Weapon $weapon,Armor $armor){
			$this->robotName = $robotName;
			$this->healthPoint = $healthPoint;
			$this->weaponName = $weapon->getWeaponName();
			$this->attackPower = $weapon->getAttackPower();
			$this->armorName = $armor->getArmorName();
			$this->defense = $armor->getDefense();
			array_push(Robot::$arrRobots,
				[
					'robotName' => $this->robotName,
					'healthPoint' => $this->healthPoint,
					'weaponName' => $this->weaponName,
					'attackPower' => $this->attackPower,
					'armorName' => $this->armorName,
					'defense' => $this->defense
				]
			);
		}

		public function showRobots(){
			$i =1;
			echo "<br>============================================== LIST ROBOT ==============================================";
			echo "<br>";

			foreach (Robot::$arrRobots as $robots) {
				echo $i. ". robotName: {$robots['robotName']} | healthPoint : {$robots['healthPoint']} | weaponName : {$robots['weaponName']} | attackPower : {$robots['attackPower']} | armorName : {$robots['armorName']} | Defense : {$robots['defense']}";
				echo "<br>";
				$i++;
			}
		}
		public function robotsStatus(){
			$i =1;
			echo "<br>================ STATUS ROBOT ================";
			echo "<br>";

			foreach (Robot::$arrRobots as $robots) {
				echo $i. ". robotName: {$robots['robotName']} | healthPoint : {$robots['healthPoint']} | Defense : {$robots['defense']}";
				echo "<br>";
				$i++;
			}
		}

		public function attack($robotName){
			$i =0; $j=0; $endGame =0; $index;
			foreach (Robot::$arrRobots as $robots) {
				if($robots['healthPoint'] == 0){
					$index = $i;
					$endGame = 1;
				}
				$i++;
			}
			if($endGame == 0){
				if($robotName == $this->robotName){
					echo "<br>Anda tidak bisa menyerang diri anda sendiri<br>";
				}
				else{
					foreach (Robot::$arrRobots as $robots) {
						if($robots['robotName'] == $robotName){
							if($robots['defense'] != 0){
								if($robots['defense'] > $this->attackPower){
									Robot::$arrRobots[$j]['defense'] -= $this->attackPower;
									echo "<br>" . $this->robotName . " attack " . $robotName . "<br>";
									echo $robots['robotName'] . " ==> Defense -" . $this->attackPower. "<br>";
								}
								else{
									echo "<br>" . $this->robotName . " attack " . $robotName . "<br>";
									if($this->attackPower > $robots['defense']){
										$rest = $this->attackPower - $robots['defense'];
										echo $robots['robotName'] . " ==> Defense -" . $robots['defense']. "<br>";
										echo $robots['robotName'] . " ==> healthPoint -" . $rest. "<br>";
										Robot::$arrRobots[$j]['defense'] = 0;
										Robot::$arrRobots[$j]['healthPoint'] -= $rest;

									}
									else{
										echo $robots['robotName'] . " ==> Defense -" . $robots['defense']. "<br>";
										Robot::$arrRobots[$j]['defense'] = 0;
									}
								}
							}
							else{
								if($robots['healthPoint'] > $this->attackPower){
									echo "<br>" . $this->robotName . " attack " . $robotName . "<br>";
									echo $robots['robotName'] . " ==> healthPoint -" . $this->attackPower . "<br>";
									Robot::$arrRobots[$j]['healthPoint'] -= $this->attackPower;
								}
								else{
										echo "<br>" . $this->robotName . " attack " . $robotName . "<br>";
										echo $robots['robotName'] . " ==> healthPoint -" . $robots['healthPoint']. "<br>";
										Robot::$arrRobots[$j]['healthPoint'] = 0;
										echo Robot::robotsStatus() . "<br>";
										echo $robots['robotName'] . " Kalah!<br>";
										echo "GAME SELESAI<br>";
								}
							}
						}
						$j++;
					}

				}
			}
			else{
				echo "<br>";
				echo Robot::$arrRobots[$index]['robotName'] . " Kalah!<br>";
				echo "GAME SELESAI<br>";
			}
			
		}
	}


	class Weapon
	{
		private $weaponName;
		private $attackPower;
		public function __construct($weaponName,$attackPower)
		{
			$this->weaponName = $weaponName;
			$this->attackPower = $attackPower;
		}
		public function getWeaponName(){
			return $this->weaponName;
		}
		public function getAttackPower(){
			return $this->attackPower;
		}
	}

	class Armor
	{
		private $armorName;
		private $defense;
		public function __construct($armorName,$defense)
		{
			$this->armorName = $armorName;
			$this->defense = $defense;
		}
		public function getArmorName(){
			return $this->armorName;
		}
		public function getDefense(){
			return $this->defense;
		}
	}

	$weapon1 = new Weapon("Machine Gun",50);
	$armor1 = new Armor("Power Armor",100);
	$weapon2 = new Weapon("Sniper",40);
	$armor2 = new Armor("Power Armor",100);

	$robot1 = new Robot("Astrobot",100,$weapon1,$armor1);
	$robot2 = new Robot("Doraemon",200,$weapon2,$armor2);

	$robot1->showRobots();

	$robot1->attack("Doraemon");
	$robot1->robotsStatus();

	$robot2->attack("Astrobot");
	$robot2->robotsStatus();

	$robot1->attack("Doraemon");
	$robot1->robotsStatus();

	$robot1->attack("Astrobot");
	$robot1->robotsStatus();

	$robot1->attack("Doraemon");
	$robot1->robotsStatus();

	$robot2->attack("Astrobot");
	$robot2->robotsStatus();

	$robot2->attack("Astrobot");
	$robot2->robotsStatus();

	$robot2->attack("Astrobot");
	$robot2->robotsStatus();

	$robot1->attack("Doraemon");
	$robot1->robotsStatus();

	$robot2->attack("Astrobot");

?>