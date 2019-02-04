<?php 
	
	class Formate{

		public function formatDate($date)
		{
			return date('F j, Y, g:i a',strtotime($date));
			//June 21, 2018, 11:53 am
		}

		public function textshort($text,$limit=400)
		{
			$text = substr($text,0,$limit);
			$text = substr($text,0,strrpos($text,' '));
			$text = $text.".....";
			return $text;
		}

		public function validation($data)
		{
			$data = trim($data);
			$data = stripcslashes($data);
			//$data = htmlspecialchars($data);
			$data = strtolower($data);
			//$data = ucwords($data);
			return $data;
		}

		public function redirect_to($location)
		{
		    header("Location: $location") ;
		    exit();
		}
	}
?>