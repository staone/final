<?php

   // connect to mongodb
   $conn = new Mongo("mongodb://rootdb:jWl09xIu2RDbC9iNCvu38T4exuVPJwV4bfVhvgdS8TNx645f7ol1bwNhs91WM6xC6UDhuCOjocMlZNlRFfQ83Q==@rootdb.documents.azure.com:10255/?ssl=true&replicaSet=globaldb");
	
   // select a database
   $db = $conn->moodsync;

?>