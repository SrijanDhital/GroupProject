<!--test for admin form-->
<?php
USE PHPUnit\Framework\TestCase;
require 'functions/adminTest.php';

class admin extends TestCase{
	function testAdminWithoutAll(){
		$criteria = [
			"name"=>"",
			"email"=>"",
			"password"=>""

		];
		$result=testAdm($criteria);
		$this->assertFalse($result);
	}
	function testAdminWithoutEmail(){
		$criteria = [
			"name"=>"",
			"email"=>"",
			"password"=>"password"

		];
		$result=testAdm($criteria);
		$this->assertFalse($result);
	}
	function testAdminWithoutPassword(){
		$criteria = [
			"name"=>"",
			"email"=>"admin@admin.com",
			"password"=>""

		];
		$result=testAdm($criteria);
		$this->assertFalse($result);
	}
	function testAdminWithAll(){
		$criteria = [
			"name"=>"",
			"email"=>"admin@admin.com",
			"password"=>"password"

		];
		$result=testAdm($criteria);
		$this->assertTrue($result);
	}

}