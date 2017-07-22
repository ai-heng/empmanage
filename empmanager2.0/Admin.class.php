<?php
	//它的一个对象实例就表示admin表的一条记录
	class Admin{
		private $id;
		private $name;
		private $password;
		/**
		 * @return unknown
		 */
		public function getId() {
			return $this->id;
		}
		
		/**
		 * @return unknown
		 */
		public function getName() {
			return $this->name;
		}
		
		/**
		 * @return unknown
		 */
		public function getPassword() {
			return $this->password;
		}
		
		/**
		 * @param unknown_type $id
		 */
		public function setId($id) {
			$this->id = $id;
		}
		
		/**
		 * @param unknown_type $name
		 */
		public function setName($name) {
			$this->name = $name;
		}
		
		/**
		 * @param unknown_type $password
		 */
		public function setPassword($password) {
			$this->password = $password;
		}

		
	}
?>