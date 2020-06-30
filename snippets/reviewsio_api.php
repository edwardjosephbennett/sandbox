<?php
/**
 * ReviewsIO API Script
 * A PHP class to pull reviews down from reviews.co.uk into a json file in the theme folder
 * @author Ed Bennett
 * @version 1.0.0
 * 
 * Supports
 * - Supports Wordpress themes
 * - Supports local usage
 * 
 * Requirements
 * - Must have write access to a directory to pull data down into a folder
 */ 
class ReviewsIO
{
	/**
	 * rioStoreID
	 * The ID number or name of the reviews.io account
	 *
	 * @var string|int
	*/
	public $rioStoreID = null;

	/**
	 * Main API Url for reviews.io
	 *
	 * @var string
	 */
	public $rioAPIUrl = "https://api.reviews.co.uk/";

	/**
	 * API Key for the account to access. Required if posting to their
	 * platform.
	 *
	 * @var [type]
	 */
	public $rioAPIKey = null;
	
	public function __construct($apiKey = '')
	{	
		$this->rioAPIKey = $apiKey;
	}

	/**
	 * isWordpressActive
	 * Check to see if wordpress constant ABSPATH is defined and return true/false
	 *
	 * @return boolean
	 */
	public function isWordpressActive()
	{
		return defined('ABSPATH') ? true : false;
	}

	/**
	 * Fetch a file using cURL.
	 *
	 * @param string $path
	 * @return void
	 */
	public static function getFile($path = "")
	{
		try {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $path);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
			$data = curl_exec($ch);
			$errNo = curl_errno($ch);
			curl_close($ch);
			if ($errNo) {
				return $errNo;
			}
			return $data;
		} catch(Exception $e) {
            trigger_error(
                sprintf(
                    'Curl failed with error #%d: %s',
                    $e->getCode(), $e->getMessage()
                ),
                E_USER_ERROR
            );
        }
	}

	/**
	 * Set the store ID to fetch from the API
	 * Can be either string or integer
	 * @param string|int $id
	 * @return string
	 * @return int
	 */
	public function setStoreID($id = '')
	{
		return $this->rioStoreID = $id;
	}

	/**
	 * Set the correct API Url to call
	 *
	 * @return string
	 */
	public function rioAPIUrl($type = 'latest')
	{
		$url = null;
		switch($type) :
			default: 
				$url = $this->rioAPIUrl . 'merchant/latest' . '?store=' . $this->rioStoreID;
				break;
			case 'latest':
				$url = $this->rioAPIUrl . 'merchant/latest' . '?store=' . $this->rioStoreID;
				break;
			case 'short':
				$url = $this->rioAPIUrl . 'merchant/reviews' . '?apikey='. $this->rioAPIKey . '&store=' . $this->rioStoreID;
				break;
		endswitch;

		return $url;
	}

	public function getReviews()
	{
		$cacheFileLocal = get_stylesheet_directory() . '/reviews/reviews.json';
		$cacheFile = get_stylesheet_directory_uri() . '/reviews/reviews.json';
		$expires = strtotime('+1 day');
		$results = $this->fetchReviewsFromAPI();

		if ( file_exists($cacheFileLocal) === false) {
			if($results) {
				if(mkdir(get_stylesheet_directory().'/reviews', 0755) && file_exists(get_stylesheet_directory().'/reviews') === false) {
					mkdir(get_stylesheet_directory().'/reviews', 0755);
				}
				$f = fopen($cacheFileLocal, 'w') or die ('File not available');
				fwrite($f, $results);
				fclose($f);
				return $this->getFile($cacheFile);
			}
		} 

		if( filemtime($cacheFileLocal) < $expires && ($this->getFile($cacheFile) !== 3 || $this->getFile($cacheFile) != '')) {
			if($results) {
				$f = fopen($cacheFileLocal, 'w') or die ('File not available');
				fwrite($f, $results);
				fclose($f);
				return $this->getFile($cacheFile);
			}
		} 

		return $this->getFile($cacheFile);
	}

	/**
	 * Perform request to API to fetch all reviews
	 *
	 * @return void
	 */
	public function fetchReviewsFromAPI()
	{
		return $this->getFile($this->rioAPIUrl('latest'));
	}
}
