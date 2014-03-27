<?php
/**
 *
 * php-crpapi example usage
 * @author Ben Pilkerton
 *
 *
 * There are a few options which need to be defined in the constructor 
 * in crpapi.php.  These include specifying your API key, default 
 * output type (json recommended, default) and cache lifetime 
 * (one day is default).
 *
 * Include the CRP API Library and create an object instance, specifying
 * the parameters.  In this example, we specify the output type.  This
 * could be ommitted and the default (defined in the constructor) will
 * be used.
 *
**/

/**
 * class php-crpapi
 * Simple PHP client library for working with the Center for Responsive Politics' API.
 * Information on CRP's API can be found at http://www.opensecrets.org/action/api_doc.php
 * Information on using this class, including examples at http://github.com/bpilkerton/php-crpapi
 * @author Ben Pilkerton <bpilkerton@gmail.com>
 * @version 0.2
 */

header("Access-Control-Allow-Origin: *");

error_reporting(0);
@ini_set('display_errors', 0);

class crp_api {

    function __construct($method=NULL,$params=NULL) {

        $this->api_key = "49df10c9a901e71fc25ecac55542454c";
        $this->base_url = "http://api.opensecrets.org/";
        $this->output = "json";
        
        //Allow output type to be overridden on object instantiation
        $this->output = isset($params['output']) ? $params['output']: $this->output;
        $this->method = $method;
        self::load_params($params);
        
        $this->file_hash = md5($method . "," . implode(",",$params));
        $this->cache_hash = "dataCache/" . $this->file_hash;
        $this->cache_time = 86400; #one day
        
    }

    private function load_params($params) {
        $this->url = $this->base_url . "?method=" . $this->method . 
            "&apikey=" . $this->api_key;

        foreach ($params as $key=>$val) {
            $this->url .= "&" . $key . "=" . $val;
            $this->$key = $val;
        }

        return;
    }
    
    public function get_data($use_cache=true) {
    
        if ($use_cache and file_exists($this->cache_hash) and (time() - filectime($this->cache_hash) < $this->cache_time)) {
        
            $this->cache_hit = true;
            $file = fopen($this->cache_hash,"r");
            $this->data = stream_get_contents($file);
            $this->data = gzuncompress($this->data);
            $this->data = unserialize($this->data);
            fclose($file);
            $this->response_headers = "No http request sent, using cache";

        } else {
            $this->cache_hit = false;
            $this->data = file_get_contents($this->url);
            $this->response_headers = $http_response_header;
            
            switch ($this->output) {
                case "json":
                    $this->data = json_decode($this->data,true);
                    break;
                case "xml":
                    $this->data = simplexml_load_string($this->data);
                    break;
                default:
                    die("Unknown output type.  Use 'json' or 'xml'");
            }

            if ($use_cache) {
                $file = fopen($this->cache_hash,"w");
                $store = serialize($this->data);
                $store = gzcompress($store);
                fwrite($file,$store);
                fclose($file);
            }
        }
        
        return $this->data;
    }
    
    function get_cache_status() {
        return $this->cache_hit;
    }

    function get_response_headers() {
        return $this->response_headers;
    }
    
}


/**
 * Setup the class instance with our request parameters
**/

$cand = $_POST['id'];

$crp = new crp_api("candIndustry", Array("cid"=>$cand,"cycle"=>"2012","output"=>"json"));

$sum = new crp_api("candSummary", Array("cid"=>$cand,"cycle"=>"2012","output"=>"json"));

/**
 * These variables are exposed upon instantiation
**/

/**
 * Get the data. This example retrieves json data which is converted to 
 * an associative array. If using xml, a SimpleXML object will be returned.  
 * The getData method can optionally be passed a true/false value (true is 
 * default).  If set to false, a local file cache will not be used.
**/

$data = $crp->get_data();
$sumdata = $sum->get_data();

$pct = $_POST['pctg'];
$finalpct = $pct * 100;

if($pct == 0.64){$rankval=1;}
if($pct == 0.591){$rankval=2;}
if($pct == 0.58){$rankval=3;}
if($pct == 0.448){$rankval=4;}
if($pct == 0.417){$rankval=5;}
if($pct == 0.386){$rankval=6;}
if($pct == 0.382){$rankval=7;}
if($pct == 0.36){$rankval=8;}
if($pct == 0.35){$rankval=9;}
if($pct == 0.33){$rankval=10;}
if($pct == 0.329){$rankval=11;}
if($pct == 0.316){$rankval=12;}
if($pct == 0.3){$rankval=13;}
if($pct == 0.3){$rankval=14;}
if($pct == 0.287){$rankval=15;}
if($pct == 0.282){$rankval=16;}
if($pct == 0.28){$rankval=17;}
if($pct == 0.272){$rankval=18;}
if($pct == 0.267){$rankval=19;}
if($pct == 0.26){$rankval=20;}
if($pct == 0.258){$rankval=21;}
if($pct == 0.253){$rankval=22;}
if($pct == 0.247){$rankval=23;}
if($pct == 0.245){$rankval=24;}
if($pct == 0.244){$rankval=25;}
if($pct == 0.23){$rankval=26;}
if($pct == 0.23){$rankval=27;}
if($pct == 0.227){$rankval=28;}
if($pct == 0.227){$rankval=29;}
if($pct == 0.222){$rankval=30;}
if($pct == 0.221){$rankval=31;}
if($pct == 0.218){$rankval=32;}
if($pct == 0.218){$rankval=33;}
if($pct == 0.211){$rankval=34;}
if($pct == 0.21){$rankval=35;}
if($pct == 0.21){$rankval=36;}
if($pct == 0.21){$rankval=37;}
if($pct == 0.209){$rankval=38;}
if($pct == 0.2){$rankval=39;}
if($pct == 0.199){$rankval=40;}
if($pct == 0.198){$rankval=41;}
if($pct == 0.195){$rankval=42;}
if($pct == 0.193){$rankval=43;}
if($pct == 0.19){$rankval=44;}
if($pct == 0.189){$rankval=45;}
if($pct == 0.188){$rankval=46;}
if($pct == 0.187){$rankval=47;}
if($pct == 0.183){$rankval=48;}
if($pct == 0.182){$rankval=49;}
if($pct == 0.181){$rankval=50;}

