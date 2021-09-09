<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include_once $_SERVER['DOCUMENT_ROOT']."/DBConfig.php";



if($_SERVER['REQUEST_METHOD'] == "GET") {
    $data = array();
    $sql = "SELECT * FROM radiokorea WHERE updated_at > now() - interval 7 day ORDER BY writer, posted_at DESC, created_at DESC";
    $QR = $con->query($sql);
    while($QD = $QR->fetch_assoc()) {
        $results[] = $QD;
    }


    // $key ;
    $postingrules = array();
    $urlchfrom=array(" ","#");
    $urlchto=array("%20","%23");
} 

$gdata = array(
    "results" => $results,
);
// echo json_encode($gdata);
$con->close();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- <script src="/js/jquery-3.2.1.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script> -->

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

    <title><?=($title? $title:"Menu")?></title>
    <style>
      /* Show it is fixed to the top */
      /*body {
        min-height: 75rem;
        padding-top: 4.5rem;
      }*/
      body {
        padding-bottom: 20px;
      }

      .navbar {
        margin-bottom: 20px;
      }

    </style>
    <script>
      $(function(){

        var url = window.location.pathname, 
        urlRegExp = new RegExp(url.replace(/\/$/,'') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
        // now grab every link from the navigation
        $('.menu a').each(function(){
            // and test its normalized href against the url pathname regexp
            if(urlRegExp.test(this.href.replace(/\/$/,''))){
                $(this).addClass('active');
            }
        });

      });
        // $(this).parent("li").addClass("active")
    </script>
    <style>
        tr.row {
        display:none;
        }

        [data-toggle="toggle"] {
            display: none;
        }

        /*var inputvalues = ['trtype','vendro','material','ba'];*/
    </style>
  </head>
  <body>
    <h1>Radio Korea Jobs</h1>

<div class="container-fluid">
    <table class="table" id="myTable"> 
        <thead> 
            <tr> 
                <th>No</th>
                <th>Area</th>
                <th>Subject</th>
                <th>Writer</th>
                <th>Date</th>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody id="myTbody">
        </tbody>
    </table>

</div>
<script type="text/javascript">
    var gdata = <?=json_encode($gdata)?>;
    function hasNumber(myString){return /\d/.test(myString);}
    function createRow(no, row){
        var trrow = "";
        trrow += "<tr";
        // if(row.cnt > 0 && !row.posting) {trrow += " class='table-success'"; }
        trrow += ">";
        trrow += "<td>";
        trrow += row.id;
        trrow += "</td>";

        trrow += "<td>";
        trrow += row.area;
        trrow += "</td>";

        trrow += "<td>";
        trrow += "<a href='" + row.link + "' target=_blank>";    
        trrow += row.subject;
        trrow += "</a>";
        trrow += "</td>";

        trrow += "<td>";
        trrow += row.writer;
        trrow += "</td>";

        trrow += "<td>" + row.posted_at + "</td>";
        trrow += "<td>" + row.updated_at + "</td>";
        trrow += "</tr>";

        return trrow;
    }

    function createTable(){
        $("tbody#myTbody").empty();
        // $("#myTbody").html("");

        $.each(gdata.results, function( key, val ) {

            $("tbody#myTbody").append(createRow(key, val));

        });
        // $("div#table").html(tableHead + tableBody + tableTail)
        $("#myTable").trigger("update");

    }

    $(document).ready(function() {
        if(gdata.results){
            createTable();
            // console.log("aa");
        }
    })


</script>
</body>
</html>