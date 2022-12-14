<?php
	class ClassAPI{
		private static function perform_http_request($method, $url, $data = false)
		{
		    $curl = curl_init();

		    switch ($method)
		    {
		        case "POST":
		            curl_setopt($curl, CURLOPT_POST, 1);

		            if ($data)
		                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		            break;
		        case "PUT":
		            curl_setopt($curl, CURLOPT_PUT, 1);
		            break;
		        default:
		            if ($data)
		                $url = sprintf("%s?%s", $url, http_build_query($data));
		    }


		    curl_setopt($curl, CURLOPT_URL, $url);
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		    $result = curl_exec($curl);
		    curl_close($curl);
		    return $result;
		}

		function postAPI($url,$data){
			$get_data =$this->perform_http_request('POST', $url, $data);
			$response = json_decode($get_data, true);
			$data =$response;
			return $data;
		}


		function getAPI($url){
			
		 	$get_data = $this->perform_http_request('GET', $url, false);
			$response = json_decode($get_data, true);
			$data =$response;
			return $data;
		}

		function getRawAPI($url){
			$data = $this->perform_http_request('GET', $url, false);
			return $data;
		}

	}
?>