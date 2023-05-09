<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Tube Map</title>
    <link rel="shortcut icon" type="image/png" href="favicon.ico"/>
    <style type="text/css">

        .original {stroke:gainsboro}
        
        
        
        text {font-family:Arimo,Liberation Sans,Helvetica,Arial,sans-serif}
        .textbg {stroke:#fff;stroke-width:4;stroke-linejoin:round}
        .zone {font-size:35px;font-weight:bold;text-anchor:middle}
        .st {font-size:14px;fill:#000}
        .small {font-size:11px;fill:#000}
        .intline {font-size:11px;fill:#fff}
        .x {fill:#999}
        /* .b {font-weight:bold} */
        .mid {text-anchor:middle}
        .end {text-anchor:end}
        .ul {text-decoration:underline;cursor:help}
        .me {fill:none;stroke-width:5}
        .mes {fill:none;stroke-width:1.5;stroke:#fff;stroke-linecap:round}
        .mes2 {fill:none;stroke-width:1.5;stroke:#fff;stroke-dasharray:8,1}
        .meb {fill:none;stroke-width:5.5}
        .xb {stroke-dasharray:4,3}
        .mex {fill:none;stroke-width:3.5;stroke:#fff}
        .ftfl {fill:#009}
        .fbakerloo {fill:#894E24}
        .sbakerloo {stroke:#894E24}
        .fcentral {fill:#DC241F}
        .scentral {stroke:#DC241F}
        .fcircle {fill:#d90}
        .scircle {stroke:#FFCE00}
        .bcircle {stroke:#d90}
        .fdistrict {fill:#007229}
        .sdistrict {stroke:#007229}
        .fhnc {fill:#c78}
        .shnc {stroke:#D799AF}
        .bhnc {stroke:#c78}
        .fjubilee {fill:#777}
        .sjubilee {stroke:#868F98}
        .fmetropolitan {fill:#826}
        .smetropolitan {stroke:#751056}
        .fnorthern {fill:#000}
        .snorthern {stroke:#000}
        .fedgware {fill:#aa3}
        .sedgware {stroke:#000}
        .fpiccadilly {fill:#0019A8}
        .spiccadilly {stroke:#0019A8}
        .fvictoria {fill:#09d}
        .svictoria {stroke:#00A0E2}
        .fwnc {fill:#5b9}
        .swnc {stroke:#76D0BD}
        .swnc2 {stroke:#0019A8;stroke-width:0.5;fill:none}
        .fdlr {fill:#00a4a7}
        .sdlr {stroke:#00a4a7}
        .sdlr2 {stroke:#fff;stroke-width:1;fill:none}
        .fog {fill:#E87511}
        .fogx {fill:#fb5}
        .sogwatford {stroke:#E87511}
        .fogwatford {fill:#E87511}
        .sogwest {stroke:#88f}
        .fogwest {fill:#88f}
        .sognorth {stroke:#f30}
        .fognorth {fill:#f30}
        .sogsouth {stroke:#7bf}
        .fogsouth {fill:#7bf}
        .sogenfield {stroke:#937}
        .fogenfield {fill:#937}
        .sogchingford {stroke:#7b6}
        .fogchingford {fill:#7b6}
        .sogromford {stroke:#a51}
        .fogromford {fill:#a51}
        .sogx {stroke:#fb5}
        .felizabeth {fill:#7156A5}
        .selizabeth {stroke:#7156A5}
        .ftflrail {fill:#0019A8}
        .stflrail {stroke:#0019A8}
        .fgreenford {fill:#177f0b}
        .sgreenford {stroke:#177f0b}
        .stl {stroke:#6C0;stroke-width:2}
        .ftl {fill:#5b0}
        .fthameslink {fill:#fad}
        .sthameslink {fill:none;stroke:#fce;stroke-width:3}
        .rn {fill:#99f}
        .osib {fill:none;stroke:#fff;stroke-width:4}
        .osi {fill:none;stroke:#000;stroke-width:2;cursor:help}
        .isib {stroke:#fff;stroke-width:7.5;fill:none}
        .isi {stroke:#000;stroke-width:6;fill:none}
        .isit {stroke:#fff;stroke-width:2;fill:none}
        .branch {stroke:#fff;stroke-width:3;stroke-dasharray:4;fill:none}
        .tleg:hover {fill:#009;stroke-width:1;stroke:#009;cursor:pointer}
        .tleg:active {cursor:progress}
        .toff:hover {cursor:pointer}
        .toff:active {cursor:progress}
        .blink {fill:none;stroke-width:12;stroke-linecap:round;opacity:0;visibility:hidden;cursor:pointer}
        .blink2 {fill:none;stroke-width:9;stroke-linecap:round;opacity:0;visibility:hidden;cursor:pointer}
        .pointer {cursor:pointer}
        .progress:active {cursor:progress}
        .zone_layer {visibility:hidden}
        .doublezone {fill:#efe;stroke:#aaa;stroke-width:1}
        .zonefw {font-size:35px;fill:#fff;stroke:#ddd;stroke-width:1}
        .zonefg {font-size:35px;fill:#efefef;stroke:#ddd;stroke-width:1}
        .zonedf {font-size:13px;fill:#999;stroke:none}

        .options_container { display: flex; flex-direction: column; width: 220px; border-style: solid; border-radius: 1mm; border-width:0.1mm; border-color: #009; background-color: rgba(255, 255, 255, 0.8);}
        .options_item { padding-left: 2mm;}
        .options_header { font-size: 16px; margin: 0mm 0mm 1mm; padding: 1.5mm 0mm; border-style: solid;  border-width: 0mm; border-bottom-width: 0.1mm; padding-bottom: 0.5mm; border-color: #009; font-family:Arimo,Liberation Sans,Helvetica,Arial,sans-serif; text-align: center; background-color: #009; color: #fff; }
        .options_title { font-size: 16px; margin: 0mm 0mm 1mm; padding: 1.5mm 0mm; border-style: solid;  border-width: 0mm; border-bottom-width: 0.1mm; padding-bottom: 0.5mm; border-color: #33f; font-family:Arimo,Liberation Sans,Helvetica,Arial,sans-serif; text-align: center; background-color: #33f; color: #fff; }
        #lines_title { border-color: #0b0; background-color: #0b0 }
        .options_text { font-family:Arimo,Liberation Sans,Helvetica,Arial,sans-serif; font-size: 14px; padding-left: 1mm;}
        .options_divider { border-style: dotted; border-width: 0mm; border-top-width: 0.1mm; margin-top: 0.5mm; border-color: #009; }
        .options_subsection { padding: 0mm 0mm 1mm; }
        .grey {
            stroke:gainsboro
        }

        .svg { width: 100%; }
        .footer { position: absolute; bottom: 10px; font-size: 3mm;  }

        .timestampclone {
            font-size: 4pt;
        }



        #selectProperties {
            position: absolute;
            top:10px;
            left:10px;
        }

        #selectLinesContainer {
            margin-top:10px;
            border-color: #0b0;
        }

        #d_timestamp {
            display: none;
        }
        .devmode {
            display:none;
        }
        </style>


  </head>
  <body>

    <?php  
        // echo $_SESSION['logged_in'];

        if (isset($_SESSION['logged_in']) || $_SESSION['logged_in'] === true) {
            $login = "true";
            $superuser = "false";
        }
        else {
            $login = "false";
            $superuser = "false";
        }

    ?>



    <div id="selectProperties" >
        <div class="options_container">
            <p class="options_header">Comfort Indicator</p>
            <div class="options_subsection">
                <p class="options_title">Data Type</p>
                <div class="options_item">
                    <input type="radio" id="r_co2" name="r_data" value="Pollution&&CO2" onclick="changeColors()" checked>
                    <label for="r_co2" class="options_text">CO<sub>2</sub></label>
                </div>
                <!-- <div class="options_item">
                    <input type="radio" id="r_temperature" name="r_data" value="Pollution&&Temperature" onclick="changeColors()">
                    <label for="r_temperature" class="options_text">Temperature (Air Quality Device)</label>
                </div> -->
                <div class="options_item">
                    <input type="radio" id="r_healthIndex" name="r_data" value="Pollution&&HealthIndex" onclick="changeColors()">
                    <label for="r_healthIndex" class="options_text">Health Index</label>
                </div>
                <div class="options_item">
                    <input type="radio" id="r_pm25" name="r_data" value="Pollution&&PM25" onclick="changeColors()">
                    <label for="r_pm25" class="options_text">PM2.5</label>
                </div>
                <!--  <div class="options_item">
                    <input type="radio" id="r_humidityPollution" name="r_data" value="Pollution&&Humidity" onclick="changeColors()">
                    <label for="r_humidityPollution" class="options_text">Humidity (Air Quality Device)</label>
                </div> -->
                <!-- <div class="options_item">
                    <input type="radio" id="r_pressure" name="r_data" value="Pollution&&Pressure" onclick="changeColors()">
                    <label for="r_pressure" class="options_text">Air Pressure</label>
                </div> -->
                <!-- <div class="options_item">
                    <input type="radio" id="r_dp" name="r_data" value="Temperature&&DP" onclick="changeColors()">
                    <label for="r_dp" class="options_text">Dew Point</label>
                </div> -->
                <div class="options_item">
                    <input type="radio" id="r_ta" name="r_data" value="Temperature&&TA" onclick="changeColors()">
                    <label for="r_ta" class="options_text">Temperature</label>
                </div>
                <!-- <div class="options_item">
                    <input type="radio" id="r_tg" name="r_data" value="Temperature&&TG" onclick="changeColors()">
                    <label for="r_tg" class="options_text">TG</label>
                </div> -->
                <!-- <div class="options_item">
                    <input type="radio" id="r_wet" name="r_data" value="Temperature&&WET" onclick="changeColors()">
                    <label for="r_wet" class="options_text">WET</label>
                </div> -->
                <div class="options_item">
                    <input type="radio" id="r_humidityTemperature" name="r_data" value="Temperature&&Humidity" onclick="changeColors()">
                    <label for="r_humidity" class="options_text">Humidity</label>
                </div>
                <!-- <div class="options_item">
                    <input type="radio" id="r_wbgt" name="r_data" value="Temperature&&WBGT" onclick="changeColors()">
                    <label for="r_wbgt" class="options_text">WBGT</label>
                </div> -->
                <div class="options_item">
                    <input type="radio" id="r_sound" name="r_data" value="Sound&&SPL" onclick="changeColors()">
                    <label for="r_sound" class="options_text">Sound Pressure Level</label>
                </div>
                <div class="options_item">
                    <input type="radio" id="r_totalacceleration" name="r_data" value="Accelerometer&&TotalAcceleration" onclick="changeColors()">
                    <label for="r_totalacceleration" class="options_text">Acceleration</label>
                </div>
            </div>
            <div class="options_subsection devmode">
                <p class="options_title">Questionnaires (perceived)</p>
                <div class="options_item devmode">
                    <input type="radio" id="r_average" name="r_data" value="Questionnaire&&Average" onclick="changeColors()">
                    <label for="r_averag" class="options_text">Average Comfort</label>
                </div>
                <div class="options_item devmode">
                    <input type="radio" id="r_acoustic" name="r_data" value="Questionnaire&&Acoustic" onclick="changeColors()">
                    <label for="r_acoustic" class="options_text">Acoustic Comfort</label>
                </div>
                <div class="options_item devmode">
                    <input type="radio" id="r_thermal" name="r_data" value="Questionnaire&&Thermal" onclick="changeColors()">
                    <label for="r_thermal" class="options_text">Thermal Comfort</label>
                </div>
                <div class="options_item devmode">
                    <input type="radio" id="r_airquality" name="r_data" value="Questionnaire&&AirQuality" onclick="changeColors()">
                    <label for="r_airquality" class="options_text">Air Quality/Ventilation</label>
                </div>
                <div class="options_item devmode">
                    <input type="radio" id="r_questionnaireacceleration" name="r_data" value="Questionnaire&&Acceleration" onclick="changeColors()">
                    <label for="r_questionnaireacceleration" class="options_text">Acceleration & Braking</label>
                </div>
                <div class="options_item devmode">
                    <input type="radio" id="r_vibration" name="r_data" value="Questionnaire&&Vibration" onclick="changeColors()">
                    <label for="r_vibration" class="options_text">Vibration</label>
                </div>
                <div class="options_item devmode">
                    <input type="radio" id="r_jerks" name="r_data" value="Questionnaire&&Jerks" onclick="changeColors()">
                    <label for="r_jerks" class="options_text">Jerks/Shaking</label>
                </div>
                <div class="options_item devmode">
                    <input type="radio" id="r_crowdedness" name="r_data" value="Questionnaire&&Crowdedness" onclick="changeColors()">
                    <label for="r_crowdedness" class="options_text">Crowdedness</label>
                </div>
            </div>
        </div>


        <div id="selectLinesContainer" class="options_container">
            <div id="selectLines" class="options_subsection">
                <p class="options_title" id="lines_title">Tube Lines</p>
                <div class="options_item">
                    <input type="checkbox" onclick="lineChange('bakerloo')" id="c_bakerloo" name="c_bakerloo">
                    <label for="c_bakerloo" class="options_text">Bakerloo line</label>
                </div>
                <div class="options_item">
                    <input type="checkbox" onclick="lineChange('central')" id="c_central" name="c_central">
                    <label for="c_central" class="options_text">Central line</label>
                </div>
                <div class="options_item">
                    <input type="checkbox" onclick="lineChange('circle')" id="c_circle" name="c_circle">
                    <label for="c_circle" class="options_text">Circle line</label>
                </div>
                <div class="options_item">
                    <input type="checkbox" onclick="lineChange('district')" id="c_district" name="c_district">
                    <label for="c_district" class="options_text">District line</label>
                </div>
                <div class="options_item">
                    <input type="checkbox" onclick="lineChange('hnc')" id="c_hnc" name="c_hnc">
                    <label for="c_hnc" class="options_text">Hammersmith & City line</label>
                </div>
                <div class="options_item">
                    <input type="checkbox" onclick="lineChange('jubilee')" id="c_jubilee" name="c_jubilee">
                    <label for="c_jubilee" class="options_text">Jubilee line</label>
                </div>
                <div class="options_item">
                    <input type="checkbox" onclick="lineChange('metropolitan')" id="c_metropolitan" name="c_metropolitan">
                    <label for="c_metropolitan" class="options_text">Metropolitan line</label>
                </div>
                <div class="options_item">
                    <input type="checkbox" onclick="lineChange('northern')" id="c_northern" name="c_northern">
                    <label for="c_northern" class="options_text">Northern line</label>
                </div>
                <div class="options_item">
                    <input type="checkbox" onclick="lineChange('piccadilly')" id="c_piccadilly" name="c_piccadilly">
                    <label for="c_piccadilly" class="options_text">Piccadilly line</label>
                </div>
                <div class="options_item">
                    <input type="checkbox" onclick="lineChange('victoria')" id="c_victoria" name="c_victoria">
                    <label for="c_victoria" class="options_text">Victoria line</label>
                </div>
                <div class="options_item">
                    <input type="checkbox" onclick="lineChange('wnc')" id="c_wnc" name="c_wnc">
                    <label for="c_wnc" class="options_text">Waterloo & City line</label>
                </div>
            </div>

            <div class="options_subsection">
                <div class="options_divider">
                    <div class="options_item">
                        <input type="checkbox" onclick="changeColors()" id="c_changeDirection" name="c_changeDirection">
                        <label for="c_changeDirection" class="options_text">Swap Direction</label>
                    </div>
                </div>
                <div class="options_item" id="d_timestamp">
                    <input type="checkbox" onclick="showTimestamps()" id="c_timestamp" name="c_data">
                    <label for="c_timestamp" class="options_text">Timestamps</label>
                </div>
            </div>


        </div>
    </div>

    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="svg" viewBox="-40.5 -120.5 2500 1340">
        <defs>
            <g id="term"><path class="me" d="M -7.5,0 H 7.5"/></g>
            <g id="termb">
                <path class="me" style="stroke-width:5.5" d="    M -7.75,0 H -2.5    M 7.75,0 H 2.5    "/>
            </g>
            <g id="termbakerloo" class="stationcolour"><use xlink:href="#term" class="sbakerloo"/></g>
            <g id="termcentral" class="stationcolour"><use xlink:href="#term" class="scentral"/></g>
            <g id="termcircle" class="stationcolour"><use xlink:href="#term" class="scircle"/></g>
            <g id="termdistrict" class="stationcolour"><use xlink:href="#term" class="sdistrict"/></g>
            <g id="termhnc" class="stationcolour"><use xlink:href="#term" class="shnc"/></g>
            <g id="termjubilee" class="stationcolour"><use xlink:href="#term" class="sjubilee"/></g>
            <g id="termmetropolitan" class="stationcolour"><use xlink:href="#term" class="smetropolitan"/></g>
            <g id="termmetropolitan2" class="stationcolour">
                <use xlink:href="#termb" class="meb" style="stroke:#fff"/>
                <use xlink:href="#termmetropolitan"/>
            </g>
            <g id="termnorthern" class="stationcolour"><use xlink:href="#term" class="snorthern"/></g>
            <g id="termedgware" class="stationcolour"><use xlink:href="#term" class="sedgware"/></g>
            <g id="termpiccadilly" class="stationcolour"><use xlink:href="#term" class="spiccadilly"/></g>
            <g id="termvictoria" class="stationcolour"><use xlink:href="#term" class="svictoria"/></g>
            <g id="termdlr" class="stationcolour"><use xlink:href="#term" class="sdlr"/></g>
            <g id="termogenfield" class="stationcolour"><use xlink:href="#term" class="sogenfield"/></g>
            <g id="termogchingford" class="stationcolour"><use xlink:href="#term" class="sogchingford"/></g>
            <g id="termelizabeth" class="stationcolour"><use xlink:href="#term" class="selizabeth"/></g>
            <g id="termelizabethx" class="stationcolour"><use xlink:href="#termx" class="selizabeth"/></g>
            <g id="termx" class="stationcolour"><path style="fill:#fff;stroke-width:0.75" d="M 1.75,-2 H 7.5 V 2 H -7.5 V -2 H -1.75"/></g>
            <g id="termedgwarex" class="stationcolour"><use xlink:href="#termx" class="sedgware"/></g>
            <g id="termognorthx" class="stationcolour"><use xlink:href="#termx" class="sognorth"/></g>
            <g id="st"><path class="me" d="M 1,0 H 7.5"/></g>
            <g id="stb" class="stationcolour"><path class="me" style="stroke-width:5.5" d="M 2.5,0 H 7.75"/></g>
            <g id="stbakerloo" class="stationcolour"><use xlink:href="#st" class="sbakerloo"/></g>
            <g id="stcentral" class="stationcolour"><use xlink:href="#st" class="scentral"/></g>
            <g id="stcircle" class="stationcolour">
                <!-- <use xlink:href="#stb" class="meb bcircle"/> -->
                <use xlink:href="#st" class="scircle"/>
            </g>
            <g id="stdistrict" class="stationcolour"><use xlink:href="#st" class="sdistrict"/></g>
            <g id="sthnc" class="stationcolour">
                <!-- <use xlink:href="#stb" class="meb bhnc"/> -->
                <use xlink:href="#st" class="shnc"/>
            </g>
            <g id="stjubilee" class="stationcolour"><use xlink:href="#st" class="sjubilee"/></g>
            <g id="stmetropolitan" class="stationcolour"><use xlink:href="#st" class="smetropolitan"/></g>
            <g id="stmetropolitan2" class="stationcolour">
                <use xlink:href="#stb" class="meb" style="stroke:#fff"/>
                <use xlink:href="#stmetropolitan"/>
            </g>
            <g id="stnorthern" class="stationcolour"><use xlink:href="#st" class="snorthern"/></g>
            <g id="stedgware" class="stationcolour"><use xlink:href="#st" class="sedgware"/></g>
            <g id="stpiccadilly" class="stationcolour"><use xlink:href="#st" class="spiccadilly"/></g>
            <g id="stpiccadilly2" class="stationcolour">
                <use xlink:href="#stb" class="meb" style="stroke:#fff"/>
                <use xlink:href="#stpiccadilly"/>
            </g>
            <g id="stvictoria" class="stationcolour"><use xlink:href="#st" class="svictoria"/></g>
            <g id="stdlr" class="stationcolour"><use xlink:href="#st" class="sdlr"/></g>
            <g id="stogwatford"><use xlink:href="#st" class="sogwatford"/></g>
            <g id="stogwest"><use xlink:href="#st" class="sogwest"/></g>
            <g id="stognorth"><use xlink:href="#st" class="sognorth"/></g>
            <g id="stogsouth"><use xlink:href="#st" class="sogsouth"/></g>
            <g id="stogenfield"><use xlink:href="#st" class="sogenfield"/></g>
            <g id="stogchingford"><use xlink:href="#st" class="sogchingford"/></g>
            <g id="stogromford"><use xlink:href="#st" class="sogromford"/></g>
            <g id="stelizabeth"><use xlink:href="#st" class="selizabeth"/></g>
            <g id="stgreenford"><use xlink:href="#st" class="sgreenford"/></g>
            <g id="stx"><path style="fill:none;stroke-width:5" d="M 8,0 L 2,0"/></g>
            <g id="stxm"><path style="fill:none;stroke:#fff;stroke-width:3.5" d="M 7.25,0 L 0,0"/></g>
            <g id="stxm2"><path style="fill:none;stroke:#fff;stroke-width:3" d="M 7,0 L 0,0"/></g>
            <g id="stbakerloox">
                <use xlink:href="#stx" class="sbakerloo"/>
                <use xlink:href="#stxm"/>
            </g>
            <g id="stmetropolitanx">
                <use xlink:href="#stx" class="smetropolitan"/>
                <use xlink:href="#stxm"/>
            </g>
            <g id="stedgwarex">
                <use xlink:href="#stx" class="sedgware"/>
                <use xlink:href="#stxm"/>
            </g>
            <g id="stpiccadillye">
                <use xlink:href="#stx" class="spiccadilly"/>
                <path style="fill:none;stroke:#fff;stroke-width:2" d="M 6.5,0 L 2.5,0"/>
            </g>
            <g id="stogwatfordx">
                <use xlink:href="#stx" class="sogwatford"/>
                <use xlink:href="#stxm"/>
            </g>
            <g id="stogsouthx">
                <use xlink:href="#stx" class="sogsouth"/>
                <use xlink:href="#stxm"/>
            </g>
            <g id="stognorthx">
                <use xlink:href="#stx" class="sognorth"/>
                <use xlink:href="#stxm"/>
            </g>
            <g id="stelizabethx">
                <use xlink:href="#stx" class="selizabeth"/>
                <use xlink:href="#stxm"/>
            </g>
            <g id="stgreenfordx">
                <use xlink:href="#stx" class="sgreenford"/>
                <use xlink:href="#stxm"/>
            </g>
            <g id="sttl"><circle cx="0" cy="0" r="4" class="ftl"/></g>
            <g id="sttlnr">
                <circle cx="0" cy="0" r="5.5" style="fill:#fff;stroke:#000;stroke-width:0.75"/>
                <path style="fill:none;stroke:#ef2721;stroke-width:1" d="    M -5,-1.25 H 5    M -5,1.25 H 5    M -2.5,-3.75 L 2.5,-1.25 -2.5,1.25 2.5,3.75"/>
            </g>
            <g id="sttlow">
                <use xlink:href="#sttl"/>
                <path style="fill:none;stroke:#fff;stroke-width:1" d="M -3,-3 L 1.5,0 -3,3"/>
            </g>
            <g id="nr">
                <path style="fill:#ef2721;cursor:help" transform="translate(-6.25,-4)scale(0.25)" d="M 11,0 L 22,0    37,8 50,8 50,13 37,13    24,20 50,20 50,25 24,25    40,33 28,33    13,25 0,25 0,20 13,20    26,13 0,13 0,8 26,8    z"/>
            </g>
            <g id="intnr">
                <circle id="intnrbase" cx="0" cy="0" r="8.25" fill="#fff"/>
                <circle id="intnrtop" cx="0" cy="0" r="7" style="fill:#fff;stroke:#000;stroke-width:1"/>
                <use xlink:href="#nr"/>
            </g>
            <g id="intnrx">
                <circle cx="0" cy="0" r="8.25" fill="#fff"/>
                <circle cx="0" cy="0" r="7" style="fill:#fff;stroke:#999;stroke-width:1"/>
                <use xlink:href="#nr"/>
            </g>
            <g id="int">
                <circle id="intbase" cx="0" cy="0" r="8.25" fill="#fff"/>
                <circle id="inttop" cx="0" cy="0" r="6" style="fill:#fff;stroke:#000;stroke-width:3"/>
            </g>
            <g id="intx">
                <circle cx="0" cy="0" r="8.25" fill="#fff"/>
                <circle cx="0" cy="0" r="6" style="fill:#fff;stroke:#999;stroke-width:3"/>
            </g>
            <g id="cap2">
                <rect x="-8.25" y="-8.25" width="31" height="16.5" rx="8.25" fill="#fff"/>
                <rect x="-6" y="-6" width="26.5" height="12" rx="6" style="fill:#fff;stroke:#000;stroke-width:3"/>
            </g>
            <g id="cap2l">
                <rect x="-8.25" y="-8.25" width="34.5" height="16.5" rx="8.25" fill="#fff"/>
                <rect x="-6" y="-6" width="30" height="12" rx="6" style="fill:#fff;stroke:#000;stroke-width:3"/>
            </g>
            <g id="cap2lx">
                <rect x="-8.25" y="-8.25" width="34.5" height="16.5" rx="8.25" fill="#fff"/>
                <rect x="-6" y="-6" width="30" height="12" rx="6" style="fill:#fff;stroke:#999;stroke-width:3"/>
            </g>
            <g id="cap2nr"><!--length from stadium center 1 to center 2=14.5; half length=7.25-->
                <rect x="-8.25" y="-8.25" width="31" height="16.5" rx="8.25" fill="#fff"/>
                <rect x="-7" y="-7" width="28.5" height="14" rx="7" style="fill:#fff;stroke:#000;stroke-width:1"/>
            </g>
            <g id="cap3nr">
                <rect x="-9.25" y="-9.25" width="40" height="18.5" rx="9.25" fill="#fff"/>
                <rect x="-7" y="-7" width="35.5" height="14" rx="7" style="fill:#fff;stroke:#000;stroke-width:3"/>
            </g>
            <g id="STRg"><path style="fill:#fff;stroke:none" d="M 0,0 L 3,3 v -2.5 L 0,-2.5 -3,0.5 v 2.5 z"/></g>
            <g id="airport" transform="rotate(-90)scale(0.04)translate(-250,-250)" style="stroke:none;fill:#000">
                <polygon points="490,250 450,225 320,225 170,10 140,10 200,225 80,225 30,150 10,150 30,240 30,260 10,350 30,350 80,275 200,275 140,490 170,490 320,275 450,275"/>
                <ellipse cx="441" cy="250" rx="50" ry="24" stroke="#000"/>
            </g>
            <g id="route_base"><rect x="-8" y="-8" width="16" height="16" rx="5" class="fog"/></g>
            <g id="AETRAM" transform="scale(0.025,0.025)translate(-250,0)">
                <path style="stroke-width:25;stroke:#000;fill:none" d="    M -80,-20 L 170,50 330,50 580,-20    M 170,50 L 200,20 300,20 330,50 300,20 250,20 250,150    "/>
                <path fill="#000" d="    M 150,140 L 350,140 410,190 90,190    M 430,190 A 70,140 0 0,1 430,580 H 70 A 70,140 0 0,1 70,190    "/>
                <path fill="#fff" d="    M 430,220 A 70,190 0 0,1 500,380 H 0 A 70,190 0 0,1 70,220    "/>
            </g>
            <g id="CONTf">
                <path stroke="none" d="    M 0,-0.5 H 5 L 0,8 -5,-0.5 z    "/>
            </g>
            <g id="airport_railway">
                <rect fill="#ddd" x="-10" y="-10" width="21" height="21" rx="5"/>
                <path fill="#000" d="    M -9,-7    H -8    L -3,-4 4,-3.5    C 9,-3 14,0 6,0    H 3    V 1    H -1    V 0    L -9,-3 -6,-3.5    "/>
                <path style="fill:none;stroke:#000;stroke-width:1" d="    M -9.5,4 H 10.5    M -9.5,7 H 10.5    M -8.5,2.5 V 8.5    M -5.5,2.5 V 8.5    M -2.5,2.5 V 8.5    M 0.5,2.5 V 8.5    M 3.5,2.5 V 8.5    M 6.5,2.5 V 8.5    M 9.5,2.5 V 8.5    "/>
            </g>
            <g id="bus" transform="scale(0.8)">
                <path fill="#000" d="    M 0,-2    a 2,2 0 0,1 2,-2    h 25 a 2,2 0 0,1 2,2    v 7    l -5,2    a 4,4 0 0,1 -7,0    h -7    a 4,4 0 0,1 -7,0    h -1.5 a 2,2 0 0,1 -2,-2    "/>
                <rect fill="#fff" x="1" y="-1" width="2" height="6" rx="0.5"/>
                <rect fill="#fff" x="5" y="-2" width="4" height="3"/>
                <rect fill="#fff" x="11" y="-2" width="4" height="3"/>
                <rect fill="#fff" x="17" y="-2" width="4" height="3"/>
                <rect fill="#fff" x="23" y="-2" width="4" height="3"/>
            </g>
        </defs>

        <g id="Thames_stripe" class="progress">
            <title>River Thames</title>
            <path style="stroke:none;fill:#e9f7ff" d="    M 327.5,1010    a 140,140 0 0,1 -140,140    a 125,125 0 0,0 125,-125    v -15.5    "/>
            <path style="stroke-width:15;stroke:#e9f7ff;fill:none" d="    M 320,1010    V 930 q 0,-40 32,-64    a 60,60 0 0,1 96,48    v 35 a 50,50 0 0,0 100,0    a 50,50 0 0,1 100,0    a 85,85 0 0,0 85,85    h 105 q 30,0 54,-18    l 117.333,-88 q 24,-18 54,-18    h 52 q 30,0 54,-18    l 40,-30 q 28,-21 28,-56    t 28,-56    l 126,-94.5 q 24,-18 54,-18    h 276.667 a 67,67 0 0,1 67,67    a 90,90 0 0,0 180,0    v -35 a 60,60 0 0,1 96,-48    l 112,84 a 60,60 0 0,0 72,0    l 160,-120 q 28,-21 28,-56    v -90 a 60,60 0 0,1 60,-60    "/>
            <text transform="translate(907,1011.5)rotate(-36.78)" class="st rn b">River <tspan dx="15">Thames</tspan></text>
            <text x="1520" y="643" class="st rn b">River Thames</text>
            <text transform="translate(2273,694)rotate(-36.78)" class="st rn b">River <tspan dx="7">Thames</tspan></text>
        </g>
        <g id="routes">
            <g class="me sjubilee">
                <title>Jubilee line</title>

                <path id="Jubilee_line_route" class="original" d="    M 651,162    V 294 a 15,15 0 0,0 15,15    H 861 q 20,0 32,16    l 300,400 q 12,16 32,16    L 1310,741 q 15,0 27,-9    l 64,-48 q 12,-9 27,-9    H 1710 q 15,0 27,-9    l 12,-9 q 12,-9 27,-9    h 230 a 20,20 0 0,0 20,-20    v -223 a 45,45 0 0,0 -9,-27    l -36,-48    "/>
                
                <path class="inner_original p_jubilee" segment_id="1201" line="jubilee" station_from="Willesden Green"  station_to="Kilburn"        id="1201" d="M 801,309 L 861,309" />
                <path class="inner_original p_jubilee" segment_id="1202" line="jubilee" station_from="Kilburn"          station_to="West Hampstead" id="1202" d="M 861,309 q 20,0 32,16 L 914,353" />
                <path class="inner_original p_jubilee" segment_id="1203" line="jubilee" station_from="West Hampstead"   station_to="Finchley Road"  id="1203" d="M 914,353 L 935,381"  />
                <path class="inner_original p_jubilee" segment_id="1204" line="jubilee" station_from="Finchley Road"    station_to="Swiss Cottage"  id="1204" d="M 935,381 L 957.5,411"  />
                <path class="inner_original p_jubilee" segment_id="1205" line="jubilee" station_from="Swiss Cottage"    station_to="St. John's Wood"id="1205" d="M 957.5,411 L 995,461" />
                <path class="inner_original p_jubilee" segment_id="1206" line="jubilee" station_from="St. John's Wood"  station_to="Baker Street"   id="1206" d="M 995,461 L 1038.5,519" />
                <path class="inner_original p_jubilee" segment_id="1207" line="jubilee" station_from="Baker Street"     station_to="Bond Street"    id="1207" d="M 1038.5,519 L 1105.75,608.75" />
                <path class="inner_original p_jubilee" segment_id="1208" line="jubilee" station_from="Bond Street"      station_to="Green Park"     id="1208" d="M 1105.75,608.75 L 1153,672" />
                <path class="inner_original p_jubilee" segment_id="1209" line="jubilee" station_from="Green Park"       station_to="Westminster"    id="1209" d="M 1153,672 L 1192,725 q 12,16 32,16 L 1236,741" />
                <path class="inner_original p_jubilee" segment_id="1210" line="jubilee" station_from="Westminster"      station_to="Waterloo"       id="1210" d="M 1236,741 L 1310,741 q 15,0 27,-9" />
                <path class="inner_original p_jubilee" segment_id="1211" line="jubilee" station_from="Waterloo"         station_to="Southwark"      id="1211" d="M 1334.36,733.98 L 1380.2,699.6" />
                <path class="inner_original p_jubilee" segment_id="1212" line="jubilee" station_from="Southwark"        station_to="London Bridge"  id="1212" d="M 1380.2,699.6 L 1400,684 q 12,-9 27,-9 L 1479,675" />
                <path class="inner_original p_jubilee" segment_id="1213" line="jubilee" station_from="London Bridge"    station_to="Bermondsey"     id="1213" d="M 1479,675 L 1590,675" />
                <path class="inner_original p_jubilee" segment_id="1214" line="jubilee" station_from="Bermondsey"       station_to="Canada Water"   id="1214" d="M 1590,675 L 1700,675" />
                <path class="inner_original p_jubilee" segment_id="1215" line="jubilee" station_from="Canada Water"     station_to="Canary Wharf"   id="1215" d="M 1700,675 L 1710,675 q 15,0 27,-9    l 12,-9 q 12,-9 27,-9 L 1893.5,648" />
                <path class="inner_original p_jubilee" segment_id="1216" line="jubilee" station_from="Canary Wharf"     station_to="North Greenwich"id="1216" d="M 1893.5,648 L 2000,648" />
                <path class="inner_original p_jubilee" segment_id="1217" line="jubilee" station_from="North Greenwich"  station_to="Canning Town"   id="1217" d="M 2000,648 L 2006,648 a 20,20 0 0,0 20,-20 L2026,584" />
                <path class="inner_original p_jubilee" segment_id="1218" line="jubilee" station_from="Canning Town"     station_to="West Ham"       id="1218" d="M 2026,584 L 2026,434" />
                <path class="inner_original p_jubilee" segment_id="1219" line="jubilee" station_from="West Ham"         station_to="Stratford"      id="1219" d="M 2026,434 v -29 a 45,45 0 0,0 -9,-27    l -36,-48" />
            </g>

            
            <g class="me svictoria">
                <title>Victoria line</title>
                <path id="Victoria_line_route" class="original" d="    M 1682,113    L 1423,113 a 30,30 0 0,0 -30,30    V 183 q 0,15 9,27    l 9,12 q 9,12 9,27    L 1420,334.5 a 40,40 0 0,1 -40,40    H 1193 a 40,40 0 0,0 -40,40    L 1153,418.5    V 735.33 q 0,20 12,36    L 1305,958    "/>
            
                <path class="inner_original p_victoria" segment_id="1601" line="victoria" station_from="Finsbury Park"            station_to="Highbury & Islington"     id="1601" d="M 1393,183 q 0,15 9,27    l 9,12 q 9,12 9,27 L1420,300" />
                <path class="inner_original p_victoria" segment_id="1602" line="victoria" station_from="Highbury & Islington"     station_to="King's Cross St. Pancras" id="1602" d="M 1420,300 L 1420,334.5 a 40,40 0 0,1 -40,40 L1290,374.5" />
                <path class="inner_original p_victoria" segment_id="1603" line="victoria" station_from="King's Cross St. Pancras" station_to="Euston"                   id="1603" d="M 1290,374.5 L 1212,374.5" />
                <path class="inner_original p_victoria" segment_id="1604" line="victoria" station_from="Euston"                   station_to="Warren Street"            id="1604" d="M 1212,374.5 H 1193 A 40,40 0 0,0 1154.5,403.5" />
                <path class="inner_original p_victoria" segment_id="1605" line="victoria" station_from="Warren Street"            station_to="Oxford Circus"            id="1605" d="M 1154.5,403.5 A 40,40 0 0,0 1153,414.5 L1153,573" />
                <path class="inner_original p_victoria" segment_id="1606" line="victoria" station_from="Oxford Circus"            station_to="Green Park"               id="1606" d="M 1153,573 L 1153,672" />
                <path class="inner_original p_victoria" segment_id="1607" line="victoria" station_from="Green Park"               station_to="Victoria"                 id="1607" d="M 1153,672 V 735.33 q 0,20 12,36 L1176,786" />
                <path class="inner_original p_victoria" segment_id="1608" line="victoria" station_from="Victoria"                 station_to="Pimlico"                  id="1608" d="M 1176,786 L 1206,826" />
                <path class="inner_original p_victoria" segment_id="1609" line="victoria" station_from="Pimlico"                  station_to="Vauxhall"                 id="1609" d="M 1206,826 L 1236,866" />
                <path class="inner_original p_victoria" segment_id="1610" line="victoria" station_from="Vauxhall"                 station_to="Stockwell"                id="1610" d="M 1236,866 L 1284.5,931" />
                <path class="inner_original p_victoria" segment_id="1611" line="victoria" station_from="Stockwell"                station_to="Brixton"                  id="1611" d="M 1284.5,931 L 1305,958" />
            </g>

            <g class="me spiccadilly">
                <title>Piccadilly line</title>
                <path id="Piccadilly_line_route" class="original" d="    M 20,299    H 308 a 40,40 0 0,1 24,8    l 36,27 a 40,40 0 0,1 16,32    L 384,693.4 a 40,40 0 0,0 16,32    L 560,845.4 a 45,45 0 0,0 27,9    L 627,854.4    H 1020.3 a 130.5,130.5 0 0,0 78.3,-26.1    q 16,-12 16,-32    V 720.8 a 40,40 0 0,1 16,-32    L 1274,581.25 a 40,40 0 0,0 16,-32    V 292 q 0,-20 16,-32    l 61,-45.75 q 16,-12 16,-32    V 130 q 0,-20 -16,-32    L 1155,-60        M 637,854.4    H 587 a 45,45 0 0,1 -27,-9    L 470,778 a 70,70 0 0,0 -84,0    L 160,947.5 q -12,9 -27,9    H 30        M 160,947.5    l -60,45    a 20,20 0 1,1 -12,-36    "/>
            
                <path class="inner_original p_piccadilly" segment_id="1501" line="piccadilly" station_from="Turnham Green"           station_to="Hammersmith"             id="1501" d="M 530,823 L 560,845.4 a 45,45 0 0,0 27,9 L637,854.4" />
                <path class="inner_original p_piccadilly" segment_id="1502" line="piccadilly" station_from="Hammersmith"             station_to="Barons Court"            id="1502" d="M 637,854.4 L 705,854.4" />
                <path class="inner_original p_piccadilly" segment_id="1503" line="piccadilly" station_from="Barons Court"            station_to="Earl's Court"            id="1503" d="M 705,854.4 L 871,854.4" />
                <path class="inner_original p_piccadilly" segment_id="1504" line="piccadilly" station_from="Earl's Court"            station_to="Gloucester Road"         id="1504" d="M 871,854.4 L 1020.3,854.4" />
                <path class="inner_original p_piccadilly" segment_id="1505" line="piccadilly" station_from="Gloucester Road"         station_to="South Kensington"        id="1505" d="M 1020.3,854.4 A 130.5,130.5 0 0,0 1076.719,840.492" />
                <path class="inner_original p_piccadilly" segment_id="1506" line="piccadilly" station_from="South Kensington"        station_to="Knightsbridge"           id="1506" d="M 1076.719,840.492 A 130.5,130.5 0 0,0 1098.6,828.3 q 16,-12 16,-32 L1114.6,766" />
                <path class="inner_original p_piccadilly" segment_id="1507" line="piccadilly" station_from="Knightsbridge"           station_to="Hyde Park Corner"        id="1507" d="M 1114.6,766 L 1114.6,726" />
                <path class="inner_original p_piccadilly" segment_id="1508" line="piccadilly" station_from="Hyde Park Corner"        station_to="Green Park"              id="1508" d="M 1114.6,726 L 1114.6,720.8 a 40,40 0 0,1 16,-32 L1153,672" />
                <path class="inner_original p_piccadilly" segment_id="1509" line="piccadilly" station_from="Green Park"              station_to="Piccadilly Circus"       id="1509" d="M 1153,672 L 1200.5,636.25" />
                <path class="inner_original p_piccadilly" segment_id="1510" line="piccadilly" station_from="Piccadilly Circus"       station_to="Leicester Square"        id="1510" d="M 1200.5,636.25 L1255.5,595" />
                <path class="inner_original p_piccadilly" segment_id="1511" line="piccadilly" station_from="Leicester Square"        station_to="Covent Garden"           id="1511" d="M 1255.5,595 L1274,581.25 A 40,40 0 0,0 1282, 573.25" />
                <path class="inner_original p_piccadilly" segment_id="1512" line="piccadilly" station_from="Covent Garden"           station_to="Holborn"                 id="1512" d="M 1282,573.25  A 40,40 0 0,0 1290,549.25 L1290,520" />
                <path class="inner_original p_piccadilly" segment_id="1513" line="piccadilly" station_from="Holborn"                 station_to="Russell Square"          id="1513" d="M 1290,520 L1290,450" />
                <path class="inner_original p_piccadilly" segment_id="1514" line="piccadilly" station_from="Russell Square"          station_to="King's Cross St. Pancras"id="1514" d="M 1290,450 L1290,397" />
                <path class="inner_original p_piccadilly" segment_id="1515" line="piccadilly" station_from="King's Cross St. Pancras"station_to="Caledonian Road"         id="1515" d="M 1290,397 L1290,292 q 0,-20 16,-32 L1306,260" />
                <path class="inner_original p_piccadilly" segment_id="1516" line="piccadilly" station_from="Caledonian Road"         station_to="Holloway Road"           id="1516" d="M 1306,260 L1336,237.5" />
                <path class="inner_original p_piccadilly" segment_id="1517" line="piccadilly" station_from="Holloway Road"           station_to="Arsenal"                 id="1517" d="M 1336,237.5 L1366,215" />
                <path class="inner_original p_piccadilly" segment_id="1518" line="piccadilly" station_from="Arsenal"                 station_to="Finsbury Park"           id="1518" d="M 1366,215 q 16,-12 16,-32 L1382.5,183" />
                <path class="inner_original p_piccadilly" segment_id="1519" line="piccadilly" station_from="Finsbury Park"           station_to="Manor House"             id="1519" d="M 1382.5,183 L1382.5,159" />
            </g>      


            <g class="me scentral">
                <title>Central line</title>
                <path id="Central_line_route" class="original" d="    M 340,718.9    H 360 q 15,0 27,-9    l 28,-21 a 40,40 0 0,1 48,0    L 498,714.9 q 12,9 27,9    H 937 q 15,0 27,-9    L 1212,529 q 12,-9 27,-9    H 1375 q 20,0 32,16     l 15,20 q 12,16 32,16    q 15,0 27,-9    l 136,-102 q 12,-9 27,-9    h 136 q 15,0 27,-9    L 1983,311 a 30,30 0 0,0 6,-42    l -54,-72 q -9,-12 -9,-27    V -104        M 624,723.9    H 525 q -15,0 -27,-9    L 158,459.9 q -16,-12 -16,-32    V 277.5        M 1926,150 a 30,30 0 0,1 30,-30    h 125 a 30,30 0 0,0 30,-30    v -50 a 30,30 0 0,0 -30,-30    h -120 a 30,30 0 0,0 -30,30    V 46    "/>
                <path class="inner_original p_central" segment_id="1101" line="central" station_from="North Acton"          station_to="East Acton"             id="1101" d="M 483,703.9 L 498,714.9 q 12,9 27,9 L580,723.9" />
                <path class="inner_original p_central" segment_id="1102" line="central" station_from="East Acton"           station_to="White City"             id="1102" d="M 580,723.9 L624,723.9" />
                <path class="inner_original p_central" segment_id="1103" line="central" station_from="White City"           station_to="Shepherd's Bush"        id="1103" d="M 624,723.9 L637,723.9" />
                <path class="inner_original p_central" segment_id="1104" line="central" station_from="Shepherd's Bush"      station_to="Holland Park"           id="1104" d="M 637,723.9 L806,723.9" />
                <path class="inner_original p_central" segment_id="1105" line="central" station_from="Holland Park"         station_to="Notting Hill Gate"      id="1105" d="M 806,723.9 L877.3,723.9" />
                <path class="inner_original p_central" segment_id="1106" line="central" station_from="Notting Hill Gate"    station_to="Queensway"              id="1106" d="M 877.3,723.9 L930,723.9" />
                <path class="inner_original p_central" segment_id="1107" line="central" station_from="Queensway"            station_to="Lancaster Gate"         id="1107" d="M 930,723.9 L937,723.9 q 15,0 27,-9 L996,691" />
                <path class="inner_original p_central" segment_id="1108" line="central" station_from="Lancaster Gate"       station_to="Marble Arch"            id="1108" d="M 996,691 L1048,652" />
                <path class="inner_original p_central" segment_id="1109" line="central" station_from="Marble Arch"          station_to="Bond Street"            id="1109" d="M 1048,652 L1105.75,608.75" />
                <path class="inner_original p_central" segment_id="1110" line="central" station_from="Bond Street"          station_to="Oxford Circus"          id="1110" d="M 1105.75,608.75 L1153,573" />
                <path class="inner_original p_central" segment_id="1111" line="central" station_from="Oxford Circus"        station_to="Tottenham Court Road"   id="1111" d="M 1153,573 L1208,531.75" />
                <path class="inner_original p_central" segment_id="1112" line="central" station_from="Tottenham Court Road" station_to="Holborn"                id="1112" d="M 1208,531.75 L1212,529 q 12,-9 27,-9 L1290,520" />
                <path class="inner_original p_central" segment_id="1113" line="central" station_from="Holborn"              station_to="Chancery Lane"          id="1113" d="M 1290,520 L1330,520" />
                <path class="inner_original p_central" segment_id="1114" line="central" station_from="Chancery Lane"        station_to="St. Paul's"             id="1114" d="M 1330,520 L1375,520 q 20,0 32,16 L1410,540" />
                <path class="inner_original p_central" segment_id="1115" line="central" station_from="St. Paul's"           station_to="Bank"                   id="1115" d="M 1410,540 L1422,556 q 12,16 32,16 q 15,0 27,-9" />
                <path class="inner_original p_central" segment_id="1116" line="central" station_from="Bank"                 station_to="Liverpool Street"       id="1116" d="M 1481,563 L1564,500" />
                <path class="inner_original p_central" segment_id="1117" line="central" station_from="Liverpool Street"     station_to="Bethnal Green"          id="1117" d="M 1564,500 L1617,461 q 12,-9 27,-9 L1660,452" />
                <path class="inner_original p_central" segment_id="1118" line="central" station_from="Bethnal Green"        station_to="Mile End"               id="1118" d="M 1660,452 L1780,452 q 15,0 27,-9 L1807,443" />
                <path class="inner_original p_central" segment_id="1119" line="central" station_from="Mile End"             station_to="Stratford"              id="1119" d="M 1807,443 L1975,317" />
            </g> 


            <g class="me swnc">
                <!-- <title>Waterloo &amp; City line. Out of service on Sundays or public holidays.</title> -->
                <title>Waterloo & City line</title>
                <path class="inner_original p_wnc" segment_id="1701" line="Waterloo & City" station_from="Bank" station_to="Waterloo" id="1701" d="M 1469.5,558 v 5 q 0,20 -16,32    l -103.14,77.355 q -16,12 -16,32    V 733.98" />
                
                <!-- <use xlink:href="#Waterloo_and_City_line_route" class="swnc2"/> -->
            </g>


            <g class="me sbakerloo">
                <title>Bakerloo line</title>
                <path id="Bakerloo_line_route" class="original" d="    M 529,239    L 529,321 a 45,45 0 0,0 18,36     L 876,603.75 a 45,45 0 0,0 54,0    c 28,-21 12,-37.5 40,-58.5    L 971,544.5    L 997,525 q 10.67,-9 24,-8    h 70 q 20,0 32,16    L 1133.5,547    L 1210,649 q 12,16 32,16    H 1256.5 q 20,0 32,16    l 53.25,71 a 40,40 0 0,0 32,16    L 1475,768    "/>
                
                <path class="inner_original p_bakerloo" segment_id="1001" line="bakerloo" station_from="Willesden Junction" station_to="Kensal Green"      id="1001" d="M 692.5,466 L725,490.5" />
                <path class="inner_original p_bakerloo" segment_id="1002" line="bakerloo" station_from="Kensal Green"       station_to="Queen's Park"      id="1002" d="M 725,490.5 L758.5,516" />
                <path class="inner_original p_bakerloo" segment_id="1003" line="bakerloo" station_from="Queen's Park"        station_to="Kilburn Park"     id="1003" d="M 758.5,516 L789,538.5" />
                <path class="inner_original p_bakerloo" segment_id="1004" line="bakerloo" station_from="Kilburn Park"       station_to="Maida Vale"        id="1004" d="M 789,538.5 L815,558" />
                <path class="inner_original p_bakerloo" segment_id="1005" line="bakerloo" station_from="Maida Vale"         station_to="Warwick Avenue"    id="1005" d="M 815,558 L841,577.5" />
                <path class="inner_original p_bakerloo" segment_id="1006" line="bakerloo" station_from="Warwick Avenue"     station_to="Paddington"        id="1006" d="M 841,577.5 L876,603.75 a 45,45 0 0,0 54,0" />
                <path class="inner_original p_bakerloo" segment_id="1007" line="bakerloo" station_from="Paddington"         station_to="Edgware Road"      id="1007" d="M 929.425,604.18 c 28,-21 12,-37.5 40,-58.5 L971,544.5" />
                <path class="inner_original p_bakerloo" segment_id="1008" line="bakerloo" station_from="Edgware Road"       station_to="Marylebone"        id="1008" d="M 971,544.5 L 997,525" />
                <path class="inner_original p_bakerloo" segment_id="1009" line="bakerloo" station_from="Marylebone"         station_to="Baker Street"      id="1009" d="M 997,525 q 10.67,-9 24,-8 L1037,517" />
                <path class="inner_original p_bakerloo" segment_id="1010" line="bakerloo" station_from="Baker Street"       station_to="Regent's Park"     id="1010" d="M 1037,517 L 1091,517" />
                <path class="inner_original p_bakerloo" segment_id="1011" line="bakerloo" station_from="Regent's Park"      station_to="Oxford Circus"     id="1011" d="M 1091,517 q 20,0 32,16 L1153,573" />
                <path class="inner_original p_bakerloo" segment_id="1012" line="bakerloo" station_from="Oxford Circus"      station_to="Piccadilly Circus" id="1012" d="M 1153,573 L 1200.5,636.25" />
                <path class="inner_original p_bakerloo" segment_id="1013" line="bakerloo" station_from="Piccadilly Circus"  station_to="Charing Cross"     id="1013" d="M 1200.5,636.25 L 1210,649 q 12,16 32,16    H 1256.5 q 20,0 32,16" />
                <path class="inner_original p_bakerloo" segment_id="1014" line="bakerloo" station_from="Charing Cross"      station_to="Embankment"        id="1014" d="M 1288.5,681 L 1299,695" />
                <path class="inner_original p_bakerloo" segment_id="1015" line="bakerloo" station_from="Embankment"         station_to="Waterloo"          id="1015" d="M 1299,695 L1330,736.5" />
                <path class="inner_original p_bakerloo" segment_id="1016" line="bakerloo" station_from="Waterloo"           station_to="Lambeth North"     id="1016" d="M 1330,736.5 L 1341.75,752 a 40,40 0 0,0 32,16 L 1420,768" />
                <path class="inner_original p_bakerloo" segment_id="1017" line="bakerloo" station_from="Lambeth North"      station_to="Elephant & Castle" id="1017" d="M 1420,768 L1475,768" />
            </g>

            <g class="me snorthern">
                <title>Northern line</title>
                <path id="Northern_line_route" class="original"  d="    M 854,4.5    L 1124,207 q 16,12 16,32    V 251 a 25,25 0 0,0 25,25    a 25,25 0 0,1 25,25    V 361 a 18.5,18.5 0 0,0 18.5,18.5    H 1389 a 90,90 0 0,1 90,90    V 765 q 0,20 -16,32    L 1000.5,1144             M 980,99    q -12,-9 -27,-9    h -40    "/>
            
                <path class="inner_original p_northern" segment_id="1301" line="northern" station_from="Archway"                  station_to="Tufnell Park"             id="1301" d="M 1069,165.75 L1108,195" />
                <path class="inner_original p_northern" segment_id="1302" line="northern" station_from="Tufnell Park"             station_to="Kentish Town"             id="1302" d="M 1108,195 L1124,207" />
                <path class="inner_original p_northern" segment_id="1303" line="northern" station_from="Kentish Town"             station_to="Camden Town"              id="1303" d="M 1124,207  q 16,12 16,32 V 251 a 25,25 0 0,0 25,25" />
                <path class="inner_original p_northern" segment_id="1304" line="northern" station_from="Camden Town"              station_to="Euston"                   id="1304" d="M 1165,276 a 25,25 0 0,1 25,25 V 361 a 18.5,18.5 0 0,0 18.5,18.5" />
                <path class="inner_original p_northern" segment_id="1305" line="northern" station_from="Euston"                   station_to="King's Cross St. Pancras" id="1305" d="M 1208.5,379.5 L1290,379.5" />
                <path class="inner_original p_northern" segment_id="1306" line="northern" station_from="King's Cross St. Pancras" station_to="Angel"                    id="1306" d="M 1290,379.5 H 1389 A 90,90 0 0,1 1419.78,384.93" />
                <path class="inner_original p_northern" segment_id="1307" line="northern" station_from="Angel"                    station_to="Old Street"               id="1307" d="M 1419.78,384.93 A 90,90 0 0,1 1466.94,424.5" />
                <path class="inner_original p_northern" segment_id="1308" line="northern" station_from="Old Street"               station_to="Moorgate"                 id="1308" d="M 1466.94,424.5 A 90,90 0 0,1 1479,469.5 L1479,500" />
                <path class="inner_original p_northern" segment_id="1309" line="northern" station_from="Moorgate"                 station_to="Bank"                     id="1309" d="M 1479,500 L1479,563" />
                <path class="inner_original p_northern" segment_id="1310" line="northern" station_from="Bank"                     station_to="London Bridge"            id="1310" d="M 1479,563 L1479,672" />
                <path class="inner_original p_northern" segment_id="1311" line="northern" station_from="London Bridge"            station_to="Borough"                  id="1311" d="M 1479,672 L1479,720" />
                <path class="inner_original p_northern" segment_id="1312" line="northern" station_from="Borough"                  station_to="Elephant & Castle"        id="1312" d="M 1479,720 L1479,765" />
                <path class="inner_original p_northern" segment_id="1313" line="northern" station_from="Elephant & Castle"        station_to="Kennington"               id="1313" d="M 1479,765 q 0,20 -16,32 L1365.5,870" />
                <path class="inner_original p_northern" segment_id="1314" line="northern" station_from="Kennington"               station_to="Oval"                     id="1314" d="M 1365.5,870 L1328.5,898" />
                <path class="inner_original p_northern" segment_id="1315" line="northern" station_from="Oval"                     station_to="Stockwell"                id="1315" d="M 1328.5,898 L1284.5,931" />
                <path class="inner_original p_northern" segment_id="1316" line="northern" station_from="Stockwell"                station_to="Clapham North"            id="1316" d="M 1284.5,931 L1240.5,964" />
                <path class="inner_original p_northern" segment_id="1317" line="northern" station_from="Clapham North"            station_to="Clapham Common"           id="1317" d="M 1240.5,964 L1210.5,986.5" />
                <path class="inner_original p_northern" segment_id="1318" line="northern" station_from="Clapham Common"           station_to="Clapham South"            id="1318" d="M 1210.5,986.5 L1180.5,1009" />   
            </g>


            <g class="me sedgware">
                <title>Edgware line</title>
                <path id="Edgware_line_route" class="original" d="    M 766,124.5    L 962.67,272 q 12,9 27,9    H 1165 a 37,37 0 0,1 37,37    L 1202,360 q 0,13 -19.5,26 t -19.5,26    L 1163,461.667 q 0,10 6,18    L 1278,625 q 9,12 9,25 t 9,25    L 1390.875,801.5 a 30,30 0 0,1 -6.5,42    L 1342.375,875 q -12,9 -27,9    H 1240.5 q -15,0 -27,9    L 1180.17,918.25 q -12,9 -27,9    H 1134    "/>
                
                <path class="inner_original p_northern" segment_id="1401" line="northern" station_from="Hampstead"            station_to="Belsize Park"            id="1401" d="M 948,261 L 962.67,272 q 12,9 27,9 L1010,281" />
                <path class="inner_original p_northern" segment_id="1402" line="northern" station_from="Belsize Park"         station_to="Chalk Farm"              id="1402" d="M 1010,281 L1090,281" />
                <path class="inner_original p_northern" segment_id="1403" line="northern" station_from="Chalk Farm"           station_to="Camden Town"             id="1403" d="M 1090,281 L1165,281" />
                <path class="inner_original p_northern" segment_id="1404" line="northern" station_from="Camden Town"          station_to="Mornington Crescent"     id="1404" d="M 1165,281 a 37,37 0 0,1 37,37 L1202,332" />
                <path class="inner_original p_northern" segment_id="1405" line="northern" station_from="Mornington Crescent"  station_to="Euston"                  id="1405" d="M 1202,332 L1202,360" />
                <path class="inner_original p_northern" segment_id="1406" line="northern" station_from="Euston"               station_to="Warren Street"           id="1406" d="M 1202,360 q 0,13 -19.5,26 t -19.5,26" />
                <path class="inner_original p_northern" segment_id="1407" line="northern" station_from="Warren Street"        station_to="Goodge Street"           id="1407" d="M 1163,412 L1163,450" />
                <path class="inner_original p_northern" segment_id="1408" line="northern" station_from="Goodge Street"        station_to="Tottenham Court Road"    id="1408" d="M 1163,450 L 1163,461.667 q 0,10 6,18 L1208,531.75" />
                <path class="inner_original p_northern" segment_id="1409" line="northern" station_from="Tottenham Court Road" station_to="Leicester Square"        id="1409" d="M 1208,531.75 L1255.5,595" />
                <path class="inner_original p_northern" segment_id="1410" line="northern" station_from="Leicester Square"     station_to="Charing Cross"           id="1410" d="M 1255.5,595 L1278,625 q 9,12 9,25 t 9,25" />
                <path class="inner_original p_northern" segment_id="1411" line="northern" station_from="Charing Cross"        station_to="Embankment"              id="1411" d="M 1296,675 L1307,690" />
                <path class="inner_original p_northern" segment_id="1412" line="northern" station_from="Embankment"           station_to="Waterloo"                id="1412" d="M 1307,690 L1338,731" />
                <path class="inner_original p_northern" segment_id="1413" line="northern" station_from="Waterloo"             station_to="Kennington"              id="1413" d="M 1338,731 L 1390.875,801.5 a 30,30 0 0,1 -6.5,42 L1359.5,862" />
                <path class="inner_original p_northern" segment_id="1414" line="northern" station_from="Kennington"           station_to="Nine Elms"               id="1414" d="M 1359.5,862  L 1342.375,875 q -12,9 -27,9    H 1240.5 q -15,0 -27,9 L1192.5,908" />
                <path class="inner_original p_northern" segment_id="1415" line="northern" station_from="Nine Elms"            station_to="Battersea Power Station" id="1415" d="M 1193.5,908 L 1180.17,918.25 q -12,9 -27,9    H 1134" />
            </g>

            <g class="me sdistrict">
                <title>District line</title>
                <path id="District_line_route" class="original" d="    M 987,567 l -54,40.5 a 145.5,145.5 0 0,0 -29.1,203.7    a 36.375,36.375 0 0,1 -29.1,58.2    L 874.8,869.4    H 867 a 36,36 0 0,0 -36,36    V 960.5 a 45,45 0 0,0 9,27    l 99,132        M 340,728.9    L 359.67,728.9 a 60,60 0 0,1 36,12    L 551,857.4    a 60,60 0 0,0 36,12    L 587,869.4    H 1020 a 145.5,145.5 0 0,0 87.3,-29.1     L 1433,596.5 a 45,45 0 0,1 27,-9    H 1563 a 46,46 0 0,0 27.6,-9.2    l 14.67,-11 q 12,-9 27,-9    H 1653 a 50,50 0 0,0 30,-10    L 1820.07,445.5 a 45,45 0 0,1 27,-9    V 436.5    H 2041 a 50,50 0 0,0 30,-10    L 2401,179        M 637,869.4    H 587 a 60,60 0 0,1 -36,-12    l -36,-27 a 45,45 0 0,0 -54.75,0    L 361,905.4    "/>
                
                <!-- Edgware Road to East Putney branch -->
                <path class="inner_original p_district" segment_id="2227" line="district" station_from="Edgware Road"           station_to="Paddington"             id="2227" d="M 987,567 L933,607.5 " />
                <path class="inner_original p_district" segment_id="2228" line="district" station_from="Paddington"             station_to="Bayswater"              id="2228" d="M 933,607.5 A 145.5,145.5 0 0,0 886.37,667.05" />
                <path class="inner_original p_district" segment_id="2229" line="district" station_from="Bayswater"              station_to="Notting Hill Gate"      id="2229" d="M 886.37,667.05 A 145.5,145.5 0 0,0 874.8,723.9" />
                <path class="inner_original p_district" segment_id="2230" line="district" station_from="Notting Hill Gate"      station_to="High Street Kensington" id="2230" d="M 874.8,723.9 A 145.5,145.5 0 0,0 903.9,811.2" />
                <path class="inner_original p_district" segment_id="2231" line="district" station_from="High Street Kensington" station_to="Earl's Court"           id="2231" d="M 903.9,811.2 a 36.375,36.375 0 0,1 -29.1,58.2 L 871,869.4" />
                <path class="inner_original p_district" segment_id="2232" line="district" station_from="Earl's Court"           station_to="West Brompton"          id="2232" d="M 871,869.4  H 867 a 36,36 0 0,0 -36,36 L831,920" />
                <path class="inner_original p_district" segment_id="2233" line="district" station_from="West Brompton"          station_to="Fulham Broadway"        id="2233" d="M 831,920 L831,960" />
                <path class="inner_original p_district" segment_id="2234" line="district" station_from="Fulham Broadway"        station_to="Parsons Green"          id="2234" d="M 831,960 L831,960.5 a 45,45 0 0,0 9,27" />
                <path class="inner_original p_district" segment_id="2235" line="district" station_from="Parsons Green"          station_to="Putney Bridge"          id="2235" d="M 840,987.5 L861,1015.5" />
                <path class="inner_original p_district" segment_id="2236" line="district" station_from="Putney Bridge"          station_to="East Putney"            id="2236" d="M 861,1015.5 L882,1043.5" />
                
                <!-- Turnham Green to West Ham branch -->
                <path class="inner_original p_district" segment_id="2201" line="district" station_from="Turnham Green"    station_to="Stamford Brook"   id="2201" d="M 521,835 L545,853" />
                <path class="inner_original p_district" segment_id="2202" line="district" station_from="Stamford Brook"   station_to="Ravenscourt Park" id="2202" d="M 545,853 L551,857.4  a 60,60 0 0,0 36,12" />
                <path class="inner_original p_district" segment_id="2203" line="district" station_from="Ravenscourt Park" station_to="Hammersmith"      id="2203" d="M 587,869.4 L637,869.4" />
                <path class="inner_original p_district" segment_id="2204" line="district" station_from="Hammersmith"      station_to="Barons Court"     id="2204" d="M 637,869.4 L705,869.4" />
                <path class="inner_original p_district" segment_id="2205" line="district" station_from="Barons Court"     station_to="West Kensington"  id="2205" d="M 705,869.4 L780,869.4" />
                <path class="inner_original p_district" segment_id="2206" line="district" station_from="West Kensington"  station_to="Earl's Court"     id="2206" d="M 780,869.4 L871,869.4" />
                <path class="inner_original p_district" segment_id="2207" line="district" station_from="Earl's Court"     station_to="Gloucester Road"  id="2207" d="M 871,869.4 L1020.3,869.4" />
                <path class="inner_original p_district" segment_id="2208" line="district" station_from="Gloucester Road"  station_to="South Kensington" id="2208" d="M 1020.3,869.4 A 145.5,145.5 0 0,0 1083,855" />
                <path class="inner_original p_district" segment_id="2209" line="district" station_from="South Kensington" station_to="Sloane Square"    id="2209" d="M 1083,855 A 145.5,145.5 0 0,0 1107.3,840.3 L1136,819" />
                <path class="inner_original p_district" segment_id="2210" line="district" station_from="Sloane Square"    station_to="Victoria"         id="2210" d="M 1136,819 L1178,787.5" />
                <path class="inner_original p_district" segment_id="2211" line="district" station_from="Victoria"         station_to="St James's Park"  id="2211" d="M 1178,787.5 L1210,763.5" />
                <path class="inner_original p_district" segment_id="2212" line="district" station_from="St James's Park"  station_to="Westminster"      id="2212" d="M 1210,763.5 L1238,742.5" />
                <path class="inner_original p_district" segment_id="2213" line="district" station_from="Westminster"      station_to="Embankment"       id="2213" d="M 1238,742.5 L1304.32,692.76" />
                <path class="inner_original p_district" segment_id="2214" line="district" station_from="Embankment"       station_to="Temple"           id="2214" d="M 1304.32,692.76 L1339,667" />
                <path class="inner_original p_district" segment_id="2215" line="district" station_from="Temple"           station_to="Blackfriars"      id="2215" d="M 1339,667 L1374,640.5" />
                <path class="inner_original p_district" segment_id="2216" line="district" station_from="Blackfriars"      station_to="Mansion House"    id="2216" d="M 1374,640.5 L1403,619" />
                <path class="inner_original p_district" segment_id="2217" line="district" station_from="Mansion House"    station_to="Cannon Street"    id="2217" d="M 1403,619 L1433,596.5" />
                <path class="inner_original p_district" segment_id="2218" line="district" station_from="Cannon Street"    station_to="Monument"         id="2218" d="M 1433,596.5 a 45,45 0 0,1 27,-9 L1495,587.5" />
                <path class="inner_original p_district" segment_id="2219" line="district" station_from="Monument"         station_to="Tower Hill"       id="2219" d="M 1495,587.5 L1563,587.5" />
                <path class="inner_original p_district" segment_id="2220" line="district" station_from="Tower Hill"       station_to="Aldgate East"     id="2220" d="M 1563,587.5 a 46,46 0 0,0 27.6,-9.2    l 14.67,-11 q 12,-9 27,-9 H1653" />
                <path class="inner_original p_district" segment_id="2221" line="district" station_from="Aldgate East"     station_to="Whitechapel"      id="2221" d="M 1653,558.3 a 50,50 0 0,0 30,-10 L1702,534" />
                <path class="inner_original p_district" segment_id="2222" line="district" station_from="Whitechapel"      station_to="Stepney Green"    id="2222" d="M 1702,534 L1755.5,494" />
                <path class="inner_original p_district" segment_id="2223" line="district" station_from="Stepney Green"    station_to="Mile End"         id="2223" d="M 1755.5,494 L1814.5,449.5" />
                <path class="inner_original p_district" segment_id="2224" line="district" station_from="Mile End"         station_to="Bow Road"         id="2224" d="M 1814.5,449.5 L1820.07,445.5 a 45,45 0 0,1 27,-9 L1878,436.5" />
                <path class="inner_original p_district" segment_id="2225" line="district" station_from="Bow Road"         station_to="Bromley-by-Bow"   id="2225" d="M 1878,436.5 L1963,436.5" />
                <path class="inner_original p_district" segment_id="2226" line="district" station_from="Bromley-by-Bow"   station_to="West Ham"         id="2226" d="M 1963,436.5 L2031,436.5" />

                <!-- Kensington (Olympia) branch of District line. Operates only on weekends and some public holidays. Check the latest official timetable for details. -->
                <path class="inner_original p_district" segment_id="2237" line="district" station_from="Earl's Court" station_to="Kensington (Olympia)" id="2237" d="M 871,869.4    H 867 a 36,36 0 0,1 -36,-36    V 819    "/>
            </g>


            <g class="me scircle">
                <title>Circle line</title>
                <path id="Circle_line_route" class="original" d="    M 990,571 l -54,40.5 a 140.5,140.5 0 0,0 168.6,224.8    L 1430,592.5 a 50,50 0 0,1 30,-10    H 1563 a 41,41 0 0,0 0,-82.5        M 984,563 a 66.25,66.25 0 0,1 -39.75,13.25    h -15 a 61.25,61.25 0 0,0 -36.75,12.25    L 862.5,610 a 50,50 0 0,1 -30,10    H 772.5 a 45,45 0 0,0 -27,9    L 655.5,697.5 a 40,40 0 0,0 -16,32    V 835        M 984,563    l 192,-144 a 143.2,143.2 0 0,1 200.48,28.64    L 1403,482 a 45,45 0 0,0 36,18    L 1563,500    "/>
            
                <path class="inner_original p_circle" segment_id="2227" line="district" station_from="Edgware Road"           station_to="Paddington"             id="2227" d="M 990,571 l -54,40.5 " />
                <path class="inner_original p_circle" segment_id="2228" line="district" station_from="Paddington"             station_to="Bayswater"              id="2228" d="M 936,611.5 A 140.5,140.5 0 0,0 891,669" />
                <path class="inner_original p_circle" segment_id="2229" line="district" station_from="Bayswater"              station_to="Notting Hill Gate"      id="2229" d="M 891,669 A 140.5,140.5 0 0,0 879.8,723.9" />
                <path class="inner_original p_circle" segment_id="2230" line="district" station_from="Notting Hill Gate"      station_to="High Street Kensington" id="2230" d="M 879.8,723.9 A 140.5,140.5 0 0,0 908,808" />
                <path class="inner_original p_circle" segment_id="2106" line="circle"   station_from="High Street Kensington" station_to="Gloucester Road"        id="2106" d="M 908,808 A 140.5,140.5 0 0,0 1020.3,864.4" />
                <path class="inner_original p_circle" segment_id="2208" line="district" station_from="Gloucester Road"        station_to="South Kensington"       id="2208" d="M 1020.3,864.4 A 140.5,140.5 0 0,0 1081,851" />
                <path class="inner_original p_circle" segment_id="2209" line="district" station_from="South Kensington"       station_to="Sloane Square"          id="2209" d="M 1081,851 A 140.5,140.5 0 0,0 1104.6,835.8 L1133,815" />
                <path class="inner_original p_circle" segment_id="2210" line="district" station_from="Sloane Square"          station_to="Victoria"               id="2210" d="M 1133,815 L1175,783.5" />
                <path class="inner_original p_circle" segment_id="2211" line="district" station_from="Victoria"               station_to="St James's Park"        id="2211" d="M 1175,783.5 L1207,759.5" />
                <path class="inner_original p_circle" segment_id="2212" line="district" station_from="St James's Park"       station_to="Westminster"             id="2212" d="M 1207,759.5 L1235,738.5" />
                <path class="inner_original p_circle" segment_id="2213" line="district" station_from="Westminster"            station_to="Embankment"             id="2213" d="M 1235,738.5 L1301.32,688.76" />
                <path class="inner_original p_circle" segment_id="2214" line="district" station_from="Embankment"             station_to="Temple"                 id="2214" d="M 1301.32,688.76 L1336,663" />
                <path class="inner_original p_circle" segment_id="2215" line="district" station_from="Temple"                 station_to="Blackfriars"            id="2215" d="M 1336,663 L1371,636.5" />
                <path class="inner_original p_circle" segment_id="2216" line="district" station_from="Blackfriars"            station_to="Mansion House"          id="2216" d="M 1371,636.5 L1400,615" />
                <path class="inner_original p_circle" segment_id="2217" line="district" station_from="Mansion House"          station_to="Cannon Street"          id="2217" d="M 1400,615 L1430,592.5" />
                <path class="inner_original p_circle" segment_id="2218" line="district" station_from="Cannon Street"          station_to="Monument"               id="2218" d="M 1430,592.5 a 50,50 0 0,1 30,-10 L1495,582.5 " />
                <path class="inner_original p_circle" segment_id="2219" line="district" station_from="Monument"               station_to="Tower Hill"             id="2219" d="M 1495,582.5 L1563,582.5" />
                <path class="inner_original p_circle" segment_id="2117" line="circle"   station_from="Tower Hill"             station_to="Aldgate"                id="2117" d="M 1563,582.5 A 41,41 0 0,0 1604,541" />
                <!-- starting in edgware road westbound -->
                <path class="inner_original p_circle" segment_id="2309" line="Hammersmith & City" station_from="Edgware Road"           station_to="Paddington"             id="2009" d="M 984,563 a 66.25,66.25 0 0,1 -39.75,13.25 h-15" />
                <path class="inner_original p_circle" segment_id="2308" line="Hammersmith & City" station_from="Paddington"             station_to="Royal Oak"              id="2008" d="M 929.25,576.25 a 61.25,61.25 0 0,0 -36.75,12.25    L 862.5,610 a 50,50 0 0,1 -30,10 L800,620" />
                <path class="inner_original p_circle" segment_id="2307" line="Hammersmith & City" station_from="Royal Oak"              station_to="Westbourne Park"        id="2007" d="M 800,620 H 772.5 a 45,45 0 0,0 -27,9 L725.5,645" />
                <path class="inner_original p_circle" segment_id="2306" line="Hammersmith & City" station_from="Westbourne Park"        station_to="Ladbroke Grove"         id="2006" d="M 725.5,645 L689.5,672" />
                <path class="inner_original p_circle" segment_id="2305" line="Hammersmith & City" station_from="Ladbroke Grove"         station_to="Latimer Road"           id="2005" d="M 689.5,672 L655.5,697.5" />
                <path class="inner_original p_circle" segment_id="2304" line="Hammersmith & City" station_from="Latimer Road"           station_to="Wood Lane"              id="2004" d="M 655.5,697.5 a 40,40 0 0,0 -16,32 L639.5,742.9" />
                <path class="inner_original p_circle" segment_id="2303" line="Hammersmith & City" station_from="Wood Lane"              station_to="Shepherd's Bush Market" id="2003" d="M 639.5,742.9 L639.5,772.9" />
                <path class="inner_original p_circle" segment_id="2302" line="Hammersmith & City" station_from="Shepherd's Bush Market" station_to="Goldhawk Road"          id="2002" d="M 639.5,772.9 L639.5,802.9" />
                <path class="inner_original p_circle" segment_id="2301" line="Hammersmith & City" station_from="Goldhawk Road"          station_to="Hammersmith"            id="2001" d="M 639.5,802.9 L639.5,835" />

                <!-- starting in edgware road eastbound -->

                <path class="inner_original p_circle" segment_id="2310" line="Hammersmith & City" station_from="Edgware Road"             station_to="Baker Street"             id="2310" d="M 984,563 L1052,512" />
                <path class="inner_original p_circle" segment_id="2311" line="Hammersmith & City" station_from="Baker Street"             station_to="Great Portland Street"    id="2311" d="M 1052,512 L1114,465.5" />
                <path class="inner_original p_circle" segment_id="2312" line="Hammersmith & City" station_from="Great Portland Street"    station_to="Euston Square"            id="2312" d="M 1114,465.5 L1176,419 A 138.2,138.2 0 0,1 1204,402.5" />
                <path class="inner_original p_circle" segment_id="2313" line="Hammersmith & City" station_from="Euston Square"            station_to="King's Cross St. Pancras" id="2313" d="M 1204,402.5 A 138.2,138.2 0 0,1 1290,393" />
                <path class="inner_original p_circle" segment_id="2314" line="Hammersmith & City" station_from="King's Cross St. Pancras" station_to="Farringdon"               id="2314" d="M 1290,393 A 138.2,138.2 0 0,1 1376.48,447.64 L1385,458" />
                <path class="inner_original p_circle" segment_id="2315" line="Hammersmith & City" station_from="Farringdon"               station_to="Barbican"                 id="2315" d="M 1385,458 L1403,482 A 45,45 0 0,0 1415,493" />
                <path class="inner_original p_circle" segment_id="2316" line="Hammersmith & City" station_from="Barbican"                 station_to="Moorgate"                 id="2316" d="M 1415,493 A 45,45 0 0,0 1439,500 L1479,500" />
                <path class="inner_original p_circle" segment_id="2317" line="Hammersmith & City" station_from="Moorgate"                 station_to="Liverpool Street"         id="2317" d="M 1479,500 L1563,500" />        
                <path class="inner_original p_circle" segment_id="2409" line="metropolitan"       station_from="Liverpool Street"         station_to="Aldgate"                  id="2409" d="M 1563,500 A 41,41 0 0,1 1604,541" />
            </g>

            <g class="me shnc">
                <title>Hammersmith &amp; City line</title>
                <path id="Hammersmith_and_City_line_route" class="inner_original original" d="    M 981,559 a 61.25,61.25 0 0,1 -36.75,12.25    h -15 a 66.25,66.25 0 0,0 -39.75,13.25    L 889.5,584.5    L 859.5,607 a 45,45 0 0,1 -27,9    H 772.5 a 50,50 0 0,0 -30,10    L 652.5,693.5 a 45,45 0 0,0 -18,36    V 835        M 981,559    l 192,-144 a 148.2,148.2 0 0,1 207.5,29.64    L 1407,479 a 40,40 0 0,0 32,16    H 1563 a 46,46 0 0,1 36.8,18.4    l 18,24 q 12,16 32,16    H 1653 a 45,45 0 0,0 27,-9    L 1817.07,441.5 a 50,50 0 0,1 30,-10    V 431.5    H 2041 a 45,45 0 0,0 27,-9    L 2158,355    "/>
            
                <!-- starting in edgware road westbound -->
                <path class="inner_original p_hnc" segment_id="2309" line="Hammersmith & City" station_from="Edgware Road"           station_to="Paddington"             id="2009" d="M 981,559 a 61.25,61.25 0 0,1 -36.75,12.25 h -15" />
                <path class="inner_original p_hnc" segment_id="2308" line="Hammersmith & City" station_from="Paddington"             station_to="Royal Oak"              id="2008" d="M 929.25,571.25 a 66.25,66.25 0 0,0 -39.75,13.25 L 859.5,607 a 45,45 0 0,1 -27,9 L800,616" />
                <path class="inner_original p_hnc" segment_id="2307" line="Hammersmith & City" station_from="Royal Oak"              station_to="Westbourne Park"        id="2007" d="M 800,616 H 772.5 a 50,50 0 0,0 -30,10 L722.5,641" />
                <path class="inner_original p_hnc" segment_id="2306" line="Hammersmith & City" station_from="Westbourne Park"        station_to="Ladbroke Grove"         id="2006" d="M 722.5,641 L686.5,668" />    
                <path class="inner_original p_hnc" segment_id="2305" line="Hammersmith & City" station_from="Ladbroke Grove"         station_to="Latimer Road"           id="2005" d="M 686.5,668 L652.5,693.5" />  
                <path class="inner_original p_hnc" segment_id="2304" line="Hammersmith & City" station_from="Latimer Road"           station_to="Wood Lane"              id="2004" d="M 652.5,693.5 a 45,45 0 0,0 -18,36 L634.5,742.9" />
                <path class="inner_original p_hnc" segment_id="2303" line="Hammersmith & City" station_from="Wood Lane"              station_to="Shepherd's Bush Market" id="2003" d="M 634.5,742.9 L634.5,772.9" />    
                <path class="inner_original p_hnc" segment_id="2302" line="Hammersmith & City" station_from="Shepherd's Bush Market" station_to="Goldhawk Road"          id="2002" d="M 634.5,772.9 L634.5,802.9" /> 
                <path class="inner_original p_hnc" segment_id="2301" line="Hammersmith & City" station_from="Goldhawk Road"          station_to="Hammersmith"            id="2001" d="M 634.5,802.9 L634.5,835" /> 
            
                <!-- starting in edgware road eastbound -->
                <path class="inner_original p_hnc" segment_id="2310" line="Hammersmith & City" station_from="Edgware Road"             station_to="Baker Street"             id="2310" d="M 981,559 L1049,508" />
                <path class="inner_original p_hnc" segment_id="2311" line="Hammersmith & City" station_from="Baker Street"             station_to="Great Portland Street"    id="2311" d="M 1049,508 L1111,461.5" />
                <path class="inner_original p_hnc" segment_id="2312" line="Hammersmith & City" station_from="Great Portland Street"    station_to="Euston Square"            id="2312" d="M 1111,461.5 L1172,416 A 148.2,148.2 0 0,1 1201.5,398" />
                <path class="inner_original p_hnc" segment_id="2313" line="Hammersmith & City" station_from="Euston Square"            station_to="King's Cross St. Pancras" id="2313" d="M 1201.5,398 A 148.2,148.2 0 0,1 1290,388" />
                <path class="inner_original p_hnc" segment_id="2314" line="Hammersmith & City" station_from="King's Cross St. Pancras" station_to="Farringdon"               id="2314" d="M 1290,388 A 148.2,148.2 0 0,1 1380.5,444.64 L1389,455" />
                <path class="inner_original p_hnc" segment_id="2315" line="Hammersmith & City" station_from="Farringdon"               station_to="Barbican"                 id="2315" d="M 1389,455 L 1407,479 A 40,40 0 0,0 1417.5,488.5" />
                <path class="inner_original p_hnc" segment_id="2316" line="Hammersmith & City" station_from="Barbican"                 station_to="Moorgate"                 id="2316" d="M 1417.5,488.5 A 40,40 0 0,0 1439,495 L1479,495" />
                <path class="inner_original p_hnc" segment_id="2317" line="Hammersmith & City" station_from="Moorgate"                 station_to="Liverpool Street"         id="2317" d="M 1479,495 L1563,495" />
                <path class="inner_original p_hnc" segment_id="2318" line="Hammersmith & City" station_from="Liverpool Street"         station_to="Aldgate East"             id="2318" d="M 1563,495 a 46,46 0 0,1 36.8,18.4    l 18,24 q 12,16 32,16    H 1653" />
                <path class="inner_original p_hnc" segment_id="2221" line="District"           station_from="Aldgate East"             station_to="Whitechapel"              id="2221" d="M 1653,553.3 a 45,45 0 0,0 27,-9 L1699,530" />
                <path class="inner_original p_hnc" segment_id="2222" line="District"           station_from="Whitechapel"              station_to="Stepney Green"            id="2222" d="M 1699,530 L1752.5,490" />
                <path class="inner_original p_hnc" segment_id="2223" line="District"           station_from="Stepney Green"            station_to="Mile End"                 id="2223" d="M 1752.5,490 L1811.5,445.5" />
                <path class="inner_original p_hnc" segment_id="2224" line="District"           station_from="Mile End"                 station_to="Bow Road"                 id="2224" d="M 1811.5,445.5 L1817.07,441.5 a 50,50 0 0,1 30,-10 L1878,431.5" />
                <path class="inner_original p_hnc" segment_id="2225" line="District"           station_from="Bow Road"                 station_to="Bromley-by-Bow"           id="2225" d="M 1878,431.5 L1963,431.5" />
                <path class="inner_original p_hnc" segment_id="2226" line="District"           station_from="Bromley-by-Bow"           station_to="West Ham"                 id="2226" d="M 1963,431.5 L2031,431.5" />        
            </g>

            <g class="me smetropolitan">
                <path id="Metropolitan_line_route" class="original" d="    M 100,60    L 400,285 q 12,9 27,9     H 861 a 55,55 0 0,1 44,22     L 1046,504 a 15,15 0 0,0 21,3     L 1179,423 a 138.2,138.2 0 0,1 193.48,27.64    L 1399,485 a 50,50 0 0,0 40,20    H 1563 a 36,36 0 0,1 36,36        M 140,90 q -16,-12 -16,-32 v -20        M 239,164.25 q -16,-12 -16,-32    V 80        M 20,294 H 440    "/>
            
                <title>Metropolitan line</title>
                <path class="inner_original p_metropolitan" segment_id="2401" line="metropolitan"       station_from="Finchley Road"            station_to="Baker Street"             id="2401" d="M 942.5,366 L1046,504" />
                <path class="inner_original p_metropolitan" segment_id="2311" line="Hammersmith & City" station_from="Baker Street"             station_to="Great Portland Street"    id="2311" d="M 1046,504 a 15,15 0 0,0 21,3 L1117,469.5" />
                <path class="inner_original p_metropolitan" segment_id="2312" line="Hammersmith & City" station_from="Great Portland Street"    station_to="Euston Square"            id="2312" d="M 1117,469.5 L1179,423 A 138.2,138.2 0 0,1 1205.92,407.5" />
                <path class="inner_original p_metropolitan" segment_id="2313" line="Hammersmith & City" station_from="Euston Square"            station_to="King's Cross St. Pancras" id="2313" d="M 1205.92,407.5 A 138.2,138.2 0 0,1 1290,398" />
                <path class="inner_original p_metropolitan" segment_id="2314" line="Hammersmith & City" station_from="King's Cross St. Pancras" station_to="Farringdon"               id="2314" d="M 1290,398 A 138.2,138.2 0 0,1 1372.48,450.64 L1381,461" />
                <path class="inner_original p_metropolitan" segment_id="2315" line="Hammersmith & City" station_from="Farringdon"               station_to="Barbican"                 id="2315" d="M 1381,461 L1399,485 A 50,50 0 0,0 1412,497" />
                <path class="inner_original p_metropolitan" segment_id="2316" line="Hammersmith & City" station_from="Barbican"                 station_to="Moorgate"                 id="2316" d="M 1412,497 A 50,50 0 0,0 1439,505 L1479,505" />
                <path class="inner_original p_metropolitan" segment_id="2317" line="Hammersmith & City" station_from="Moorgate"                 station_to="Liverpool Street"         id="2317" d="M 1479,505 L1563,505" />
                <path class="inner_original p_metropolitan" segment_id="2409" line="metropolitan"       station_from="Liverpool Street"         station_to="Aldgate"                  id="2409" d="M 1563,505 a 36,36 0 0,1 36,36" />
            </g>

        </g>


        <g id="station_nodes" opacity="1">
            <g id="Multiple_interchanges_group">
                
                <g id="Aldgate">
                    <use xlink:href="#int" x="1601.5" y="541.5"/>
                </g>
                
                <use xlink:href="#termnorthern" transform="translate(1069,165.75)rotate(-53.13)" id="Archway"/>
                
                <use xlink:href="#cap2" transform="translate(1038.5,519)rotate(-36.87)" id="Baker_Street"/>			
                <g transform="translate(1474.5,558)">
                    <g id="Bank_Monument_hub">
                        <path d="M 0,0 l 20.25,27" style="stroke:#fff;stroke-width:7.5"/>
                        <rect x="-8.25" y="-8.25" width="31" height="16.5" rx="8.5" fill="#fff" transform="rotate(53.13)"/>
                        <circle cx="20.25" cy="27" r="8.25" fill="#fff"/>
                        <rect x="-6" y="-6" width="26.5" height="12" rx="6" style="stroke:#000;stroke-width:3" transform="rotate(53.13)"/>
                        <circle cx="20.25" cy="27" r="6" style="stroke:#000;stroke-width:3"/>
                        <path d="M 0,0 l 20.25,27" style="stroke:#000;stroke-width:6"/>
                        <rect x="-4.5" y="-4.5" width="23.5" height="9" rx="4.5" style="fill:#fff;stroke:none" transform="rotate(53.13)"/>
                        <circle cx="20.25" cy="27" r="4.5" style="fill:#fff;stroke:none"/>
                        <path d="M 0,0 l 20.25,27" style="stroke:#fff;stroke-width:2"/>
                    </g>
                </g>
            
                <use xlink:href="#int" transform="translate(1105.75,608.75)rotate(270)" id="Bond_Street_cr"/>
                
                <g>
                    <use xlink:href="#stjubilee" transform="translate(861,309)rotate(90)" id="Kilburn"/>
                </g>
                
                <use xlink:href="#stjubilee" transform="translate(1700,675)rotate(90)" id="Canada_Water"/>
                
                <g>
                    <g><use xlink:href="#stjubilee" transform="translate(1893.5,648)rotate(90)" id="Canary_Wharf_jubilee"/></g>
                </g>
                
                <use xlink:href="#int" x="1165" y="278.5" id="Camden_Town"/>
                <use xlink:href="#stjubilee" x="2026" y="584" id="Canning_Town"/>
                <g>
                    <use xlink:href="#int" x="1287.32" y="671.26" id="Charing_Cross"/>
                </g>
                <use xlink:href="#stnorthern" transform="translate(1240.5,964)rotate(53.13)" id="Clapham_North"/>
                
                <use xlink:href="#cap2" transform="translate(871,869.4)rotate(-90)" id="Earls_Court"/>
                <g>
                    <use xlink:href="#stbakerloo" transform="translate(970,545.25)rotate(-126.67)" id="Edgware_Road_bakerloo"/>
                    <use xlink:href="#cap2" transform="translate(981,559)rotate(53.13)" id="Edgware_Road_circle"/>
                </g>
                <g>
                    <use xlink:href="#int" x="1478" y="769" id="Elephant_And_Castle"/>
                </g>
                <use xlink:href="#int" x="1302.32" y="691.26" id="Embankment"/>
                <use xlink:href="#Euston_osi" class="osib"/>
                <g>
                    <use xlink:href="#cap2" transform="translate(1212,376.85)rotate(233.13)" id="Euston_Northern_Victoria"/>
                </g>
                <g>
                    <use xlink:href="#int" x="1159.5" y="403.5" id="Warren_Street"/>
                </g>
                
                <use xlink:href="#cap2" transform="translate(935,381)rotate(-36.87)" id="Finchley_Road"/>
                <g>
                    <use xlink:href="#int" x="1387.5" y="183" id="Finsbury_Park"/>
                </g>
                
                <use xlink:href="#cap2" transform="translate(1020.3,869.4)rotate(-90)" id="Gloucester_Road"/>
                <use xlink:href="#int" x="1153" y="672" id="Green_Park"/>
                
                <path class="osi" d="M 637,835 V 869.4"></path>
                <use xlink:href="#int" x="637" y="835" id="Hammersmith_circle"/>
                <use xlink:href="#cap2" transform="translate(637,869.4)rotate(-90)" id="Hammersmith_district"/>

                <g>
                    <use xlink:href="#stvictoria" x="1420" y="300" id="Highbury_and_Islington"/>
                </g>
                <use xlink:href="#int" x="1290" y="520" id="Holborn"/>
                
                
                <g>
                   <use xlink:href="#stnorthern" transform="translate(1128,210)rotate(-53.13)" id="Kentish_Town"/>
                </g>
                <g>
                    <use xlink:href="#termdistrict" x="831" y="819" id="Kensington_Olympia"/>
                </g>
                <g>
                    <use xlink:href="#cap3nr" transform="translate(1290,397)rotate(-90)" id="Kings_Cross_St_Pancras"/>
                    <!-- <use xlink:href="#nr" x="1290" y="385.5"/> -->
                </g>
                
                <use xlink:href="#int" x="1255.5" y="595" id="Leicester_Square"/>
                <use xlink:href="#Liverpool_Street_Moorgate_osi" class="osib"/>

                <use xlink:href="#intbase" x="1564" y="500" id="Liverpool_Street_circle_base"/>
                <!-- <use xlink:href="#intnrbase" x="1479" y="500" id="Moorgate_base">
                </use> -->
                
                <use xlink:href="#inttop" x="1564" y="500" id="Liverpool_Street_circle_top">
                </use>
                <use xlink:href="#int" x="1479" y="500" id="Moorgate_mid">
                </use>
                <!-- <use xlink:href="#nr" x="1479" y="500" id="Moorgate_top">
                </use> -->
                <use xlink:href="#int" x="1479" y="675" id="London_Bridge">
                </use>
                <use xlink:href="#int" x="1812.5" y="445" id="Mile_End"/>
                
                <use xlink:href="#int" x="877.3" y="723.9" id="Notting_Hill_Gate"/>
                
                <use xlink:href="#int" x="1153" y="573" id="Oxford_Circus"/>
                
                <g>
                    <path class="osi" d="M 921,574 L932.43,608.17"></path>
                    <!-- <g class="osib">
                        <circle id="Paddington_osi_base" cx="921" cy="593" r="19"/>
                        <path id="Paddington_osi_base" d="M 902.238,596 A 19,19 0 1,1 932.736,607.6985"/>
                    </g> -->
                    <!-- <use xlink:href="#Paddington_osi_base" class="osi" id="Paddington_osi"/> -->
                    <!-- <use xlink:href="#intbase" transform="translate(921,593)rotate(170.915)translate(19)" id="Paddington_elizabeth_base"/> -->
                    <use xlink:href="#intbase" transform="translate(921,593)rotate(53)translate(19)" id="Paddington_deep_base"/>
                    <!-- <g class="isib">
                        <path id="Paddington_below_ground_isi" d="M 902.238,596 A 19,19 0 0,0 932.736,607.6985"/>
                    </g> -->
                    <!-- <use xlink:href="#Paddington_below_ground_isi" class="isi">
                        </use>
                    <use xlink:href="#inttop" transform="translate(921,593)rotate(170.915)translate(19)" id="Paddington_elizabeth">
                        </use>-->
                    <use xlink:href="#inttop" transform="translate(921,593)rotate(53)translate(19)" id="Paddington_deep">
                        </use>
                    <!--<use xlink:href="#Paddington_below_ground_isi" class="isit">
                            </use> -->
                    <use xlink:href="#int" transform="translate(921,593)rotate(-90)translate(19)" id="Paddington_surface">
                            </use>
                    <!-- <use xlink:href="#nr" x="921" y="588" id="Paddington_nr"/> -->
                    
                </g>
                
                <use xlink:href="#int" x="1200.5" y="636.25" id="Piccadilly_Circus"/>
                
                <use xlink:href="#stbakerloo" transform="translate(758.5,516)rotate(126.87)" id="Queens_Park"/>

                <g>
                    <use xlink:href="#stcentral" transform="translate(696,723.9)rotate(-90)" id="Shepherds_Bush_tube"/>
                </g>
                <use xlink:href="#int" x="1284.5" y="931" id="Stockwell"/>
                <g>
                    <use xlink:href="#cap2" transform="translate(1975,320)rotate(53.13)" id="Stratford"/>
                    <!-- <use xlink:href="#nr" x="1982.375" y="323.5"/> -->
                </g>
                <use xlink:href="#cap2" transform="translate(1020.3,719.5)rotate(245)translate(-148.5)" id="South_Kensington"/>
                
                <use xlink:href="#int" transform="translate(1208,531.75)rotate(270)" id="Tottenham_Court_Road_cr"/>
                
                <g>
                    <use xlink:href="#int" x="1176" y="786" id="Victoria"/>
                </g>

                
                <g>
                    <use xlink:href="#int" x="1334.36" y="733.98" id="Waterloo"/>
                </g>
                <g>
                    <use xlink:href="#stdistrict" transform="translate(831,920)rotate(180)" id="West_Brompton"/>
                </g>
                <g>
                    <use xlink:href="#int" x="2026" y="434" id="West_Ham"/>
                </g>
                <g>
                    <use xlink:href="#stjubilee" transform="translate(914,353)rotate(143.13)" id="West_Hampstead"/>
                </g>
                <use xlink:href="#int" x="1236" y="741" id="Westminster"/>
                <use xlink:href="#termbakerloo" transform="translate(694.5,467)rotate(126.87)" id="Willesden_Junction"/>
                <use xlink:href="#stcentral" transform="translate(624,723.9)rotate(90)" id="White_City"/>
            </g>
            <g id="Bakerloo_line_stations">
                <use xlink:href="#stbakerloo" transform="translate(725,490.5)rotate(126.87)" id="Kensal_Green_bakerloo"/>
                <use xlink:href="#stbakerloo" transform="translate(789,538.5)rotate(126.87)" id="Kilburn_Park"/>
                <use xlink:href="#stbakerloo" transform="translate(815,558)rotate(126.87)" id="Maida_Vale"/>
                <use xlink:href="#stbakerloo" transform="translate(841,577.5)rotate(126.87)" id="Warwick_Avenue"/>
                <g>
                    <use xlink:href="#stbakerloo" transform="translate(1001,522)rotate(-126.67)" id="Marylebone"/>
                </g>
                <use xlink:href="#stbakerloo" transform="translate(1091,517)rotate(-90)" id="Regents_Park"/>
                <use xlink:href="#stbakerloo" transform="translate(1420,768)rotate(90)" id="Lambeth_North"/>
            </g>
            <g id="Central_line_stations">
                <use xlink:href="#termcentral" transform="translate(483,703.9)rotate(-53.13)" id="North_Acton"/>
                <use xlink:href="#stcentral" transform="translate(580,723.9)rotate(-90)" id="East_Acton"/>
                <use xlink:href="#stcentral" transform="translate(806,723.9)rotate(90)" id="Holland_Park"/>
                <use xlink:href="#stcentral" transform="translate(930,723.9)rotate(90)" id="Queensway"/>
                <g>
                    <use xlink:href="#stcentral" transform="translate(996,691)rotate(233.13)" id="Lancaster_Gate"/>
                </g>
                <use xlink:href="#stcentral" transform="translate(1048,652)rotate(233.13)" id="Marble_Arch"/>
                <use xlink:href="#stcentral" transform="translate(1330,520)rotate(90)" id="Chancery_Lane"/>
                <use xlink:href="#stcentral" transform="translate(1410,540)rotate(143.13)" id="St_Pauls"/>
                <use xlink:href="#stcentral" transform="translate(1660,452)rotate(-90)" id="Bethnal_Green_central"/>
            </g>
            <g id="Circle_line_stations">
                <use xlink:href="#stdistrict" transform="translate(1020.3,723.9)rotate(203)translate(145.5,0)" id="Bayswater_district"/>
                <use xlink:href="#stcircle" transform="translate(1020.3,723.9)rotate(203)translate(140.5,0)" id="Bayswater_circle"/>
                <use xlink:href="#stcircle" transform="translate(1020.3,723.9)rotate(-36.87)translate(-140.5,0)" id="High_Street_Kensington_circle"/>
                <use xlink:href="#stdistrict" transform="translate(1020.3,723.9)rotate(-36.87)translate(-145.5,0)" id="High_Street_Kensington_district"/>
                <use xlink:href="#stdistrict" transform="translate(1136,819)rotate(53.13)" id="Sloane_Square_district"/>
                <use xlink:href="#stcircle" transform="translate(1133,815)rotate(53.13)" id="Sloane_Square_circle"/>
                <use xlink:href="#stdistrict" transform="translate(1210,763.5)rotate(53.13)" id="St_Jamess_Park_district"/>
                <use xlink:href="#stcircle" transform="translate(1207,759.5)rotate(53.13)" id="St_Jamess_Park_circle"/>
                <use xlink:href="#stcircle" transform="translate(1336,663)rotate(233.13)" id="Temple_circle"/>
                <use xlink:href="#stdistrict" transform="translate(1339,667)rotate(233.13)" id="Temple_district"/>
                <use xlink:href="#stcircle" transform="translate(1371,636.5)rotate(233.13)" id="Blackfriars_circle"/>
                <use xlink:href="#stdistrict" transform="translate(1374,640.5)rotate(233.13)" id="Blackfriars_district"/>
                <use xlink:href="#stcircle" transform="translate(1400,615)rotate(233.13)" id="Mansion_House_circle"/>
                <use xlink:href="#stdistrict" transform="translate(1403,619)rotate(233.13)" id="Mansion_House_district"/>
                <use xlink:href="#stcircle" transform="translate(1430,592.5)rotate(233.13)" id="Cannon_Street_circle"/>
                <use xlink:href="#stdistrict" transform="translate(1433,596.5)rotate(233.13)" id="Cannon_Street_district"/>
                <use xlink:href="#stcircle" transform="translate(1563,582.5)rotate(-90)" id="Tower_Hill_circle"/>
                <use xlink:href="#stdistrict" transform="translate(1563,587.5)rotate(-90)" id="Tower_Hill_district"/>
                <use xlink:href="#stmetropolitan" transform="translate(1205.7,407.3)rotate(66)" id="Euston_Square_metropolitan"/>
                <use xlink:href="#stcircle" transform="translate(1203.6,402.8)rotate(66)" id="Euston_Square_circle"/>
                <use xlink:href="#sthnc" transform="translate(1201.5,398.3)rotate(66)" id="Euston_Square_hnc"/>
                <use xlink:href="#sthnc" transform="translate(1390,456.625)rotate(323.33)" id="Farringdon_hnc"/>
                <use xlink:href="#stcircle" transform="translate(1386,459.625)rotate(323.33)" id="Farringdon_circle"/>
                <use xlink:href="#stmetropolitan" transform="translate(1382,462.625)rotate(323.33)" id="Farringdon_metropolitan"/>
                <use xlink:href="#sthnc" transform="translate(1417.8,488.8)rotate(-56)" id="Barbican_hnc"/>
                <use xlink:href="#stcircle" transform="translate(1415,493)rotate(-56)" id="Barbican_circle"/>
                <use xlink:href="#stmetropolitan" transform="translate(1412.2,497.2)rotate(-56)" id="Barbican_metropolitan"/>
                <use xlink:href="#sthnc" transform="translate(1111,461.5)rotate(233.13)" id="Great_Portland_Street_hnc"/>
                <use xlink:href="#stcircle" transform="translate(1114,465.5)rotate(233.13)" id="Great_Portland_Street_circle"/>
                <use xlink:href="#stmetropolitan" transform="translate(1117,469.5)rotate(233.13)" id="Great_Portland_Street_metropolitan"/>
                <use xlink:href="#stcircle" transform="translate(800,620)rotate(90)" id="Royal_Oak_circle"/>
                <use xlink:href="#sthnc" transform="translate(800,615)rotate(90)" id="Royal_Oak_hnc"/>
                <use xlink:href="#sthnc" transform="translate(722.5,641)rotate(233.13)" id="Westbourne_Park_hnc"/>
                <use xlink:href="#stcircle" transform="translate(725.5,645)rotate(233.13)" id="Westbourne_Park_circle"/>
                <use xlink:href="#stcircle" transform="translate(689.5,672)rotate(53.13)" id="Ladbroke_Grove_circle"/>
                <use xlink:href="#sthnc" transform="translate(686.5,668)rotate(53.13)" id="Ladbroke_Grove_hnc"/>
                <use xlink:href="#sthnc" transform="translate(652.5,693.5)rotate(233.13)" id="Latimer_Road_hnc"/>
                <use xlink:href="#stcircle" transform="translate(655.5,697.5)rotate(233.13)" id="Latimer_Road_circle"/>
                <use xlink:href="#stcircle" x="639.5" y="742.9" id="Wood_Lane_circle"/>
                <use xlink:href="#sthnc" x="634.5" y="742.9" id="Wood_Lane_hnc"/>
                <use xlink:href="#stcircle" x="639.5" y="772.9" id="Shepherds_Bush_Market_circle"/>
                <use xlink:href="#sthnc" x="634.5" y="772.9" id="Shepherds_Bush_Market_hnc"/>
                <use xlink:href="#stcircle" x="639.5" y="802.9" id="Goldhawk_Road_circle"/>
                <use xlink:href="#sthnc" x="634.5" y="802.9" id="Goldhawk_Road_hnc"/>
            </g>
            <g id="District_line_stations">
                <use xlink:href="#termdistrict" transform="translate(521,835)rotate(-53.13)" id="Turnham_Green_district"/>
                <use xlink:href="#stdistrict" transform="translate(545,853)rotate(126.87)" id="Stamford_Brook"/>
                <use xlink:href="#stdistrict" transform="translate(587,869.4)rotate(90)" id="Ravenscourt_Park"/>
                <use xlink:href="#stdistrict" transform="translate(705,869.4)rotate(90)" id="Barons_Court_district"/>
                <use xlink:href="#stdistrict" transform="translate(780,869.4)rotate(90)" id="West_Kensington"/>
                <use xlink:href="#sthnc" transform="translate(1653,553.5)rotate(-90)" id="Aldgate_East_hnc"/>
                <use xlink:href="#stdistrict" transform="translate(1653,558.5)rotate(-90)" id="Aldgate_East_district"/>
                <use xlink:href="#stdistrict" transform="translate(1702,534)rotate(53.13)" id="Whitechapel_district"/>
                <use xlink:href="#sthnc" transform="translate(1699,530)rotate(53.13)" id="Whitechapel_hnc"/>
                <use xlink:href="#stdistrict" transform="translate(1755.5,494)rotate(53.13)" id="Stepney_Green_district"/>
                <use xlink:href="#sthnc" transform="translate(1752.5,490)rotate(53.13)" id="Stepney_Green_hnc"/>
                <use xlink:href="#sthnc" transform="translate(1878,431.5)rotate(90)" id="Bow_Road_hnc"/>
                <use xlink:href="#stdistrict" transform="translate(1878,436.5)rotate(90)" id="Bow_Road_district"/>
                <use xlink:href="#sthnc" transform="translate(1963,431.5)rotate(90)" id="Bromley-by-Bow_hnc"/>
                <use xlink:href="#stdistrict" transform="translate(1963,436.5)rotate(90)" id="Bromley-by-Bow_district"/>
                <use xlink:href="#stdistrict" transform="translate(831,960)rotate(180)" id="Fulham_Broadway"/>
                <use xlink:href="#stdistrict" transform="translate(840,987.5)rotate(143.33)" id="Parsons_Green"/>
                <use xlink:href="#stdistrict" transform="translate(861,1015.5)rotate(143.33)" id="Putney_Bridge"/>
                <g>
                    <use xlink:href="#termdistrict" transform="translate(882,1043.5)rotate(143.33)" id="East_Putney"/>
                </g>
            </g>
            <g id="Hammersmith_And_City_line_stations">
            </g>
            <g id="Jubilee_line_stations">
                <use xlink:href="#termjubilee" transform="translate(801,309)rotate(90)" id="Willesden_Green"/>
                <use xlink:href="#stjubilee" transform="translate(957.5,411)rotate(143.13)" id="Swiss_Cottage"/>
                <use xlink:href="#stjubilee" transform="translate(995,461)rotate(143.13)" id="St_Johns_Wood"/>
                <g>
                    <use xlink:href="#stjubilee" transform="translate(1380.2,699.6)rotate(53.13)" id="Southwark"/>
                </g>
                <use xlink:href="#stjubilee" transform="translate(1590,675)rotate(90)" id="Bermondsey"/>
                <use xlink:href="#stjubilee" transform="translate(2000,648)rotate(90)" id="North_Greenwich"/>
            </g>
            <g id="Metropolitan_line_stations">
            </g>
            <g id="Northern_line_stations">
                <use xlink:href="#stnorthern" transform="translate(1108,195)rotate(-53.13)" id="Tufnell_Park"/>
                <use xlink:href="#stnorthern" transform="translate(1389,469.5)rotate(110)translate(-90)" id="Angel"/>
                <g>
                    <use xlink:href="#stnorthern" transform="translate(1389,469.5)rotate(150)translate(-90)" id="Old_Street"/>
                </g>
                <use xlink:href="#stnorthern" x="1479" y="720" id="Borough"/>
                <use xlink:href="#int" x="1362.5" y="866" id="Kennington"/>
                <use xlink:href="#stnorthern" transform="translate(1328.5,898)rotate(53.13)" id="Oval"/>
                <use xlink:href="#stnorthern" transform="translate(1210.5,986.5)rotate(53.13)" id="Clapham_Common"/>
                <use xlink:href="#termnorthern" transform="translate(1180.5,1009)rotate(53.13)" id="Clapham_South"/>
            </g>
            <g id="Edgware_line_stations">
                <use xlink:href="#termedgware" transform="translate(948,261)rotate(126.87)" id="Hampstead"/>
                <use xlink:href="#stedgware" transform="translate(1010,281)rotate(90)" id="Belsize_Park"/>
                <use xlink:href="#stedgware" transform="translate(1090,281)rotate(90)" id="Chalk_Farm"/>
                <use xlink:href="#stedgware" x="1202" y="332" id="Mornington_Crescent"/>
                <use xlink:href="#stedgware" x="1163" y="450" id="Goodge_Street"/>
                <use xlink:href="#stedgware" transform="translate(1193.5,908)rotate(233.13)" id="Nine_Elms"/>
                <use xlink:href="#termedgware" transform="translate(1134,927.25)rotate(90)" id="Battersea_Power_Station"/>
            </g>
            <g id="Piccadilly_line_stations">
                <use xlink:href="#termpiccadilly" transform="translate(530,823)rotate(-53.13)" id="Turnham_Green_piccadilly"></use>
                <use xlink:href="#stpiccadilly" transform="translate(705,854.4)rotate(90)" id="Barons_Court_piccadilly"/>
                <use xlink:href="#stpiccadilly" transform="translate(1114.6,766)rotate(180)" id="Knightsbridge"/>
                <use xlink:href="#stpiccadilly" transform="translate(1114.6,726)rotate(180)" id="Hyde_Park_Corner"/>
                <use xlink:href="#stpiccadilly" transform="translate(1250,549.25)rotate(216.87)translate(-40)" id="Covent_Garden"/>
                <use xlink:href="#stpiccadilly" x="1290" y="450" id="Russell_Square"/>
                <use xlink:href="#stpiccadilly" transform="translate(1306,260)rotate(53.13)" id="Caledonian_Road"/>
                <use xlink:href="#stpiccadilly" transform="translate(1336,237.5)rotate(233.13)" id="Holloway_Road"/>
                <use xlink:href="#stpiccadilly" transform="translate(1366,215)rotate(233.13)" id="Arsenal"/>
                <use xlink:href="#termpiccadilly" transform="translate(1382.5,159)rotate(180)" id="Manor_House"/>
            </g>
            <g id="Victoria_line_stations">
                <use xlink:href="#stvictoria" transform="translate(1206,826)rotate(-36.87)" id="Pimlico"/>
                <use xlink:href="#stvictoria" transform="translate(1236,866)rotate(-36.87)" id="Vauxhall"/>
                <g>
                    <use xlink:href="#termvictoria" transform="translate(1305,958)rotate(-36.87)" id="Brixton"/>
                </g>
            </g>
        </g>
        
        <g id="text">
            <g class="st" id="stname" transform="translate(0,4)" opacity="1">
                <g id="stname_interchanges" class="b">
                    <text x="1591.5" y="541.5" class="end">Aldgate</text>
                    <text x="1653" y="525" class="mid">Aldgate<tspan x="1683" dy="0"> </tspan><tspan x="1653" dy="13">East</tspan></text>
                    <text x="1057" y="165.75" class="end">Archway</text>
                    <text x="1053" y="528">Baker <tspan x="1062" dy="13">Street</tspan></text>
                    <text x="1465" y="555" class="end">Bank</text>
                    <text x="1444" y="474" class="mid">Barbican</text>
                    <text x="1362" y="630" class="end">Blackfriars</text>
                    <g transform="translate(1052,600)">
                        <text x="0" y="0" class="textbg">Bond <tspan x="-2" dy="13">Street</tspan></text>
                        <text x="0" y="0">Bond <tspan x="-2" dy="13">Street</tspan></text>
                    </g>
                    <text x="1893" y="453.5" class="end">Bow<tspan x="1893" dy="13"> Road</tspan></text>
                    <text x="1180" y="298" class="end"><tspan>Camden</tspan><tspan x="1180" dy="13"> <tspan>Town</tspan></tspan></text>
                    <text x="1722" y="689" class="end">Canada<tspan x="1718" dy="13"> Water</tspan></text>
                    <text x="1870" y="665">Canary <tspan x="1875" dy="15">Wharf</tspan></text><!--Jubilee line-->
                    <text x="2040" y="578">Canning <tspan x="2040" dy="13">Town</tspan></text>
                    <text x="1426" y="568" class="end">Cannon<tspan x="1426" dy="13"> Street</tspan></text>
                    <text x="1277" y="677" class="end">Charing Cross</text>
                    <text x="1244.5" y="977">Clapham North</text>
                    
                    <text x="871" y="886.4" class="mid">Earl's<tspan x="892" dy="0"> </tspan><tspan x="871" dy="13">Court</tspan></text>
                    <text x="1484" y="759">Elephant &amp; Castle</text>
                    <text x="1282" y="695" class="end">Embankment</text>
                    <text x="1215" y="362">Euston</text><!--tube-->
                    <text x="1214" y="417">Euston <tspan x="1214" dy="13">Square</tspan></text>
                    <text x="1400" y="452">Farringdon</text><!--tube-->
                    <text x="957" y="368">Finchley <tspan x="963" dy="13">Road</tspan></text>
                    <text x="1375" y="183" class="end">Finsbury Park</text>
                    <text x="1142" y="670" class="end">Green Park</text>
                    <text x="1020.3" y="884" class="mid">Gloucester<tspan x="1062" dy="0"> </tspan><tspan x="1020.3" dy="13">Road</tspan></text>
                    <text x="647" y="843">Hammersmith</text>
                    <text x="1432" y="290">Highbury &amp; <tspan x="1432" dy="15">Islington</tspan></text>
                    <text x="1345" y="508" class="end">Holborn</text>
                    <text x="818" y="806" class="end">Kensington<tspan x="818" dy="15"> (Olympia)</tspan></text>
                    <text x="1138" y="203">Kentish Town</text>
                    <text x="1295" y="349">King's Cross <tspan x="1295" dy="15">St. Pancras</tspan></text>
                    <text x="1269" y="595">Leicester <tspan x="1273" dy="13">Square</tspan></text>=
                    <text x="1590" y="470" class="end">Liverpool<tspan x="1572" dy="15"> Street</tspan></text><!--tube - NR-->
                    <text x="1485" y="659">London Bridge</text>
                    <text x="1816" y="459.5">Mile <tspan x="1816" dy="13">End</tspan></text>
                    <g transform="translate(1485,602)">
                        <text x="0" y="0" class="textbg">Monument</text>
                        <text x="0" y="0">Monument</text>
                    </g>
                    <text transform="translate(1484,514)scale(0.9,1)">Moorgate</text>
                    <text x="869" y="700.5" class="end">Notting<tspan x="869" dy="13"> Hill Gate</tspan></text>
                    <text x="1164" y="574">Oxford <tspan x="1170" dy="13">Circus</tspan></text>
                    <text x="945" y="617">Paddington</text>
                    <text x="1213" y="637">Piccadilly <tspan x="1218" dy="13">Circus</tspan></text>
                    <text x="754" y="527" class="end">Queen's Park</text>
                    <text x="688" y="699">Shepherd's <tspan x="700" dy="15">Bush</tspan></text>
                    <text x="1296" y="933">Stockwell</text>
                    <text x="1960" y="318" class="end">Stratford</text>
                    <text x="1085" y="813" class="end">South<tspan x="1085" dy="13"> Kensington</tspan></text>
                    <text x="1205" y="484">Tottenham <tspan x="1205" dy="13">Court <tspan x="1205" dy="13">Road</tspan></tspan></text>
                    <text x="1543" y="567" class="mid">Tower Hill</text>
                    <!-- <text x="1573" y="602" class="mid">Tower<tspan x="1586" dy="0"> </tspan><tspan x="1573" dy="13">Hill</tspan></text> -->
                    <text x="1188" y="793">Victoria</text>
                    <text x="1148" y="404" class="end">Warren Street</text>
                    <text x="1350" y="736">Waterloo</text>
                    <text x="816.5" y="920" class="end">West Brompton</text>
                    <text x="2037" y="450">West <tspan x="2037" dy="13">Ham</tspan></text>
                    <text x="917" y="369" class="end">West<tspan x="917" dy="13"> Hampstead</tspan></text>			
                    <text x="1243" y="754">Westminster</text>
                    <text x="683" y="466.5" class="end">Willesden Junction</text>
                    <text x="1716" y="536">Whitechapel</text>
                    <text x="652" y="744">Wood Lane</text>
                </g>
                <g id="stname_Bakerloo_line">
                    <g class="end">
                        <text x="715" y="496">Kensal<tspan x="715" dy="13"> Green</tspan></text>
                        <text x="779" y="547">Kilburn Park</text>
                        <text x="805" y="566.5">Maida Vale</text>
                        <text x="831" y="586">Warwick Avenue</text>
                        <text x="961" y="536">Edgware Road</text>
                        <text x="991" y="513.5">Marylebone</text>
                    </g>
                    <text x="1088" y="502">Regent's <tspan x="1114" dy="13">Park</tspan></text>
                    <text x="1420" y="785" class="mid">Lambeth<tspan x="1452" dy="0"> </tspan><tspan x="1420" dy="13">North</tspan></text>
                </g>
                <g id="stname_Central_line">
                    <text x="491" y="678">North <tspan x="491" dy="13">Acton</tspan></text>
                    <g class="mid">
                        <text x="580" y="693.9">East<tspan x="597" dy="0"> </tspan><tspan x="580" dy="13">Acton</tspan></text>
                    </g>
                    <text x="624" y="737" class="end b">White<tspan x="624" dy="13"> City</tspan></text>
                    <text x="806" y="741" class="mid">Holland Park</text>
                    <text x="930" y="740.9" class="mid">Queensway</text>
                    <g class="end">
                        <text x="986" y="669.5">Lancaster<tspan x="986" dy="13"> Gate</tspan></text>
                        <text x="1038" y="643.5">Marble Arch</text>
                    </g>
                    <text x="1330" y="535" class="mid">Chancery<tspan x="1364" dy="0"> </tspan><tspan x="1330" dy="13">Lane</tspan></text>
                    <text x="1400" y="540" class="end">St.<tspan x="1400" dy="13"> Paul's</tspan></text>
                    <text x="1655" y="435">Bethnal Green</text>
                </g>
                <g id="stname_Circle_line">
                    <text transform="translate(1000,562)" class="b">Edgware <tspan x="0" dy="13">Road</tspan></text>
                    <text x="875" y="660" class="end">Bayswater</text>
                    <text x="918" y="789.5">High Street <tspan x="918" dy="13">Kensington</tspan></text>
                    <text x="1127" y="835">Sloane <tspan x="1127" dy="13">Square</tspan></text>
                    <text x="1220" y="772">St. James's Park</text>
                    <g class="end">
                        <text x="1336" y="648">Temple</text>
                        <text x="1402" y="598">Mansion<tspan x="1390" dy="13"> House</tspan></text>
                        <text x="1101" y="443">Great Portland<tspan x="1101" dy="13"> Street</tspan></text>
                        <text x="732.5" y="619.5">Westbourne<tspan x="712.5" dy="13"> Park</tspan></text>
                        <text x="642.5" y="672">Latimer<tspan x="642.5" dy="13"> Road</tspan></text>
                    </g>
                    <text x="800" y="637" class="mid">Royal Oak</text>
                    <text x="699.5" y="680.5">Ladbroke Grove</text>
                    <text x="651.5" y="767.9">Shepherd's <tspan x="651.5" dy="15">Bush Market</tspan></text>
                    <text x="651.5" y="804.9">Goldhawk <tspan x="651.5" dy="13">Road</tspan></text>
                </g>
                <g id="stname_District_line_and_Hammersmith_And_City_line">
                    <text x="540" y="814.5"><tspan>Turnham</tspan> <tspan x="550" dy="13">Green</tspan></text>
                    <text x="535" y="855.5" class="end">Stamford<tspan x="535" dy="13"> Brook</tspan></text>
                    <g class="mid">
                        <text x="587" y="886.4">Ravenscourt<tspan x="630" dy="0"> </tspan><tspan x="587" dy="13">Park</tspan></text>
                        <text x="705" y="886.4">Barons<tspan x="731" dy="0"> </tspan><tspan x="705" dy="13">Court</tspan></text>
                        <text x="780" y="886.4">West<tspan x="800" dy="0"> </tspan><tspan x="780" dy="13">Kensington</tspan></text>
                        <text x="1963" y="453.5">Bromley-by-Bow</text>
                    </g>
                    <text x="1765.5" y="496.5">Stepney <tspan x="1765.5" dy="13">Green</tspan></text>
                    <g class="end">
                        <text x="819" y="960">Fulham Broadway</text>
                        <text x="830" y="996">Parsons Green</text>
                        <text x="851" y="1024">Putney Bridge</text>
                        <text x="872" y="1052">East Putney</text>
                    </g>
                </g>
                <g id="stname_Jubilee_line">
                    <g>
                        <text x="768" y="326">Willesden<tspan x="835" dy="0"> </tspan><tspan x="768" dy="13">Green</tspan></text>
                        <text x="836" y="326" class="b">Kilburn</text>
                    </g>
                    <text x="947.5" y="419.5" class="end">Swiss Cottage</text>
                    <text x="985" y="469.5" class="end">St. John's<tspan x="985" dy="13"> Wood</tspan></text>
                    <text x="1390" y="708">Southwark</text>
                    <text x="1590" y="692" class="mid">Bermondsey</text>
                    <text x="2000" y="665" class="mid">North<tspan x="2020" dy="0"> </tspan><tspan x="2000" dy="13">Greenwich</tspan></text>
                </g>
                <g id="stname_Metropolitan_line">
                </g>
                <g id="stname_Northern_line">
                    <text x="938" y="269.5" class="end">Hampstead</text>
                    <text x="1010" y="298" class="mid">Belsize<tspan x="1035" dy="0"> </tspan><tspan x="1010" dy="13">Park</tspan></text>
                    <text x="1090" y="298" class="mid">Chalk<tspan x="1111" dy="0"> </tspan><tspan x="1090" dy="13">Farm</tspan></text>
                    <text x="1116" y="184.5">Tufnell Park</text>
                    <text transform="translate(1213,325)scale(0.93,1)">Mornington <tspan x="0" dy="13">Crescent</tspan></text>
                    <text x="1175" y="450">Goodge Street</text>
                    <text x="1418" y="401" class="end">Angel</text>
                    <text x="1455" y="425" class="end">Old Street</text>
                    <text x="1491" y="720">Borough</text>
                    <text x="1376" y="875" class="b">Kennington</text>
                    <text x="1338.5" y="906.5">Oval</text>
                    <text x="1220.5" y="995">Clapham Common</text>
                    <text x="1190.5" y="1018">Clapham South</text>
                    <text x="1182.5" y="898.5" dy="-6" class="end">Nine<tspan x="1182.5" dy="13"> Elms</tspan></text>
                    <text x="1125" y="927.25" class="end">Battersea Power Station</text>
                </g>
                <g id="stname_Piccadilly_line">
                    <g class="end">
                        <text x="1102.6" y="766">Knightsbridge</text>
                        <text x="1102.6" y="720">Hyde Park<tspan x="1102.6" dy="13"> Corner</tspan></text>
                    </g>
                    <text x="1302" y="445">Russell <tspan x="1302" dy="13">Square</tspan></text>
                    <text x="1302" y="278">Caledonian Road</text>
                    <g class="end">
                        <text x="1326" y="229">Holloway Road</text>
                        <text x="1356" y="206.5">Arsenal</text>
                        <text x="1370.5" y="160">Manor House</text>
                        <text x="1284" y="544">Covent<tspan x="1284" dy="13"> Garden</tspan></text>
                    
                    </g>
                </g>
                <g id="stname_Victoria_line">
                    <text x="1216" y="817.5">Pimlico</text>
                    <text x="1246" y="857.5">Vauxhall</text>
                    <text x="1317" y="958">Brixton</text>
                </g>
                    <!-- <g class="b">
                        <text transform="translate(808,543)rotate(36.87)" class="fbakerloo">Bakerloo line</text>
                        <text x="1420" y="758" class="fbakerloo mid">Bakerloo line</text>
                        <text transform="translate(415,642)rotate(36.87)" class="fcentral">Central line</text>
                        <text transform="translate(1050,662)rotate(-36.87)" class="fcentral">Central line</text>
                        <text transform="translate(1985,280)rotate(53.13)" class="fcentral end">Central line</text>
                        <g class="fcircle">
                            <text transform="translate(714,665)rotate(-36.87)">Circle line</text>
                            <text transform="translate(1020.3,723.9)rotate(205)translate(129,0)rotate(90)" class="mid">Circle</text>
                            <text transform="translate(1020.3,723.9)rotate(219)translate(129,0)rotate(90)" class="mid">line</text>
                        </g>
                        <g class="fdistrict">
                            <text x="908" y="878">District line</text>
                            <g class="end">
                                <text transform="translate(484,829)rotate(-36.87)">District line</text>
                                <text transform="translate(2218,305)rotate(-36.87)">District line</text>
                                <text transform="translate(932,1097.5)rotate(53.33)">District line</text>
                            </g>
                            <text transform="translate(1020.3,723.9)rotate(167)translate(158,0)rotate(-90)" class="mid">District</text>
                            <text transform="translate(1020.3,723.9)rotate(155)translate(158,0)rotate(-90)" class="mid">line</text>
                        </g>
                        <text transform="translate(620,837)rotate(90)" class="fhnc end">Hammersmith<tspan x="0" dy="10"> &amp; City line</tspan></text>
                        <text transform="translate(2144,354)rotate(-36.87)" cursor="help" class="fhnc end"><title>Hammersmith &amp; City line</title>H&amp;C line</text>
                        <text transform="translate(640,211.5)rotate(90)" class="fjubilee">Jubilee line</text>
                        <text transform="translate(1163,674)rotate(53.13)" class="fjubilee">Jubilee line</text>
                        <text transform="translate(1978,343)rotate(53.13)" class="fjubilee">Jubilee line</text>
                        <text x="544" y="284" class="fmetropolitan">Metropolitan line</text>
                        <g class="fnorthern">
                            <text transform="translate(977,109)rotate(36.87)">Northern line</text>
                            <text transform="translate(1409,849)rotate(-36.87)">Northern line</text>
                        </g>
                        <g class="fedgware">
                            <text transform="translate(763,133.5)rotate(36.87)">Northern line</text>
                            <text transform="translate(1204,542)rotate(53.33)scale(0.9,1)">Northern line</text>
                            <text transform="translate(1387,813)rotate(53.13)" class="end">Northern<tspan x="0" dy="10"> line</tspan></text>
                        </g>
                        <g class="fpiccadilly">
                            <text transform="translate(324,836)rotate(-36.87)" class="end">Piccadilly line</text>
                            <text transform="translate(391,500)rotate(90)">Piccadilly line</text>
                            <text transform="translate(1121,705)rotate(90)">Piccadilly line</text>
                            <text transform="translate(1372,89)rotate(36.87)" class="end">Piccadilly line</text>
                        </g>
                        <text x="1612" y="121" class="fvictoria">Victoria line</text>
                        <text transform="translate(1141,682)rotate(90)" class="fvictoria">Victoria line</text>
                        <text transform="translate(1361,676)rotate(-36.87)" class="fwnc" cursor="help"><title>Waterloo &amp; City line. Out of service on Sundays or public holidays.</title>Waterloo &amp; City line</text>
                    </g> -->
                <g id="timestamps">
                    <text class="ts" x="100" y="200"></text>
                </g>
            </g>
        </g>

        <g id="key_to_lines_box" transform="translate(2045,1010)">
            <rect x="0.5" y="0.5" width="410" height="200" rx="25" fill="#fff"/>
            <rect x="0" y="0" width="410" height="180" rx="25" style="fill:#fff;fill-opacity:0;stroke:#009;stroke-width:2.5"/>
            <path style="stroke:none;fill:#009" d="   M 1.25,25   h 410   a 25,25 0 0,0 -25,-25   h -361.25   a 25,25 0 0,0 -25,25   "/>
            <text x="205" y="17" class="b mid" style="font-size:15px;fill:#fff">Key to lines</text>
            <g class="me">
                <path class="sbakerloo" d="M 10,48 h 190"/>
                <path class="scentral" d="M 10,70 h 190"/>
                <path class="scircle" d="M 10,92 h 190"/>
                <path class="sdistrict" d="M 10,114 h 190"/>
                <path class="sedgware" d="M 10,137 h 190"/>
                <path class="shnc" d="M 10,158 h 190"/>
                <path class="sjubilee" d="M 210,48 h 190"/>
                <path class="smetropolitan" d="M 210,70 h 190"/>
                <path class="snorthern" d="M 210,92 h 190"/>
                <path class="spiccadilly" d="M 210,114 h 190"/>
                <path class="svictoria" d="M 210,137 h 190"/>
                <g class="swnc">
                    <path id="legend_swnc" d="M 210,158 h 190"/>
                </g>
            </g>
            <g class="st">
                <g transform="translate(10,25)">
                    <text class="st">
                        <tspan x="0" dy="18" class="tleg" id="lbakerloo">Bakerloo line </tspan>
                        <tspan x="0" dy="22" class="tleg" id="lcentral">Central line </tspan>
                        <tspan x="0" dy="22" class="tleg" id="lcircle">Circle line </tspan>
                        <tspan x="0" dy="22" class="tleg" id="ldistrict">District line </tspan>
                        <tspan x="0" dy="22" class="tleg" id="ledgware">Northern line (west) </tspan>
                        <tspan x="0" dy="22" class="tleg" id="lhnc">Hammersmith &amp; City line </tspan>
                        <tspan x="200" y="18" class="tleg" id="ljubilee">Jubilee line </tspan>
                        <tspan x="200" dy="22" class="tleg" id="lmetropolitan">Metropolitan line </tspan>
                        <tspan x="200" dy="22" class="tleg" id="lnorthern">Northern line (east)</tspan>
                        <tspan x="200" dy="22" class="tleg" id="lpiccadilly">Piccadilly line </tspan>
                        <tspan x="200" dy="22" class="tleg" id="lvictoria">Victoria line </tspan>
                        <tspan x="200" dy="22" class="tleg" id="lwnc">Waterloo &amp; City line </tspan>
                    </text>
                </g>
            </g>
        </g>

        <g id="key_to_colours" transform="translate(2430,-80)">
            <g class="me">
                <path id="keyToColours" class="original" style="stroke:grey" d="M 0,0 v400"/>
            </g>
            <g class="me">
                <text class="st">
                    <tspan x="10" y="-20" class="end" style="font-size:15px" id="keyTitle">Title [Unit]</tspan>
                    <tspan x="-10" y="6" class="end" id="keyMaxVal">max value</tspan>
                    <tspan x="-10" y="200" class="end" id="keyUpperThreshold">upperThreshold</tspan>
                    <tspan x="-10" y="300" class="end" id="keyLowerThreshold">lowerThreshold</tspan>
                    <tspan x="-10" y="403" class="end" id="keyMinVal">min value</tspan>
                </text>
                <path id="upperThresholdMarker" style="stroke:black" d="M -5,200 h10"/>
                <path id="lowerThresholdMarker" style="stroke:black" d="M -5,300 h10"/>
            </g>
        </g>
    </svg>

    <div id="output"></div>

    <footer class="footer">Alternative route map of London Underground, London Overground, Docklands Light Railway and Elizabeth line licensed under Creative Commons Attribution-Share Alike 4.0 International by Wikimedians</footer>


    <script>
        // function to get the constants from const.json
        function Get(url) {
          var xhr = new XMLHttpRequest();
          xhr.open("GET", url, true);
          xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
              var data = JSON.parse(xhr.responseText);
              return data;
            }
          };
          xhr.send();
        }

        var constJson

        fetch('Consts.json')
          .then(response => response.json())
          .then(data => {
            constJson = data;
            startUp();
          })
          .catch(error => console.error(error));

        // read in consts.json
        // var constJson = Get("Consts.json");

        // initialise everything on first load after ConstJSON is loaded
        function startUp() {
          
            // console.log(constJson);
            var isDev = <?php echo $login ?>;
            var isSuperuser = <?php echo $superuser ?>;

            if (isDev) {
                const devmodes = document.querySelectorAll('.devmode');
                devmodes.forEach(dev => {
                    dev.style.display = 'block';
                });
            }
            if (isSuperuser) {
                document.getElementById("d_timestamp").style.display = "block";
            }


            // initialise map on first load
            changeColors();

        }

        // is called when corresponding textbox is selected. 
        // shows the timestamps of the recordings next to stations
        function showTimestamps() {
            var c_timestamp = document.getElementById("c_timestamp");
            if (c_timestamp.checked) {
                var selectLinesDiv = document.getElementById("selectLines");
                var all_checkboxes = selectLinesDiv.getElementsByTagName('input');
                let n = 0;
                for (let i = 0; i < all_checkboxes.length; i++) {
                    var nameOfLine = all_checkboxes[i].name.split("_")[1]
                    var className = "p_" + nameOfLine;
                    var all_paths = document.getElementsByClassName(className)
                    var patharray = Object.values(all_paths);
                    for (let path in patharray) {
                        getDataset(patharray[path], "Timestamp", "Timestamp", 0, 0, 0, 0);
                    }
                }
            }
            else {
                removeTimestamps();
            }
        }

        function removeTimestamps() {
            var allTsClones = document.getElementsByClassName("timestampclone");
            var tsarray = Object.values(allTsClones);
            tsarray.forEach(removePaths);
        }

        // is called on load and whenever a new radio button is clicked
        // updates the key on the right hand side and
        // "reclicks" the checkboxes, which are checked to activate their onclick event
        function changeColors() {
            updateKey();
            var selectLinesDiv = document.getElementById("selectLines");
            var all_checkboxes = selectLinesDiv.getElementsByTagName('input');
            let n = 0;
            for (let i = 0; i < all_checkboxes.length; i++) {
                if (all_checkboxes[i].checked) {
                    all_checkboxes[i].click();
                    all_checkboxes[i].click();
                }
            }

            if (document.getElementById("c_timestamp").checked) {
                removeTimestamps();
                showTimestamps();
            }
        }

        
        // onclick event of the checkboxes for the different tube lines
        function lineChange(nameOfLine) {
            // check which radio button is checked
            var radioValue = document.querySelector('input[name="r_data"]:checked').value;
            const valueArray = radioValue.split("&&");
            var dataType = valueArray[0];
            var dataName = valueArray[1];

            // get corresponding min and max values
            var minVal = constJson["DataTypes"][dataType][dataName]["min"];
            var maxVal = constJson["DataTypes"][dataType][dataName]["max"];
            var lower_threshold = constJson["DataTypes"][dataType][dataName]["lower_threshold"];
            var upper_threshold = constJson["DataTypes"][dataType][dataName]["upper_threshold"];

            // check how many lines are selected (aka how many checkboxes are checked)
            var selectLinesDiv = document.getElementById("selectLines");
            var all_checkboxes = selectLinesDiv.getElementsByTagName('input');
            let n = 0;
            for (let i = 0; i < all_checkboxes.length; i++) {
                if (all_checkboxes[i].checked) {
                    n++;
                }
            }

            // get all paths and station ticks
            const inner_original = document.getElementsByClassName('inner_original');
            const station_ticks = document.getElementsByClassName('stationcolour');
            // if no checkboxes are ticked, remove the grey colour (aka recolour the lines)
            if (n==0) {
                for (const elem of inner_original) {
                    elem.classList.remove("grey");
                }
                for (const ticks of station_ticks) {
                    ticks.getElementsByTagName("*")[0].classList.remove("grey");
                }
            }
            // otherwise make all lines and ticks grey
            else {
                for (const elem of inner_original) {
                    elem.classList.add("grey");
                }
                for (const ticks of station_ticks) {
                    ticks.getElementsByTagName("*")[0].classList.add("grey");
                }
            }

            
            // get class name of current tube line
            var className = "p_" + nameOfLine;
            // var tickStName = "st" + nameOfLine;
            // var tickTermName = "term" + nameOfLine;

            // if checkbox is checked (aka line is selected), cycle through every segment
            // and colour each segment in by calling getDataset function for each segment
            if (document.getElementById("c_" + nameOfLine).checked) {
                // document.getElementById(tickStName).getElementsByTagName("*")[0].classList.remove("grey");
                // document.getElementById(tickTermName).getElementsByTagName("*")[0].classList.remove("grey");
                var all_paths = document.getElementsByClassName(className)
                var patharray = Object.values(all_paths);
                for (let path in patharray) {
                    getDataset(patharray[path], dataType, dataName, minVal, maxVal, lower_threshold, upper_threshold);
                }
            }
            // otherwise checkbox has just been unchecked and the data colouring has to be removed
            else {
                var path_clones = document.getElementById("routes").querySelectorAll("." + className + ".clone");
                var patharray = Object.values(path_clones);
                patharray.forEach(removePaths);
            }
        }
            

        // this function finds the correct data for a single segment for the chosen parameters and initiates the colouring
        function getDataset(path, dataType, dataName, minVal, maxVal, lower_threshold, upper_threshold){
            // detect the correct segment and direction
            const station_from = path.getAttribute("station_from");
            const station_to = path.getAttribute("station_to");
            const line = path.getAttribute("line");
            var changedDirection = document.getElementById("c_changeDirection").checked;

            // create the url for the database query
            // var url = "http://{{ BaseURL }}/data/" + station_to + "/" + station_from + "/" + line + "/" + dataType + "/" + dataName;
            // if (changedDirection) {
            //     url = "http://{{ BaseURL }}/data/" + station_from + "/" + station_to + "/" + line + "/" + dataType + "/" + dataName;
            // }

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

        function displayTimeStamps(dataset, path) {
            var xy = path.getAttribute("d").split(" ")[1].split(",");
            // console.log(xy);
            var timestamp_node = document.getElementById("timestamps");
            var ts = document.getElementsByClassName("ts")[0];

            var dateObject = new Date(parseInt(dataset[0]) * 1000);
            var humanDateFormat = dateObject.toLocaleString();

            if (path.getAttribute("station_from") == null) {
                console.log(path);
            }
            var thisid = path.getAttribute("station_from").replace(/['".&]+/g, '').replace(/ /g,'');
            var existingText = document.getElementById("ts_" + thisid);

            var line = path.getAttribute("line").replace(/['".&]+/g, '').replace(/ /g,'');

            if (existingText) {
                // var children = existingText.children;
                // var alreadyIncluded = false;
                // for (i=0; i<children.length; i++) {
                //     if (children[i].classList.contains(line)) {
                //         alreadyIncluded = true;
                //     }
                // }
                // if (!alreadyIncluded) {
                    // var offset = -5;
                    addChild(humanDateFormat, existingText, -5, line);
                // }
            }
            else {
                var newts = ts.cloneNode(true);
                newts.classList.add("timestampclone");
                newts.id = "ts_" + thisid;
                newts.setAttribute("x", (parseInt(xy[0]) + 10).toString());
                newts.setAttribute("y", (parseInt(xy[1]) - 10).toString());
                addChild(humanDateFormat, newts, 0, line);

                timestamp_node.appendChild(newts);
            }
        }

        function addChild(value, parent, offset, line) {
            var text = document.createElementNS('http://www.w3.org/2000/svg', 'tspan');
            if (parent.getAttribute("x") == null){
                console.log(parent.id);
            }
            text.setAttribute('x', parent.getAttribute("x"));
            text.setAttribute('dy', offset);
            text.classList.add(line);
            text.innerHTML = line + ": " + value;

            parent.appendChild(text);
        }

        function checkSensorID(dataset) {
            // console.log(dataset);
            var obj = {};
            for (let i = 0; i < dataset.length; i++) {
                var el = dataset[i];
                var tsid = el["DBid"];
                // console.log(el["DataValue"]);
                var datavalue = parseFloat(el["DataValue"]);
                if (!obj[tsid]) {
                    obj[tsid] = [datavalue, 1]
                } else {
                    obj[tsid] = [obj[tsid][0] + datavalue, obj[tsid][1] + 1]
                }
            }

            average = []
            for (var p in obj) {
                average.push([p, obj[p][0] / obj[p][1]]);                
            }

            average.sort(function(a,b) {
                return a[0]-b[0]
            });

            return average
        }

        function colourPaths (dataset, minVal, maxVal, lower_threshold, upper_threshold, changedDirection, path) {
            // transform values into colours
            var cur_colors = ColorsByMinMax(dataset, minVal, maxVal, lower_threshold, upper_threshold, changedDirection);
            // seperate the segment into as many parts as there are datapoints
            var total = cur_colors.length;
            var length = path.getTotalLength();
            var offset = length / total;
            
            // create a subpath for each datapoint with a single colour
            for (let i = 0; i < cur_colors.length; i++) {
                var clone = path.cloneNode(true);
                var dasharray = String(offset) + "," + String(length-offset);
                clone.style.strokeDasharray = dasharray;
                clone.style.stroke = cur_colors[i];
                clone.style.strokeDashoffset = -i*offset;
                clone.classList.add("clone");
                
                path.parentNode.appendChild(clone);
            }
        }

               
        // remove the colouring of this path
        function removePaths(path, n) {
            path.remove();
        }

        function updateKey() {
            // check which radio button is checked
            var radioValue = document.querySelector('input[name="r_data"]:checked').value;
            const valueArray = radioValue.split("&&");
            var dataType = valueArray[0];
            var dataName = valueArray[1];
            // get corresponding min and max values
            var name = constJson["DataTypes"][dataType][dataName]["name"];
            var minVal = constJson["DataTypes"][dataType][dataName]["min"];
            var maxVal = constJson["DataTypes"][dataType][dataName]["max"];
            var lower_threshold = constJson["DataTypes"][dataType][dataName]["lower_threshold"];
            var upper_threshold = constJson["DataTypes"][dataType][dataName]["upper_threshold"];
            var unit = constJson["DataTypes"][dataType][dataName]["unit"];
            var resolution = constJson["DataTypes"][dataType][dataName]["resolution"];
            var hideValues = constJson["DataTypes"][dataType][dataName]["hideValues"];

            document.getElementById("keyTitle").innerHTML = name + " [" + unit + "]";
            document.getElementById("keyMaxVal").innerHTML = maxVal;
            document.getElementById("keyMinVal").innerHTML = minVal;

            if (upper_threshold != 0) {
                document.getElementById("keyUpperThreshold").innerHTML = upper_threshold;
                upperThresholdHeight = 403 - (upper_threshold-minVal)/(maxVal-minVal) * 397;
                document.getElementById("keyUpperThreshold").setAttribute("y", upperThresholdHeight);
                document.getElementById("upperThresholdMarker").setAttribute("d", "M -5," + (upperThresholdHeight -5) + " h10")
            }
            else {
                document.getElementById("keyThreshold").innerHTML = "";
                document.getElementById("upperThresholdMarker").setAttribute("d", "M 0,0 h0")
            }

            if (upper_threshold != 0) {
                document.getElementById("keyLowerThreshold").innerHTML = lower_threshold;
                lowerThresholdHeight = 403 - (lower_threshold-minVal)/(maxVal-minVal) * 397;
                document.getElementById("keyLowerThreshold").setAttribute("y", lowerThresholdHeight);
                document.getElementById("lowerThresholdMarker").setAttribute("d", "M -5," + (lowerThresholdHeight -5) + " h10")
            }
            else {
                document.getElementById("keyThreshold").innerHTML = "";
                document.getElementById("lowerThresholdMarker").setAttribute("d", "M 0,0 h0")
            }

            // option to not show values when data is skewed
            if (hideValues) {
                document.getElementById("keyMaxVal").innerHTML = "";
                document.getElementById("keyMinVal").innerHTML = "";
                document.getElementById("keyUpperThreshold").innerHTML = "";
                document.getElementById("keyLowerThreshold").innerHTML = "";
            }

            path = document.getElementById("keyToColours");
            keyDataset = [];
            nSteps = (maxVal - minVal)/resolution + 1;
            for (i=0; i<nSteps; i++) {
                keyDataset.push([0,i*resolution + minVal]);
            }
            colourPaths(keyDataset, minVal, maxVal, lower_threshold, upper_threshold, true, path);

        }


        // this function defines colours using min and max values using the FindColorStringGivenRange function
        // TODO: Add a threshold as a border between green and red values
        function ColorsByMinMax(dataset, min, max, lower_threshold, upper_threshold, changedDirection) {
            var colors = new Array();
            if (changedDirection) {
                for (let i = dataset.length; i > 0; i--) {
                    colors.push(FindColorStringGivenRange(dataset[i-1][1], min, max, lower_threshold, upper_threshold));
                }               
            }
            else {
                for (let i = 0; i < dataset.length; i++) {
                    colors.push(FindColorStringGivenRange(dataset[i][1], min, max, lower_threshold, upper_threshold));
                }
            }
            return colors;
        }

        // this function transforms a datapoint into an rgb colour using min and max values
        function FindColorStringGivenRange(value, min, max, lower_threshold, upper_threshold){
            // if there is a threshold defined
            if (upper_threshold != 0) {
                // from min to threshold go from green rgb(77,140,87) to yellow rgb(248,222,126)
                // halfthreshold = 0.5 * (upper_threshold-min)+min
                if (value <= lower_threshold) {
                    // var minR = 77;
                    // var maxR = 248;
                    // var minG = 140;
                    // var maxG = 222;
                    // var minB = 87;
                    // var maxB = 126;

                    var minR = 143;
                    var maxR = 248;
                    var minG = 210;
                    var maxG = 232;
                    var minB = 173;
                    var maxB = 144;

                    var R = ((value-min)/(lower_threshold - min)*(maxR-minR)) + minR;
                    var G = ((value-min)/(lower_threshold - min)*(maxG-minG)) + minG;
                    var B = ((value-min)/(lower_threshold - min)*(maxB-minB)) + minB;
                }
                // if value between threshold and 2* threshold go from yellow rgb(248,222,126) to red rgb(240,5,5)
                else if (value <= upper_threshold) {
                    // var minR = 248;
                    // var maxR = 240;
                    // var minG = 222;
                    // var maxG = 5;
                    // var minB = 126;
                    // var maxB = 5;

                    var minR = 248;
                    var maxR = 215;
                    var minG = 232;
                    var maxG = 109;
                    var minB = 144;
                    var maxB = 129;

                    var R = ((value-lower_threshold)/(upper_threshold-lower_threshold)*(maxR-minR)) + minR;
                    var G = ((value-lower_threshold)/(upper_threshold-lower_threshold)*(maxG-minG)) + minG;
                    var B = ((value-lower_threshold)/(upper_threshold-lower_threshold)*(maxB-minB)) + minB;
                }
                // if value between 2* threshold and 3* threshold go from red rgb(240,5,5) to purple rgb(48,25,52)
                else if (value <= 2*upper_threshold) {
                    // var minR = 240;
                    // var maxR = 48;
                    // var minG = 5;
                    // var maxG = 25;
                    // var minB = 5;
                    // var maxB = 52;

                    var minR = 215;
                    var maxR = 147;
                    var minG = 109;
                    var maxG = 103;
                    var minB = 129;
                    var maxB = 210;

                    var R = ((value-upper_threshold)/(2*upper_threshold-upper_threshold)*(maxR-minR)) + minR;
                    var G = ((value-upper_threshold)/(2*upper_threshold-upper_threshold)*(maxG-minG)) + minG;
                    var B = ((value-upper_threshold)/(2*upper_threshold-upper_threshold)*(maxB-minB)) + minB;
                }
                // if value higher than 3* threshold go from purple rgb(75,0,130) to black rgb(0,0,0)
                else {
                    var minR = 147;
                    var maxR = 126;
                    var minG = 103;
                    var maxG = 75;
                    var minB = 210;
                    var maxB = 75;

                    var R = ((value-2*upper_threshold)/(max-2*upper_threshold)*(maxR-minR)) + minR;
                    var G = ((value-2*upper_threshold)/(max-2*upper_threshold)*(maxG-minG)) + minG;
                    var B = ((value-2*upper_threshold)/(max-2*upper_threshold)*(maxB-minB)) + minB;
                }
            }
            // no threshold available
            else {
                var minRGB = 0;
                var maxRGB = 255;
                var rangeRGB = maxRGB;

                var valueRange = (max - min);
                var AdjustedValue = (((value - min) * rangeRGB) / valueRange) + minRGB;

                var R = AdjustedValue;
                var G = maxRGB - AdjustedValue;
                var B = 0;
            }

            return "rgb(" + R + "," + G + ", " + B + ")";
        }
    </script>

  </body>
</html>

