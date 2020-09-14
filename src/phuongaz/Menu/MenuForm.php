<?php

namespace phuongaz\Menu;

use pocketmine\Player;
use pocketmine\Server;
use jojoe77777\FormAPI\SimpleForm;

Class MenuForm{

	/** @var Player */
	private $player;

	/** @var array */
	private static $form_data;

	public function __construct(Player $player) {
		$this->player = $player;
		self::$form_data = Loader::getFormData();
	}

	public function send() :void{
		$form = $this->praseForm();
		$form->sendToPlayer($this->player);
	}

	public function praseForm() :SimpleForm{
		$form = new SimpleForm(function(Player $player, ?int $data){
			if(is_null($data)) return;
			$form_data = self::$form_data;
			if(isset($form_data[$data])){
				Server::getInstance()->getCommandMap()->dispatch($player, $form_data[$data]["cmd"]);
			}
		});
		$form->setTitle("MENU");
		foreach(self::$form_data as $data){
			if(!is_null($data["url"])){
				$form->addButton($data["name"], 1, $data["url"]);
			}else $form->addButton($data["name"]);
		}
		return $form;
	}
}