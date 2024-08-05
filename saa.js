document.addEventListener("DOMContentLoaded", function() {
    const hakuNappi = document.getElementById("haku-nappi");
    const kaupunkiSyöte = document.getElementById("kaupunki-syöte");
    const sääData = document.querySelector(".säädata");
    const nykyinenSää = document.querySelector(".nykyinen-sää");

    hakuNappi.addEventListener("click", function() {
        const kaupunki = kaupunkiSyöte.value.trim();
        if(kaupunki !== "") {
            haeSää(kaupunki);
        } else {
            alert("Syötä kaupunki ensin.");
        }
    });

    async function haeSää(kaupunki) {
        const apiKey = "c49e0d0e1305e5e9ad1909e1f7cac7f8"; 
        const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${kaupunki}&appid=${apiKey}&units=metric&lang=fi`;

        try {
            const vastaus = await fetch(apiUrl);
            const data = await vastaus.json();
            if(vastaus.ok) {
                päivitäSää(data);
            } else {
                alert("Säätietoja ei löytynyt. Syötä toinen kaupunki.");
            }
        } catch(virhe) {
            console.error("Virhe tapahtui:", virhe);
            alert("Jotain meni pieleen. Yritä myöhemmin uudelleen.");
        }
    }

    function päivitäSää(data) {
        const lämpötila = data.main.temp;
        const tuulenNopeus = data.wind.speed;
        const kosteus = data.main.humidity;

        nykyinenSää.innerHTML = `
            <div>
                <h3 class="fw-bold">${data.name}</h3>
                <h6 class="my-5 mt-6">Lämpötila: ${lämpötila} °C</h6>
                <h6 class="my-5">Tuuli: ${tuulenNopeus} M/S</h6>
                <h6 class="my-5">Ilmankosteus: ${kosteus} %</h6>
            </div>
        `;

        sääData.style.display = "block"; 
    }
});
