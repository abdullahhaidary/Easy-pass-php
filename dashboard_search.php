<?php
include 'admin/header.php';

?>
<div class="row">
    <div class="col-2"><h2>Search:</h2></div>
    <div class="col-7"><input  type="text" id="household" style="font-size:26pt;width:100%;height:100%;"/></div>
    <div class="col-2"><button class="btn btn-primary btn-lg" id="household_button" onclick="DisplayData()">Search</button></div>
</div>

<div id="displayData">

</div>
<script type="text/javascript">
    let household=document.getElementById('household');
    household.addEventListener('keydown',function(event){
        if(event.keyCode===13){
            document.getElementById('household_button').click();
        }
    })
    function DisplayData(){
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                document.getElementById('displayData').innerHTML=this.responseText;
            }
        };
        var household=document.getElementById('household').value;
        xmlhttp.open('GET','ajaxProcess/dashboard_search.php?household='+household);
        xmlhttp.send();

    }
</script>

<?php
include 'admin/footer.php';
?>
