//import './node_modules/dotenv/config.js';

const x = document.getElementById("location");
const position = document.getElementsByName("place");
const button = $("#btnSubmit");
const inputS = $("#placeSearch");
const datalist = $("#locations");

const butToday = $("#todayWeather");
const butTomorrow = $("#tomorrowWeather");
const butWeak = $("#weakWeather");

const contToday = $("#todayContainer");
const contTomorrow = $("#tomorrowContainer");
const contWEak = $("#weakContainer");

function sendGeoLocation(position) {

    $.ajax({
        url: '/SetGeoLocation',
        method: 'post',
        dataType: "json",
        data: {latitude: position.coords.latitude, longitude: position.coords.longitude},
        success: function(data){
            console.log(data)
        },
        error: function (data){
            alert(data);
        }
    });
}

butToday.on('click', function(){
    contTomorrow.css('visibility', 'hidden');
    contWEak.css('visibility', 'hidden');
    contToday.css('visibility', 'visible');
})

butTomorrow.on('click', function(){
    contToday.css('visibility', 'hidden');
    contWEak.css('visibility', 'hidden');
    contTomorrow.css('visibility', 'visible');
})

butWeak.on('click', function(){
    contTomorrow.css('visibility', 'hidden');
    contToday.css('visibility', 'hidden');
    contWEak.css('visibility', 'visible');
})

inputS.on('input', function(){
    datalist.innerHTML = '';
    // let api = process.env.YANDEX_GEOCODER;
    // console.log(api);
    $.ajax({
        url: `https://geocode-maps.yandex.ru/1.x/?apikey=33358b54-d3e0-4033-a4bf-88814b3c07d4&format=json`,
        method: 'get',
        dataType: "json",
        data: {geocode: $("#placeSearch").val()},
        success: function(data){
            let locations = data.response.GeoObjectCollection.featureMember;
            //console.log(locations);
            locations.forEach(function (loca){
                var el = document.createElement('option');
                el.value = loca.GeoObject.metaDataProperty.GeocoderMetaData.text;
                datalist.append(el);
            })
        },
        error: function (data){
        }
    });
})