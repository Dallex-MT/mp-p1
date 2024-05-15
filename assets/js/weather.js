document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        // Llamamos a la función callAPI al cargar la página con los valores deseados
        const result = document.querySelector('.result');
        callAPI('Ambato', 'Ecuador');
        
        function callAPI(city, country) {
            const apiId = '41d1d7f5c2475b3a16167b30bc4f265c';
            const url = `http://api.openweathermap.org/data/2.5/weather?q=${city},${country}&appid=${apiId}`;
        
            fetch(url)
                .then(data => {
                    return data.json();
                })
                .then(dataJSON => {
                    if (dataJSON.cod === '404') {
                        showError('Ciudad no encontrada...');
                    } else {
                        clearHTML();
                        showWeather(dataJSON);
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        }
        
        function showWeather(data) {
            const {name, main: {temp, temp_min, temp_max}, weather: [arr]} = data;
        
            const degrees = kelvinToCentigrade(temp);
            const min = kelvinToCentigrade(temp_min);
            const max = kelvinToCentigrade(temp_max);
            let back = "";
    
            switch (arr.main) {
                case 'Clear':
                    back="sunny";
                    break;
                case 'Clouds':
                    back="cloud";
                    break;
                case 'Rain':
                    back="rain";
                    break;
                default:
                    back="normal";
                    break;
            }
        
            const content = document.createElement('div');
            content.innerHTML = `
                <div class="mdl-card mdl-shadow--2dp weather ${back}">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">Clima</h2>
        
                        <div class="mdl-layout-spacer"></div>
                        <div class="mdl-card__subtitle-text">
                            <i class="material-icons">room</i>
                            Ambato, Ecuador
                        </div>
                    </div>
                    <div class="mdl-card__supporting-text mdl-card--expand">
                        <img class="card-icono" src="https://openweathermap.org/img/wn/${arr.icon}@2x.png" alt="icon">
                        <p class="weather-temperature">${degrees}<sup>&deg;</sup></p>
                        <p class="weather-description">
                            Max ${max}°C <br> Min ${min}°C
                        </p>
                    </div>
                </div>
            `;
        
            result.appendChild(content);
        }
        
        function showError(message) {
            const alert = document.createElement('p');
            alert.classList.add('alert-message');
            alert.innerHTML = message;
        
            result.appendChild(alert);
            setTimeout(() => {
                alert.remove();
            }, 3000);
        }
        
        function kelvinToCentigrade(temp) {
            return parseInt(temp - 273.15);
        }
        
        function clearHTML() {
            result.innerHTML = '';
        }
    }, 500);
});
