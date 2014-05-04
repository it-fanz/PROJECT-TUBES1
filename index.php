<?php
require_once 'xpath.php';
set_time_limit(0);
$startUrl = "http://www.poskerja.com/";

// anchor text "//div[@class= 'p-head']//h2/a/text()"
// anchor href "//div[@class= 'p-head']//h2/a/@href"
// anchor continue prg "//div[@class= 'p-con']//p/a/text()"
// anchor paragraph src "//div[@class= 'p-con']//p/text()"
// anchor continue link "//div[@class= 'p-con']//p/a/@href"

function scrapeLOKER($url){
	//$baseUrl = "http://www.poskerja.com/";
	$array = array();
	$xpath = new XPATH($url);	

	//$imageSrcQuery = $xpath->query("//td[@class = 'pl-video-thumbnail'] //span[@class = 'yt-thumb-clip']//img/@src");
	$linkTitleQuery = $xpath->query("//div[@class= 'p-head']//h2/a/text()");
	$linkHrefQuery = $xpath->query("//div[@class= 'p-head']//h2/a/@href");
	//$linkPrgQuery = $xpath->query("//div[@class= 'p-con']//p/text()");
	$linkContiPrgQuery = $xpath->query("//div[@class= 'p-con']//p/a/text()");
	$linkContiHrefQuery = $xpath->query("//div[@class= 'p-con']//p/a/@href");

	$fh = fopen("poskerja.txt", "a+");
	for($x=0; $x<$linkHrefQuery->length; $x++){

		//$string = $array[$x]['imageSrc'] = $imageSrcQuery->item($x)->nodeValue ."*";
		$string = $array[$x]['linkTitle'] = $linkTitleQuery->item($x)->nodeValue ."*";
		$string .= $array[$x]['linkHref'] = /*$baseUrl .*/ $linkHrefQuery->item($x)->nodeValue ."*";
		//$string .= $array[$x]['prgQuery'] = $linkPrgQuery->item($x)->nodeValue ."*";
		$string .= $array[$x]['contiPrg'] = /*$baseUrl . */$linkContiPrgQuery->item($x)->nodeValue ."*";
		$string .= $array[$x]['contiPrgHref'] = $linkContiHrefQuery->item($x)->nodeValue;

		fwrite($fh, $string ."\n");
		//$array[$x]['imageSrc'] = $imageSrcQuery->item($x)->nodeValue;
		//$array[$x]['linkTitle'] = $linkTitleQuery->item($x)->nodeValue;
		//$array[$x]['linkHref'] = $baseUrl . $linkHrefQuery->item($x)->nodeValue;
		//$array[$x]['linkOwner'] = $linkOwnerQuery->item($x)->nodeValue;
		//$array[$x]['linkOwnerHref'] = $baseUrl . $linkOwnerHrefQuery->item($x)->nodeValue;
		//$array[$x]['linkTimestamp'] = $linkTimestampQuery->item($x)->nodeValue;

	}
	fclose($fh);
	return $array;
}

$data = scrapeLOKER("http://www.poskerja.com/");


echo "<pre>";
print_r($data);