if($finalpct === 100) {
	$finalpct = "N/A";
}

if($finalpct < 5) {
	$scale = 1;
}
if($finalpct >= 5 and $finalpct < 10) {
	$scale = 2;
}
if($finalpct >= 10 and $finalpct < 99) {
	$scale = 3;
}

/**
 * Show the cache status.  By default, the library caches API query results in a
 * gzipped, serialized form in a text file in the dataCache directory.  If you do 
 * not desire file caching, call get_data(false) (see above).  The cache life can
 * be set by altering $this->cache_time value in crpapi.php.  The default is 
 * one day.
**/

/**
 * Iterate over the results
**/

$first = true;

foreach($data['response']['industries']['@attributes'] as $key=>$val) {
	if ($first) {
		$party = substr($val, -2, 1);
		$first = false;
		define("PARTY", $party);
	}
	else {
		break;
	}
	if (strlen($val) > 17) {
		$newval = explode(" ", $val);
		$firstname = $newval[0];
		$finalval = $firstname[0] . ". " . $newval[1] . " " . $newval[2];
	}
	else {
		$finalval = $val;
	}
	if(substr($finalval, -1) === ")") {
		$finalval = substr($finalval, 0, -3);
	}
	if ($party === "D") {
		echo "<div id='my-tooltip-2986234'><div><a target='_blank' href='https://www.opensecrets.org/politicians/summary.php?cid=" . $cand . "&cycle=2014'><h1>" . $finalval . "</h1></a>";
		$first = false;
	}
	elseif ($party === "R") {
		echo "<div id='my-tooltip-091234'><div><a target='_blank' href='https://www.opensecrets.org/politicians/summary.php?cid=" . $cand . "&cycle=2014'><h1>" . $finalval . "</h1></a>";
		$first = false;
	}
	else {
		echo "<div id='my-tooltip-2986234'><div><a target='_blank' href='https://www.opensecrets.org/politicians/summary.php?cid=" . $cand . "&cycle=2014'><h1>" . $finalval . "</h1></a>";
		$first = false;
	}
}	

$file = "http://extension.nicholasrub.in/headshots/" . $cand . ".png";

$file_headers = @get_headers($file);

if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
    $exists = false;
}
else {
    $exists = true;
}

if ($exists == true) {
    echo "<img src='http://extension.nicholasrub.in/headshots/" . $cand . ".png'>";
}

$firstthree = 0;

foreach($sumdata['response']['summary']['@attributes'] as $keytwo=>$valtwo) {
	if ($firstthree === 3) {
		echo "<p id='state1235'>" . PARTY . "-" . $valtwo . "</p>";
		$firstthree++;
	}
	else {
		$firstthree++;
	}	
}

$firsttwo = 0;

foreach($sumdata['response']['summary']['@attributes'] as $keytwo=>$valtwo) {
	if ($firsttwo === 8) {
		echo "<p id='money2444'><span title='Total donations'> $" . number_format($valtwo) . "</span><br><span id='lessthan1756' title='Click for list of all members of Congress'><a id='pctlink12' href='http://greenhouse.nicholasrub.in/percentages' target='_blank'>≤ $200</a>: </span><a id='pctlink12' href='http://greenhouse.nicholasrub.in/percentages' target='_blank'><span id='percent" . $scale . "' title='Small contributions (≤$200) as % of total'>" . $finalpct . "%</a></span>";
		$firsttwo++;
	}
	else {
		$firsttwo++;
	}
}	

/**
if($finalpct >= 18.1 and $finalpct < 24.4) {
	echo "<span id='topbadge-152' title='In top 50 in Congress based on % of small contributions'>50</span>";
}
if($finalpct >= 24.4 and $finalpct < 33) {
	echo "<span id='topbadge-152' title='In top 25 in Congress based on % of small contributions'>25</span>";
}
if($finalpct >= 33 and $finalpct < 41.7) {
	echo "<span id='topbadge-152' title='In top 10 in Congress based on % of small contributions'>10</span>";
}
if($finalpct >= 41.7 and $finalpct < 99) {
	echo "<span id='topbadge-152' title='In top 5 in Congress based on % of small contributions'>5</span>";
}**/

if (isset($rankval)) {
echo "<span id='topbadge-152' title='Is #" . $rankval ." in congress based on % of small contributions.'>#" . $rankval . "</span>";
}
echo "</p></div>";


echo "<table><tr><th title='Top 10 industries' contributions'>Industry</th><th id='totalheader152'>Total</th></tr>";

$firstthree = 0;
foreach ($data['response']['industries']['industry'] as $ind) {
    foreach ($ind as $row) {
    if($firstthree < 10) {
        echo "<tr><td>" . $row['industry_name'] . " " . "</td><td id='total-1847'>" . "$" . 
            number_format($row['total']) . '</td></tr>';
            $firstthree++;
           }
    }
}

echo "</table><h2>by <a id='greenhouse-1523' target='_blank'>Greenhouse</a> | data <a target='_blank' href='https://www.opensecrets.org/politicians/summary.php?cid=" . $cand . "&cycle=2014'>OpenSecrets.org</a></h2></div>";

?>