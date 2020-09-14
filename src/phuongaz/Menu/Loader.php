<?php

namespace phuongaz\Menu;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\{CommandSender, Command};

use jojoe77777\FormAPI\SimpleForm;

Class Loader extends PluginBase{

	/** @var array*/
	private static $form_data;

	public function onEnable() :void {
		$this->saveResource("menu.yml");
		self::$form_data = yaml_parse_file($this->getDataFolder(). "menu.yml");
	}

	public static function getFormData() :array{
		return self::$form_data;
	}

	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) :bool{
		if(!$sender instanceof Player) return false;
		if(strtolower($cmd->getName()) == "menu"){
			$form = new MenuForm($sender);
			$form->send();
		}
		return true;
	}
}