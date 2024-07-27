const listFarms = document.querySelectorAll(".list-farms");

listFarms.forEach((farm, index) => {
    if (farm) {
        const farmid = farm.getAttribute("data-farmid");
        
        if (farmid === null) return;

        farm.addEventListener("click", () => { // Removed unnecessary argument
            const form = document.getElementById("welcomefarms");

            if (form) { // Check if form exists before fetching data
                const url_action = form.getAttribute('action') + farmid;
                fetch(url_action,
                    {
                        method: "GET"
                    })
                    .then(response => response.json())
                    .then(data => {
                        let farmName =document.getElementById('farmName');
                        let farmId =document.getElementById('farmId');
                        let buttonFarm =document.getElementById('viewfarm');
                        if(farmName)farmName.innerHTML ="<i class=\"ico ico_farm mr-1\"></i> " + data.data[0].Nombre;
                        if(farmId)farmId.innerHTML ="<i class=\"ico ico_idfarm\"></i>ID: " + data.data[0].id_Finca;
                        if(buttonFarm) {
                            const href = buttonFarm.getAttribute('href');
                            buttonFarm.setAttribute('href', 'dashboard/finca/rebano/' +  data.data[0].id_Finca);
                        }
                    })
                    .catch(error => console.error(error));
            } else {
                console.error("Form element not found. Cannot fetch data.");
            }
        });
    }
});
//gap reveals 