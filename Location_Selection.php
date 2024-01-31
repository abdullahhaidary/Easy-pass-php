<?php
include_once('admin/header.php');
include_once('dbconnection.php');
$con=openconnection();
$pd='data';
$sql="SELECT DISTINCT Location from $pd";
$result=$con->query($sql);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['states'])) {
    // Get selected values from the form
    $selectedLocations = $_POST['states'];

    // Specify the file path
    $filePath = 'files/locations.txt';

    // Create or open the file for writing
    $file = fopen($filePath, 'w');

    // Write each selected location to the file, separated by a comma
    fwrite($file, implode(',', $selectedLocations));

    // Close the file
    fclose($file);

    // Output success message
    // echo 'Locations saved successfully!';
    echo '<div class="alert alert-success" role="alert">Locations saved successfully!</div>';
}
$filePath = 'files/locations.txt';

if (file_exists($filePath)) {
    // Read the contents of the file and explode into an array
    $selectedLocations = explode(',', file_get_contents($filePath));
} else {
    $selectedLocations = [];
}
?>
<form action="" method="post">
    <select class="js-example-basic-multiple" name="states[]" multiple="multiple">
        <?php
        // Assuming $result is your result set
        while ($row = $result->fetch_assoc()) {
            $location = $row['Location'];
            $isSelected = in_array($location, $selectedLocations);

            ?>
            <option style="min-width: 300px;color:blue;" value="<?php echo $location ?>" <?php echo $isSelected ? 'selected' : ''; ?>><?php echo $location ?></option>
            <?php
        }
        ?>
    </select>
    <button class="btn btn-primary">Submit</button>
</form>
<script>
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2({
        placeholder: "Select a Location",
        allowClear: true
    });
    });
</script>
<?php
include_once('admin/footer.php');
?>