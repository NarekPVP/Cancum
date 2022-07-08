<?php

namespace app\controllers;

use app\helpers\Is;
use ishop\App;

class SearchController extends AppController {

	public function typeaheadAction(){
		if (Is::ajax()) {
			$query = !empty(trim($_GET['query'])) ? trim($_GET['query']) : null;
			if ($query) {
				$users = \R::getAll("SELECT id, name FROM user WHERE name LIKE ? LIMIT 11", ["%{$query}%"]);
				echo json_encode($users);
			}
		}
		die;
	}

	public function indexAction(){
		$query = !empty(trim($_GET['s'])) ? trim($_GET['s']) : null;
		$data = [];
		if ($query) {
			$data['users'] = \R::findAll('user', "name LIKE ?", ["%{$query}%"]);
			$data['groups'] = \R::findAll('groups', "title LIKE ?", ["%{$query}%"]);
		}

		$default_user_img_path = App::$app->getProperty('default_user_img_path');
		$default_group_img_path = App::$app->getProperty('default_group_img_path');

		$data = array_reverse($data);
		$this->setMeta('Поиск по: ' . h($query));
		$this->set(compact('data', 'query', 'default_user_img_path', 'default_group_img_path'));
		/*
			Example:

			user['users'] = {
				[0] => {
					id => "1"
					name => "Narek"
					login => "NarekPVP"
					email => "hnarek2005@gmail.com"
				}
				[1] => {
					id = "79"
					name => "Tigran"
					login => "Hovhannisyan710"
					email => "tigerinfinity@gmail.com"
				}
			},
			user['groups'] = {
				[0] => {
					id = "1"
					title => "Heaven"
					creator_id = "1";
					description => "Best group";
					websites = {
						facebook => "https://facebook.com/?group=eff27fu89q2uc82"
						instagram => "https://instagram.com/?page=23123123123"
					}
				}
			}
		*/
	}

}