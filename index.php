<?php
include("connect.php");
include("process.php");
?>

<!doctype html>
<html lang="en">

<?php include("head.php"); ?>

<body data-bs-theme="light">

  <div class="container-fluid">
    <div class="row mt-4 mx-md-3">
      <div class="col text-center">
        <form method="get">
          <div class="card p-4 rounded-5">
            <!-- Header -->
            <div class="row py-3">
              <div class="col">
                <h1 class="text-center heading">JMAR FLIGHT LOGS</h1>
              </div>
            </div>

           <!-- Dashboard -->
            <div class="row text-center my-4">
              <div class="col-12 col-sm-6 col-md-4">
                <div class="card text-white bg-primary mb-3 card-layout">
                  <div class="card-body">
                    <h5 class="card-title heading">Total Flights</h5>
                    <p class="card-text fs-3 body"><?php echo $totalFlights ?></p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-md-4">
                <div class="card text-white bg-success mb-3 card-layout">
                  <div class="card-body">
                    <h5 class="card-title heading">Total Airlines</h5>
                    <p class="card-text fs-3 body"><?php echo $totalAirlines ?></p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-md-4">
                <div class="card text-white bg-danger mb-3 card-layout">
                  <div class="card-body">
                    <h5 class="card-title heading">Total Aircraft Types</h5>
                    <p class="card-text fs-3 body"><?php echo $totalAircraftTypes ?></p>
                  </div>
                </div>
              </div>
            </div>

            <div class="row justify-content-center align-items-center">
              
              <!-- Aircraft Type Filter -->
              <div class="col-12 col-sm-4 col-md-auto mb-3 d-flex flex-column align-items-center body">
                <select name="aircraftType" class="form-control" style="width: fit-content">
                  <option value="" selected disabled>Filter by Aircraft Type</option>
                  <option value="">Any</option>
                  <?php
                  while ($aircraftTypeRow = mysqli_fetch_assoc($aircraftTypeResult)) {
                    ?>
                    <option <?php if ($aircraftTypeFilter == $aircraftTypeRow['aircraftType']) {
                      echo "selected";
                    } ?>
                      value="<?php echo $aircraftTypeRow['aircraftType']; ?>">
                      <?php echo $aircraftTypeRow['aircraftType']; ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

               <!-- Airline Name Filter -->
               <div class="col-12 col-sm-4 col-md-auto mb-3 d-flex flex-column align-items-center body">
                <select name="airlineName" class="form-control" style="width: fit-content">
                  <option value="" selected disabled>Filter by Airline Name</option>
                  <option value="">Any</option>
                  <?php
                  while ($airlineNameRow = mysqli_fetch_assoc($airlineNameResult)) {
                  ?>
                  <option <?php if ($airlineNameFilter == $airlineNameRow['airlineName']) { echo "selected"; } ?>
                    value="<?php echo $airlineNameRow['airlineName'] ?>">
                    <?php echo $airlineNameRow['airlineName'] ?>
                  </option>
                  <?php } ?>
                </select>
              </div>

              <!-- Sort Filter -->
              <div class="col-12 col-sm-4 col-md-auto mb-3 d-flex flex-column align-items-center body">
                <select name="sort" class="form-control" style="width: fit-content;">
                  <option value="" selected disabled>Sort</option>
                  <option value="">None</option>
                  <option <?php if($sort == "airlineName") { echo "selected";} ?> value="airlineName">Airline Name</option>
                  <option <?php if($sort == "aircraftType") { echo "selected";} ?> value="aircraftType">Aircraft</option>
                  <option <?php if($sort == "arrivalDatetime") { echo "selected";} ?> value="arrivalDatetime">Arrival Date Time</option>
                  <option <?php if($sort == "departureDatetime") { echo "selected";} ?> value="departureDatetime">Departure Date Time</option>
                  <option <?php if($sort == "flightNumber") { echo "selected";} ?> value="flightNumber">Flight Number</option>
                  <option <?php if($sort == "pilotName") { echo "selected";} ?> value="pilotName">Pilot Name</option>
                </select>
              </div>

              <!-- Order Filter -->
              <div class="col-12 col-sm-4 col-md-auto mb-3 d-flex flex-column align-items-center body">
                <select name="order" class="form-control" style="width: fit-content">
                  <option value="" selected disabled>Order</option>
                  <option <?php if($order == "ASC") {echo "selected";}?> value="ASC">Ascending</option>
                  <option <?php if($order == "DESC") {echo "selected";}?> value="DESC">Descending</option>
                </select>
              </div>

              <!-- Submit and Clear Buttons -->
              <div class="row justify-content-center align-items-center">
                <div class="col-12 col-sm-4 col-md-auto mb-3 d-flex justify-content-center">
                  <button class="btn btn-primary mt-4 body" style="width: fit-content">SUBMIT</button>
                </div>
                <div class="col-12 col-sm-4 col-md-auto mb-3 d-flex justify-content-center">
                  <button type="submit" name="btnClear" class="btn btn-secondary mt-md-4 body"
                    style="width: fit-content">CLEAR</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Flight Log Table Display with Data Retrieval and Error Handling -->
  <div class="container-fluid">
    <div class="row mt-4 mx-md-3">
      <div class="col">
        <div class="card p-4 rounded-5">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr class="text-center heading">
                  <th>Flight Number</th>
                  <th>Departure Airport Code</th>
                  <th>Arrival Airport Code</th>
                  <th>Departure Date</th>
                  <th>Arrival Date</th>
                  <th>Airline Name</th>
                  <th>Aircraft Type</th>
                  <th>Pilot Name</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (mysqli_num_rows($flightLogResult) > 0) {
                  while ($flightLogRow = mysqli_fetch_assoc($flightLogResult)) {
                    ?>
                    <!-- Display each flight log data in a table row -->
                    <tr class="text-center body">
                      <td><?= $flightLogRow['flightNumber'] ?></td>
                      <td><?= $flightLogRow['departureAirportCode'] ?></td>
                      <td><?= $flightLogRow['arrivalAirportCode'] ?></td>
                      <td><?= $flightLogRow['departureDatetime'] ?></td>
                      <td><?= $flightLogRow['arrivalDatetime'] ?></td>
                      <td><?= $flightLogRow['airlineName'] ?></td>
                      <td><?= $flightLogRow['aircraftType'] ?></td>
                      <td><?= $flightLogRow['pilotName'] ?></td>
                    </tr>
                    <?php
                  }
                } else { ?>
                  <!-- Display a message if no results are found -->
                  <tr>
                    <td colspan="12" class="text-center alert text-danger fw-bold pt-5 body"><?php echo $error ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>