<?php
require_once("config.php");
ini_set('error_reporting', E_ALL ^ E_NOTICE);
#ini_set('display_errors', true);


  if(isset($_REQUEST['q']) && $_REQUEST['q'] != '') {
    $q = trim($_REQUEST['q']);
    $q = stripslashes($q);
    $q = preg_replace('/[()*]/','',$q);
  }
  else $q = '';

  if(isset($_REQUEST['department']) && $_REQUEST['department'] != '') {
    $department = urldecode($_REQUEST['department']);
    $department = stripslashes($department);
    $department = preg_replace('/[()*]/','',$department);
  }
  else $department = '';

  if(isset($_REQUEST['filter'])) {
#    $commonsearch="(&(!(telexNumber=Yes))(!(mail=_*))";
    switch($_REQUEST['filter']) {
      case 'students':
        #$filter = '(edupersonaffiliation=student)';
        $filteroption = 'students';
        $sqlFilter = " and (is_stu = 'Y')";
        break;
      case 'employees':
        #$filter = '(|(edupersonaffiliation=staff)(edupersonaffiliation=faculty))';
        $filteroption = 'employees';
        $sqlFilter = " and (is_fac = 'Y' or is_stf = 'Y' or is_oth = 'Y')";
        break;
      default:
        $filter='';
        $filteroption = 'all';
        #$commonsearch="(&(!(telexNumber=Yes))(!(edupersonprimaryaffiliation=retired))(!(mail=_*))";
        $sqlFilter = "";
    }
  }
  else {
    $filteroption = 'all';
    #$commonsearch="(&(!(telexNumber=Yes))(!(edupersonprimaryaffiliation=retired))(!(mail=_*))";
    $sqlFilter = "";
  }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <!--Meta needed in order for Media Query to execute-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--End of Media Query Meta tag-->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" media="all" href="styles/libraries.css"/>
	<link rel="stylesheet" type="text/css" media="all" href="styles/oocss.css"/>
	<link rel="stylesheet" type="text/css" media="all" href="styles/smoothness/jquery-ui-1.8.16.custom.css" />
	<link rel="stylesheet" type="text/css" media="all" href="styles/styles.css">
	<script type="text/javascript" src="scripts/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="scripts/jquery-ui-1.8.16.custom.min.js"></script>
  <script type="text/javascript">
	    $(document).ready(function(){
	        // setup jQuery UI items
            $("#tabs").tabs();
            $("#tabs input:submit, #tabs button").button();
            $( "#radio" ).buttonset();
            $('#titanServicesLink').hover(
                function(){
                    $("#titanServicesLinks").fadeIn(300);
                },
                function(){
                    $("#titanServicesLinks").fadeOut(200);
            });
            //Togglers for Drop Down Menus
            jQuery('.toggle-nav').click(function(e) {
              jQuery(this).toggleClass('oo-simpleHList');
              jQuery('.oo-size1of1 ul').toggleClass('oo-simpleHList');
            });
            jQuery('.toggle-nav2').click(function(e) {
              jQuery(this).toggleClass('oo-simpleHFloatList');
              jQuery('.uwo-audience-nav ul').toggleClass('oo-simpleHFloatList');
            });
            jQuery('#titanServicesLink').click(function(e) {
              jQuery(this).toggleClass('titan-servicesNav');
              jQuery('#titanServicesLink ul').toggleClass('titan-servicesNav');

              e.preventDefault();
            });
	    });
	</script>
	<!-- Google Stuff -->

	<!-- Google Universal Analytics -->
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-6634319-1', 'uwosh.edu');
    ga('require', 'displayfeatures');
    ga('send', 'pageview');

  </script>

	<!-- Google Custom Search -->
	<style type="text/css">
		@import url(http://www.google.com/cse/api/overlay.css);
	</style>
	<script src="http://www.google.com/uds/api?file=uds.js&amp;v=1.0&amp;key=ABQIAAAA_hxp3RI8qqPYVC9t6pA8shRbJimFOXjwfZ7D6AgkUmNWU0eYjBTgBg715rbnb0xGjGheQwXJTgv0ww&amp;hl=en" type="text/javascript"></script>
	<script src="http://www.google.com/cse/api/overlay.js" type="text/javascript"></script>
	<script type="text/javascript">
		function OnLoad() {
	 		new CSEOverlay("016914008736719096284:eascmls-b2u",
				document.getElementById("searchbox_016914008736719096284:eascmls-b2u"),
				document.getElementById("results_016914008736719096284:eascmls-b2u")
			);
		}
		GSearch.setOnLoadCallback(OnLoad);
	</script>

	<!-- End Google Stuff -->

	<title>Directory - University of Wisconsin Oshkosh</title>
</head>
<body>
<div class="oo-line uwo-div-center oo-gs960 uwo-top-nav">
	<div class="oo-unit oo-size1of1">
    <!--Drop Down Menu Icons-->
      <a class="toggle-nav" href="#">&#9776;</a>
      <a class="toggle-nav2" href="#">&#9776;</a>
    <!--End of Menu Icons-->
		<ul class="oo-simpleHList">
			<li><a href="http://www.uwosh.edu/home/about-uw-oshkosh">About</a></li>
      <li><a href="http://www.uwosh.edu/home/future-students/undergraduate/academics">Academics</a></li>
      <li><a href=" http://www.titans.uwosh.edu/">Athletics</a></li>
      <li><a href="http://www.uwosh.edu/alumni">Alumni</a></li>
      <li><a href=" http://admissions.uwosh.edu/">Admissions</a></li>
    	<li><a href="http://www.uwosh.edu/home/administration">Administration</a></li>
      <li><a href="http://www.uwosh.edu/home/resources">Resources</a></li>
      <li><a href="http://www.uwosh.edu/home/calendars">Calendars</a></li>
			<li id="titanServicesLink" class="titan_servicesNav"><a href="http://www.uwosh.edu/home/titan-services-and-campus-resources#documentContent">Titan Services</a>
				<ul id="titanServicesLinks" class="titan-servicesNav"> <!--Added class for toggle(Kong)-->
					<li><a href="http://www.uwosh.edu/site-index/" class="services-link">Site Index</a></li>
		      <li><a href="http://www.uwosh.edu/directory/" class="services-link">Directory</a></li>
          <li><a href="http://www.uwosh.edu/registrar/titanweb/" class="services-link">Titan Web</a></li>
          <li><a href="http://www.uwosh.edu/titanapps/" class="services-link">Titan Apps</a></li>
          <li><a href="https://titanfiles.uwosh.edu/xythoswfs/webview/xythoslogin.action" class="services-link">Titan Files</a></li>
          <li><a href="https://my.wisconsin.edu/" class="services-link">My UW System</a></li>
					<li><a href="https://uwosh.courses.wisconsin.edu/" class="services-link">Desire2Learn (D2L)</a></li>
					<li><a href="http://www.uwosh.edu/library/" class="services-link">Polk Library</a></li>
					<li><a href="http://www.uwosh.edu/myuwo/" class="services-link">MyUWO</a></li>
					<li><a href="https://uwosh.collegiatelink.net/" class="services-link">Student Clubs &amp; Orgs</a></li>
          <li><a href="https://uwosh.joinhandshake.com/login" class="services-link">Handshake</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>
<div class="oo-page oo-gs960 oo-bamw">
	<div class="oo-head uwo-audience-nav oo-bbmw oo-bhnw">
		<a class="oo-fl" href="http://www.uwosh.edu/"><img class="uwo-logo oo-mhl" src="img/uwo-wordmark.png" alt="University of Wisconsin Oshkosh"/></a>
		<ul class="oo-simpleHFloatList">
        	<li><a href="http://www.uwosh.edu/home/future-students" class="simpleHFloatList">Future Students</a></li>
	        <li><a href="http://www.uwosh.edu/home/parents-and-family" class="simpleHFloatList">Parents</a></li>
	       	<li><a href=" http://www.uwosh.edu/alumni" class="simpleHFloatList">Alumni</a></li>
	        <li><a href="http://www.uwosh.edu/home/faculty-staff" class="simpleHFloatList">Faculty and Staff</a></li>
	        <li><a href="http://www.uwosh.edu/home/current-students" class="simpleHFloatList">Current Students</a></li>
		</ul>
		<!--Search -->
		<div id="google-searchbox" class="uwosh-searchbox oo-fr oo-prm">
			<form action="http://www.uwosh.edu/home/uwosh-search" id="searchbox_016914008736719096284:eascmls-b2u" class="uwosh-searchbox" onsubmit="return false;">
				<div class="LSBox">
			   		<input class="inputLabelActive" title="Search Campus" type="text" name="q" size="18" />
			   		<input class="searchButton" type="submit" value="Search" />
					<div class="searchSection">
						<input id="portal-searchbox-checkbox-campus" class="noborder" type="checkbox" checked="true" name="search_entire_campus" />
						<label for="portal-searchbox-checkbox-campus" style="cursor: pointer">search entire campus</label>
					</div>
			 	</div>
			</form>
			<script type="text/javascript" src="http://www.google.com/coop/cse/brand?form=searchbox_016914008736719096284%3Aeascmls-b2u&amp;lang=en"></script>
			<div id="results_016914008736719096284:eascmls-b2u" style="display:none">
			 	<div class="cse-closeResults">
			   		<a>&times;</a>
			 	</div>
			 	<div class="cse-resultsContainer"></div>
			</div>

		</div>
		<div class="uwosh-searchbox" style="display:none">
			<form name="searchform" id="searchbox_016914008736719096284:eascmls-b2u" action="http://www.uwosh.edu/home/uwosh-search">
				<label for="searchGadget" class="hiddenStructure">Search Site</label>
				<div class="LSBox">
					<input name="SearchableText" type="text" size="18" title="Search Site" accesskey="4" class="inputLabel" id="searchGadget" />
					<input class="searchButton" type="submit" value="Search" />
					<div class="searchSection">
						<input id="portal-searchbox-checkbox-site" class="noborder" type="checkbox" name="search_entire_campus" />
						<label for="portal-searchbox-checkbox-site" style="cursor: pointer">search entire campus</label>
					</div>
					<div class="LSResult" id="LSResult" style="">
						<div class="LSShadow" id="LSShadow"></div>
					</div>
				</div>
			</form>
		</div>
		<!-- END Search -->
	</div>
	<h1 id="title-bar">UW Oshkosh Directory</h1>
	<div class="oo-body oo-cb">
		<div class="oo-main">
            <div id="tabs">
                <ul class="tabs">
        		    <li><a href="#tab-search">Search</a></li>
        		    <li><a href="#tab-info">Update Your Information</a></li>
        		    <li><a href="#tab-printed">Printed Directory</a></li>
                    <li><a href="#tab-retired">Retired Staff</a></li>
        		</ul>
    	        <div id="tab-search">
                    <div class="oo-line uwo-search">
                        <div class="oo-unit oo-size1of2">
                            <p><strong>by name:</strong></p>
                            <form name="byname" method="get" action="">
                                <div id="radio">
                                    <input type="radio" name="filter" id="all" value="all" <?php if($filteroption=='all') echo "checked='checked'" ?> /><label for="all">All</label>
                                    <input type="radio" name="filter" id="employees" value="employees" <?php if($filteroption=='employees') echo "checked='checked'" ?> /><label for="employees">Staff and Faculty</label>
                                    <input type="radio" name="filter" id="students" value="students" <?php if($filteroption=='students') echo "checked='checked'" ?> /><label for="students">Students</label>
                                </div>
                                <input type="text" name="q" id="q" value="<?php echo $q; ?>" size="40" />
                                <input type="submit" name="button" id="button" value="Submit" />
                            </form>

                            <form name="bydept" method="get" action="" class="oo-ptl">
                              <label for="department"><strong>by Department:</strong></label><br />
                              <select class="department" name="department">
                                <option value=""></option>
                                <?php
                                    $depts = file('depts.txt');
                                    foreach( $depts as $dept ) {
                                      $dept = trim($dept);
                                      print "<option value=\"".trim(urlencode($dept))."\"";
                                      if($department == $dept) print " selected='selected'";
                                      print ">".trim(preg_replace('/&/', '&amp;', $dept))."</option>\n";
                                    }
                                  ?>
                              </select>
                              <input type="submit" name="button2" id="button2" value="Submit" />
                            </form>
                        </div>
                        <div class="oo-unit oo-size1of2 oo-lastUnit">
                            <p><strong>Examples:</strong><br />
                                <em>First and Last Name:</em> Joe Smith or Smith, Joe<br />
                                <em>Email or Last Name:</em> smith or Smith <br />
                                <em>Campus Phone Number:</em> 1234
                            </p>
                            <p>This search tool is intended to provide access to general public information. This utility should not be used for the solicitation of business or for the submission of unwanted email or other uses incompatible with the University's status as a state institution.</p>
                        </div>
                    </div>

                    <div id="results">
                        <?php

                        if($department || $q) {
                            print "<h2>Results</h2>";
                            $db = mysqli_init();
                            $db->real_connect($hostname, $user, $password, $database);
                            if((strlen($q) < 3) && !$department) { ?>
                                <div class="ui-widget">
                              		<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
                  					    <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                  					    <strong>Alert:</strong> Search criteria requires at least 3 characters.</p>
                  				    </div>
                  			    </div>
                                <?php
                                $q = '';
                            }
                            $nResults = 0;
                            if($q != '') {
#                                $searchbase = "ou=people,o=uwosh.edu,dc=uwosh,dc=edu";
                                //$commonsearch="(&(!(telexNumber=Yes))(!(edupersonprimaryaffiliation=retired))(!(mail=_*))";
                                $limit = 50;
                                $toplimit = 100;
                                if(preg_match('/,/',$q)) {
                                    list($lastname,$firstname) = explode(',', $q);
                                    $firstname = ltrim($firstname);
                                    print "<p id='search-message'>Search for people with name <strong>$lastname, $firstname</strong></p>\n";
#                                    $searchcrit = "$commonsearch(sn=$lastname*)(givenname=$firstname*)$filter)";

                                    //set SQL for addition query
                                    //$query = "SELECT * FROM information WHERE name LIKE '%$q%' ORDER BY name DESC";
                                    $deptQuery = $db->prepare("select department, name, phonenumber, location from information where name like ? order by name desc limit 50");
                                    $wildcard = "%$q%";
                                    $deptQuery->bind_param("s", $wildcard);
                                    $deptQuery->execute();
                                    $deptQuery->store_result();
                                    $nResults += $deptQuery->num_rows;

                                    $personQuery = $db->prepare("select hash, username, lastname, firstname, mi, is_fac, is_stf, is_stu, is_oth, department, mailstop, zip, building, room, phone from directory_public left join directory_public_dept using(username) where lastname like ? and firstname like ? " . $sqlFilter . " order by lastname, firstname limit 50");
                                    $wcLast = "$lastname%";
                                    $wcFirst = "$firstname%";
                                    $personQuery->bind_param("ss", $wcLast, $wcFirst);
                                    $personQuery->execute();
                                    $personQuery->store_result();
                                    $nResults += $personQuery->num_rows;

                                }
                                else if(preg_match('/[0-9][0-9][0-9][0-9]/',$q)) {
                                    $phone = $q;
                                    print "<p id='search-message'>Search for people with phone number <strong>$phone</strong></p>\n";
#                                    $searchcrit = "$commonsearch(telephonenumber=$phone))";

                                    //set SQL for addition query
                                    #$query = "SELECT * FROM information WHERE phoneNumber = '$q' ORDER BY name DESC";
                                    $deptQuery = $db->prepare("select department, name, phonenumber, location from information where phonenumber = ? order by name desc limit 50");
                                    $deptQuery->bind_param("s", $q);
                                    $deptQuery->execute();
                                    $deptQuery->store_result();
                                    $nResults += $deptQuery->num_rows;

                                    $personQuery = $db->prepare("select hash, username, lastname, firstname, mi, is_fac, is_stf, is_stu, is_oth, department, mailstop, zip, building, room, phone from directory_public left join directory_public_dept using(username) where phone is not null and phone = ? " . $sqlFilter . " order by lastname, firstname limit 50");
                                    $personQuery->bind_param("s", $q);

                                    $personQuery->execute();
                                    $personQuery->store_result();
                                    $nResults += $personQuery->num_rows;


                                }
                                else if(preg_match('/ /',$q)) {
                                    list($firstname,$lastname) = explode(' ', $q);
                                    print "<p id='search-message'>Search for people with name <strong>$firstname $lastname</strong></p>\n";
#                                    $searchcrit = "$commonsearch(sn=$lastname*)(givenname=$firstname*)$filter)";

                                    //set SQL for addition query
                                    #$query = "SELECT * FROM information WHERE name LIKE '%$q%' ORDER BY name DESC";
                                    $deptQuery = $db->prepare("select department, name, phonenumber, location from information where name like ? order by name desc limit 50");
                                    $wildcard = "%$q%";
                                    $deptQuery->bind_param("s", $wildcard);
                                    $deptQuery->execute();
                                    $deptQuery->store_result();
                                    $nResults += $deptQuery->num_rows;

                                    $personQuery = $db->prepare("select hash, username, lastname, firstname, mi, is_fac, is_stf, is_stu, is_oth, department, mailstop, zip, building, room, phone from directory_public left join directory_public_dept using(username) where lastname like ? and firstname like ? " . $sqlFilter . " order by lastname, firstname limit 50");
                                    $wcLast = "$lastname%";
                                    $wcFirst = "$firstname%";
                                    $personQuery->bind_param("ss", $wcLast, $wcFirst);
                                    $personQuery->execute();
                                    $personQuery->store_result();
                                    $nResults += $personQuery->num_rows;

                                }
                                else {
                                    print "<p id='search-message'>Search for people with email or lastname <strong>$q</strong></p>";
#                                    $searchcrit = "$commonsearch(|(sn=$q*)(uid=$q*))$filter)";

                                    //set SQL for addition query
                                    #$query = "SELECT * FROM information WHERE name LIKE '%$q%' ORDER BY name DESC";
                                    $deptQuery = $db->prepare("select department, name, phonenumber, location from information where name like ? order by name desc limit 50");
                                    $wildcard = "%$q%";
                                    $deptQuery->bind_param("s", $wildcard);
                                    $deptQuery->execute();
                                    $deptQuery->store_result();
                                    $nResults += $deptQuery->num_rows;

                                    $personQuery = $db->prepare("select hash, username, lastname, firstname, mi, is_fac, is_stf, is_stu, is_oth, department, mailstop, zip, building, room, phone from directory_public left join directory_public_dept using(username) where (lastname like ? or username like ?) " . $sqlFilter . " order by lastname, firstname limit 50");
                                    $wildcard = "$q%";
                                    $personQuery->bind_param("ss", $wildcard, $wildcard);
                                    $personQuery->execute();
                                    $personQuery->store_result();
                                    $nResults += $personQuery->num_rows;

                                }
                            }
                            else if($department != '') {
                                print "<p id='search-message'>Search for people in department <strong>$department</strong></p>";
#                                $searchcrit = "$commonsearch(ou=$department)(|(edupersonaffiliation=staff)(edupersonaffiliation=faculty)))";
#                                $searchbase = "ou=people,o=uwosh.edu,dc=uwosh,dc=edu";
                                $limit = 200;
                                $toplimit = 200;

                                //set SQL for addition query
                                #$query = "SELECT * FROM information WHERE department='".addslashes($department)."' ORDER BY name DESC";
                                $deptQuery = $db->prepare("select department, name, phonenumber, location from information where department = ? order by name desc limit 50");
                                $deptQuery->bind_param("s", $department);
                                $deptQuery->execute();
                                $deptQuery->store_result();
                                $nResults += $deptQuery->num_rows;

                                $personQuery = $db->prepare("select hash, username, lastname, firstname, mi, is_fac, is_stf, is_stu, is_oth, department, mailstop, zip, building, room, phone from directory_public left join directory_public_dept using(username) where department = ? " . $sqlFilter . " order by lastname, firstname limit 100");
                                $personQuery->bind_param("s", $department);
                                $personQuery->execute();
                                $personQuery->store_result();
                                $nResults += $personQuery->num_rows;

                            }

#                            if($q != '') {
                                /*
                                 *  Do the LDAP Search
                                 */
#                                $ds=ldap_connect("ldap.uwosh.edu");

                                //Get the total results from the search to be used later to check the search is too generic
#                                $srt=@ldap_search($ds, $searchbase, $searchcrit, array('uid'));
#                                $total_results = ldap_count_entries($ds, $srt);

                                /*
                                 *This is the actual search, it is limited to $limit results
                                 */
#                                $sr=@ldap_search($ds, $searchbase, $searchcrit, array('sn','givenname','cn','displayname','uid','mail','ou','telephonenumber','l','uwodepartmentassoc','edupersonaffiliation','edupersonprimaryaffiliation'),0,$limit);
#                                ldap_sort($ds, $sr, 'displayname');
#                                $info = ldap_get_entries($ds, $sr);
#                                ldap_close($ds);

                                if($nResults > $toplimit){ ?>
                                    <div class="ui-widget">
                                  		<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
                      					    <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                      					    <strong>Alert:</strong> Too many results returned, please redefine search criteria.</p>
                      				    </div>
                      			    </div>
                                <?php
                                } else {
                                    if($nResults >= $limit && !$department) { ?>
                                        <div class="ui-widget oo-pbm">
                                      		<div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;">
                          					    <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                          					    <strong>Info:</strong> Search limit of <?php echo $limit; ?> results reached, please refine your search.</p>
                          				    </div>
                          			    </div>
                                    <?php
                                    } else if($nResults == 0){ ?>
                                        <div class="ui-widget">
                                      		<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
                          					    <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                          					    <strong>Alert:</strong> No results returned, please refine your search.</p>
                          				    </div>
                          			    </div>
                                    <?php
                                    }


                                    /*
                                     *  Iterate through department SQL Results
                                     */
                                    $recordCount = 0;
                                    $deptQuery->bind_result($department, $name, $phoneNumber, $location);
                                    while($deptQuery->fetch()) { ?>
                                        <div class='result'>
                                            <ul class="oo-simpleHList">
                                                <liclass="oo-phm"><strong><?php echo $name; ?></strong></li>
                                            </ul>
                                            <div class="oo-data uwo-dataTable oo-cb oo-pbm">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th scope="column" width="66%">Department</th>
                                                            <th scope="column" width='18%'>Office</th>
                                                            <th scope="column" width='15%'>Campus Phone</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><?php echo $department; ?></td>
                                                            <td><?php if(!empty($location)) {echo $location;} ?></td>
                                                            <td>
                                                                <?php
                                                                    if(strlen($phoneNumber) == 4) {
                                                                        echo "(920) 424-" . $phoneNumber;
                                                                    } else {
                                                                        echo $phoneNumber;
                                                                    }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <?php $recordCount++; ?>
                                    <?php }
                                   $personQuery->bind_result($hash, $username, $lastname, $firstname, $mi, $is_fac, $is_stf, $is_stu, $is_oth, $department, $mailstop, $zip, $building, $room, $phone);
                                    /*
                                     * Iterate through Person results
                                     */
                                    $i=0;
                                    while($personQuery->fetch()) {
                                    $i++;
                                ?>

                                        <div class='result'>
                                            <ul class="oo-simpleHList">
                                                <li class="oo-phm oo-banb oo-brsb"><strong><?php echo "$lastname, $firstname" ?></strong></li>
                                                <?php if (preg_match("/^141.233./", $_SERVER['REMOTE_ADDR']) !== 0) { ?>
                                                <li class="oo-phm oo-banb oo-brsb"><a href='mailto:<?php echo "$username@uwosh.edu" ?>'><?php echo "$username@uwosh.edu" ?></a></li> <?php } else { ?>
                                                <li class="oo-phm oo-banb oo-brsb"><img src="email.php?entry=<?php echo $hash ?>" /></li> <?php } ?>
                                                <li class="oo-plm">
                                                    <em>
                                                <?php
                                                        unset($affils);
                                                        if($is_stf == 'Y')
                                                            $affils[] = "Staff";
                                                        if($is_fac == 'Y')
                                                            $affils[] = "Faculty";
                                                        if($is_stu == 'Y')
                                                            $affils[] = "Student";
                                                        if($is_oth == 'Y')
                                                            $affils[] = "Other Affiliation";
                                                       print implode(", ", $affils);
                                                    ?>
                                                    </em>
                                                </li>
                                            </ul>
                                            <?php
                                            if(!empty($department)) { ?>
                                            <div class="oo-data uwo-dataTable oo-cb oo-pbm">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th scope="column" width="33%">Department</th>
                                                            <th scope="column" width="33%">Campus Mailstop / Plus 4 Zip</th>
                                                            <th scope="column" width='18%'>Office</th>
                                                            <th scope="column" width='15%'>Campus Phone</th>
                                                        </tr>
                                                    </thead>
                                                    <tr>
                                                        <td><?php echo $department ?></td>
                                                        <td>
                                                            <?php if(!empty($mailstop)) { echo $mailstop." / ".$zip ?>
                                                            <span id="details<?php echo $i.$x;?>" class="ui-icon ui-icon-search" style="display:inline-block;cursor:pointer;"></span>
                                                            <?php } ?>
                                                            <script type="text/javascript">
                                                                $(document).ready(function() {
                                                                    $( "#mailstop<?php echo $i.$x;?>" ).dialog({
                                                                    	modal: true,
                                                            			autoOpen: false,
                                                            			buttons: {
                                                            				Ok: function() {
                                                            					$( this ).dialog( "close" );
                                                            				}
                                                            			}
                                                            		});
                                                                    $("#details<?php echo $i.$x;?>").click(function(){
                                                                        $("#mailstop<?php echo $i.$x;?>").dialog('open');
                                                                    })
                                                                });
                                                            </script>
                                                            <div id="mailstop<?php echo $i.$x;?>" title="Mail Stop">
                                                                <p>Campus Mailstop is the location where postal and interdepartmental mail is to be sent for this person.</p>
                                                                <p>
                                                                <?php echo "$firstname $lastname" ?><br />
                                                                UW Oshkosh<br />
                                                                <?php echo $mailstop; ?><br />
                                                                800 Algoma Boulevard<br />
                                                                Oshkosh, WI 54901-<?php echo $zip; ?>
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td><?php echo "$building $room" ?></td>
                                                        <td><?php if(strlen($phone) == 4) echo "(920) 424-"; echo $phone; ?></td>
                                            	    </tr>
                                            <?php
//                                                } //end for
                                            ?>
                                                </table>
                                            </div>
                                            <?php
                                            } //end for
                                            ?>
                                        </div>
                                    <?php
                                    }
                                }
                        #    }
                            #$count = $info['count'] + $recordCount;
                            print "<p id='search-count'>{$nResults} results returned</p>\n";
                            $db->close();
                        }
                        ?>
                    </div>
                </div>
                <div id="tab-info">
                    <p><strong>Students:</strong> <a href='http://www.uwosh.edu/registrar/titanweb/'>Log into TitanWeb.</a></p>
                    <p><strong>Employees:</strong>To updated your home address, visit the <a href="https://my.wisconsin.edu">My UWSystem portal</a>; to update your departmental address, contact Rachael Kruszka in Human Resources at <a style="text-decoration:underline;" href="mailto:kruszkar@uwosh.edu?subject=Directory%20Update">kruszkar@uwosh.edu</a>.</p>
                    <p>Under the Family Educational Rights and Privacy Act, students may have requested the nondisclosure of directory information. This means that the search may not reveal the names of selected students.</p>
                </div>
                <div id="tab-printed">
                    <p>When it comes to sustainable practices, there are not many institutions that do it better than UW Oshkosh. In accordance with the University’s Sustainability Plan, there is a strong, growing on-campus recycling and waste reduction program. With this in mind it has been decided to forego the printed directory and instead embrace new technology.</p>
					<p>The online directory, also available in the <a style="text-decoration:underline;" href="http://m.uwosh.edu">University Mobile App</a>, is a quick and easy way to get the information you need quickly.</p>
                    <p>
                </div>
                <div id="tab-retired">
                    <p><a href="http://www.uwosh.edu/directory/Directory_Retired_Staff_2014-15.pdf" style="text-decoration: underline">Directory of Retired Staff 2014-2015</a></p>
                </div>
            </div>
		</div>
	</div>
	<div class="oo-foot oo-line">
		<div class="oo-unit oo-size1of2">
			<ul class="oo-cleanList oo-fl">
				<li><a href="http://www.uwosh.edu/home/future-students">Future Students</a></li>
				<li><a href="http://www.uwosh.edu/home/parents-and-family">Parents</a></li>
				<li><a href=" http://www.uwosh.edu/alumni">Alumni</a></li>
				<li><a href="http://www.uwosh.edu/home/faculty-staff">Faculty and Staff</a></li>
				<li><a href="http://www.uwosh.edu/home/current-students">Current Students</a></li>
				<li><a href="http://www.uwosh.edu/home/about-uw-oshkosh">About UW Oshkosh</a></li>
				<li><a href="http://www.uwosh.edu/home/future-students/undergraduate/academics">Academics</a></li>
			</ul>
			<ul class="oo-cleanList oo-fl">
				<li><a href=" http://www.titans.uwosh.edu/">Athletics</a></li>
				<li><a href=" http://admissions.uwosh.edu/">Admissions</a></li>
				<li><a href="http://www.uwosh.edu/home/administration">Administration</a></li>
				<li><a href="http://www.uwosh.edu/home/resources">Resources</a></li>
				<li><a href="http://www.uwosh.edu/home/calendars">Calendars</a></li>
				<li><a href=" http://www.uwosh.edu/imc/media-relations/newsroom">Media Relations</a></li>
				<li><a href="http://www.uwosh.edu/home/community-and-visitors">Community &amp; Visitors</a></li>
			</ul>
			<ul class="oo-cleanList oo-fl">
				<li><a href=" http://www.uwosh.edu/hr/jobs.php">Work at UW Oshkosh</a></li>
				<li><a href="http://www.tts.uwosh.edu/career/">Career Services</a></li>
				<li><a href="http://www.uwosh.edu/home/titan-services-and-campus-resources">Titan Services</a></li>
				<li><a href="http://www.uwosh.edu/home/contact-us">Contact Us</a></li>
				<li><a href="http://www.uwosh.edu/home/accessibility-info">Accessibility</a></li>
				<li><a href=" http://www.uwosh.edu/foundation">Give to UW Oshkosh</a></li>
			</ul>
		</div>
		<div class="oo-unit oo-size1of2 oo-lastUnit oo-txtR oo-ptm">
				<a href="http://www.uwosh.edu/chancellor/systemofaccountability/" target="_blank">
					<img src="img/college-portrait.gif" class="uwo-inlineImg" alt="College Portait" />
				</a>
				<a href="http://www.wisconsin.edu/" target="_blank">
					<img src="img/uw-system.gif" class="uwo-inlineImg" alt="UW System" />
				</a>
				<a href="http://www.uwosh.edu/" target="_blank">
					<img src="img/uwo-logo.gif" class="uwo-inlineImg" alt="UW Oshkosh" />
				</a>
			</div>
		</div>
	</div>
</div>
</body>
</html>
