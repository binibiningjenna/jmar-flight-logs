<?php 

// Parameter Setup: Get filters and sorting options from URL parameters
$aircraftTypeFilter = isset($_GET['aircraftType']) ? $_GET['aircraftType'] : '';
$airlineNameFilter = isset($_GET['airlineName']) ? $_GET['airlineName'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';
$order = isset($_GET['order']) ? $_GET['order'] : '';


// Query Construction: Flight Log with Filters, Sorting, and Ordering
$flightLogQuery = "SELECT * FROM flightlogs";

if ($aircraftTypeFilter != '' || $airlineNameFilter != '') {
  $flightLogQuery .= " WHERE";

  if ($aircraftTypeFilter != '') {
      $flightLogQuery .= " aircraftType='$aircraftTypeFilter'";
  }

  if ($aircraftTypeFilter != '' && $airlineNameFilter != '') {
      $flightLogQuery .= " AND";
  }

  if ($airlineNameFilter != '') {
      $flightLogQuery .= " airlineName='$airlineNameFilter'";
  }
}

if ($sort != '') {
  $flightLogQuery = $flightLogQuery . " ORDER BY $sort";

  if($order != ''){
    $flightLogQuery = $flightLogQuery." $order";
  }
}

// Redirect to index when clear button is clicked 
if (isset($_GET['btnClear'])) {
  header('Location: index.php');
}

// Retrieve and execute flight log, aircraft types, and airline name
$flightLogResult = executeQuery($flightLogQuery);
$error = (mysqli_num_rows($flightLogResult) == 0) ? "No result found" : "";

$aircraftTypeQuery = "SELECT DISTINCT aircraftType FROM flightlogs ORDER BY aircraftType";
$aircraftTypeResult = executeQuery($aircraftTypeQuery);

$airlineNameQuery = "SELECT DISTINCT airlineName FROM flightlogs ORDER BY airlineName";
$airlineNameResult = executeQuery($airlineNameQuery);

// Retrieve summary data for the dashboard
$totalFlightsQuery = "SELECT COUNT(*) AS totalFlights FROM flightlogs";
$totalFlightsResult = executeQuery($totalFlightsQuery);
$totalFlightsRow = mysqli_fetch_assoc($totalFlightsResult);
$totalFlights = $totalFlightsRow['totalFlights'];

$totalAirlinesQuery = "SELECT COUNT(DISTINCT airlineName) AS totalAirlines FROM flightlogs";
$totalAirlinesResult = executeQuery($totalAirlinesQuery);
$totalAirlinesRow = mysqli_fetch_assoc($totalAirlinesResult);
$totalAirlines = $totalAirlinesRow['totalAirlines'];

$totalAircraftTypesQuery = "SELECT COUNT(DISTINCT aircraftType) AS totalAircraftTypes FROM flightlogs";
$totalAircraftTypesResult = executeQuery($totalAircraftTypesQuery);
$totalAircraftTypesRow = mysqli_fetch_assoc($totalAircraftTypesResult);
$totalAircraftTypes = $totalAircraftTypesRow['totalAircraftTypes'];

?>