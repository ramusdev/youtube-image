<?php
/**
 * Class for retrive Youtube image, id and embeded link
 *
 * @since 1.0.0
 */

namespace Youtube;

class YoutubeImage
{
	public $result;
	public $matches;

	/**
	 * Url video of youtube
	 *
	 * @since 1.0.0
	 * @param $url link for youtube video
	 */
	public function __construct($url) 
	{
	    $pattern = 
	        '%^# Match any youtube URL
	        (?:https?://)?  # Optional scheme. Either http or https
	        (?:www\.)?      # Optional www subdomain
	        (?:             # Group host alternatives
	          youtu\.be/    # Either youtu.be,
	        | youtube\.com  # or youtube.com
	          (?:           # Group path alternatives
	            /embed/     # Either /embed/
	          | /v/         # or /v/
	          | /watch\?v=  # or /watch\?v=
	          )             # End path alternatives.
	        )               # End host alternatives.
	        ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
	        $%x';

	   	$this->result = preg_match($pattern, $url, $this->matches);
	}

	/**
	 * Return youtube video id
	 *
	 * @since 1.0.0
	 * @return string video id
	 */
	public function getId()
	{
		if ($this->result) {
			return $this->matches[1];
		}
	}

	/**
	 * Return image max res or hq
	 *
	 * @since 1.0.0
	 * @return string link image
	 */
	public function getImage($size = 'medium')
	{
		$hq = 'https://img.youtube.com/vi/' . $this->getId() . '/hqdefault.jpg'; 
		$max = 'https://img.youtube.com/vi/' . $this->getId() . '/maxresdefault.jpg';

		if ($size == 'large') {
			//if ( ! @getimagesize( $max ) ) return $hq;
			return $max;
		}

		return $hq;
	}

	/**
	 * Return embed youtube video link
	 *
	 * @since 1.0.0
	 * @return string video embed link
	 */
	public function getVideo()
	{
		$video = 'https://youtube.com/embed/' . $this->getId();
		return $video;
	}
}

?>
