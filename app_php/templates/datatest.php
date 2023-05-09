<script>
// this function finds the correct data for a single segment for the chosen parameters and initiates the colouring
        function getDataset(){
            // detect the correct segment and direction
            const station_from = "Waterloo";
            const station_to = "Kennington";
            const line = "Northern";
            const dataType = "Accelerometer";
            const dataName = "TotalAcceleration";

            var changedDirection = false;


            var xhr = new XMLHttpRequest();
            xhr.open("POST", "getdata.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    if (dataType == "Timestamp") {
                        displayTimeStamps(JSON.parse(xhr.response), path);
                    }
                    else {
                        dataset = checkSensorID(JSON.parse(xhr.response));
                        // console.log(dataset);
                        colourPaths (dataset, minVal, maxVal, lower_threshold, upper_threshold, changedDirection, path);
                    }
                }
            };
            xhr.send("station_to=" + encodeURIComponent(station_to) + "&station_from=" + encodeURIComponent(station_from) + "&line=" + encodeURIComponent(line) + "&dataType=" + encodeURIComponent(dataType) + "&dataName=" + encodeURIComponent(dataName));
        }

</script>