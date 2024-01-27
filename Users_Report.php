<?php
include_once('admin/header.php');
?>
<script type="text/javascript">
    function loadF() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open('GET', 'ajaxProcess/user_report_table.php', true);
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('dbTable').innerHTML = this.responseText;
            }
        }
        xmlhttp.send();
    }
    setInterval(function(){
        loadF();
    },100);
    window.load=loadF();
</script>
<div id="dbTable">

</div>
<?php
include_once 'admin/footer.php';
?>
