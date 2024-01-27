<?php
include_once('admin/header.php');
include_once('dbconnection.php');
$con=openconnection();
$pd='data';
$sql="SELECT DISTINCT Location from $pd";
$result=$con->query($sql);
?>

    <input type="hidden" id="select-input" style="width: 100%;" multiple>
    <script>
        $(document).ready(function() {
            $('#select-input').select2({
                data: [
                    { id: '12', text: 'Nahia 12' },
                    { id: '22', text: 'Nahia 22' },
                    { id: '8', text: 'Nahia 8' }
                ],
                tags: true,
                tokenSeparators: [',', ' ']
            });
        });

    </script>

<?php
while($row=$result->fetch_assoc()){
    ?>
<li><?php echo $row['Location'] ?></li>
<?php
}
include_once('admin/footer.php');
?>