<?php
/** * Copyright 2013 Microsoft Corporation 
	*  
	* Licensed under the Apache License, Version 2.0 (the "License"); 
	* you may not use this file except in compliance with the License. 
	* You may obtain a copy of the License at 
	* http://www.apache.org/licenses/LICENSE-2.0 
	*  
	* Unless required by applicable law or agreed to in writing, software 
	* distributed under the License is distributed on an "AS IS" BASIS, 
	* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. 
	* See the License for the specific language governing permissions and 
	* limitations under the License. 
	*/
	
function connect()
{
	// DB connection info
	$host = "ap-cdbr-azure-southeast-b.cloudapp.net";
	$user = "bcce9f24ac545d";
	$pwd = "7fca2ba4";
	$db = "MyDemo";
	try{
		$conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
		$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	catch(Exception $e){
		die(print_r($e));
	}
	return $conn;
}

function markItemComplete($item_id)
{
	$conn = connect();
	$sql = "UPDATE items SET is_complete = 1 WHERE id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bindValue(1, $item_id);
	$stmt->execute();
}



function getAllItems()
{
	$conn = connect();
	$sql = "SELECT id, name, category_name, date, is_complete, items.category_id FROM items, category WHERE items.category_id = category.category_id";
	$stmt = $conn->query($sql);
	return $stmt->fetchAll(PDO::FETCH_NUM);
}


function getAllCategorys()
{
	$conn = connect();
	$sql = "SELECT * FROM Category";
	$stmt = $conn->query($sql);
	return $stmt->fetchAll(PDO::FETCH_NUM);
}


function addItem($name, $category, $date, $is_complete)
{
	$conn = connect();
	$sql = "INSERT INTO items (name, category_id, date, is_complete) VALUES (?, ?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bindValue(1, $name);
	$stmt->bindValue(2, $category);
	$stmt->bindValue(3, $date);
	$stmt->bindValue(4, $is_complete);
	$stmt->execute();
}

function addCategory($name)
{
	$conn = connect();
	$sql = "INSERT INTO category (category_name) VALUES (?)";
	$stmt = $conn->prepare($sql);
	$stmt->bindValue(1, $name);
	$stmt->execute();	
}

function deleteItem($item_id)
{
	$conn = connect();
	$sql = "DELETE FROM items WHERE id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bindValue(1, $item_id);
	$stmt->execute();
}


function deleteCategory($category_id)
{
	$conn = connect();
	$sql = "DELETE FROM Category WHERE category_id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bindValue(1, $category_id);
	$stmt->execute();
}

?>
