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
    */
	public function __construct(string $url) 
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
	 */
	public function getId() : string
	{
		if ($this->result) {
			return $this->matches[1];
		}
	}

	/**
	 * Return image max res or hq
	 *
     */
	public function getImageLink(string $size = 'medium') : string
	{
		$hq = 'https://img.youtube.com/vi/' . $this->getId() . '/hqdefault.jpg'; 
		$max = 'https://img.youtube.com/vi/' . $this->getId() . '/maxresdefault.jpg';

		if ($size == 'large') {
			return $max;
		}

		return $hq;
	}

	/**
	 * Return embed youtube video link
	 *
	*/
	public function getEmbededLink() : string
	{
        return 'https://youtube.com/embed/' . $this->getId();
	}
}